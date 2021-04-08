@extends('new_email.layout')
@section('content')
    <tr>
        <td style="padding-left: 80px; ">Dear Admin,</td>
    </tr>
    <tr>
        <td style="padding-left: 80px; padding-right: 80px">
            <p> Customer name: {{ $lend->lender->name }} & Borrowed game : {{ $lend->rent->game->name }}</p>
            <p> Deadline date is {{ $end_date }} and only 1 days left </p>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 80px; ">
            <p style="margin-top: 40px; margin-bottom: 8px;">Cheers,</p> <b>The GameHub</b>
        </td>
    </tr>
@endsection
