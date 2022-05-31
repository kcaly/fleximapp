<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobGroup extends Model
{
    use HasFactory;

    public function job_orders()
    {
        return $this->hasMany('App\Models\JobOrder');
    }

}
