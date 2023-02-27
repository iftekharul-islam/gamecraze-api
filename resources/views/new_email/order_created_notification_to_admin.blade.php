@extends('new_email.layout')
@section('content')
    <tr>
        <td style="padding-left: 80px;">Dear Admin,</td>
    </tr>
    <tr>
        <td style="padding-left: 80px; padding-right: 80px">
            <p> New Order available, Please review this Order.</p>
            <p> Order no : {{ $order }}</p>
            <p> Customer name: {{ $customer }}</p>
            <p> Game(s) : {{ $games }}</p>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 80px;">
            <p style="margin-top: 40px; margin-bottom: 8px;">Cheers,</p> <b>The GameHub</b>
        </td>
    </tr>
@endsection
