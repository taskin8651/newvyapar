@extends('layouts.admin')
@section('content')
<div class="content">
    @can('cash_in_hand_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.cash-in-hands.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.cashInHand.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'CashInHand', 'route' => 'admin.cash-in-hands.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.cashInHand.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-CashInHand">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.cashInHand.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.cashInHand.fields.adjustment') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.cashInHand.fields.enter_amount') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.cashInHand.fields.adjustment_date') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cashInHands as $key => $cashInHand)
                                    <tr data-entry-id="{{ $cashInHand->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $cashInHand->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\CashInHand::ADJUSTMENT_SELECT[$cashInHand->adjustment] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $cashInHand->enter_amount ?? '' }}
                                        </td>
                                        <td>
                                            {{ $cashInHand->adjustment_date ?? '' }}
                                        </td>
                                        <td>
                                            @can('cash_in_hand_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.cash-in-hands.show', $cashInHand->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('cash_in_hand_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.cash-in-hands.edit', $cashInHand->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('cash_in_hand_delete')
                                                <form action="{{ route('admin.cash-in-hands.destroy', $cashInHand->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('cash_in_hand_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.cash-in-hands.massDestroy') }}",
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
  let table = $('.datatable-CashInHand:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection