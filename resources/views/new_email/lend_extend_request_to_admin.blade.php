@extends('new_email.layout')
@section('content')
    <tr>
        <td style="padding-left: 80px;">Dear Admin,</td>
    </tr>
    <tr>
        <td style="padding-left: 80px; padding-right: 80px">
            <p> New lend extend request available, please review this post and take an appropriate action.</p>
            <p> Order no : {{ $order_no }}</p>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 80px;">
            <p style="margin-top: 40px; margin-bottom: 8px;">Cheers,</p> <b>The GameHub</b>
        </td>
    </tr>
@endsection
