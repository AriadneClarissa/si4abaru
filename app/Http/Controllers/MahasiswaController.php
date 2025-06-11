<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //panggil model mahasiswa dmenggunakan eloquent
        $mahasiswa = Mahasiswa::all(); // perintah sql select * from mahasiswa
        // dd($mahasiswa); // dump and die
        return view('mahasiswa.index')->with('mahasiswa', $mahasiswa);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodi = Prodi::all(); // ambil semua data fakultas
        return view('mahasiswa.create', compact('prodi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi input
        $input = $request->validate([
            'npm' => 'required|unique:mahasiswa',
            'nama' => 'required',
            'jk' => 'required',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'asal_sma' => 'required',
            'prodi_id' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // jika ada file foto yang diupload
        if ($request->hasFile('foto')) {
            // // ambil file foto
            // $file = $request->file('foto');
            // // buat nama file unik, agar nama foto tidak ada yang sama
            // $filename = time() . '.' . $file->getClientOriginalExtension();
            // // simpan file foto ke folder public/foto
            // $file->move(public_path('foto'), $filename);
            // // simpan nama file baru ke database
            // $input['foto'] = $filename;
            try {
                $file = $request->file('foto');
                $response = Http::asMultipart()->post(
                    'https://api.cloudinary.com/v1_1/' . env('CLOUDINARY_CLOUD_NAME') . '/image/upload',
                    [
                        [
                            'name'     => 'file',
                            'contents' => fopen($file->getRealPath(), 'r'),
                            'filename' => $file->getClientOriginalName(),
                        ],
                        [
                            'name'     => 'upload_preset',
                            'contents' => env('CLOUDINARY_UPLOAD_PRESET'),
                        ],
                    ]
                );

                $result = $response->json();
                if (isset($result['secure_url'])) {
                    $input['foto'] = $result['secure_url'];
                } else {
                    return back()->withErrors(['foto' => 'Cloudinary upload error: ' . ($result['error']['message'] ?? 'Unknown error')]);
                }
            } catch (\Exception $e) {
                return back()->withErrors(['foto' => 'Cloudinary error: ' . $e->getMessage()]);
            }
        }

        // simpan data ke tabel mahasiswa
        Mahasiswa::create($input);

        // redirect ke route mahasiswa.index
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //dd($mahasiswa);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //dd($mahasiswa);
        $prodi = Prodi::all(); // ambil semua data prodi
        return view('mahasiswa.edit', compact('mahasiswa', 'prodi')); // mengirim data mahasiswa dan prodi ke view edit
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        //validasi input
        $input = $request->validate([
            'npm' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required',
            'asal_sma' => 'required',
            'prodi_id' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // jika ada file foto yang diupload
        if ($request->hasFile('foto')) {
            // hapus foto lama jika ada
            if ($mahasiswa->foto) {
                $fotoPath = public_path('foto/' . $mahasiswa->foto);
                if (file_exists($fotoPath)) {
                    unlink($fotoPath); // hapus file foto lama
                }
            }
            
            // ambil file foto
            $file = $request->file('foto');
            // buat nama file unik, agar nama foto tidak ada yang sama
            $filename = time() . '.' . $file->getClientOriginalExtension();
            // simpan file foto ke folder public/foto
            $file->move(public_path('foto'), $filename);
            // simpan nama file baru ke database
            $input['foto'] = $filename;
        } else {
            // jika tidak ada file foto yang diupload, tetap gunakan foto lama
            $input['foto'] = $mahasiswa->foto;
        }
        // update data ke tabel mahasiswa
        $mahasiswa->update($input);
        // redirect ke route mahasiswa.index
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete(); // hapus data mahasiswa
        // jika ada foto, hapus juga file fotonya
        if ($mahasiswa->foto) {
            $fotoPath = public_path('foto/' . $mahasiswa->foto);
            if (file_exists($fotoPath)) {
                unlink($fotoPath); // hapus file foto
            }
        }
        // redirect ke route mahasiswa.index
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }
}