<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeProfile extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'company_name', 'phone', 'logo', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
