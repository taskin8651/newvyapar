@extends('layouts.admin')
@section('content')

<h2 class="text-2xl font-bold mb-6">Edit Raw Materials</h2>

<form method="POST" action="{{ route('admin.raw-materials.update',$rawMaterial->id) }}">
@csrf
@method('PUT')

<!-- Header Section -->
<div class="grid grid-cols-3 gap-4 bg-white p-4 rounded-xl shadow mb-6">

    <div>
        <label class="text-sm font-medium">Warehouse Location</label>
        <input type="text"
               name="warehouse_location"
               value="{{ $rawMaterial->warehouse_location }}"
               class="border p-2 w-full rounded">
    </div>

    <div>
        <label class="text-sm font-medium">Low Stock Warning</label>
        <input type="number"
               name="low_stock_warning"
               value="{{ $rawMaterial->low_stock_warning }}"
               class="border p-2 w-full rounded">
    </div>

    <div>
        <label class="text-sm font-medium">Unique Code</label>
        <input type="text"
               value="{{ $rawMaterial->unique_code }}"
               class="border p-2 w-full rounded bg-gray-100"
               disabled>
    </div>

</div>


<div x-data="rawMaterialTable()" x-init="init()" class="bg-white p-4 rounded-xl shadow">

<table class="w-full text-sm border">
<thead class="bg-gray-100">
<tr>
    <th class="p-2">Title</th>
    <th class="p-2">Item Code</th>
    <th class="p-2">HSN</th>
    <th class="p-2">Unit</th>
    <th class="p-2">Qty</th>
    <th class="p-2">Purchase</th>
    <th class="p-2">Sale</th>
    <th class="p-2">Tax %</th>
    <th class="p-2">With Tax</th>
    <th class="p-2">Total</th>
    <th class="p-2">+</th>
</tr>
</thead>

<tbody>
<template x-for="(row,index) in rows" :key="index">
<tr class="border-t">

<td>
<input :name="'materials['+index+'][title]'"
       x-model="row.title"
       class="border p-1 w-full">
</td>

<td>
<input :name="'materials['+index+'][item_code]'"
       x-model="row.item_code"
       class="border p-1 w-full">
</td>

<td>
<input :name="'materials['+index+'][item_hsn]'"
       x-model="row.item_hsn"
       class="border p-1 w-full">
</td>

<td>
<input :name="'materials['+index+'][unit]'"
       x-model="row.unit"
       class="border p-1 w-full">
</td>

<td>
<input type="number"
       x-model.number="row.qty"
       @input="calc(index)"
       :name="'materials['+index+'][quantity]'"
       class="border p-1 w-full">
</td>

<td>
<input type="number"
       x-model.number="row.purchase"
       @input="calc(index)"
       :name="'materials['+index+'][purchase_price]'"
       class="border p-1 w-full">
</td>

<td>
<input type="number"
       :name="'materials['+index+'][sale_price]'"
       x-model="row.sale_price"
       class="border p-1 w-full">
</td>

<td>
<input type="number"
       x-model.number="row.tax"
       @input="calc(index)"
       :name="'materials['+index+'][tax_percent]'"
       class="border p-1 w-full">
</td>

<td class="text-center">
<input type="hidden" :name="'materials['+index+'][with_tax]'" value="0">
<input type="checkbox"
       value="1"
       :name="'materials['+index+'][with_tax]'"
       x-model="row.withTax"
       @change="calc(index)">
</td>

<td class="font-semibold text-right">
₹ <span x-text="row.total.toFixed(2)"></span>
</td>

<td class="text-center">
<button type="button" @click="addRow()" class="text-green-600 text-lg">+</button>
<button type="button" @click="removeRow(index)" class="text-red-600">🗑</button>
</td>

</tr>
</template>
</tbody>
</table>

<button type="submit"
class="mt-6 bg-gradient-to-r from-indigo-600 to-purple-600 text-white px-6 py-2 rounded-lg shadow">
Update
</button>

</div>
</form>


<script>
function rawMaterialTable(){
return{
rows: [],

init(){
this.rows = @json($materials).map(item => ({
    title: item.title,
    item_code: item.item_code,
    item_hsn: item.item_hsn,
    unit: item.unit,
    qty: parseFloat(item.quantity),
    purchase: parseFloat(item.purchase_price),
    sale_price: item.sale_price,
    tax: parseFloat(item.tax_percent),
    withTax: item.with_tax == 1,
    total: 0
}));

this.calcAll();
},

addRow(){
this.rows.push({title:'',qty:0,purchase:0,tax:0,withTax:false,total:0});
},

removeRow(i){
this.rows.splice(i,1);
this.calcAll();
},

calc(i){
let r=this.rows[i];
let base=r.qty*r.purchase;
let tax=r.withTax?base*r.tax/100:0;
r.total=base+tax;
this.calcAll();
},

calcAll(){
this.rows.forEach(r=>{
let base=r.qty*r.purchase;
let tax=r.withTax?base*r.tax/100:0;
r.total=base+tax;
});
}
}
}
</script>

@endsection
