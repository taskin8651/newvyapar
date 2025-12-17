@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="p-6 max-w-5xl mx-auto">

        <!-- Back Button -->
        <div class="mb-4">
            <a href="{{ route('admin.expense-lists.index') }}"
               class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        <!-- Expense List Card -->
        <div class="bg-white shadow-lg rounded-xl p-6 text-sm">

            <h2 class="text-2xl font-bold mb-6 text-blue-600">
                {{ trans('global.show') }} {{ trans('cruds.expenseList.title') }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- ID --}}
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.expenseList.fields.id') }}
                    </span>
                    <span class="text-gray-800 font-medium">{{ $expenseList->id }}</span>
                </div>

                {{-- Entry Date --}}
                <div class="bg-purple-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.expenseList.fields.entry_date') }}
                    </span>
                    <span class="text-gray-800 font-medium">{{ $expenseList->entry_date }}</span>
                </div>

                {{-- Category --}}
                <div class="bg-blue-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.expenseList.fields.category') }}
                    </span>
                    <span class="text-gray-800 font-medium">
                        {{ $expenseList->category->expense_category ?? '' }}
                    </span>
                </div>

                {{-- Amount --}}
                <div class="bg-green-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.expenseList.fields.amount') }}
                    </span>
                    <span class="text-gray-800 font-medium">
                        ₹ {{ number_format($expenseList->amount, 2) }}
                    </span>
                </div>

                {{-- Payment --}}
                <div class="bg-yellow-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.expenseList.fields.payment') }}
                    </span>
                    <span class="text-gray-800 font-medium">
                        {{ $expenseList->payment->account_name ?? '' }}
                    </span>
                </div>

                {{-- Tax Include --}}
                <div class="bg-pink-50 p-4 rounded-lg shadow-inner">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.expenseList.fields.tax_include') }}
                    </span>
                    <span class="text-gray-800 font-medium">
                        {{ App\Models\ExpenseList::TAX_INCLUDE_RADIO[$expenseList->tax_include] ?? '' }}
                    </span>
                </div>

                {{-- Description --}}
                <div class="bg-indigo-50 p-4 rounded-lg shadow-inner md:col-span-2">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.expenseList.fields.description') }}
                    </span>
                    <span class="text-gray-800 font-medium">
                        {{ $expenseList->description ?? '-' }}
                    </span>
                </div>

                {{-- Notes --}}
                <div class="bg-gray-50 p-4 rounded-lg shadow-inner md:col-span-2">
                    <span class="text-gray-500 font-semibold block mb-1">
                        {{ trans('cruds.expenseList.fields.notes') }}
                    </span>
                    <div class="text-gray-800 prose max-w-none">
                        {!! $expenseList->notes ?? '-' !!}
                    </div>
                </div>

            </div>

            <!-- Back Button Bottom -->
            <div class="mt-6">
                <a href="{{ route('admin.expense-lists.index') }}"
                   class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>

        </div>

    </div>

</div>
@endsection
