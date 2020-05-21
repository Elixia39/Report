<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Folder;

class ReportController extends Controller
{
    public function index(int $id)
    {
        $folders = Folder::all();
        $current_folder = Folder::find($id);

        return view('reports.index', [
            'folders' => $folders,
            'current_folder_id' => $id,
        ]);
    }
}
