<?php

namespace App\Http\Controllers;

use App\Http\Requests\ElementRequest;
use App\Models\Article;
use App\Models\Element;
use App\Models\ElementFile;
use App\Models\JobGroup;
use App\Models\Machine;

use Illuminate\Http\Request;

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
            $element->job_group_id = $request->job_group_id;
            $element->machine_id = $request->machine_id;
            
            $length = $element->length*0.001;
            $width = $element->width*0.001;
            $height = $element->height*0.001;
            $value = $element->material->value;
            $weight = $length*$width*$height*$value;
            $element->weight = $weight;

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


    public function edit($id)
    {
        $element = Element::find($id);
        $articles = Article::with('elements')->get();

        return view('element-edit', compact('element'), compact('articles'));    
    }


    public function wylicz_wage_elementu($element_id)
    {
        $element = Element::find($element_id);
        $length = $element->length*0.001;
        $width = $element->width*0.001;
        $height = $element->height*0.001;
        $value = $element->material->value;
        $weight = $length*$width*$height*$value;
        $element->weight = $weight;

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
        

        if ($request->job_group_id != null)
        {
            $element->job_group_id = $request->job_group_id;
        }
        
        if ($request->machine_id != null)
        {
            $element->machine_id = $request->machine_id;
        }
        

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




    public function show()
    {   
        $elements = Element::with(['material', 'elementfiles'])->orderBy('id', 'DESC')->paginate(50);

        $active_filter = array(
            'material_id' => null,
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




    public function create_machine(Request $request)
    {
        $machine = new Machine();
        $machine->name = $request->name;
        $machine->save();

        return redirect()->route('element.list')->with('message', 'Pomyślnie utworzono nową maszynę.');
    }


    public function add_elements_to_machine(Request $request) 
    {

        $active_filter = array(
            'material_id' => $request->filter_material_id,
            'id' => $request->filter_id,
            'name' => $request->filter_name,
            'length_operator' => $request->filter_length_operator,
            'length_value' => $request->filter_length_value,
            'width_operator' => $request->filter_width_operator,
            'width_value' => $request->filter_width_value,
            'height_operator' => $request->filter_height_operator,
            'height_value' => $request->filter_height_value,
            'machine_id' => 0,
            'job_group_id' => 0,
                      
            );

        $elements = ElementController::filter_returner($request->material_id, $request->filter_id, $request->filter_name, $request->filter_length_operator, $request->filter_length_value, $request->filter_width_operator, $request->filter_width_value, $request->filter_height_operator, $request->filter_height_value);


        $select_machine = $request->select_machine;

        switch ($request->action)
        {
            case 1:

                $new_machine = new Machine();
                $new_machine->name = $request->name_new_machine;

                $new_machine->save();

                $select_machine = $new_machine->id;

            case 0:

                    if ($select_machine != null)
                    {
                        
                                if ($request->default_filter == 1)
                                {
                                    $filter_string = "material_id:".$request->filter_material_id.";"."id:".$request->filter_id.";"."name:".$request->filter_name.";"."length_operator:".$request->filter_length_operator.";"."length:".$request->filter_length_value.";"."width_operator:".$request->filter_type.";"."width_value:".$request->filter_width_value.";"."height_operator:".$request->filter_height_operator.";"."height_value:".$request->filter_height_value;
                                    
                                    $machine = Machine::find($select_machine);
                                    $machine->default_filter = $filter_string;
                                    $machine->save();
                                }


                                if ($request->not_null == 1)
                                {
                                    foreach ($elements as $element)
                                    {
                                            $element->machine_id = $select_machine;
                                            $element->save(); 
                                    }
                                    
                                }
                                else
                                {
                                    
                                    foreach ($elements as $element)
                                    {
                                        if ($element->machine_id == null)
                                        {
                                            $element->machine_id = $select_machine;
                                            $element->save(); 
                                        }
                                    }

                                }

                                $elements = Element::with(['material', 'elementfiles'])
                                ->where('machine_id', $select_machine)
                                ->orderBy('id', 'DESC')->paginate(100);

                                $active_filter = array(
                                    'material_id' => null,
                                    'id' => null,
                                    'name' => null,
                                    'length_operator' => null,
                                    'length_value' => null,
                                    'width_operator' => null,
                                    'width_value' => null,
                                    'height_operator' => null,
                                    'height_value' => null,
                                    'machine_id' => $select_machine,
                                    'job_group_id' => null,

                                );
                        }

                        
        }

        return view('element-list', compact('elements', 'active_filter'));

    }



    public function create_job_group(Request $request)
    {
        $job_group = new JobGroup();
        $job_group->name = $request->name;
        $job_group->save();

        return redirect()->route('element.list')->with('message', 'Pomyślnie utworzono nową grupę.');     
    }


    public function add_elements_to_jobgroup(Request $request) 
    {

        $active_filter = array(
            'material_id' => $request->filter_material_id,
            'id' => $request->filter_id,
            'name' => $request->filter_name,
            'length_operator' => $request->filter_length_operator,
            'length_value' => $request->filter_length_value,
            'width_operator' => $request->filter_width_operator,
            'width_value' => $request->filter_width_value,
            'height_operator' => $request->filter_height_operator,
            'height_value' => $request->filter_height_value,
            'machine_id' => 0,
            'job_group_id' => 0,
                      
            );

        $elements = ElementController::filter_returner($request->material_id, $request->filter_id, $request->filter_name, $request->filter_length_operator, $request->filter_length_value, $request->filter_width_operator, $request->filter_width_value, $request->filter_height_operator, $request->filter_height_value);


        $select_job_group = $request->select_job_group;

        switch ($request->action)
        {
            case 1:

                $new_job_group = new JobGroup();
                $new_job_group->name = $request->name_new_job_group;

                $new_job_group->save();

                $select_job_group = $new_job_group->id;

            case 0:

                    if ($select_job_group != null)
                    {

                                if ($request->default_filter == 1)
                                {
                                    $filter_string = $request->filter_material_id.";".$request->filter_id.";".$request->filter_name.";".$request->filter_length_operator.";".$request->filter_length_value.";".$request->filter_type.";".$request->filter_width_value.";".$request->filter_height_operator.";".$request->filter_height_value;
                                    
                                    $job_group = JobGroup::find($select_job_group);
                                    $job_group->default_filter = $filter_string;
                                    $job_group->save();
                                }


                                if ($request->not_null == 1)
                                {
                                    foreach ($elements as $element)
                                    {
                                            $element->job_group_id = $select_job_group;
                                            $element->save(); 
                                    }
                                    
                                }
                                else
                                {
                                    
                                    foreach ($elements as $element)
                                    {
                                        if ($element->job_group_id == null)
                                        {
                                            $element->job_group_id = $select_job_group;
                                            $element->save(); 
                                        }
                                    }

                                }

                                $elements = Element::with(['material', 'elementfiles'])
                                ->where('job_group_id', $select_job_group)
                                ->orderBy('id', 'DESC')->paginate(100);

                                $active_filter = array(
                                    'material_id' => null,
                                    'id' => null,
                                    'name' => null,
                                    'length_operator' => null,
                                    'length_value' => null,
                                    'width_operator' => null,
                                    'width_value' => null,
                                    'height_operator' => null,
                                    'height_value' => null,
                                    'machine_id' => null,
                                    'job_group_id' => $select_job_group,

                                );
                    }
        }           

        return view('element-list', compact('elements', 'active_filter'));

    }


    public function filter(Request $request)
    {
           
    if($request->job_group_id == 0 && $request->machine_id == 0)
    {

        $active_filter = array(
            'material_id' => $request->material_id,
            'id' => $request->id,
            'name' => $request->name,
            'length_operator' => $request->length_operator,
            'length_value' => $request->length_value,
            'width_operator' => $request->width_operator,
            'width_value' => $request->width_value,
            'height_operator' => $request->height_operator,
            'height_value' => $request->height_value,
            'machine_id' => 0,
            'job_group_id' => 0,
               
            );

        $elements = ElementController::filter_returner($request->material_id, $request->id, $request->name, $request->length_operator, $request->length_value, $request->width_operator, $request->width_value, $request->height_operator, $request->height_value);

    }
    else
    {

        $active_filter = array(
            'material_id' => $request->material_id,
            'id' => null,
            'name' => null,
            'length_operator' => null,
            'length_value' => null,
            'width_operator' => null,
            'width_value' => null,
            'height_operator' => null,
            'height_value' => null,
            'machine_id' => $request->machine_id,
            'job_group_id' => $request->job_group_id,
               
            );

        if($request->material_id == 0)
        {
            $material_operator = '<>';
        }
        else
        {
            $material_operator = '=';
        }

        if($request->machine_id == 0 || $request->machine_id == null)
        {
            $machine_operator = '<>';
        }
        else
        {
            $machine_operator = '=';
        }

        if($request->job_group_id == 0 || $request->job_group_id == null)
        {
            $job_group_operator = '<>';
        }
        else
        {
            $job_group_operator = '=';
        }    

        if($request->machine_id == 0)
        {
            $elements = Element::with(['material', 'elementfiles'])
            ->where('material_id', $material_operator, $request->material_id)
            ->where('job_group_id', $job_group_operator, $request->job_group_id)
            ->orderBy('id', 'DESC')->paginate(100);
        }

        if($request->job_group_id == 0)
        {
            $elements = Element::with(['material', 'elementfiles'])
            ->where('material_id', $material_operator, $request->material_id)
            ->where('machine_id', $machine_operator, $request->machine_id)
            ->orderBy('id', 'DESC')->paginate(100);
        }

        if($request->job_group_id != 0 && $request->machine_id != 0)
        {
            $elements = Element::with(['material', 'elementfiles'])
            ->where('material_id', $material_operator, $request->material_id)
            ->where('job_group_id', $job_group_operator, $request->job_group_id)
            ->where('machine_id', $machine_operator, $request->machine_id)
            ->orderBy('id', 'DESC')->paginate(100);
        }
        

    }
       
       
        return view('element-list', compact('elements', 'active_filter'));

    }


    public function filter_returner($material_id, $id, $name, $length_operator, $length_value, $width_operator, $width_value, $height_operator, $height_value)
    {

        if($material_id == 0)
        {
            $material_operator = '<>';
        }
        else
        {
            $material_operator = '=';
        }

        // if($machine_id == 0 || $machine_id == null)
        // {
        //     $machine_operator = '<>';
        // }
        // else
        // {
        //     $machine_operator = '=';
        // }

        // if($job_group_id == 0 || $job_group_id == null)
        // {
        //     $job_group_operator = '<>';
        // }
        // else
        // {
        //     $job_group_operator = '=';
        // }
      
        
            if($length_value==null && $width_value!=null && $height_value!=null)
            {
                $elements = Element::with(['material', 'elementfiles'])
               ->where('material_id', $material_operator, $material_id)
            //    ->where('machine_id', $machine_operator, $machine_id)
            //    ->where('job_group_id', $job_group_operator, $job_group_id)
               ->where('name','LIKE',$name.'%')
               ->where('id','LIKE',$id)
               ->where('width', $width_operator, $width_value)
               ->where('height', $height_operator, $height_value)
               ->orderBy('id', 'DESC')->paginate(100);
            }
        
            if($height_value==null && $length_value!=null && $width_value!=null)
            {
                $elements = Element::with(['material', 'elementfiles'])
               ->where('material_id', $material_operator, $material_id)
            //    ->where('machine_id', $machine_operator, $machine_id)
            //    ->where('job_group_id', $job_group_operator, $job_group_id)
               ->where('name','LIKE',$name.'%')
               ->where('id','LIKE',$id)
               ->where('length', $length_operator, $length_value)
               ->where('width', $width_operator, $width_value)
               ->orderBy('id', 'DESC')->paginate(100);
            }
        
            if($width_value==null && $length_value!=null && $height_value!=null)
            {
                $elements = Element::with(['material', 'elementfiles'])
               ->where('material_id', $material_operator, $material_id)
            //    ->where('machine_id', $machine_operator, $machine_id)
            //    ->where('job_group_id', $job_group_operator, $job_group_id)
               ->where('name','LIKE',$name.'%')
               ->where('id','LIKE',$id)
               ->where('length', $length_operator, $length_value)
               ->where('height', $height_operator, $height_value)
               ->orderBy('id', 'DESC')->paginate(100);
            }
    
    
            if($length_value==null && $width_value==null && $height_value!=null)
            {  
                $elements = Element::with(['material', 'elementfiles'])
               ->where('material_id', $material_operator, $material_id)
            //    ->where('machine_id', $machine_operator, $machine_id)
            //    ->where('job_group_id', $job_group_operator, $job_group_id)
               ->where('name','LIKE',$name.'%')
               ->where('id','LIKE',$id)
               ->where('height', $height_operator, $height_value)
               ->orderBy('id', 'DESC')->paginate(100);  
            }
        
            if($length_value==null && $width_value!=null && $height_value==null)
            {  
                $elements = Element::with(['material', 'elementfiles'])
               ->where('material_id', $material_operator, $material_id)
            //    ->where('machine_id', $machine_operator, $machine_id)
            //    ->where('job_group_id', $job_group_operator, $job_group_id)
               ->where('name','LIKE',$name.'%')
               ->where('id','LIKE',$id)
               ->where('width', $width_operator, $width_value)
               ->orderBy('id', 'DESC')->paginate(100);  
            }
        
            if($length_value!=null && $width_value==null && $height_value==null)
            {  
                $elements = Element::with(['material', 'elementfiles'])
               ->where('material_id', $material_operator, $material_id)
            //    ->where('machine_id', $machine_operator, $machine_id)
            //    ->where('job_group_id', $job_group_operator, $job_group_id)
               ->where('name','LIKE',$name.'%')
               ->where('id','LIKE',$id)
               ->where('length', $length_operator, $length_value)
               ->orderBy('id', 'DESC')->paginate(100);  
            }
        
    
            if($length_value!=null && $width_value!=null && $height_value!=null)
            {
                $elements = Element::with(['material', 'elementfiles'])
               ->where('material_id', $material_operator, $material_id)
            //    ->where('machine_id', $machine_operator, $machine_id)
            //    ->where('job_group_id', $job_group_operator, $job_group_id)
               ->where('name','LIKE',$name.'%')
               ->where('id','LIKE',$id)
               ->where('length', $length_operator, $length_value)
               ->where('width', $width_operator, $width_value)
               ->where('height', $height_operator, $height_value)
               ->orderBy('id', 'DESC')->paginate(100);
            }
        
            if($length_value==null && $width_value==null && $height_value==null)
            {
                $elements = Element::with(['material', 'elementfiles'])
               ->where('material_id', $material_operator, $material_id)
            //    ->where('machine_id', $machine_operator, $machine_id)
            //    ->where('job_group_id', $job_group_operator, $job_group_id)
               ->where('name','LIKE',$name.'%')
               ->where('id','LIKE',$id)
               ->orderBy('id', 'DESC')->paginate(100);
            }
        

        return $elements;
    }





}
