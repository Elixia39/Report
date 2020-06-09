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

        //ここにフォルダーなかった時のif文を置きます

        return view('reports.index', [
            'folders' => $folders,
            'current_folder_id' => $id,
        ]);
    }

    public function showCreateForm(int $id)
    {
        return view('reports.create', [
            'folder_id' => $id,
        ]);
    }
}
