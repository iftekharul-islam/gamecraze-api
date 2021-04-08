@extends('new_email.layout')
@section('content')
    <tr>
        <td style="padding-left: 80px; ">
            Dear admin,
        </td>
    </tr>
    <tr>
        <td style="padding-left: 80px; padding-right: 80px">
            <h5>Dear admin, </h5>
            <p>New contact request from Gamehub</p>
            <p>Name: {{ $data['first_name'] }} {{ $data['last_name'] }}</p>
            <p>Phone: {{ $data['phone_number'] }}</p>
            <p>Email: {{ $data['email'] }}</p>
            <p>Message:</p>
            <p>{{ $data['message'] }}</p>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 80px; ">
            <p style="margin-top: 40px; margin-bottom: 8px;">Cheers,</p> <b>The GameHub</b>
        </td>
    </tr>
@endsection




