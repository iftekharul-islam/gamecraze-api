@extends('new_email.layout')
@section('content')
    <tr>
        <td style="padding-left: 80px; ">
            Dear {{ $name }},
        </td>
    </tr>
    <tr>
        <td style="padding-left: 80px; padding-right: 80px">
            <p>
                Thanks for trusting GameHub. Your order of renting {{ $order }} and game : {{ $game }} is processed. The game is delivered to: {{ $address }}. The rent count down will start from next date after delivery.
            </p>
            @if($game_id != null)
                <p>Account User Id: {{ $game_id }}</p>
                <p>Account Password: {{ $game_password }}</p>
            @endif
            <p> We hope you will enjoy playing & to save more money rent more games ;)</p>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 80px; ">
            <p style="margin-top: 40px; margin-bottom: 8px;">Cheers,</p> <b>The GameHub</b>
        </td>
    </tr>
@endsection
