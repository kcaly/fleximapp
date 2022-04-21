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

        $material_id = $material->id;
        $elements = \App\Models\Element::with(['material', 'elementfiles'])->orderBy('id', 'DESC')->paginate(50);

        $active_filter = array(
            'material_id' => $material_id,
            'id' => null,
            'name' => null,
            'length_operator' => null,
            'length_value' => null,
            'width_operator' => null,
            'width_value' => null,
            'height_operator' => null,
            'height_value' => null,
            'machine_id' => 0,
            'job_group_id' => 0,
            );
            
        return view('element-list', compact('elements'), compact('active_filter'));
    }

    public function delete($id)
    {
        $material = Material::find($id);
        $material->delete();

        return redirect()->route('element.list')->with('message', 'Usunięto materiał.');
    }
}
