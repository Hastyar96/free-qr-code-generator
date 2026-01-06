<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Picqer\Barcode\BarcodeGeneratorSVG;
use Picqer\Barcode\BarcodeGeneratorPNG;

class BarcodeController extends Controller
{
    public function index()
    {
        return view('barcode.index'); // Make sure your view folder name matches
    }

    public function generate(Request $request)
    {
        // 1. Validate Input
        $request->validate([
            'data' => 'required|string',
            'type' => 'required|string',
        ]);

        try {
            // 2. Setup Generator
            $generator = new BarcodeGeneratorSVG();
            $type = $this->getBarcodeType($request->type);

            // 3. Generate SVG String
            // widthFactor: 1-5, height: 30-200, color: array
            $svg = $generator->getBarcode(
                $request->data,
                $type,
                $request->width ?? 2,
                $request->height ?? 50,
                $request->color ?? 'black' // Library defaults to black
            );

            // 4. Color Fix (The library produces black bars by default)
            // We manually inject the fill color into the SVG string
            if ($request->color && $request->color !== '#000000') {
                $svg = str_replace('black', $request->color, $svg);
                // Also add fill to rects if not present
                $svg = str_replace('<rect', '<rect fill="'.$request->color.'"', $svg);
            }

            return response($svg, 200)->header('Content-Type', 'image/svg+xml');

        } catch (\Exception $e) {
            return response('Error: ' . $e->getMessage(), 400);
        }
    }

    public function download(Request $request)
    {
        $request->validate([
            'data' => 'required',
            'format' => 'required'
        ]);

        $type = $this->getBarcodeType($request->type);
        $width = $request->width ?? 2;
        $height = $request->height ?? 50;
        $color = $this->hexToRgb($request->color ?? '#000000');

        // Handle Formats
        if ($request->format === 'svg') {
            $generator = new BarcodeGeneratorSVG();
            $content = $generator->getBarcode($request->data, $type, $width, $height, $request->color);
            // Apply color fix
            if ($request->color) {
                $content = str_replace('black', $request->color, $content);
                $content = str_replace('<rect', '<rect fill="'.$request->color.'"', $content);
            }
            $mime = 'image/svg+xml';
        } else {
            // PNG (and used for PDF fallback)
            $generator = new BarcodeGeneratorPNG();
            $content = $generator->getBarcode($request->data, $type, $width, $height, $color);
            $mime = 'image/png';
        }

        return response($content)
            ->header('Content-Type', $mime)
            ->header('Content-Disposition', 'attachment; filename="barcode.'.$request->format.'"');
    }

    // Helper: Map user selection to Library Constants
    private function getBarcodeType($type)
    {
        return match ($type) {
            'code128' => \Picqer\Barcode\BarcodeGenerator::TYPE_CODE_128,
            'code39'  => \Picqer\Barcode\BarcodeGenerator::TYPE_CODE_39,
            'ean13'   => \Picqer\Barcode\BarcodeGenerator::TYPE_EAN_13,
            'ean8'    => \Picqer\Barcode\BarcodeGenerator::TYPE_EAN_8,
            'upca'    => \Picqer\Barcode\BarcodeGenerator::TYPE_UPC_A,
            'upce'    => \Picqer\Barcode\BarcodeGenerator::TYPE_UPC_E,
            'itf'     => \Picqer\Barcode\BarcodeGenerator::TYPE_INTERLEAVED_2_5,
            'isbn'    => \Picqer\Barcode\BarcodeGenerator::TYPE_ISBN, // Note: Library might treat ISBN as EAN13
            'codabar' => \Picqer\Barcode\BarcodeGenerator::TYPE_CODABAR,
            default   => \Picqer\Barcode\BarcodeGenerator::TYPE_CODE_128,
        };
    }

    // Helper: Convert Hex to RGB array for PNG generator
    private function hexToRgb($hex) {
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
