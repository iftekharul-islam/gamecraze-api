@extends('new_email.layout')
@section('content')
    <tr>
        <td style="padding-left: 80px; ">Dear {{ $name }},</td>
    </tr>
    <tr>
        <td style="padding-left: 80px; padding-right: 80px">
            <p>
                Thanks for trusting GameHub.
                Your order of renting {{ $order->order_no }} is over.
                To avoid any penalty please prepare the game(s) for return.
                To process the return someone from our team will contact you soon.
            </p>
            <p>We hope you will enjoy playing the rented game(s). To save more money, rent more.</p>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 80px; ">
            <p style="margin-top: 40px; margin-bottom: 8px;">Cheers,</p> <b>The GameHub</b>
        </td>
    </tr>
@endsection
