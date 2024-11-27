<?php

namespace App\Services;

use Dompdf\Dompdf;
use App\Exports\GenericExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportService
{
    public function toPdf($data, $view, $filename)
    {
        $pdf = new Dompdf();
        $pdf->loadHtml(view($view, $data)->render());
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        return $pdf->stream($filename . '.pdf');
    }

    public function toExcel($data, $filename)
    {
        $headings = array_keys(reset($data));
        return Excel::download(new GenericExport($data, $headings), $filename . '.xlsx');
    }
}
