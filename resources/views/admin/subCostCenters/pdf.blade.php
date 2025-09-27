<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sub Cost Center - {{ $subCostCenter->sub_cost_center_name ?? '-' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .invoice-container { box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        @media print {
            body { font-size: 10px !important; }
            .invoice-container { box-shadow: none !important; border: none !important; }
            @page { size: A4; margin: 8mm; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen py-4 px-2 text-xs">
    <div class="max-w-4xl mx-auto">

        <!-- Header -->
        <div class="text-center mb-2">
            <h1 class="text-xl font-bold text-blue-800">SUB COST CENTER REPORT</h1>
            <p class="text-blue-600 text-xs">Maruti Suzuki Ventures</p>
        </div>

        <div class="invoice-container bg-white rounded-xl overflow-hidden text-xs">

            <!-- Header Section -->
            <div class="bg-blue-700 text-white p-4 text-xs flex justify-between items-start">
                <div>
                    <h1 class="text-lg font-bold">Sub Cost Center</h1>
                    <p class="text-blue-200 mt-1 text-xs">Generated Report</p>
                </div>
                <div class="text-right bg-white/10 p-2 rounded-lg text-xs">
                    <p class="font-semibold">ID: {{ $subCostCenter->id ?? '-' }}</p>
                    <p>Status: {{ ucfirst($subCostCenter->status) ?? '-' }}</p>
                </div>
            </div>

            <!-- Sub Cost Center Details -->
            <div class="p-4 border-b border-gray-200 text-xs">
                <table class="w-full text-sm border border-gray-200 rounded-lg">
                    <tbody>
                        <tr class="bg-gray-50">
                            <td class="p-2 font-medium">Name</td>
                            <td class="p-2">{{ $subCostCenter->sub_cost_center_name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-medium">Unique Code</td>
                            <td class="p-2">{{ $subCostCenter->unique_code ?? '-' }}</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="p-2 font-medium">Main Cost Center</td>
                            <td class="p-2">{{ $subCostCenter->main_cost_center?->cost_center_name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-medium">Responsible Manager</td>
                            <td class="p-2">{{ $subCostCenter->responsible_manager ?? '-' }}</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="p-2 font-medium">Budget Allocated</td>
                            <td class="p-2">Rs {{ number_format($subCostCenter->budget_allocated ?? 0, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-medium">Actual Expense</td>
                            <td class="p-2">Rs {{ number_format($subCostCenter->actual_expense ?? 0, 2) }}</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="p-2 font-medium">Start Date</td>
                            <td class="p-2">{{ $subCostCenter->start_date ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-medium">Created By</td>
                            <td class="p-2">{{ $subCostCenter->created_by?->name ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Details -->
            @if(!empty($subCostCenter->details_of_sub_cost_center))
            <div class="p-4 border-b border-gray-200 text-xs">
                <h3 class="text-sm font-semibold text-blue-700 mb-2">Details</h3>
                <p class="text-gray-700 leading-relaxed">{{ $subCostCenter->details_of_sub_cost_center }}</p>
            </div>
            @endif

            <!-- Purchase Bills -->
            @if($subCostCenter->purchase_bills->count())
            <div class="p-4 border-b border-gray-200 text-xs">
                <h3 class="text-sm font-semibold text-blue-700 mb-2">Purchase Bills</h3>
                <table class="w-full text-xs border border-gray-200">
                    <thead class="bg-blue-100 text-blue-700">
                        <tr>
                            <th class="p-2 text-left">#</th>
                            <th class="p-2 text-left">Bill Number</th>
                            <th class="p-2 text-left">Amount</th>
                            <th class="p-2 text-left">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subCostCenter->purchase_bills as $key => $bill)
                        <tr class="border-b">
                            <td class="p-2">{{ $key + 1 }}</td>
                            <td class="p-2">{{ $bill->bill_number ?? '-' }}</td>
                            <td class="p-2">Rs {{ number_format($bill->amount ?? 0, 2) }}</td>
                            <td class="p-2">{{ $bill->bill_date ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

            <!-- Footer -->
            <div class="p-4 text-xs text-gray-500 flex justify-between items-start">
                <div>
                    <p>Generated on {{ now()->format('d-m-Y h:i A') }} by {{ auth()->user()->name ?? 'System' }}.</p>
                </div>
                <div class="text-center">
                    <div class="mb-2">
                        <img src="{{ asset('uploads/sign.png') }}" alt="Signature" class="h-12 mx-auto">
                    </div>
                    <div class="border-t border-blue-400 w-40 pt-1 mx-auto">
                        <p class="font-medium text-blue-700 text-xs">Authorized Signatory</p>
                    </div>
                    <p class="text-gray-500 mt-1 text-xs">For: MARUTI SUZUKI VENTURES</p>
                </div>
            </div>

        </div>
    </div>

    <!-- Print Button -->
    <div class="fixed bottom-4 right-4 no-print">
        <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-full shadow-lg flex items-center text-xs">
            <i class="fas fa-print mr-1"></i> Print
        </button>
    </div>
</body>
</html>
