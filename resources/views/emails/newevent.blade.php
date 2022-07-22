@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Wonderful Company
        @endcomponent
    @endslot
    Dear {{$user->name}}


    <h2>{{ $new_event->title }}</h2>

    <p>{{ $new_event->description }}</p>
    <p>{{ $new_event->venue }}</p>

    click on the link below to see more


    @component('mail::button', ['url' => url('/')])
        View Event
    @endcomponent

    Regards,<br>
    Wonderful Company Support Team

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <!-- footer here -->
        @endcomponent
    @endslot
@endcomponent
