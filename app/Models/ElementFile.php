<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementFile extends Model
{
    use HasFactory;
    
    public function element()
    {
        return $this->belongsTo('App\Models\Element');
        
    }
}
