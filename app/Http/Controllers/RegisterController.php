<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RecoverPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request): object
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        $success['name'] = $user->name;

        return $this->sendResponse($success, 'Registration successful.');
    }

    public function login(LoginRequest $request): object
    {
        $credentials = $request->validated();

        if (!Auth::attempt($credentials)) {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }

        $user = Auth::user();
        $success['token'] =  $user->createToken('Authorization')->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User login successfully.');
    }

    public function recoverPassword(RecoverPasswordRequest $request): object
    {
        $validated = $request->validated();

        $user = User::whereEmail($validated['email'])->first();

        $passwordReset = $validated['email'];

        if ($user) {
            $passwordReset = PasswordReset::updateOrCreate(
                ['email' => $user->email],
                [
                    'email' => $user->email,
                    'token' => Str::random(60)
                ]
            );

            $url = config('app.frontend_url') . '/dashboard/reset/' . $passwordReset->token;
            $data = array(
                'name' => $user->name,
                'url' => $url
            );

            Mail::to($user->email)->send(new SendRecoverPasswordMail($data));
        }

        return $this->sendResponse($passwordReset, 'Mail was sent successfully');
    }

    public function resetPassword(ResetPasswordRequest $request): object
    {
        $validated = $request->validated();

        $resetToken = PasswordReset::where('token', $validated['token'])->first();

        if (!$resetToken) {
            return $this->sendError('Not found.', ['error' => 'This password reset token is invalid.']);
        }

        $user = User::whereEmail($resetToken->email)->first();

        if (!$user) {
            return $this->sendError('Not found.', ['error' => 'We can\'t find a user with that e-mail address.']);
        }

        $user->password = Hash::make($validated['password']);
        $user->save();

        $resetToken->delete();

        Mail::to($user->email)->send(new PasswordChangedMail());

        return $this->sendResponse(true, 'Password changed successfully.');
    }

    public function logout(): object
    {
        Auth::user()->tokens()->delete();

        return $this->sendResponse(true, 'User logged out successfully.');
    }
}
