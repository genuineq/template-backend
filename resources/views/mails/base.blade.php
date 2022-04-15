@component('mail::message')
[![Fera logo]({{ $logoPath }})]({{ $headerUrl }})

@yield('content')

Thanks,<br />
{{ config('app.name') }}
@endcomponent
