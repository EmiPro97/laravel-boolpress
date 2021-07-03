@component('mail::message')
# You have a new message!

**Name:** {{ $contact['name'] }}

**Email:** {{ $contact['email'] }}

**Message:** {{ $contact['message'] }}

@component('mail::button', ['url' => ''])
View Order
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent