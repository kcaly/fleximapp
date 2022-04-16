<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    public function create(Request $request)
    {

        $material = new Material();

        $material->name = $request->name;
        $material->value = $request->value;
        $material->price = $request->price;
        $material->length = $request->length;
        $material->width = $request->width;
        $material->height = $request->height;

        $material->save();

        return view('home');



    }
}
