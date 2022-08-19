@extends('layouts.user')

@section('title', 'Order Details')

@section('content')
<div class="border-bottom pb-4">
    <h4 class="mb-0 pb-0">Order #{{ $order->order_no }}</h4>
    <small class="text-muted">Buyer: <strong>{{ $order->transaction->user->name }}</strong> | {{ $order->created_at->format('M d, Y') }}</small>
    <br>
    @if ($order->status == "1")
        <span class="badge bg-soft-dark">Active</span>
    @elseif ($order->status == "2")
        <span class="badge bg-soft-success">Completed</span>
    @elseif ($order->status == "3")
        <span class="badge bg-soft-danger">Declined</span>
    @endif
</div>
<div class="table-responsive bg-white shadow mt-4">
    <table class="table table-center table-padding mb-0">
        <thead>
            <tr>
                <th class="border-bottom py-3" style="min-width: 300px;">Product</th>
            </tr>
        </thead>

        <tbody>
            <tr class="shop-list">
                <td>
                    <div class="d-flex align-items-center">
                        <img src="{{ asset($order->listing->featured_image) }}" class="img-fluid avatar avatar-small rounded shadow" style="height:auto;" alt="">
                        <h6 class="mb-0 ms-3">{{ $order->listing->title }}</h6>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

@if ($order->status == "1")
<div class="text-center mt-4">
    <button type="button" onclick="alertMessage('{{ route('user.order.status', [$order->order_no, 'accept']) }}', 'You want to mark this request delivered!')" class="btn btn-primary">Mark as Delivered</button>
    <button type="button" onclick="alertMessage('{{ route('user.order.status', [$order->order_no, 'decline']) }}', 'You want to Decline this order request!')" class="btn btn-secondary">Decline</button>
</div>
@endif
@endsection
