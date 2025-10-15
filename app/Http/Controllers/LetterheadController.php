<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi;

class LetterheadController extends Controller
{
    public function index()
    {
        return view('letterhead');
    }

    public function process(Request $request)
    {
        $request->validate([
            'pdf' => 'required|mimes:pdf|max:10240', // max 10MB
        ]);

        $uploadedFile = $request->file('pdf');
        $inputPath = $uploadedFile->getRealPath();
        $outputPath = storage_path('app/public/outputs/stamped_' . time() . '.pdf');
        $imagePath = public_path('letterheads/letterhead.png');

        $this->addLetterheadImage($inputPath, $imagePath, $outputPath);

        return response()->download($outputPath)->deleteFileAfterSend(true);
    }

    private function addLetterheadImage($inputPdf, $imagePath, $outputPdf)
    {
        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($inputPdf);

        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $templateId = $pdf->importPage($pageNo);
            $size = $pdf->getTemplateSize($templateId);

            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);

            // Add the PNG letterhead (adjust position and size as needed)
            $pdf->Image($imagePath, 0, 0, $size['width'], $size['height']);

            // Add the original PDF content on top
            $pdf->useTemplate($templateId, 0, 0, $size['width'], $size['height']);
        }

        $pdf->Output('F', $outputPdf);
    }
}
