<!DOCTYPE html>
<html>
<head>
    <title>QR Codes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        .qr-code {
            display: inline-block;
            margin: 10px;
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Generated QR Codes</h1>
    
        <div class="qr-code">
            <p>QR Code #{{ $i + 1 }}</p>
            {!! $qr !!}
        </div>
 
</body>
</html>
