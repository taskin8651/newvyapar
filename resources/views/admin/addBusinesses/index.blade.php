@extends('layouts.admin')
@section('content')
<div class="content">
    @can('add_business_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.add-businesses.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.addBusiness.title_singular') }}
                </a>
                <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                    {{ trans('global.app_csvImport') }}
                </button>
                @include('csvImport.modal', ['model' => 'AddBusiness', 'route' => 'admin.add-businesses.parseCsvImport'])
            </div>
        </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('cruds.addBusiness.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-AddBusiness">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('cruds.addBusiness.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addBusiness.fields.company_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addBusiness.fields.legal_name') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addBusiness.fields.business_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addBusiness.fields.industry_type') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.addBusiness.fields.logo_upload') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($addBusinesses as $key => $addBusiness)
                                    <tr data-entry-id="{{ $addBusiness->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $addBusiness->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addBusiness->company_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $addBusiness->legal_name ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\AddBusiness::BUSINESS_TYPE_SELECT[$addBusiness->business_type] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\AddBusiness::INDUSTRY_TYPE_SELECT[$addBusiness->industry_type] ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($addBusiness->logo_upload as $key => $media)
                                                <a href="{{ $media->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $media->getUrl('thumb') }}">
                                                </a>
                                            @endforeach
                                        </td>
                                        <td>
                                            @can('add_business_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('admin.add-businesses.show', $addBusiness->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('add_business_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('admin.add-businesses.edit', $addBusiness->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('add_business_delete')
                                                <form action="{{ route('admin.add-businesses.destroy', $addBusiness->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('add_business_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.add-businesses.massDestroy') }}",
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
  let table = $('.datatable-AddBusiness:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection