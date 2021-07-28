@extends('new_email.layout')
@section('content')
    <tr>
        <td style="padding-left: 80px;">Dear Admin,</td>
    </tr>
    <tr>
        <td style="padding-left: 80px; padding-right: 80px">
            <p>Customer name : {{ $user_name }} , User id : {{ $user_id }} has requested for payment of {{ $amount }} BDT he/she is reachable at the following number/email: {{ $phone_no ?? $email }}. Please process the payment at your convenience. </p>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 80px;">
            <p style="margin-top: 40px; margin-bottom: 8px;">Cheers,</p> <b>The GameHub</b>
        </td>
    </tr>
@endsection
