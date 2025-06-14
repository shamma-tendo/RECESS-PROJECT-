
@extends('layouts.app')

@section('content')

<div class="container">
  <h1>Available Products</h1>
  <div class="product-list">
    @foreach ($products as $product)
    <div class="card">
      <h2>{{ $product->name }}</h2>
      <p>Type: {{ $product->type }}</p>
      <p>Price: {{ number_format($product->price) }} UGX</p>
      <p>Available: <span class="stock">{{ $product->inventory->quantity ?? 0 }}</span></p>
      <input type="number" class="qty-input" placeholder="Qty" min="1">
      <button class="order-btn">Order</button>
    </div>
    @endforeach
  </div>
</div>

<!-- Modal & Toast -->
<div class="modal hidden">
  <div class="modal-box">
    <p class="modal-message">Confirm your order?</p>
    <div class="modal-actions">
      <button id="confirmOrder" class="btn green">Confirm</button>
      <button id="cancelOrder" class="btn red">Cancel</button>
    </div>
  </div>
</div>
<div id="toast" class="toast hidden">Order placed successfully!</div>
@endsection

