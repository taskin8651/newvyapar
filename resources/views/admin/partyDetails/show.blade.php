@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">

    {{-- Card --}}
    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        
        {{-- Header --}}
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-800">
                {{ trans('global.show') }} {{ trans('cruds.partyDetail.title') }}
            </h2>
            <a href="{{ route('admin.party-details.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-lg shadow hover:bg-gray-300 transition">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

        {{-- Table --}}
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-200 divide-y divide-gray-200">
                    <tbody class="divide-y divide-gray-100">
                        
                        {{-- Row --}}
                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600 w-1/3">
                                {{ trans('cruds.partyDetail.fields.id') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $partyDetail->id }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.party_name') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $partyDetail->party_name }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.gstin') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $partyDetail->gstin }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.phone_number') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $partyDetail->phone_number }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.pan_number') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $partyDetail->pan_number }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.place_of_supply') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $partyDetail->place_of_supply }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.type_of_supply') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ App\Models\PartyDetail::TYPE_OF_SUPPLY_SELECT[$partyDetail->type_of_supply] ?? '' }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.gst_type') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ App\Models\PartyDetail::GST_TYPE_SELECT[$partyDetail->gst_type] ?? '' }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.pincode') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $partyDetail->pincode }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.state') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $partyDetail->state }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.city') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $partyDetail->city }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.billing_address') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {!! $partyDetail->billing_address !!}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.shipping_address') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {!! $partyDetail->shipping_address !!}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.email') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $partyDetail->email }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.opening_balance') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $partyDetail->opening_balance }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.as_of_date') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $partyDetail->as_of_date }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.opening_balance_type') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ App\Models\PartyDetail::OPENING_BALANCE_TYPE_SELECT[$partyDetail->opening_balance_type] ?? '' }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.credit_limit') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ App\Models\PartyDetail::CREDIT_LIMIT_RADIO[$partyDetail->credit_limit] ?? '' }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.credit_limit_amount') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $partyDetail->credit_limit_amount }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.payment_terms') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $partyDetail->payment_terms }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.ifsc_code') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $partyDetail->ifsc_code }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.account_number') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $partyDetail->account_number }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.bank_name') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $partyDetail->bank_name }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.branch') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $partyDetail->branch }}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.notes') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {!! $partyDetail->notes !!}
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50">
                            <th class="px-4 py-3 text-left text-sm font-medium text-gray-600">
                                {{ trans('cruds.partyDetail.fields.status') }}
                            </th>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ App\Models\PartyDetail::STATUS_SELECT[$partyDetail->status] ?? '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Footer --}}
        {{-- Footer --}}
<div class="px-6 py-4 border-t border-gray-200 flex justify-between">
    <a href="{{ route('admin.party-details.index') }}" 
       class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 text-sm font-medium rounded-lg shadow hover:bg-gray-300 transition">
        {{ trans('global.back_to_list') }}
    </a>

    <!-- Button -->
<button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
        onclick="openModal()">
    📑 Choose PDF Template & Download
</button>

<!-- Modal -->
<div id="templateModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white w-full max-w-md rounded-lg shadow-lg p-6">
        <div class="flex justify-between items-center border-b pb-3">
            <h5 class="text-lg font-semibold">📑 Select PDF Template</h5>
            <button onclick="closeModal()" class="text-gray-500 hover:text-red-600">✖</button>
        </div>

        <div class="mt-4">
            <form id="templateForm">
                <div class="space-y-2">
                    @for ($i = 1; $i <= 10; $i++)
                        <label class="flex items-center justify-between px-3 py-2 border rounded-lg hover:bg-gray-100 cursor-pointer">
                            <span>Template {{ $i }}</span>
                            <input type="radio" name="template" value="{{ $i }}" class="form-radio text-indigo-600">
                        </label>
                    @endfor
                </div>
            </form>
        </div>

        <div class="flex justify-end gap-2 mt-6 border-t pt-4">
            <button onclick="closeModal()" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">❌ Cancel</button>
            <button id="downloadPdfBtn" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                ⬇ Download
            </button>
        </div>
    </div>
</div>

<!-- JS -->
<script>
    function openModal() {
        document.getElementById("templateModal").classList.remove("hidden");
        document.getElementById("templateModal").classList.add("flex");
    }
    function closeModal() {
        document.getElementById("templateModal").classList.add("hidden");
        document.getElementById("templateModal").classList.remove("flex");
    }

   document.getElementById("downloadPdfBtn").addEventListener("click", function(){
    let templateId = document.querySelector("input[name='template']:checked")?.value;
    if(!templateId){
        alert("⚠️ Please select a template!");
        return;
    }

    // ✅ Laravel route with PartyDetail ID
    let url = "{{ route('admin.pdf.download', [$partyDetail->id, ':id']) }}".replace(':id', templateId);

    window.location.href = url;
    closeModal();

    });
</script>


</div>
@endsection
