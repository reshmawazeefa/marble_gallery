<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\CustomQuotation;
use PDF;

class PDFController extends Controller
{
    public function generatePDF($id)
    {
        $pdf = \PDF::loadView('admin/graphs-pdf');
        $pdf->setOption('enable-javascript', true);
        $pdf->setOption('javascript-delay', 5000);
        $pdf->setOption('enable-smart-shrinking', true);
        $pdf->setOption('no-stop-slow-scripts', true);
        return $pdf->download('graph.pdf');
    }
    public function pdfview($id)
    {
        $data = Quotation::find($id);

        return view('admin.print_quotation',compact('data'));
    }
    public function custom_pdfview($id)
    {
        $data = CustomQuotation::find($id);

        return view('admin.print_custom_quotation',compact('data'));
    }
}
