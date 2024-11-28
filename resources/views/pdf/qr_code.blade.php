<!DOCTYPE html>
<html>
<head>
    <title>QR Codes</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .qr-code { margin: 10px; }
    </style>
</head>
<body>
    <h1>Generated QR Codes</h1>
    @for ($i = 0; $i < $quantity; $i++)
        <div class="qr-code">
            <p>QR Code #{{ $i + 1 }}</p>
            <img src="{{ $qrCodeUrl }}" alt="QR Code #{{ $i + 1 }}">
        </div>
    @endfor
</body>
</html>
