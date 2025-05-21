<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{   
    protected $table = 'mahasiswa'; //nhama tabel
    protected $fillable =[
        'npm',
        'nama',
        'jk',
        'tanggal_lahir',
        'tempat_lahir',
        'asal_sma',
        'prodi_id',
        'foto'
    ];
    public function prodi()
    {
        return $this->belongsTo(Prodi::class);

    }
}
