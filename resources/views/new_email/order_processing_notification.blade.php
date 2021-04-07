@extends('new_email.layout')
@section('content')
    <tr>
        <td>
            Dear {{ $name }},
        </td>
    </tr>
    <tr>
        <td>
            <p>
                Thanks for trusting GameHub. Your order of renting {{ $order->order_no }} is under processing. The game(s) will be delivered within 72 hours. The rent count down will start once you have the game(s) in your hand.
            </p>
            <p> We hope you will enjoy playing & to save more money rent more games ;)</p>
        </td>
    </tr>
    <tr>
        <td>
            <p style="margin-top: 40px; margin-bottom: 8px;">Cheers,</p> <b>The GameHub</b>
        </td>
    </tr>
@endsection

