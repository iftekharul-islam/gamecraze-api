@extends('new_email.layout')
@section('content')
    <tr>
        <td>
            Dear concern,
        </td>
    </tr>
    <tr>
        <td>
            <a href="{{ $link }}" style="background: #FFD715; width: 120px; height: 35px; display: flex;align-items: center;justify-content: center; color: black;margin: auto;  text-decoration: none; font-weight: 700;">Reset Now</a>
        </td>
    </tr>
    <tr>
        <td>
            <p style="margin-top: 40px; margin-bottom: 8px;">Cheers,</p> <b>The GameHub</b>
        </td>
    </tr>
@endsection



