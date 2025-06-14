@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Your Order Status</h1>
  <div class="status-list">
    @foreach ($orders as $order)
    <div class="status-item">
      <strong>{{ $order->product->name }}</strong> — Qty: {{ $order->quantity }} —
      <span class="{{ $order->status == 'pending' ? 'pending' : 'completed' }}">
        {{ ucfirst($order->status) }}
      </span> — {{ $order->created_at->format('Y-m-d') }}
    </div>
    @endforeach
  </div>
</div>
@endsection
