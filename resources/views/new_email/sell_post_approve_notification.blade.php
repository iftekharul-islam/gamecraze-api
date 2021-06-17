@extends('new_email.layout')
@section('content')
    <tr>
        <td style="padding-left: 80px; ">Dear {{ $user->name }},</td>
    </tr>
    <tr>
        <td style="padding-left: 80px; padding-right: 80px">
            <p>Thanks for trusting GameHub. Your sell post for product no: {{ $product->product_no }} is approved.
                If anyone wants to rent your game we will let you know.
                Keep posting more to earn more.</p>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 80px; ">
            <p style="margin-top: 40px; margin-bottom: 8px;">Cheers,</p> <b>The GameHub</b>
        </td>
    </tr>
@endsection
