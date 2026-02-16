<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warga extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'rt',
        'rw',
        'no_kk',
        'pendidikan',
        'agama',
        'status_keluarga',
        'status_perkawinan',
        'pekerjaan',
        'no_hp',
        'status_warga',
        'status_rumah'
    ];

    public function iurans()
    {
        return $this->hasMany(Iuran::class);
    }

}
