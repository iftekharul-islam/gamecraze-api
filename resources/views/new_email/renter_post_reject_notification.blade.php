@extends('new_email.layout')
@section('content')
    <tr>
        <td>
            Dear {{ $name }},
        </td>
    </tr>
    <tr>
        <td>
            <p>Thanks for trusting GameHub. Your Rent post for {{ $game }} is rejected due : {{ $reason }}.
                If you want to earn money by lending your unused games make sure your games maintaining our rules.
                Better luck next time!
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <p style="margin-top: 40px; margin-bottom: 8px;">Cheers,</p> <b>The GameHub</b>
        </td>
    </tr>
@endsection


