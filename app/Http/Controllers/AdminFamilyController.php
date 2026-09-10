<?php

namespace App\Http\Controllers;

use App\Imports\FamilyImport;
use App\Models\Family;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class AdminFamilyController extends Controller
{
    public function index()
    {
        $families = Family::withCount('members')->orderBy('no_kk')->get();
        return view('admin.families.index', compact('families'));
    }

    public function create()
    {
        return view('admin.families.form');
    }

    public function importForm()
    {
        return view('admin.families.import');
    }

    public function import(Request $request)
    {
        $request->validate(['file' => ['required', 'mimes:xlsx,xls,csv', 'max:2048']]);
        try {
            Excel::import(new FamilyImport, $request->file('file'));
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (\Throwable $exception) {
            return back()->withInput()->withErrors(['file' => 'Import gagal. Periksa format file dan data KK.']);
        }
        return back()->with('success', 'Data KK berhasil diimport.');
    }

    public function store(Request $request)
    {
        Family::create($this->validated($request));
        return redirect()->route('admin.families.index')->with('success', 'Data KK berhasil ditambahkan.');
    }

    public function edit(Family $family)
    {
        return view('admin.families.form', compact('family'));
    }

    public function update(Request $request, Family $family)
    {
        $family->update($this->validated($request, $family));
        return redirect()->route('admin.families.index')->with('success', 'Data KK berhasil diperbarui.');
    }

    public function destroy(Family $family)
    {
        $family->delete();
        return back()->with('success', 'Data KK berhasil dihapus.');
    }

    private function validated(Request $request, ?Family $family = null): array
    {
        if (! $family && Family::count() >= 100) {
            abort(422, 'Batas 100 KK telah tercapai.');
        }

        return $request->validate([
            'no_kk' => ['required', 'string', 'max:50', Rule::unique('families', 'no_kk')->ignore($family)],
            'golongan' => ['required', 'integer', Rule::in(array_keys(Family::TARIF_GOLONGAN))],
        ]);
    }
}
