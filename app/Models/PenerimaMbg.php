<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenerimaMbg extends Model
{
    use HasFactory;

    protected $table = 'penerima_mbgs';

    protected $fillable = [
        'warga_id',
        'kategori',
        'tanggal_mulai',
        'keterangan'
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}