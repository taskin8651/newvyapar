<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Party Detail - {{ $partyDetail->party_name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; background-color: #f3f4f6; }
        .card { background: #fff; border-radius: 0.75rem; box-shadow: 0 4px 12px rgba(0,0,0,0.08); padding: 1rem; }
        .card-header { background: linear-gradient(135deg, #1e40af, #3b82f6); color: white; padding: 0.5rem 1rem; border-radius: 0.75rem 0.75rem 0 0; font-weight: 600; }
        @media print {
            body { font-size: 10px !important; }
            .card { box-shadow: none !important; border: 1px solid #ddd; }
            @page { size: A4; margin: 8mm; }
            .no-print { display: none !important; }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen py-4 px-2 text-xs">

<div class="max-w-4xl mx-auto border-2 border-black bg-blue-50 p-4 rounded-lg shadow-md">


    <!-- Title -->
    <div class="text-center mb-4">
        <h1 class="text-2xl font-bold text-blue-800">PARTY DETAIL REPORT</h1>
        <p class="text-blue-600 text-sm">Maruti Suzuki Ventures</p>
    </div> 

    <!-- Company / Party Info -->
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-building mr-1"></i> Company Information</div>
        <div class="p-3">
            <p><strong>Party Name:</strong> {{ $partyDetail->party_name ?? '-' }}</p>
            <p><strong>Status:</strong> {{ ucfirst($partyDetail->status ?? '-') }}</p>
            <p><strong>Phone:</strong> {{ $partyDetail->phone_number ?? '-' }}</p>
            <p><strong>Email:</strong> {{ $partyDetail->email ?? '-' }}</p>
            <p><strong>Place of Supply:</strong> {{ $partyDetail->place_of_supply ?? '-' }}</p>
            <p><strong>Type of Supply:</strong> {{ $partyDetail->type_of_supply ?? '-' }}</p>
        </div>
    </div>

    <!-- Bank Details -->
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-university mr-1"></i> Bank Details</div>
        <div class="p-3 grid grid-cols-2 gap-2">
            <p><strong>Bank Name:</strong> {{ $partyDetail->bank_name ?? '-' }}</p>
            <p><strong>Branch:</strong> {{ $partyDetail->branch ?? '-' }}</p>
            <p><strong>Account Number:</strong> {{ $partyDetail->account_number ?? '-' }}</p>
            <p><strong>IFSC Code:</strong> {{ $partyDetail->ifsc_code ?? '-' }}</p>
        </div>
    </div>

    <!-- Other Details -->
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-file-alt mr-1"></i> Other Details</div>
        <div class="p-3 grid grid-cols-2 gap-2">
            <p><strong>GSTIN:</strong> {{ $partyDetail->gstin ?? '-' }}</p>
            <p><strong>PAN:</strong> {{ $partyDetail->pan_number ?? '-' }}</p>
            <p><strong>GST Type:</strong> {{ $partyDetail->gst_type ?? '-' }}</p>
            <p><strong>Opening Balance:</strong> {{ ucfirst($partyDetail->opening_balance_type ?? '-') }} Rs {{ number_format($partyDetail->opening_balance ?? 0,2) }}</p>
            <p><strong>As of Date:</strong> {{ $partyDetail->as_of_date ?? '-' }}</p>
            <p><strong>Credit Limit:</strong> {{ $partyDetail->credit_limit ?? '-' }} Rs {{ number_format($partyDetail->credit_limit_amount ?? 0,2) }}</p>
            <p><strong>Payment Terms:</strong> {{ $partyDetail->payment_terms ?? '-' }}</p>
            <p><strong>Created By:</strong> {{ $partyDetail->created_by?->name ?? '-' }}</p>
        </div>
    </div>

    <!-- Notes -->
    <div class="card mb-4">
        <div class="card-header"><i class="fas fa-sticky-note mr-1"></i> Notes</div>
        <div class="p-3">
            <p>{{ $partyDetail->notes ?? 'No notes available.' }}</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="flex justify-between items-center text-gray-500 text-xs mt-6">
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

<!-- Print Button -->
<div class="fixed bottom-4 right-4 no-print">
    <button onclick="window.print()" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded-full shadow-lg flex items-center text-xs">
        <i class="fas fa-print mr-1"></i> Print
    </button>
</div>

</body>
</html>
