<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportsController extends Controller
{
    public function index()
    {   
        $reports = Report::whereNotNull('published_at')
            ->whereNull('archived_at')
            ->orderBy('year', 'DESC')
            ->get()
            ->map(function ($n) {
                $n->content = substr(strip_tags($n->content), 0, 300);
                return $n;
            });

        return view('reports', ['reports' => $reports]);
    }

    public function getReportPage($id)
    {
        $report = Report::find($id);
        if ($report) {
            return view('report_page', ['report' => $report]);
        }

    }
}
