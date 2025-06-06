
@component('mail::message')
  # Introduction
  Welcome {{ $data['data']->name }}
  The body of your message.

  @component('mail::button', ['url' => url('reset/password/' . $data['token']) ])
    Reset Password
  @endcomponent


  Thanks,<br>
  {{ config('app.name') }}
@endcomponent
