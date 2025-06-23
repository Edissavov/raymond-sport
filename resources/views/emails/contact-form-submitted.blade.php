@component('mail::layout')
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            {{ config('app.name') }}
        @endcomponent
    @endslot

    # New Contact Form Submission

    **Name:** {{ $contact->name }}
    **Email:** {{ $contact->email }}
    **Phone:** {{ $contact->phone ?? 'Not provided' }}
    **Subject:** {{ $contact->subject }}

    **Message:**
    {{ $contact->message }}

    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
        @endcomponent
    @endslot
@endcomponent