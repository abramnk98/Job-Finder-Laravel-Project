<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'min_salary', 'max_salary', 'location_id', 'type', 'user_id', 'career_id', 'image'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function career()
    {
        return $this->belongsTo(Career::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class)->distinct();
    }

    public function candidates ()
    {

        return $this->belongsToMany(CandidateProfile::class,'job_candidate', 'job_id', 'candidate_id')
            ->withPivot('status')
            ->withTimestamps();
    }
}
