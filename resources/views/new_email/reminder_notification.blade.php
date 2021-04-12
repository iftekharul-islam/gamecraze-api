@extends('new_email.layout')
@section('content')
    <tr>
        <td style="padding-left: 80px; ">
            Dear concern,
            <p>
                Greetings from GameHub.
                You opted for a reminder for {{ $game }} & the game is now available for rent.
                Please rent the immediately to avoid more waiting time.
            </p>
        </td>
    </tr>
{{--    <tr>--}}
{{--        <td style="text-align: center; padding-left: 80px;">--}}
{{--            <p>To get the game link, click the button below:</p>--}}
{{--            <a href="{{ $link }}"><img src="{{ asset('email_image/reset.png') }}" alt="reset" style="margin-top: 32px; margin-bottom: 32px;"></a>--}}
{{--        </td>--}}
{{--    </tr>--}}
    <tr>
        <td style="padding-left: 80px; ">
            <p style="margin-top: 40px; margin-bottom: 8px;">Cheers,</p> <b>The GameHub</b>
        </td>
    </tr>
@endsection



