<!-- =============================== -->
<!--  Inventory Create Form (inventory/create.blade.php) -->
<!-- =============================== -->
@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Add or Update Inventory</h1>

  <form method="POST" action="{{ route('inventory.store') }}">
    @csrf
    <label for="product_id">Select Product:</label>
    <select name="product_id" class="qty-input" required>
      <option value="" disabled selected>Select a product</option>
      @foreach ($products as $product)
        <option value="{{ $product->id }}">{{ $product->name }}</option>
      @endforeach
    </select>

    <label for="batch_id">Batch ID (Optional):</label>
    <input type="text" name="batch_id" class="qty-input">

    <label for="quantity">Quantity to Add:</label>
    <input type="number" name="quantity" class="qty-input" min="1" required>

    <button type="submit" class="order-btn">Update Inventory</button>
  </form>
</div>
@endsection
