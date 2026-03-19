<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenerimaBansos extends Model
{
    protected $table = 'penerima_bansos';

    protected $fillable = [
        'bansos_id',
        'warga_id'
    ];

    public function bansos()
    {
        return $this->belongsTo(Bansos::class);
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}