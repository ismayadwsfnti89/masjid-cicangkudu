<?php

namespace App\Http\Controllers;

use App\Imports\WargaImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class WargaImportController extends Controller
{
    public function index()
    {
        return view('admin.import-warga');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new WargaImport, $request->file('file'));

        return back()->with('success', 'Data warga berhasil diimport!');
    }
}