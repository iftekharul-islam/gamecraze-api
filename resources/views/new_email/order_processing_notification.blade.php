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
                Thanks for trusting GameHub. Your order of renting {{ $order->order_no }} is under processing. The game(s) will be delivered to {{ $order->address }} within 72 hours. The rent count down will start once you have the game(s) in your hand.
            </p>
            <p> We hope you will enjoy playing & to save more money rent more games ;)</p>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 80px; ">
            <p style="margin-top: 40px; margin-bottom: 8px;">Cheers,</p> <b>The GameHub</b>
        </td>
    </tr>
@endsection

