@extends('new_email.layout')
@section('content')
    <tr>
        <td style="padding-left: 80px; ">Dear {{ $name }},</td>
    </tr>
    <tr>
        <td style="padding-left: 80px; padding-right: 80px">
            <p>Thanks for trusting GameHub. Your extend request for {{ $game }} is approved.</p>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 80px; ">
            <p style="margin-top: 40px; margin-bottom: 8px;">Cheers,</p> <b>The GameHub</b>
        </td>
    </tr>
@endsection
