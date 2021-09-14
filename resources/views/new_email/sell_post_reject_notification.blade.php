@extends('new_email.layout')
@section('content')
    <tr>
        <td style="padding-left: 80px; ">Dear {{ $user->name }},</td>
    </tr>
    <tr>
        <td style="padding-left: 80px; padding-right: 80px">
            <p>Thanks for trusting GameHub. Your Sell post for product no {{ $product->product_no }} is rejected due to:
                {{ $product->reason }}.
            </p>
            <p>Please resolve this issue and contact to gamehub team</p>
        </td>
    </tr>
    <tr>
        <td style="padding-left: 80px; ">
            <p style="margin-top: 40px; margin-bottom: 8px;">Cheers,</p> <b>The GameHub</b>
        </td>
    </tr>
@endsection
