@extends('layouts.admin')
@section('content')

<div class="bg-white p-8 shadow rounded-lg print:p-0">

<h2 class="text-center text-2xl font-bold mb-4">Production Invoice</h2>

<p><strong>Reference:</strong> {{ $production->reference_no }}</p>
<p><strong>Date:</strong> {{ $production->created_at }}</p>

<table class="w-full mt-6 border">
<thead class="bg-gray-100">
<tr>
<th class="p-2">Raw Material</th>
<th class="p-2">Qty</th>
<th class="p-2">Cost</th>
</tr>
</thead>
<tbody>
@foreach($production->rawMaterials as $rm)
<tr class="border-t">
<td class="p-2">{{ $rm->rawMaterial->title }}</td>
<td class="p-2">{{ $rm->used_qty }}</td>
<td class="p-2">₹ {{ $rm->total_cost }}</td>
</tr>
@endforeach
</tbody>
</table>

<div class="mt-6 text-right">
<p>Total Cost: ₹ {{ $production->total_production_cost }}</p>
<p>Total Profit: ₹ {{ $production->profit }}</p>
</div>

<button onclick="window.print()"
class="mt-6 bg-blue-600 text-white px-4 py-2 rounded print:hidden">
Print
</button>

</div>

@endsection
