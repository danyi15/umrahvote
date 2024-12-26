<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Candidate;


class Vote extends Model
{
    public function candidate()
{
    return $this->belongsTo(Candidate::class, 'candidate_id', 'id_candidate');
}
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
