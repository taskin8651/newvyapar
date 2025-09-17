<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Template {{ $template }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .header { text-align:center; font-size:20px; font-weight:bold; margin-bottom:20px; }
        .content { margin: 20px; }
    </style>
</head>
<body>
    <div class="header">📄 Template {{ $template }} - Invoice</div>
    <div class="content">
        <p><strong>Party Name:</strong> {{ $partyDetail->party_name }}</p>
        <p><strong>GSTIN:</strong> {{ $partyDetail->gstin }}</p>
        <p><strong>Phone:</strong> {{ $partyDetail->phone_number }}</p>
        <p><strong>Email:</strong> {{ $partyDetail->email }}</p>
        <p><strong>Date:</strong> {{ $date }}</p>
    </div>
</body>
</html>
