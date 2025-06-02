<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use App\Models\Sesi;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // panggil model Jadwal menggunakan Eloquent
        $jadwal = Jadwal::all(); // perintah SQL: SELECT * FROM jadwal
        // dd($jadwal); // dump and die
        return view('jadwal.index')->with('jadwal', $jadwal);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sesi = Sesi::all(); // ambil semua data sesi
        $mataKuliah = MataKuliah::all(); // ambil semua data mata kuliah
        $dosen = User::where('role', 'dosen')->get(); // ambil semua dosen dengan role 'dosen'
        return view('jadwal.create', compact('sesi', 'mataKuliah', 'dosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi input
        $input = $request->validate([
            'tahun_akademik' => 'required',
            'kode_smt' => 'required',
            'kelas' => 'required',
            'mata_kuliah_id' => 'required',
            'dosen_id' => 'required',
            'sesi_id' => 'required'
        ]);
        // simpan data ke tabel jadwal
        Jadwal::create($input);
        // redirect ke route jadwal.index
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        // dd($jadwal);
        return view('jadwal.show', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        // dd($jadwal);
        $sesi = Sesi::all(); // ambil semua data sesi
        $mataKuliah = MataKuliah::all(); // ambil semua data mata kuliah
        $dosen = User::where('role', 'dosen')->get(); // ambil semua dosen dengan role 'dosen'
        return view('jadwal.edit', compact('jadwal', 'sesi', 'mataKuliah', 'dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        // validasi input
        $input = $request->validate([
            'tahun_akademik' => 'required',
            'kode_smt' => 'required',
            'kelas' => 'required',
            'mata_kuliah_id' => 'required',
            'dosen_id' => 'required',
            'sesi_id' => 'required'
        ]);
        // update data jadwal
        $jadwal->update($input);
        // redirect ke route jadwal.index
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        // Temukan jadwal berdasarkan ID
        $jadwal = Jadwal::findOrFail($jadwal->id);
        // dd($jadwal);
        $jadwal->delete();
        // redirect ke route jadwal.index
        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}