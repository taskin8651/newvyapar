<div class="content">
    @can('add_item_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.add-items.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.addItem.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.addItem.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-selectCategoryAddItems">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.addItem.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addItem.fields.item_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addItem.fields.item_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addItem.fields.item_hsn') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addItem.fields.select_unit') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addItem.fields.select_category') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addItem.fields.item_code') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addItem.fields.sale_price') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addItem.fields.select_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addItem.fields.disc_on_sale_price') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addItem.fields.disc_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addItem.fields.wholesale_price') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addItem.fields.select_type_wholesale') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addItem.fields.minimum_wholesale_qty') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addItem.fields.purchase_price') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addItem.fields.select_purchase_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addItem.fields.select_tax') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.taxRate.fields.parcentage') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($addItems as $key => $addItem)
                                    <tr data-entry-id="{{ $addItem->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $addItem->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\AddItem::ITEM_TYPE_SELECT[$addItem->item_type] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addItem->item_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addItem->item_hsn ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addItem->select_unit->base_unit ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($addItem->select_categories as $key => $item)
                                                <span class="label label-info label-many">{{ $item->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $addItem->item_code ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addItem->sale_price ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\AddItem::SELECT_TYPE_SELECT[$addItem->select_type] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addItem->disc_on_sale_price ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addItem->disc_type ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addItem->wholesale_price ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\AddItem::SELECT_TYPE_WHOLESALE_SELECT[$addItem->select_type_wholesale] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addItem->minimum_wholesale_qty ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addItem->purchase_price ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\AddItem::SELECT_PURCHASE_TYPE_SELECT[$addItem->select_purchase_type] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addItem->select_tax->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addItem->select_tax->parcentage ?? '' }}
                                        </td>
                                        <td>
                                            @can('add_item_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.add-items.show', $addItem->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('add_item_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.add-items.edit', $addItem->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('add_item_delete')
                                                <form action="{{ route('admin.add-items.destroy', $addItem->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('add_item_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.add-items.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-selectCategoryAddItems:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection