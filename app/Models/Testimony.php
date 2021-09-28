<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'candidate_profile_id'];

    public function candidateProfile()
    {
        return $this->belongsTo(CandidateProfile::class);
    }
}
