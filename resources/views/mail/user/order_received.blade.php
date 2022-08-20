@extends('mail.layouts')

@section('mail-content')
    <tr>
        <td style="padding: 48px 24px 0; color: #161c2d; font-size: 18px; font-weight: 600;">
            Hello {{ $user->name }},
        </td>
    </tr>
    <tr>
        <td style="padding: 15px 24px 15px; color: #8492a6;">
            You've just received an order request. Please respond as soon as possible.
        </td>
    </tr>

    <tr>
        <td style="padding: 48px 24px 0; color: #161c2d; font-size: 18px; font-weight: 600;">
            Order No: <a href="{{ route('user.order', $order->order_no) }}" target="_blank">#{{ $order->order_no }}</a>
        </td>
    </tr>

    <tr>
        <td style="padding: 15px 24px;">
            <a href="{{ route('user.dashboard') }}" style="padding: 8px 20px; outline: none; text-decoration: none; font-size: 16px; letter-spacing: 0.5px; transition: all 0.3s; font-weight: 600; border-radius: 6px; background-color: #f85c70; border: 1px solid #f85c70; color: #ffffff;">Dashboard</a>
        </td>
        
    </tr>
    <tr>
        <td style="padding: 15px 24px;">
            <a href="{{  route('user.chat') }}?active={{ $order->transaction->user->id }}" style="padding: 8px 20px; outline: none; text-decoration: none; font-size: 16px; letter-spacing: 0.5px; transition: all 0.3s; font-weight: 600; border-radius: 6px; background-color: #4285f4;border: 1px solid #4285f4; color: #ffffff;">Chat With User</a>
        </td>
    </tr>

    <tr>
        <td style="padding: 15px 24px 15px; color: #8492a6;">
            {{ config("app.name") }} <br> Support Team
        </td>
    </tr>

    <tr>
        <td style="padding: 15px 24px 0; color: #8492a6; font-size: 13px; font-weight: 400;">
            If you’re having trouble clicking the "Dashboard" button, copy and paste the URL below into your web browser:
            <a href="{{ route('user.dashboard') }}" target="_blank" style="text-decoration: underline; color: #3869d4;">{{ route('user.dashboard') }}</a>
        </td>
    </tr>
@endsection
