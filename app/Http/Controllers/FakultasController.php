<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use Illuminate\Http\Request;

class FakultasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //panggil model fakultas dmenggunakan eloquent
        $fakultas = Fakultas ::all(); // perintah sql select * from fakultas
        // dd($fakultas); // dump and die
        return view('fakultas.index', compact('fakultas')); //selain compact, bisa menggunakan with()
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fakultas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // cek apakah user memiliki hak akses untuk membuat fakultas
        if ($request->user()->cannot('create', Fakultas::class)) {
            abort(403);
        }

        
        // validasi input
        $input = $request->validate([
            'nama' => 'required|unique:fakultas',
            'singkatan' => 'required|max:5',
            'dekan' => 'required',
            'wakil_dekan' => 'required',
        ]);
        // simpan data ke tabel fakutlas
        Fakultas::create($input);

        //redirect ke route fakultas.index
        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($fakultas)
    {
        $fakultas = Fakultas::findOrFail($fakultas);
        //dd($fakultas);
        return view('fakultas.show', compact('fakultas')); //menampilkan detail fakultas
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($fakultas)
    {
        $fakultas = Fakultas::findOrFail($fakultas);
        return view('fakultas.edit', compact('fakultas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $fakultas)
    {
        $fakultas = Fakultas::findOrFail($fakultas);

        // cek apakah user memiliki hak akses untuk mengupdate fakultas
        if ($request->user()->cannot('update', $fakultas)) {
            abort(403);
        }
        
        
        // validasi input
        $input = $request->validate([
            'nama' => 'required',
            'singkatan' => 'required|max:5',
            'dekan' => 'required',
            'wakil_dekan' => 'required',
        ]);
        // update data fakultas
        $fakultas->update($input);
        //redirect ke route fakultas.index
        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $fakultas)
    {
        $fakultas = Fakultas::findOrFail($fakultas);
        // dd($fakultas);

        if ($request->user()->cannot('delete', $fakultas)) {
            abort(403);
        }


        //hapus data fakultas
        $fakultas->delete();

        //redirect ke route fakultas.index
        return redirect()->route('fakultas.index')->with('success', 'Fakultas berhasil dihapus.');
    }
}