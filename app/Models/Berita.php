<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'kategori_id',
        'thumbnail',
        'is_active',
        'created_by'
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class ,'kategori_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class ,'created_by','id');
    }
}
