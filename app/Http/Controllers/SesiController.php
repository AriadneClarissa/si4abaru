<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use Illuminate\Http\Request;

class SesiController extends Controller
{
    public function index()
    {
        //panggil model sesi dmenggunakan eloquent
        $sesi = Sesi ::all(); // perintah sql select * from sesi
        // dd($sesi); // dump and die
        return view('sesi.index', compact('sesi'));
    }
    public function create()
    {
        // Logic to show the form for creating a new resource
        return view('sesi.create');
    }
    public function store(Request $request)
    {
        //validasi input
        $input = $request->validate([
            'nama' => 'required|unique:sesi'
        ]);
        // simpan data ke tabel sesi
        Sesi::create($input);
        // redirect ke route sesi.index
        return redirect()->route('sesi.index')->with('success', 'Sesi berhasil ditambahkan.');
    }
    public function show($sesi)
    {
        $sesi = Sesi::findOrFail($sesi);
        //dd($sesi);
        return view('sesi.show', compact('sesi'));
    }
    public function edit($sesi)
    {
        $sesi = Sesi::findOrFail($sesi);
        //dd($sesi);
        return view('sesi.edit', compact('sesi'));
    }
    public function update(Request $request, $sesi)
    {
        $sesi = Sesi::findOrFail($sesi);
        // validasi input
        $input = $request->validate([
            'nama' => 'required',
        ]);
        // update data sesi
        $sesi->update($input);
        // redirect ke route sesi.index
        return redirect()->route('sesi.index')->with('success', 'Sesi berhasil diperbarui.');
    }
    public function destroy($sesi)
    {
        $sesi = Sesi::findOrFail($sesi);
        // dd($sesi);

        // Hapus data sesi
        $sesi->delete();
        // Redirect ke route sesi.index
        return redirect()->route('sesi.index')->with('success', 'Sesi berhasil dihapus.');
    }
}
