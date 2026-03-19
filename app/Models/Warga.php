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
        'rt',
        'rw',
        'no_kk',
        'pendidikan',
        'agama',
        'status_keluarga',
        'status_perkawinan',
        'pekerjaan',
        'status_warga',
        'status_rumah'
    ];

    public function iurans()
    {
        return $this->hasMany(Iuran::class);
    }

    public function getNamaSensorAttribute()
    {
    return substr($this->nama_lengkap, 0, 3) . '***';
    }

    public function mbg()
    {
    return $this->hasOne(PenerimaMbg::class);
    }

    public function bansos()
    {
    return $this->hasMany(PenerimaBansos::class);
    }

    public function kartuKeluarga()
    {
    return $this->belongsTo(KartuKeluarga::class, 'no_kk', 'no_kk');
    }

}
