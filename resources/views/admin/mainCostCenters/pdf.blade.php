<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main Cost Center - {{ $mainCostCenter->id }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .invoice-container { box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .header-gradient { background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); }

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
            <h1 class="text-xl font-bold text-blue-800">MAIN COST CENTER REPORT</h1>
            <p class="text-blue-600 text-xs">Maruti Suzuki Ventures</p>
        </div>

        <div class="invoice-container bg-white rounded-xl overflow-hidden text-xs">

            <!-- Header Section -->
            <div class="header-gradient text-white p-4 text-xs">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-lg font-bold">Cost Center</h1>
                        <p class="text-blue-200 mt-1 text-xs">Generated Report</p>
                    </div>
                    <div class="text-right bg-white/10 p-2 rounded-lg text-xs">
                        <p class="font-semibold">ID: {{ $mainCostCenter->id }}</p>
                        <p>Status: {{ ucfirst($mainCostCenter->status) }}</p>
                    </div>
                </div>
            </div>

            <!-- Details Table -->
            <div class="p-4 border-b border-gray-200 text-xs">
                <table class="w-full text-sm border border-gray-200 rounded-lg">
                    <tbody>
                        <tr class="bg-gray-50">
                            <td class="p-2 font-medium">Cost Center Name</td>
                            <td class="p-2">{{ $mainCostCenter->cost_center_name }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-medium">Unique Code</td>
                            <td class="p-2">{{ $mainCostCenter->unique_code }}</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="p-2 font-medium">Details</td>
                            <td class="p-2">{{ $mainCostCenter->details_of_cost_center }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-medium">Location</td>
                            <td class="p-2">{{ $mainCostCenter->location }}</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="p-2 font-medium">Budget Amount</td>
                            <td class="p-2">Rs {{ number_format($mainCostCenter->budget_amount, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-medium">Actual Amount</td>
                            <td class="p-2">Rs {{ number_format($mainCostCenter->actual_amount, 2) }}</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="p-2 font-medium">Start Date</td>
                            <td class="p-2">{{ $mainCostCenter->start_date }}</td>
                        </tr>
                        <tr>
                            <td class="p-2 font-medium">Responsible Manager</td>
                            <td class="p-2">{{ $mainCostCenter->responsible_manager->name ?? '-' }}</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="p-2 font-medium">Linked Company</td>
                            <td class="p-2">{{ $mainCostCenter->link_with_company->company_name ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Sub-Cost Centers -->
            <div class="p-4 border-b border-gray-200 text-xs">
                <h3 class="text-sm font-semibold text-blue-700 mb-2 flex items-center">
                    <i class="fas fa-diagram-project mr-1"></i> Sub Cost Centers
                </h3>
                <table class="w-full text-xs border border-gray-200">
                    <thead class="bg-blue-100 text-blue-700">
                        <tr>
                            <th class="p-2 text-left">#</th>
                            <th class="p-2 text-left">Name</th>
                            <th class="p-2 text-left">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mainCostCenter->mainCostCenterSubCostCenters as $key => $sub)
                            <tr class="border-b">
                                <td class="p-2">{{ $key+1 }}</td>
                                <td class="p-2">{{ $sub->sub_cost_center_name ?? '-' }}</td>
                                <td class="p-2">{{ $sub->details ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-2 text-center italic text-gray-500">No sub cost centers found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Footer Note & Signature -->
            <div class="p-4 text-xs text-gray-500 flex justify-between items-start">
                <div>
                    <p>Generated on {{ now()->format('d-m-Y h:i A') }} by {{ auth()->user()->name ?? 'System' }}.</p>
                </div>
                <div class="text-center">
                    <div class="mb-2">
                        {{-- Browser Print → asset() | Dompdf PDF → public_path() --}}
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
