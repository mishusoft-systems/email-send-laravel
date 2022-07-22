@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            Wonderful Company
        @endcomponent
    @endslot
    Dear {{$user->name}}


    <h2>{{ $new_message->title }}</h2>

    <p>{{ $new_message->body }}</p>

    click on the link below to see more


    @component('mail::button', ['url' => route('user.response', ['user' => $user->id, 'type'=>'message', 'id'=>$new_message->id])])
        View Message
    @endcomponent

    If you want to opt out this message, you can <a href="{{ route('user.unsubscribe', ['user_hash' => md5($user->id)]) }}" > unsubscribe </a> anytime.

    Regards,<br>
    Wonderful Company Support Team

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            <!-- footer here -->
            {{ date('Y') }} | Wonderful Company
        @endcomponent
    @endslot
@endcomponent
