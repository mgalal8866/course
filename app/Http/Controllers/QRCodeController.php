<?php

namespace App\Http\Controllers;

use App\Models\Qrcode as ModelsQrcode;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRCodeController extends Controller
{
    public function store(Request $request)
    {
        // التحقق من صحة البيانات المدخلة
        $request->validate([
            'name' => 'required|string|max:255',
            'redirect_to' => 'required|url',
            'color' => 'required|string|max:7', // اللون بصيغة hex
            'backcolor' => 'required|string|max:7', // اللون بصيغة hex
            'size' => 'nullable|integer|min:50|max:500',
        ]);
        $code = Str::random(8);
        // حفظ الـ QR Code في قاعدة البيانات
      

        // إنشاء QR Code باستخدام البيانات المدخلة
        $qr = QrCode::size(100)
            ->backgroundColor(
                hexdec(substr($request->backcolor, 1, 2)),
                hexdec(substr($request->backcolor, 3, 2)),
                hexdec(substr($request->backcolor, 5, 2))
            )
            ->color(
                hexdec(substr($request->color, 1, 2)),
                hexdec(substr($request->color, 3, 2)),
                hexdec(substr($request->color, 5, 2))
            )
            // ->format('png') // Specify format as PNG
            ->generate(env('APP_URL') . '/' . $code); // Ensure URL is correct
            $qrCode = ModelsQrcode::create([
                'code' => $code,
                'name' => $request->name,
                'redirect_to' => $request->redirect_to,
                'color' => $request->color,
                'backcolor' => $request->backcolor,
    
            ]);
        // تخزين الصورة الـ QR في المسار المناسب (مثال: public/qrcodes)
        // $fileName = 'qrcode_' . $qrCode->id . '.png';
        // \Storage::disk('public')->put('qrcodes/' . $fileName, $qr);
        // $qrCode->update(['qr_image' => 'qrcodes/' . $fileName]);

        // تحديث الـ QR Code بملف الصورة المحفوظ
        $qrCode->update(['qr' =>  $qr]);

        // إرجاع استجابة بنجاح العملية
        //  return redirect()->route('qr-codes.index')
        // ->with('success', 'QR code added successfully!');
        return response()->json(['message' => 'QR Code added successfully']);
    }
    public function qr_redirect($code)
    {
        // إنشاء QR Code يحتوي على نص أو رابط
        $qrCode = ModelsQrcode::where('code', $code)->first();
        if (!$qrCode) {
            abort(404, 'Invalid QR Code');
        }

        // Use Laravel's redirect helper
        return redirect()->away($qrCode->redirect_to);
    }
    public function generate_pdf(Request $request)
    {
        $validated = $request->validate([
            'qrCodeUrl' => 'required|string',
            'quantity' => 'required|integer|min:1',
        ]);

        $qrCodeUrl = $validated['qrCodeUrl'];
        $quantity = $validated['quantity'];
         // Generate the PDF with the validated data
        $pdf = Pdf::loadView('pdf.qr_code', [
            'qrCodeUrl' => $qrCodeUrl,
            'quantity' => $quantity,
        ]);

        // Return the PDF as a downloadable file
        return $pdf->download('qr_code.pdf');

      
    }
    public function qr_mangement()
    {
        // phpinfo() ;
        $qrCode = ModelsQrcode::get();

        return view('dashboard.qrcode.qr', compact('qrCode'));
    }
    public function update_qr(Request $request, ModelsQrcode $qr)
    {

        $qr->update([
            'redirect_to' => $request->redirect_to,
        ]);
        return response()->json(['message' => 'QR Code updated successfully']);
    }
    public function generateQRCode()
    {
        $code = Str::random(8);
        $qrCode = QrCode::  // Explicitly set the format to PNG
            size(100)
            ->color(0, 0, 0) // Black QR code
            ->generate(env('APP_URL') . '/' . $code);
        $qr =  ModelsQrcode::create(['name' => $name ?? '', 'qr' => $qrCode, 'code' => $code, 'redirect_to' => 'https://example.com']);



        return view('qrcode', compact('qrCode'));
    }
}
