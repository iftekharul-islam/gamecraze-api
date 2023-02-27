@extends('new_email.layout')
@section('content')
    <tr>
        <td style="padding-left: 80px; ">
            Dear concern,
        </td>
    </tr>
    <tr>
        <td style="padding-left: 80px; ">
            <p>Thanks for trusting GameHub. Your order of renting {{ $order }} is confirmed.</p>
            <p>You Lend the game(s): {{$games}} successfully.We will start processing your order soon.</p>
            <p>We hope you will enjoy the games you rented & to save more money rent more games ;) </p>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 80px; ">
            <p style="margin-top: 40px; margin-bottom: 8px;">Cheers,</p> <b>The GameHub</b>
        </td>
    </tr>
@endsection
