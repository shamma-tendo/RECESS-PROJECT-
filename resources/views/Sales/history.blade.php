@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Order History</h1>
  <table>
    <thead>
      <tr><th>Product</th><th>Quantity</th><th>Status</th><th>Date</th></tr>
    </thead>
    <tbody>
      @foreach ($orders as $order)
      <tr>
        <td>{{ $order->product->name }}</td>
        <td>{{ $order->quantity }}</td>
        <td>{{ ucfirst($order->status) }}</td>
        <td>{{ $order->created_at->format('Y-m-d') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
