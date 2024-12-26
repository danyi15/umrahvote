<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Vote;


class Candidate extends Model
{

    public function vote()
{
    return $this->hasMany(Vote::class, 'candidate_id', 'id_candidate');
}
    // Nama tabel jika tidak sesuai konvensi
    protected $table = 'candidates';

    // Primary key yang berbeda dari default 'id'
    protected $primaryKey = 'id_candidate';

    // Primary key auto increment
    public $incrementing = true;

    // Tipe primary key
    protected $keyType = 'int';

    // Kolom yang diizinkan untuk mass assignment
    protected $fillable = [
        'nama_ketua',
        'nama_wakil',
        'visi',
        'misi',
        'program_kerja',
        'photo',
    ];

    // Tanggal soft delete
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    // Cast untuk tipe data tertentu
    protected $casts = [
        'program_kerja' => 'array', // JSON menjadi array
    ];

    // Accessor untuk photo_url
    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('storage/' . $this->photo) : asset('images/default.png');
    }

    // Relasi dengan tabel votes
    public function votes()
    {
        return $this->hasMany(Vote::class, 'candidate_id', 'id_candidate');
    }
}
