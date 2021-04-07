@extends('new_email.layout')
@section('content')
    <tr>
        <td>Dear {{ $name }},</td>
    </tr>
    <tr>
        <td>
            <p>
                Thanks for trusting GameHub. Your order of renting {{ $order->order_no }} is completed. To avoid any penalty please prepare the game(s) for return. To process the return someone from our team will contact you soon.
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <p style="margin-top: 40px; margin-bottom: 8px;">Cheers,</p> <b>The GameHub</b>
        </td>
    </tr>
@endsection
