<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;
use App\Http\Requests\CreateReport;
use App\Http\Requests\EditReport;
use App\Report;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index(Folder $folder)
    {
        $folders = Auth::user()->folders()->get();

        $reports = $folder->reports()->get();

        return view('reports.index', [
            'folders' => $folders,
            'current_folder_id' => $folder->id,
            'reports' => $reports,
        ]);
    }

    public function showCreateForm(Folder $folder)
    {
        return view('reports.create', [
            'folder_id' => $folder->id,
        ]);
    }

    public function create(Folder $folder, CreateReport $request)
    {
        $report = new Report();

        $report->report_date = $request->report_date;
        $report->temperature = $request->temperature;
        $report->am_condition = $request->am_condition;
        $report->pm_condition = $request->pm_condition;
        $report->medicines = implode(",", $request->medicines);
        $report->condition_report = $request->condition_report;
        $report->curricilum1 = $request->curricilum1;
        $report->contant1 = $request->contant1;
        $report->curricilum2 = $request->curricilum2;
        $report->contant2 = $request->contant2;
        $report->impressions = $request->impressions;
        $report->interview = $request->interview;
        $report->contact_information = $request->contact_information;

        $folder->reports()->save($report);

        return redirect()->route('reports.index', [
            'folder' => $folder->id,
        ]);
    }

    public function showEditForm(Folder $folder, Report $report)
    {

        $this->checkRelation($folder, $report);
        return view('reports.edit', [
            'report' => $report,
        ]);
    }

    public function edit(Folder $folder, Report $report, CreateReport $request)
    {
        $this->checkRelation($folder, $report);

        $report->report_date = $request->report_date;
        $report->temperature = $request->temperature;
        $report->am_condition = $request->am_condition;
        $report->pm_condition = $request->pm_condition;
        $report->medicines = implode(",", $request->medicines);
        $report->condition_report = $request->condition_report;
        $report->curricilum1 = $request->curricilum1;
        $report->contant1 = $request->contant1;
        $report->curricilum2 = $request->curricilum2;
        $report->contant2 = $request->contant2;
        $report->impressions = $request->impressions;
        $report->interview = $request->interview;
        $report->contact_information = $request->contact_information;

        $report->save();

        return redirect()->route('reports.index', [
            'folder' => $report->folder_id,
        ]);
    }

    private function checkRelation(Folder $folder, Report $report)
    {
        if ($folder->id !== $report->folder_id) {
            abort(404);
        }
    }
}
