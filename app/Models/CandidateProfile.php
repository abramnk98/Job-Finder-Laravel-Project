<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateProfile extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'phone', 'location_id', 'careers', 'photo', 'user_id'];


    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function testimony()
    {
        return $this->hasOne(Testimony::class);
    }

    public function user()
    {

        return $this->belongsTo(User::class);
    }

    public function jobs()
    {
        return $this->belongsToMany(Job::class, 'job_candidate','candidate_id', 'job_id')
            ->withPivot('status');
    }
}
