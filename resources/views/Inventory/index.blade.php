<!-- =============================== -->
<!-- 1. Inventory Index (inventory/index.blade.php) -->
<!-- =============================== -->
@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Inventory Dashboard</h1>
  <a href="{{ route('inventory.create') }}" class="btn green" style="margin-bottom: 15px; display: inline-block;">Add Stock</a>

  <canvas id="inventoryChart" height="100"></canvas>

  <table style="margin-top: 30px;">
    <thead>
      <tr><th>Product</th><th>Batch ID</th><th>Available Quantity</th><th>Last Updated</th></tr>
    </thead>
    <tbody>
      @foreach ($inventory as $item)
      <tr>
        <td>{{ $item->product->name }}</td>
        <td>{{ $item->batch_id ?? 'N/A' }}</td>
        <td>{{ $item->quantity }} @if ($item->quantity < 10) <span style="color: red; font-weight: bold;">(Low)</span> @endif</td>
        <td>{{ $item->updated_at->format('Y-m-d H:i') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('inventoryChart').getContext('2d');
  const inventoryChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
        @foreach ($inventory as $item)
          '{{ $item->product->name }}',
        @endforeach
      ],
      datasets: [{
        label: 'Stock Quantity',
        data: [
          @foreach ($inventory as $item)
            {{ $item->quantity }},
          @endforeach
        ],
        backgroundColor: '#10b981',
        borderRadius: 6
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: { display: false },
        title: {
          display: true,
          text: 'Inventory Stock Levels by Product'
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 5
          }
        }
      }
    }
  });
</script>
@endsection

