<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //panggil model prodi menggunakan eloquent
        $prodi = Prodi::all(); // perinta SQL select * from Prodi
        // dd($prodi); // dump and die
        return view('prodi.index')->with('prodi', $prodi); //selain compact, bisa menggunakan with()
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fakultas = Fakultas::all(); 
        return view ('prodi.create', compact ('fakultas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'nama' => 'required|unique:prodi',
            'singkatan' => 'required|max:5',
            'kaprodi' => 'required',
            'sekretaris' => 'required',
            'fakultas_id' => 'required|exists:fakultas,id',
        ]);

        Prodi::create($input);

        return redirect()->route('prodi.index')->with('success', 'Program studi berhasil ditambahkan.');
    }


    /**
     * Display the specified resource.
     */
    public function show($prodi)
    {
        $prodi = Prodi::findOrFail($prodi); // mencari fakultas berdasarkan id
        //dd($prodi); // dump and die
        return view('prodi.show', compact('prodi')); // menampilkan detail fakultas
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prodi $prodi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prodi $prodi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($prodi)
    {
        // Temukan data prodi berdasarkan ID
        $prodi = Prodi::findOrFail($prodi);
        // dd($prodi);
        // Hapus data prodi
        $prodi->delete();
        // Redirect ke route prodi.index
        return redirect()->route('prodi.index')->with('success', 'Program Studi berhasil dihapus.');
    }
}