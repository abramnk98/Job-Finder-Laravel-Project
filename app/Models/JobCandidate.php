<?php

namespace  App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class JobCandidate extends Pivot
{

    public function candidate()
    {

        return $this->belongsTo(CandidateProfile::class, 'candidate_id', 'id');
    }

    public function job()
    {

        return $this->belongsTo(Job::class, 'job_id', 'id');
    }
}
