<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementProduction extends Model
{
    use HasFactory;

    public function order()
    {
        return $this->belongsTo('App\Models\Order');
    }

    public function article()
    {
        return $this->belongsTo('App\Models\Articel');
    }

    public function element()
    {
        return $this->belongsTo('App\Models\Element');
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function production()
    {
        return $this->belongsTo('App\Models\Production');
    }

}
