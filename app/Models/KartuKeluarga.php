<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KartuKeluarga extends Model
{
    protected $fillable = ['no_kk', 'foto_kk'];

    public function wargas()
    {
        return $this->hasMany(Warga::class, 'no_kk', 'no_kk');
    }
}
