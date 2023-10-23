<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobOrder extends Model
{
    use HasFactory;

    public function job_group()
    {
        return $this->belongsTo('App\Models\JobGroup');
    }

    public function machine()
    {
        return $this->belongsTo('App\Models\Machine');
    }

    public function element_jobs()
    {
        return $this->hasMany('App\Models\ElementJob');
    }

}
