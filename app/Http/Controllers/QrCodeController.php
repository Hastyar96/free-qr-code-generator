<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeController extends Controller
{
    public function index()
    {
        return view('qr.index');
    }

    public function generate(Request $request)
    {
        $data = $this->getData($request);

        // Return raw SVG string for the AJAX preview
        return QrCode::format('svg')
                     ->size($request->size ?? 400)
                     ->color(...$this->hexToRgb($request->color))
                     ->backgroundColor(...$this->hexToRgb($request->bg_color))
                     ->errorCorrection($request->error_correction ?? 'M')
                     ->style($request->style ?? 'square')
                     ->eye($request->eye_style ?? 'square')
                     ->generate($data);
    }

    public function download(Request $request)
    {
        $data = $this->getData($request);

        return response(
            QrCode::format($request->format)
                  ->size($request->size ?? 400)
                  ->color(...$this->hexToRgb($request->color))
                  ->backgroundColor(...$this->hexToRgb($request->bg_color))
                  ->errorCorrection($request->error_correction ?? 'M')
                  ->generate($data)
        )->header('Content-Disposition', 'attachment; filename=qrcode.' . $request->format);
    }

    private function getData(Request $request)
    {
        // specific data path: name="data[url]", name="data[phone]", etc.
        $d = $request->input('data');

        return match ($request->type) {
            'text' => $d['text'] ?? '',
            'email' => "mailto:" . ($d['email'] ?? ''),
            'phone' => "tel:" . ($d['phone'] ?? ''),
            'sms' => "sms:" . ($d['phone'] ?? '') . "?body=" . ($d['message'] ?? ''),
            'whatsapp' => "https://wa.me/" . ltrim($d['phone'] ?? '', '+') . "?text=" . urlencode($d['message'] ?? ''),
            'wifi' => "WIFI:T:" . ($d['encryption'] ?? 'WPA') . ";S:" . ($d['ssid'] ?? '') . ";P:" . ($d['password'] ?? '') . ";;",
            'location' => "geo:" . ($d['lat'] ?? '') . "," . ($d['lng'] ?? ''),
            'social' => $d['social_url'] ?? '',
            default => $d['url'] ?? 'https://example.com' // Fallback to URL
        };
    }

    private function hexToRgb($hex)
    {
        $hex = ltrim($hex, '#');
        if(strlen($hex) == 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        return [$r, $g, $b];
    }
}
