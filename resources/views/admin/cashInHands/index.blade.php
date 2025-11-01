@extends('layouts.admin')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-indigo-700 flex items-center gap-2">
                <i class="fas fa-wallet text-indigo-600"></i>
                {{ trans('cruds.cashInHand.title_singular') }} {{ trans('global.list') }}
            </h2>

            <div class="flex items-center gap-3">
                @can('cash_in_hand_create')
                    <a href="{{ route('admin.cash-in-hands.create') }}"
                       class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded hover:bg-indigo-700 transition">
                        <i class="fas fa-plus mr-1"></i> {{ trans('global.add') }}
                    </a>
                    <button class="px-4 py-2 bg-yellow-500 text-white font-semibold rounded hover:bg-yellow-600 transition"
                            data-toggle="modal" data-target="#csvImportModal">
                        <i class="fas fa-file-csv mr-1"></i> {{ trans('global.app_csvImport') }}
                    </button>
                @endcan
            </div>
        </div>

        @include('csvImport.modal', ['model' => 'CashInHand', 'route' => 'admin.cash-in-hands.parseCsvImport'])

        <div class="bg-white shadow rounded-lg overflow-hidden p-2">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200" id="cashInHandTable">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                {{ trans('cruds.cashInHand.fields.id') }}
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                {{ trans('cruds.cashInHand.fields.adjustment') }}
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                {{ trans('cruds.cashInHand.fields.enter_amount') }}
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                {{ trans('cruds.cashInHand.fields.adjustment_date') }}
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Account Number</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($cashInHands as $key => $cashInHand)
                            <tr class="hover:bg-gray-50 transition" data-entry-id="{{ $cashInHand->id }}">
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $cashInHand->id ?? '' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $cashInHand->account_name ?? '' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $cashInHand->opening_balance ?? '' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $cashInHand->as_of_date ?? '' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $cashInHand->account_number ?? '' }}</td>
                                <td class="px-4 py-3 text-sm text-center">
                                    <div class="flex justify-center gap-2">
                                        @can('cash_in_hand_show')
                                            <a href="{{ route('admin.cash-in-hands.show', $cashInHand->id) }}"
                                               class="px-3 py-1 bg-green-500 text-white text-xs rounded hover:bg-green-600 transition">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        @endcan
                                        @can('cash_in_hand_edit')
                                            <a href="{{ route('admin.cash-in-hands.edit', $cashInHand->id) }}"
                                               class="px-3 py-1 bg-blue-500 text-white text-xs rounded hover:bg-blue-600 transition">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endcan
                                        @can('cash_in_hand_delete')
                                            <form action="{{ route('admin.cash-in-hands.destroy', $cashInHand->id) }}" method="POST" 
                                                  onsubmit="return confirm('{{ trans('global.areYouSure') }}');" class="inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                        class="px-3 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600 transition">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
$(function () {
    let table = $('#cashInHandTable').DataTable({
        order: [[1, 'desc']],
        pageLength: 25,
    });
});
</script>
@endsection
