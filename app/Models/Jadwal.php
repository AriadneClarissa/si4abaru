<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sesi;
use App\Models\MataKuliah;
use App\Models\User;

class Jadwal extends Model
{
    protected $table = 'jadwal';

    protected $fillable = [
        'tahun_akademik',
        'kode_smt',
        'kelas',
        'mata_kuliah_id',
        'dosen_id',
        'sesi_id',
    ];

    public function sesi()
    {
        return $this->belongsTo(Sesi::class, 'sesi_id');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }

    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }
}