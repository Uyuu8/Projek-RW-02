<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bansos extends Model
{
    use HasFactory;

    protected $table = 'bansos';

    protected $fillable = [
        'uraian_bansos',
        'jenis_bantuan',
        'tahun',
        'diselenggarakan_oleh',
        'disalurkan_melalui',
        'kategori_penerima',
    ];

    public function penerima()
    {
    return $this->hasMany(PenerimaBansos::class);
    }
}

