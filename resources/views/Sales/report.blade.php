@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Admin Sales Report</h1>
  <p><strong>Total Revenue:</strong> UGX {{ number_format($totalRevenue) }}</p>
  <table>
    <thead>
      <tr><th>Product</th><th>Qty</th><th>Date</th></tr>
    </thead>
    <tbody>
      @foreach ($sales as $order)
      <tr>
        <td>{{ $order->product->name }}</td>
        <td>{{ $order->quantity }}</td>
        <td>{{ $order->created_at->format('Y-m-d') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
