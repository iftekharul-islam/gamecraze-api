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
                Thanks for trusting GameHub. Your order of renting {{ $order->order_no }} is processed. The game(s) is delivered to: {{ $order->address }}. The rent count down will start from next date after delivery.
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
