<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan oleh model
    protected $table = 'mahasiswa';
    // Menentukan kolom yang dijasikan sebagai primayKey pada tabel
    protected $primaryKey = 'mahasiswa_id';
    // Menentukan kolom yang boleh diisi secara massal (mass assignment)
    protected $fillable = ['nim', 'nama_lengkap', 'prodi_id'];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'prodi_id');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'mahasiswa_id', 'mahasiswa_id');
    
    }
}