<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primary = 'kategori_id';
    protected $fillable = ['nama_kategori'];

    public function media()
    {
        return $this->hasMany(Media::class, 'kategori_id');
    }
}
