@extends('layouts.admin')

@section('content')

<style>
.fade-in{animation:fadeIn .45s ease-out}
@keyframes fadeIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}

.glass{backdrop-filter:blur(12px);background:rgba(255,255,255,.65)}
.card{border-radius:1rem;box-shadow:0 20px 25px rgba(0,0,0,.15);padding:1.5rem;background:white}
.lift{transition:.25s}
.lift:hover{transform:translateY(-2px);box-shadow:0 8px 18px rgba(0,0,0,.15)}

.modal-overlay{background:rgba(0,0,0,.55);backdrop-filter:blur(4px)}
.modal-box{animation:pop .35s ease-out}
@keyframes pop{from{transform:scale(.85);opacity:0}to{transform:scale(1);opacity:1}}
</style>

<div class="max-w-6xl mx-auto fade-in">

<!-- HEADER -->
<div class="p-6 rounded-2xl shadow-xl bg-gradient-to-r from-indigo-700 to-blue-600 text-white mb-8">
<div class="flex justify-between items-center">

<div>
<h1 class="text-3xl font-extrabold">Estimate / Quotation</h1>
<p class="text-lg mt-1">#{{ $estimateQuotation->estimate_quotations_number }}</p>
</div>

<div class="flex gap-3">

@if($estimateQuotation->status !== 'converted')
<button onclick="openConfirmModal('convert')" class="lift bg-green-500 px-4 py-2 rounded-lg font-semibold shadow">
<i class="fas fa-sync-alt mr-1"></i> Convert
</button>
@else
<button disabled class="px-4 py-2 rounded-lg bg-gray-300 text-gray-700">
<i class="fas fa-check-circle mr-1"></i> Converted
</button>
@endif

@if($estimateQuotation->status !== 'converted')
<button onclick="openConfirmModal('cancel')" class="lift bg-red-500 px-4 py-2 rounded-lg font-semibold shadow">
<i class="fas fa-times mr-1"></i> Cancel
</button>
@endif

<button onclick="openDateModal()" class="lift bg-yellow-400 px-4 py-2 rounded-lg font-semibold text-gray-900">
<i class="fas fa-calendar-alt mr-1"></i> Update Date
</button>

<a href="{{ route('admin.estimate-quotations.invoice',$estimateQuotation->id) }}" target="_blank"
class="lift bg-white text-indigo-700 px-4 py-2 rounded-lg font-semibold shadow">
<i class="fas fa-print mr-1"></i> Print
</a>

</div>
</div>
</div>

<!-- CUSTOMER -->
<div class="card mb-8">
<h2 class="text-xl font-semibold mb-4">Customer Information</h2>
<div class="grid grid-cols-2 gap-4 text-gray-700">
<p><b>Name:</b> {{ $estimateQuotation->select_customer->party_name }}</p>
<p><b>Phone:</b> {{ $estimateQuotation->select_customer->phone_number }}</p>
<p><b>GSTIN:</b> {{ $estimateQuotation->select_customer->gstin }}</p>
<p><b>Billing:</b> {{ $estimateQuotation->billing_address }}</p>
<p><b>Delivery:</b> {{ $estimateQuotation->shipping_address }}</p>
<p><b>Cost Centers:</b> {{ $estimateQuotation->main_cost_centers_id }} / {{ $estimateQuotation->sub_cost_centers_id }}</p>
</div>
</div>

<!-- ITEMS -->
<div class="card mb-8">
<h2 class="text-xl font-semibold mb-4">Items</h2>
<table class="w-full border">
<thead class="bg-gray-100">
<tr>
<th class="p-2">Item</th>
<th class="p-2">Qty</th>
<th class="p-2">Rate</th>
<th class="p-2">Tax</th>
<th class="p-2 text-right">Amount</th>
</tr>
</thead>
<tbody>
@foreach($estimateQuotation->items as $it)
<tr class="border-t">
<td class="p-2">{{ $it->item_name }}</td>
<td class="p-2">{{ $it->pivot->qty }}</td>
<td class="p-2">₹{{ number_format($it->pivot->price,2) }}</td>
<td class="p-2">{{ $it->pivot->tax }}%</td>
<td class="p-2 text-right font-bold">₹{{ number_format($it->pivot->amount,2) }}</td>
</tr>
@endforeach
</tbody>
</table>
</div>

<!-- SUMMARY -->
<div class="card mb-20 text-right">
<p>Subtotal: ₹{{ number_format($estimateQuotation->subtotal,2) }}</p>
<p>Tax: ₹{{ number_format($estimateQuotation->tax,2) }}</p>
<p>Discount: ₹{{ number_format($estimateQuotation->discount,2) }}</p>
<p class="text-2xl font-bold mt-3 text-indigo-700">
Total: ₹{{ number_format($estimateQuotation->total,2) }}
</p>
</div>
</div>

<!-- DATE MODAL -->
<div id="dateModal" class="fixed inset-0 hidden modal-overlay flex items-center justify-center z-50" style="position: absolute">
<div class="modal-box bg-white w-96 p-6 rounded-xl">
<h2 class="text-xl font-bold mb-3">Update Valid Date</h2>
<form method="POST" action="{{ route('admin.estimate-quotations.update-date',$estimateQuotation->id) }}">
@csrf @method('PUT')
<input type="date" name="due_date" value="{{ $estimateQuotation->due_date }}" class="w-full border p-2 rounded" required>
<div class="flex justify-end gap-2 mt-4">
<button type="button" onclick="closeDateModal()" class="px-4 py-2 bg-gray-200 rounded">Cancel</button>
<button class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
</div>
</form>
</div>
</div>

<!-- CONFIRM MODAL -->
<div id="confirmModal" class="fixed inset-0 hidden modal-overlay flex items-center justify-center z-50" style="position: absolute">
<div class="modal-box bg-white w-96 p-6 rounded-xl">
<h2 class="text-xl font-bold mb-3 text-gray-800" id="confirmTitle"></h2>
<p class="text-gray-600 mb-4" id="confirmText"></p>

<form id="confirmForm" method="POST">
@csrf
<div id="methodSpoof"></div>
<div class="flex justify-end gap-2">
<button type="button" onclick="closeConfirmModal()" class="px-4 py-2 bg-gray-200 rounded">No</button>
<button class="px-4 py-2 bg-red-600 text-white rounded">Yes</button>
</div>
</form>
</div>
</div>

<script>
function openDateModal(){document.getElementById('dateModal').classList.remove('hidden')}
function closeDateModal(){document.getElementById('dateModal').classList.add('hidden')}

function openConfirmModal(type){
const modal=document.getElementById('confirmModal')
const title=document.getElementById('confirmTitle')
const text=document.getElementById('confirmText')
const form=document.getElementById('confirmForm')
const method=document.getElementById('methodSpoof')

method.innerHTML=''

if(type==='convert'){
title.innerText='Convert Estimate'
text.innerText='Are you sure you want to convert this estimate into Sale Invoice?'
form.action='{{ route("admin.estimate-quotations.convert",$estimateQuotation->id) }}'
}else{
title.innerText='Cancel Estimate'
text.innerText='Are you sure you want to cancel this estimate?'
form.action='{{ route("admin.estimate-quotations.cancel",$estimateQuotation->id) }}'
method.innerHTML='@method("PUT")'
}

modal.classList.remove('hidden')
}

function closeConfirmModal(){
document.getElementById('confirmModal').classList.add('hidden')
}
</script>

@endsection
