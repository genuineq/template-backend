@component('mail::message')
### You have changed your password successfully.<br />

### If you did changed your password, no further action is required.<br /><br />

Thanks,<br />
{{ config('app.name') }}<br /><br /><br />

If you did not change password, contact our support.
@endcomponent
