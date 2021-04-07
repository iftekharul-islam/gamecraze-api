@extends('new_email.layout')
@section('content')
    <tr>
        <td>
            Dear concern,
        </td>
    </tr>
    <tr>
        <td>
            <p>Your Game: {{ $game }}is rented successfully</p>
        </td>
    </tr>
    <tr>
        <td>
            <p style="margin-top: 40px; margin-bottom: 8px;">Cheers,</p> <b>The GameHub</b>
        </td>
    </tr>
@endsection

