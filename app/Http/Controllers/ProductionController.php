<?php

namespace App\Http\Controllers;

use App\Models\ElementProduction;
use App\Models\ElementJob;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ProductionController extends Controller
{   



    public function index()
    {
        // $production_data = \App\Models\ElementProduction::select('date_production')->distinct()->get();
        
        return redirect()->route('production');
    }




    public function show(Request $request)
    {
        if ($request->refresh != 0 && $request->action != 'load')
        {
            ElementProduction::where('date_production', $request->date)->delete();
                    ElementJob::where('date_production', $request->date)->delete();
                    $orders = Order::where('date_production', $request->date)->get();
                    foreach ($orders as $single_order)
                    {
                        $order = Order::find($single_order->id);
                        $order->status = 0;
                        $order->save();
                    }
        }
        else
        {
            
        }
        
        if ($request->date != null)
        {
            switch ($request->action) {
                case "delete":
                    ElementProduction::where('date_production', $request->date)->delete();
                    ElementJob::where('date_production', $request->date)->delete();
                    $orders = Order::where('date_production', $request->date)->get();
                    foreach ($orders as $single_order)
                    {
    
                        $order = Order::find($single_order->id);
                        $order->status = 0;
                        $order->save();
                    }

                    $message = 'Usunięto dane produkcyjne: ' . $request->date; 
                    return redirect()->route('production.show')->with('message', $message)->with('date', $request->date);
                    break;


                // case "refresh":    
                case "generate":    
                
                    $order_records = 0;
                    $orders = Order::where('date_production', $request->date)->get();
    
                
        foreach ($orders as $single_order){
    
            $order = Order::find($single_order->id);

    
            if ($order->status != 0)
            {
            
            }
            else
            {
            $products = $order->products;
            $order_records = $order_records + 1;
    
            foreach ($products as $product)
            {
                $amount_product = $product->pivot->amount;
                $articles = $product->articles;
    
    
                foreach($articles as $article)
                {
    
                    $amount_article = $article->pivot->amount;
                    $elements = $article->elements;
    
                    foreach($elements as $element)
                    {   
                        $amount_element = $element->pivot->amount;
                        
                        $amount_suma = $amount_product * $amount_article * $amount_element;
                        
                        
                       
                        $element_production_record = new ElementProduction();

                        

                        if($element->machine_id != null || 0)
                        {
                            $element_production_record->machine = \App\Models\Machine::find($element->machine_id)->first()->titel;
                        }

                        if($element->job_group_id != null || 0)
                        {
                            $element_production_record->job_group = \App\Models\JobGroup::find($element->job_group_id)->first()->titel;
                        }
                        
                        $element_production_record->articel_info = $article->name;
                        $element_production_record->product_info = $product->name;
                        $element_production_record->order_info = 'Z'.$order->code.' ['.$order->date_order.']';

                        $element_production_record->material = \App\Models\Material::find($element->material_id)->first()->name;
                        $element_production_record->weight = $element->weight;

                        $element_production_record->amount = $amount_suma;

                        $element_production_record->element_id = $element->id;
                        $element_production_record->material_id = $element->material_id;
                        $element_production_record->order_id = $order->id;

                        $element_production_record->date_production = $order->date_production;
                        $element_production_record->status = '0';


                       
                        $element_production_record->save();


    
    
                    }
                    
    
    
                }
                
            }
            $order->save();
            }
        }









        foreach ($orders as $single_order){
    
            $order = Order::find($single_order->id);

    
            if ($order->status != 0)
            {
            
            }
            else
            {
            $products = $order->products;
            $order_records = $order_records + 1;
    
            foreach ($products as $product)
            {
                $amount_product = $product->pivot->amount;
                $articles = $product->articles;
    
    
                foreach($articles as $article)
                {
    
                    $amount_article = $article->pivot->amount;
                    $elements = $article->elements;
    
                    foreach($elements as $element)
                    {   
                        $amount_element = $element->pivot->amount;
                        
                        $amount_suma = $amount_product * $amount_article * $amount_element;
                        
                        
                       
                        $element_production_record = new ElementProduction();

                        

                        if($element->machine_id != null || 0)
                        {
                            $element_production_record->machine = \App\Models\Machine::find($element->machine_id)->first()->titel;
                        }

                        if($element->job_group_id != null || 0)
                        {
                            $element_production_record->job_group = \App\Models\JobGroup::find($element->job_group_id)->first()->titel;
                        }
                        
                        $element_production_record->articel_info = $article->name;
                        $element_production_record->product_info = $product->name;
                        $element_production_record->order_info = 'Z'.$order->code.' ['.$order->date_order.']';
                        // $material_element = \App\Models\Material::find($element->material_id)->first();
                        $element_production_record->material = $element->material->name;
                        $element_production_record->weight = $element->weight;

                        $element_production_record->amount = $amount_suma;

                        $element_production_record->element_id = $element->id;
                        $element_production_record->material_id = $element->material_id;
                        $element_production_record->order_id = $order->id;

                        $element_production_record->date_production = $order->date_production;
                        $element_production_record->status = '0';

                        $order->status = 1;

                       
                        $element_production_record->save();


    
    
                    }
                    
    
    
                }
                
    
    
            }
            $order->save();
            }
        }








                
                $date = $request->date;
                $elements_date_prod = ElementProduction::where('date_production','=',$date)->get();
                $element_gen = 0;
              
                foreach ($elements_date_prod as $element_prod)
                {
                   $element_gen = $element_prod->element_id;
                    
                   $element_id_exists = (!ElementJob::where('date_production', '=', $date)->where('element_id', '=', $element_prod->element_id)->exists());
                   if($element_id_exists == true)
                   {
                    $suma_for_element_id = ElementProduction::where('date_production','=',$date)->where('element_id','=',$element_gen)->sum('amount');
                    $element_job = new ElementJob();
                    $element_job->sum_amount = $suma_for_element_id;
                    $element_job->element_id = $element_prod->element_id;
                    $element_job->code = $element_prod->element->code;
                    $element_job->name = $element_prod->element->name;
                    $element_job->date_production = $date;
                    $element_job->status = 0;
                    $element_job->length = $element_prod->element->length;
                    $element_job->width = $element_prod->element->width;
                    $element_job->height = $element_prod->element->height;
                    $element_job->material = $element_prod->element->material->name;
                    $element_job->sum_weight = $element_prod->element->weight * $element_job->sum_amount;

                    $element_job->material_id = $element_prod->material_id;
                    $element_job->machine_id = $element_prod->element->machine_id;
                    $element_job->job_group_id = $element_prod->element->job_group_id;

                    $element_job->save();

                  
                   }
                   else
                   {
                    $element_amount_id_job = ElementJob::where('date_production', '=', $date)->where('element_id', '=', $element_prod->element_id)->first();
                    $element_job = ElementJob::find($element_amount_id_job->id);
                    
                    $element_amount_in_prod = ElementProduction::where('date_production','=',$date)->where('element_id','=',$element_gen)->sum('amount');
                    
                    if($element_amount_id_job->sum_amount != $element_amount_in_prod)
                    {
                        $element_job->sum_amount = $element_amount_in_prod;
                        $element_job->save();
                    }
                    else
                    {   

                        
                    }
                        
                   }

                            
                                           
                    

                }


            // $elements_production = ElementProduction::where('date_production', $request->date)->get();
   
            $message = 'Wygenerowano dane produkcyjne dla ' . $order_records . ' zam.'; 
           return redirect()->route('production.show')->with('message', $message)->with('date', $request->date);
                    break;
                    
 
                    
                case "load":
                    return redirect()->route('production.show')->with('date', $request->date);
                    break;
                
            }


        }
        else
        {
            return redirect()->route('production.show')->with('message', 'Brak rekordu daty dla wybranego działania.');
        }

        
    }






}
 