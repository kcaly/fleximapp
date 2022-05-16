<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementJob extends Model
{
    use HasFactory;

    public function element()
    {
        return $this->belongsTo('App\Models\Element');
    }
    
    public function material()
    {
        return $this->belongsTo('App\Models\Material');
    }

    public function machine()
    {
        return $this->belongsTo('App\Models\Machine');
    }

    public function job_group()
    {
        return $this->belongsTo('App\Models\JobGroup');
    }
}
