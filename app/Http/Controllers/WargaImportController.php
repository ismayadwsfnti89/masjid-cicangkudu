<?php

namespace App\Http\Controllers;

use App\Imports\WargaImport;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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

        try {
            Excel::import(new WargaImport, $request->file('file'));
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (\Throwable $exception) {
            return back()->withInput()->withErrors(['file' => 'Import gagal. Periksa format file dan pastikan data tidak duplikat.']);
        }

        return back()->with('success', 'Data warga dan KK berhasil diimport.');
    }
}
