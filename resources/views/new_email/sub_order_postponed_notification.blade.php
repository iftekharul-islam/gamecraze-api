@extends('new_email.layout')
@section('content')
    <tr>
        <td style="padding-left: 80px; ">
            Dear {{ $user }},
        </td>
    </tr>
    <tr>
        <td style="padding-left: 80px; padding-right: 80px">
            <p>
                Thanks for trusting GameHub. Your order of renting game : {{ $game }} of order {{ $order }} is postponed due occupied lender's account. Someone from our team will call you soon with the expected date of delivery.
            </p>
            <p> We hope you will enjoy playing & to save more money rent more games ;)</p>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 80px; ">
            <p style="margin-top: 40px; margin-bottom: 8px;">Cheers,</p> <b>The GameHub</b>
        </td>
    </tr>
@endsection

