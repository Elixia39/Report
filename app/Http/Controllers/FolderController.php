<?php

namespace App\Http\Controllers;

use App\Folder;
use App\Calendar;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFolder;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{

    public function showCreateForm()
    {
        return view('folders/create');
    }

    public function create(CreateFolder $request)
    {
        $folder = new Folder();
        $folder->title = $request->title;

        Auth::user()->folders()->save($folder);

        return redirect()->route('reports.index', [
            'folder' => $folder->id,
        ]);
    }
}
