<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    use HasFactory;

    public function job_orders()
    {
        return $this->hasMany('App\Models\JobOrder');
    }

    public function element_productions()
    {
        return $this->hasMany('App\Models\ElementProduction');
    }

    
}
