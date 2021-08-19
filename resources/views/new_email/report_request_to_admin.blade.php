@extends('new_email.layout')
@section('content')
    <tr>
        <td style="padding-left: 80px;">Dear Admin,</td>
    </tr>
    <tr>
        <td style="padding-left: 80px; padding-right: 80px">
            <p> New post report request available, please review this report and take an appropriate action.</p>
            <p> Reporter name : {{ $report->name }}</p>
            <p> Reporter email/phone : {{ $report->email ?? $report->phone_no }}</p>
            <p> Post id : {{ $report->product_id }}</p>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 80px;">
            <p style="margin-top: 40px; margin-bottom: 8px;">Cheers,</p> <b>The GameHub</b>
        </td>
    </tr>
@endsection
