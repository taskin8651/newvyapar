@extends('layouts.admin')
@section('content')

<div class="max-w-7xl mx-auto py-6">
    <div class="bg-white shadow-lg rounded-2xl p-6">

        <!-- Header -->
        <div class="flex justify-between items-center mb-6 border-b pb-4">

            <h2 class="text-xl font-bold text-indigo-700 flex items-center gap-2">
                <i class="fas fa-boxes text-indigo-600"></i>
                Raw Materials List
            </h2>

            <div class="flex gap-3 items-center">

                <!-- ✅ Add Raw Material -->
                @can('raw_material_create')
                <a href="{{ route('admin.raw-materials.create') }}"
                   class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow transition">
                    <i class="fas fa-plus mr-1"></i> Add Raw Material
                </a>
                @endcan

                <!-- ✅ Add Production (Permission Based) -->
                @can('production_create')
                <a href="{{ route('admin.productions.create') }}"
                   class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow transition">
                    <i class="fas fa-industry mr-1"></i> Add Production
                </a>
                @endcan

                <!-- Search -->
                <input type="text" id="materialSearch"
                       placeholder="Search materials..."
                       class="px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 text-sm w-64">

            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 datatable datatable-RawMaterial">
                <thead class="bg-gray-50">
                    <tr>
                        <th width="10"></th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Code</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Title</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Stock</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Purchase</th>
                        <th class="px-4 py-3 text-xs font-medium text-gray-500 uppercase">Warehouse</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($materials as $material)
                        @php
                            $isLow = $material->quantity <= $material->low_stock_warning;
                        @endphp

                        <tr data-entry-id="{{ $material->id }}"
                            class="hover:bg-gray-50 {{ $isLow ? 'bg-red-50' : '' }}">

                            <td></td>

                            <td class="px-4 py-3 text-sm font-medium">
                                {{ $material->id }}
                            </td>

                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 bg-indigo-100 text-indigo-700 rounded-full text-xs font-medium">
                                    {{ $material->unique_code }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-sm">
                                {{ $material->title }}
                            </td>

                            <td class="px-4 py-3 text-sm">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $isLow ? 'bg-red-100 text-red-700' : 'bg-emerald-100 text-emerald-700' }}">
                                    {{ $material->quantity }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-sm">
                                ₹ {{ number_format($material->purchase_price, 2) }}
                            </td>

                            <td class="px-4 py-3 text-sm">
                                {{ $material->warehouse_location }}
                            </td>

                            <!-- Actions -->
                            <td class="px-4 py-3 text-center relative"
                                x-data="{ open: false }"
                                @mouseenter="open = true"
                                @mouseleave="open = false">

                                <button class="text-gray-600 hover:text-gray-900 focus:outline-none">
                                    <i class="fa-solid fa-ellipsis-vertical text-lg"></i>
                                </button>

                                <div x-show="open"
                                     class="absolute top-full right-0 mt-2 w-44 bg-white border border-gray-200 rounded-lg shadow-lg z-50"
                                     style="display: none;">

                                    @can('raw_material_show')
                                    <a href="{{ route('admin.raw-materials.show', $material->id) }}"
                                       class="flex items-center px-4 py-2 text-sm hover:bg-blue-50 text-blue-700">
                                        <i class="fas fa-eye mr-2"></i> View
                                    </a>
                                    @endcan

                                    @can('raw_material_edit')
                                    <a href="{{ route('admin.raw-materials.edit', $material->id) }}"
                                       class="flex items-center px-4 py-2 text-sm hover:bg-yellow-50 text-yellow-700">
                                        <i class="fas fa-edit mr-2"></i> Edit
                                    </a>
                                    @endcan

                                    @can('raw_material_delete')
                                    <form action="{{ route('admin.raw-materials.destroy', $material->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure?');">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit"
                                                class="w-full flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                            <i class="fas fa-trash mr-2"></i> Delete
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

@endsection


@section('scripts')
@parent
<script>
    $(function () {

        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[1, 'desc']],
            pageLength: 25,
            dom: 'Brtip',
        });

        let table = $('.datatable-RawMaterial:not(.ajaxTable)').DataTable({
            buttons: dtButtons
        });

        $('#materialSearch').on('keyup change clear', function () {
            table.search(this.value).draw();
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });

    })
</script>
@endsection
