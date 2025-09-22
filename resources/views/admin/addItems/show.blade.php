@extends('layouts.admin')
@section('content')
<div class="content">

<div class="max-w-6xl mx-auto p-6 text-sm">
    <!-- Heading -->
    <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white px-6 py-4 rounded-t-xl shadow-md">
        <h2 class="text-xl font-bold">
            {{ trans('global.show') }} {{ trans('cruds.addItem.title') }}
        </h2>
    </div>

    <!-- Card -->
    <div class="bg-white shadow-lg rounded-b-xl p-6">
        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.add-items.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg shadow-sm hover:bg-gray-300 transition">
                ⬅️ {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Details Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 ">
            <div class="bg-gray-50 p-2 rounded-lg shadow-sm hover:shadow-md transition">
                <h4 class="font-semibold text-gray-700">{{ trans('cruds.addItem.fields.id') }}</h4>
                <p class="text-gray-900">{{ $addItem->id }}</p>
            </div>

            <div class="bg-gray-50 p-2 rounded-lg shadow-sm hover:shadow-md transition">
                <h4 class="font-semibold text-gray-700">{{ trans('cruds.addItem.fields.item_type') }}</h4>
                <p class="text-gray-900">{{ App\Models\AddItem::ITEM_TYPE_SELECT[$addItem->item_type] ?? '' }}</p>
            </div>

            <div class="bg-gray-50 p-2 rounded-lg shadow-sm hover:shadow-md transition">
                <h4 class="font-semibold text-gray-700">{{ trans('cruds.addItem.fields.item_name') }}</h4>
                <p class="text-gray-900">{{ $addItem->item_name }}</p>
            </div>

            <div class="bg-gray-50 p-2 rounded-lg shadow-sm hover:shadow-md transition">
                <h4 class="font-semibold text-gray-700">{{ trans('cruds.addItem.fields.item_hsn') }}</h4>
                <p class="text-gray-900">{{ $addItem->item_hsn }}</p>
            </div>

            <div class="bg-gray-50 p-2 rounded-lg shadow-sm hover:shadow-md transition">
                <h4 class="font-semibold text-gray-700">{{ trans('cruds.addItem.fields.select_unit') }}</h4>
                <p class="text-gray-900">{{ $addItem->select_unit->base_unit ?? '' }}</p>
            </div>

            <div class="bg-gray-50 p-2 rounded-lg shadow-sm hover:shadow-md transition">
                <h4 class="font-semibold text-gray-700">{{ trans('cruds.addItem.fields.select_category') }}</h4>
                <div class="flex flex-wrap gap-2">
                    @foreach($addItem->select_categories as $key => $select_category)
                        <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm shadow-sm">
                            {{ $select_category->name }}
                        </span>
                    @endforeach
                </div>
            </div>

            <div class="bg-gray-50 p-2 rounded-lg shadow-sm hover:shadow-md transition">
                <h4 class="font-semibold text-gray-700">{{ trans('cruds.addItem.fields.item_code') }}</h4>
                <p class="text-gray-900">{{ $addItem->item_code }}</p>
            </div>

            <div class="bg-gray-50 p-2 rounded-lg shadow-sm hover:shadow-md transition">
                <h4 class="font-semibold text-gray-700">{{ trans('cruds.addItem.fields.sale_price') }}</h4>
                <p class="text-gray-900">{{ $addItem->sale_price }}</p>
            </div>

            <div class="bg-gray-50 p-2 rounded-lg shadow-sm hover:shadow-md transition">
                <h4 class="font-semibold text-gray-700">{{ trans('cruds.addItem.fields.select_type') }}</h4>
                <p class="text-gray-900">{{ App\Models\AddItem::SELECT_TYPE_SELECT[$addItem->select_type] ?? '' }}</p>
            </div>

            <div class="bg-gray-50 p-2 rounded-lg shadow-sm hover:shadow-md transition">
                <h4 class="font-semibold text-gray-700">{{ trans('cruds.addItem.fields.disc_on_sale_price') }}</h4>
                <p class="text-gray-900">{{ $addItem->disc_on_sale_price }}</p>
            </div>

            <div class="bg-gray-50 p-2 rounded-lg shadow-sm hover:shadow-md transition">
                <h4 class="font-semibold text-gray-700">{{ trans('cruds.addItem.fields.disc_type') }}</h4>
                <p class="text-gray-900">{{ $addItem->disc_type }}</p>
            </div>

            <div class="bg-gray-50 p-2 rounded-lg shadow-sm hover:shadow-md transition">
                <h4 class="font-semibold text-gray-700">{{ trans('cruds.addItem.fields.wholesale_price') }}</h4>
                <p class="text-gray-900">{{ $addItem->wholesale_price }}</p>
            </div>

            <div class="bg-gray-50 p-2 rounded-lg shadow-sm hover:shadow-md transition">
                <h4 class="font-semibold text-gray-700">{{ trans('cruds.addItem.fields.select_type_wholesale') }}</h4>
                <p class="text-gray-900">{{ App\Models\AddItem::SELECT_TYPE_WHOLESALE_SELECT[$addItem->select_type_wholesale] ?? '' }}</p>
            </div>

            <div class="bg-gray-50 p-2 rounded-lg shadow-sm hover:shadow-md transition">
                <h4 class="font-semibold text-gray-700">{{ trans('cruds.addItem.fields.minimum_wholesale_qty') }}</h4>
                <p class="text-gray-900">{{ $addItem->minimum_wholesale_qty }}</p>
            </div>

            <div class="bg-gray-50 p-2 rounded-lg shadow-sm hover:shadow-md transition">
                <h4 class="font-semibold text-gray-700">{{ trans('cruds.addItem.fields.purchase_price') }}</h4>
                <p class="text-gray-900">{{ $addItem->purchase_price }}</p>
            </div>

            <div class="bg-gray-50 p-2 rounded-lg shadow-sm hover:shadow-md transition">
                <h4 class="font-semibold text-gray-700">{{ trans('cruds.addItem.fields.select_purchase_type') }}</h4>
                <p class="text-gray-900">{{ App\Models\AddItem::SELECT_PURCHASE_TYPE_SELECT[$addItem->select_purchase_type] ?? '' }}</p>
            </div>

            <div class="bg-gray-50 p-2 rounded-lg shadow-sm hover:shadow-md transition">
                <h4 class="font-semibold text-gray-700">{{ trans('cruds.addItem.fields.select_tax') }}</h4>
                <p class="text-gray-900">{{ $addItem->select_tax->name ?? '' }}</p>
            </div>
        </div>

        <!-- Back Button Bottom -->
        <div class="mt-6">
            <a href="{{ route('admin.add-items.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg shadow-sm hover:bg-gray-300 transition">
                ⬅️ {{ trans('global.back_to_list') }}
            </a>
        </div>
    </div>
</div>

</div>
@endsection