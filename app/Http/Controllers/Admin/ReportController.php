<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use PDF;

class ReportController extends Controller
{
    public function generatePDF()
    {
        $data = Order::all();

        $pdf = PDF::loadView('admin.report', ['data' => $data]);

        return $pdf->stream('report.pdf');
    }
}
