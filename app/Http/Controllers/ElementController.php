<?php

namespace App\Http\Controllers;

use App\Http\Requests\ElementRequest;
use App\Models\Article;
use App\Models\Element;
use App\Models\ElementFile;
use Illuminate\Http\Request;
use DB;

class ElementController extends Controller
{
    public function create(ElementRequest $request)
    {

            $element = new Element();
            $element->name = $request->name;
            $element->length = $request->length;
            $element->width = $request->width;
            $element->height = $request->height;
            $element->material_id = $request->material_id;

            $dl = $element->length*0.001;
            $szer = $element->width*0.001;
            $wys = $element->height*0.001;
            $gr = $element->material->value;
            $waga = $dl*$szer*$wys*$gr;
            $element->weight = $waga;


            $element->save();

            if ($request->pdf)
            {
                $path = $request->pdf->store('public/element_files');
                $element_pdf = new ElementFile();
                $element_pdf->type = "pdf"; 
                $element_pdf->path = $path;
                $element_pdf->element_id = $element->id;

                $element_pdf->save();

            }

            if ($request->dxf)
            {
                $path = $request->dxf->store('public/element_files');
                $element_dxf = new ElementFile();
                $element_dxf->type = "dxf";
                $element_dxf->path = $path;
                $element_dxf->element_id = $element->id;

                $element_dxf->save();

            }

            return redirect()->route('element.list')->with('message', 'Pomyślnie dodano nowy element.');

    }

    public function show()
    {
        
        $elements = Element::with(['material', 'elementfiles'])->paginate(50);

        $active_filter = array(
            'material_id' => null,
            'id' => null,
            'name' => null,
            'length_type' => null,
            'length_value' => null,
            'width_type' => null,
            'width_value' => null,
            'height_type' => null,
            'height_value' => null,
            );
            
        return view('element-list', compact('elements'), compact('active_filter'));
    }

    public function show_custom_size(Request $request)
    {
        $active_filter = array(
            'material_id' => null,
            'id' => null,
            'name' => null,
            'length_type' => null,
            'length_value' => null,
            'width_type' => null,
            'width_value' => null,
            'height_type' => null,
            'height_value' => null,
            );
        
        $elements = Element::with(['material', 'elementfiles'])->paginate($request->size);
        return view('element-list', compact('elements'), compact('active_filter'));
        
    }




    public function edit($id)
    {
        $element = Element::find($id);
        $articles = Article::with('elements')->get();
        // $pdf = $element->elementfiles->where('type', 'pdf')->first();
        // $dxf = $element->elementfiles->where('type', 'dxf')->first();

        return view('element-edit', compact('element'), compact('articles'));
        
        
    }

    public function wylicz_wage_elementu($element_id)
    {
        $element = Element::find($element_id);
        $dl = $element->length*0.001;
        $szer = $element->width*0.001;
        $wys = $element->height*0.001;
        $gr = $element->material->value;
        $waga = $dl*$szer*$wys*$gr;
        $element->weight = $waga;
        $element->save();



    }

    public function rekalkuacja_artykulow($element_id)
    {
        $element = Element::find($element_id);
        $articles = Article::with('elements')->get();

        foreach ($articles as $article)
        {
            foreach ($article->elements as $element_in_article)
            {
                if($element_in_article->id != $element->id)
                {

                }
                else
                {
                    $article = Article::find($article->id);
                    $article->price = 0;
                    $article_elements = $article->elements;
        
        
                    foreach ($article_elements as $element)
                    {
            
                        $price_for_element = $element->weight * $element->material->price * $element->pivot->amount;
            
                        $article->price = $article->price + $price_for_element;
            

                    }
        
                    $article->save();
                    
                }                             
            }
        }
    }

    public function update(ElementRequest $request)
    {

        $element = Element::find($request->id);

        $element->name = $request->name;

        if (!($element->length == $request->length && $element->width == $request->width && $element->height == $request->height))
        {
            $element->length = $request->length;
            $element->width = $request->width;
            $element->height = $request->height;
            $element->save();
            ElementController::wylicz_wage_elementu($request->id);
            ElementController::rekalkuacja_artykulow($request->id);
        
        }


        
        if ($request->material_id != $element->material_id)
        {
            $element->material_id = $request->material_id;
            $element->save();
            ElementController::wylicz_wage_elementu($request->id);
            ElementController::rekalkuacja_artykulow($request->id);

           
        }

        
        if ($request->pdf)
            {
                $path = $request->pdf->store('public/element_files');
                $element_pdf = new ElementFile();
                $element_pdf->type = "pdf"; 
                $element_pdf->path = $path;
                $element_pdf->element_id = $request->id;

                $element_pdf->save();

            }

            if ($request->dxf)
            {
                $path = $request->dxf->store('public/element_files');
                $element_dxf = new ElementFile();
                $element_dxf->type = "dxf"; 
                $element_dxf->path = $path;
                $element_dxf->element_id = $request->id;

                $element_dxf->save();

            }

        $element->save();

        return redirect()->route('element.list')->with('message', 'Pomyślnie zapisano element.');

    }


    public function filepdf_delete($id)
    {
      
        ElementFile::where('element_id', $id)->where('type', 'pdf')->delete();

        $element = Element::find($id);
        $articles = Article::with('elements')->get();
        
        return view('element-edit', compact('element'), compact('articles'));

    }
    public function filedxf_delete($id)
    {
      
        ElementFile::where('element_id', $id)->where('type', 'dxf')->delete();

        $element = Element::find($id);
        $articles = Article::with('elements')->get();
        
        return view('element-edit', compact('element'), compact('articles'));

    }


    public function element_delete($id)
    {

        ElementFile::where('element_id', $id)->delete();

        Element::where('id', $id)->delete();

        return redirect()->route('element.list')->with('message', 'Usunięto element.');
        
    }













    public function filter_returner($material_id, $id, $name, $length_type, $length_value, $width_type, $width_value, $height_type, $height_value)
    {

        if($material_id == 0)
        {
            $material_operator = '<>';
        }
        else
        {
            $material_operator = '=';
        }


        if($length_value==null && $width_value!=null && $height_value!=null)
        {
            $elements = Element::with(['material', 'elementfiles'])
           ->where('material_id', $material_operator, $material_id)
           ->where('name','LIKE',$name.'%')
           ->where('id','LIKE',$id)
           ->where('width', $width_type, $width_value)
           ->where('height', $height_type, $height_value)
           ->paginate(500);
        }
    
        if($height_value==null && $length_value!=null && $width_value!=null)
        {
            $elements = Element::with(['material', 'elementfiles'])
           ->where('material_id', $material_operator, $material_id)
           ->where('name','LIKE',$name.'%')
           ->where('id','LIKE',$id)
           ->where('length', $length_type, $length_value)
           ->where('width', $width_type, $width_value)
           ->paginate(500);
        }
    
        if($width_value==null && $length_value!=null && $height_value!=null)
        {
            $elements = Element::with(['material', 'elementfiles'])
           ->where('material_id', $material_operator, $material_id)
           ->where('name','LIKE',$name.'%')
           ->where('id','LIKE',$id)
           ->where('length', $length_type, $length_value)
           ->where('height', $height_type, $height_value)
           ->paginate(500);
        }
    
    
        ////
    
    
        if($length_value==null && $width_value==null && $height_value!=null)
        {  
            $elements = Element::with(['material', 'elementfiles'])
           ->where('material_id', $material_operator, $material_id)
           ->where('name','LIKE',$name.'%')
           ->where('id','LIKE',$id)
           ->where('height', $height_type, $height_value)
           ->paginate(500);  
        }
    
        if($length_value==null && $width_value!=null && $height_value==null)
        {  
            $elements = Element::with(['material', 'elementfiles'])
           ->where('material_id', $material_operator, $material_id)
           ->where('name','LIKE',$name.'%')
           ->where('id','LIKE',$id)
           ->where('width', $width_type, $width_value)
           ->paginate(500);  
        }
    
        if($length_value!=null && $width_value==null && $height_value==null)
        {  
            $elements = Element::with(['material', 'elementfiles'])
           ->where('material_id', $material_operator, $material_id)
           ->where('name','LIKE',$name.'%')
           ->where('id','LIKE',$id)
           ->where('length', $length_type, $length_value)
           ->paginate(500);  
        }
    
    
        ////
    
    
        if($length_value!=null && $width_value!=null && $height_value!=null)
        {
            $elements = Element::with(['material', 'elementfiles'])
           ->where('material_id', $material_operator, $material_id)
           ->where('name','LIKE',$name.'%')
           ->where('id','LIKE',$id)
           ->where('length', $length_type, $length_value)
           ->where('width', $width_type, $width_value)
           ->where('height', $height_type, $height_value)
           ->paginate(500);
        }
    
        if($length_value==null && $width_value==null && $height_value==null)
        {
            $elements = Element::with(['material', 'elementfiles'])
           ->where('material_id', $material_operator, $material_id)
           ->where('name','LIKE',$name.'%')
           ->where('id','LIKE',$id)
           ->paginate(500);
        }

        return $elements;

    }




    public function filter(Request $request)
    {
    
    $active_filter = array(
    'material_id' => $request->material_id,
    'id' => $request->id,
    'name' => $request->name,
    'length_type' => $request->length_type,
    'length_value' => $request->length_value,
    'width_type' => $request->width_type,
    'width_value' => $request->width_value,
    'height_type' => $request->height_type,
    'height_value' => $request->height_value,
    
    
    );


    $elements = ElementController::filter_returner($request->material_id, $request->id, $request->name, $request->length_type, $request->length_value, $request->width_type, $request->width_value, $request->height_type, $request->height_value);


        
        return view('element-list', compact('elements', 'active_filter'));


    }






}
