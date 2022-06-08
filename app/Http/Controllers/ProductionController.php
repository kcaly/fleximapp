<?php

namespace App\Http\Controllers;

use App\Models\Production;
use App\Models\ElementProduction;
use App\Models\ElementJob;
use App\Models\JobGroup;
use App\Models\JobOrder;
use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Hamcrest\Core\HasToString;
use Illuminate\Support\Arr;

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
                                       
                    $orders = Order::where('date_production', $request->date)->where('status', 1)->get();
                    foreach ($orders as $single_order)
                    {
                        ElementProduction::where('date_production', $request->date)->where('status', 0)->where('order_id', $single_order->id)->delete();

                        $order = Order::find($single_order->id);
                        $order->status = 0;
                        $order->save();
                    }

                    //ElementProduction::where('date_production', $request->date)->where('status', 0)->delete();
                    ElementJob::where('date_production', $request->date)->where('status', 0)->delete();

                    $message = 'Usunięto dane produkcyjne: ' . $request->date; 
                    // return redirect()->route('production.show')->with('message', $message)->with('date', $request->date);
                    return redirect()->route('production.show')->with('message', $message);
                    break;


                // case "refresh":    
                case "generate":    
                
                    $order_records = 0;
                    $orders = Order::where('date_production', $request->date)->get();
    
                                    
        foreach ($orders as $single_order)
        {
    
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
                       
                        // if($element->machine_id != null || 0)
                        // {
                        //     $element_production_record->machine = \App\Models\Machine::find($element->machine_id)->first()->titel;
                        // }

                        // if($element->job_group_id != null || 0)
                        // {
                        //     $element_production_record->job_group = \App\Models\JobGroup::find($element->job_group_id)->first()->titel;
                        // }
                        
                        $element_production_record->article_info = $article->name;
                        $element_production_record->product_info = $product->name;
                        $element_production_record->order_info = 'Z'.$order->code.' ['.$order->date_order.']';
                        // $material_element = \App\Models\Material::find($element->material_id)->first();
                        $element_production_record->material = $element->material->name;
                        $element_production_record->weight = $element->weight;

                        $element_production_record->amount = $amount_suma;
                        $element_production_record->done = 0;

                        $element_production_record->element_id = $element->id;
                        $element_production_record->material_id = $element->material_id;
                        $element_production_record->article_id = $article->id;
                        $element_production_record->order_id = $order->id;

                        $element_production_record->date_production = $order->date_production;
                        $element_production_record->status = 0;

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
                    $element_job->done = 0;
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
            // return redirect()->route('production.show')->with('message', $message)->with('date', $request->date);
            return redirect()->route('production.show')->with('message', $message);

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


    public function production_create(Request $request)
    {

        $production = new Production();
        $production->name = $request->production_name;

        if($request->check_number == 1)
        {
            $production->date_first = $request['check1'];
            $production->date_last = $request['check1'];
            $production->dates_textcode = $request['check1'] . ' — ' . $request['check1'];
        }
        else
        {
            $sort_dates = array();
            $sort_number = 1;
            for ($i=0; $i <= $request->check_number; $i++)
            {
                $sort_dates[$i] = $request['check'.$sort_number];
                $sort_number = $sort_number + 1;
            }

            // $production->date_first = $request['check1'];
            // $production->date_last = $request['check'.$request->check_number];
            // $production->dates_textcode = $request['check1'] . ' — ' . $request['check'.$request->check_number];

            asort($sort_dates);
            $dates_sorted = array();

            $sort_number = 1;

            foreach($sort_dates as $date)
            {
                if ($date == null || $date == 0)
                {
                    $dates_sorted[0] = $date;
                }
                else
                {
                    $dates_sorted[$sort_number] = $date;
                    $sort_number = $sort_number + 1;
                }               
                
            }
           
            $production->date_first = $dates_sorted[1];
            $production->date_last = end($dates_sorted);
            $production->dates_textcode = $dates_sorted[1] . ' — ' . end($dates_sorted);
        }
        
        $production->sum_elements = 0;
        $production->done = 0;
        $production->status = 0;
        $production->save();

        $production_id = $production->id;

        $dates = \App\Models\ElementProduction::where('status', 0)->select('date_production')->distinct()->get();
        $dates_all = '';
      
        foreach($dates as $date)
        {   
           

            for($i=1; $i <= $request->check_number; $i++)
            {   
                
                if ($date->date_production == $dates_sorted[$i])
                {  
                    $elements_jobs = \App\Models\ElementJob::where('date_production', $date->date_production)->get();
                    
                    foreach($elements_jobs as $element_job)
                    {
                        $element_job->status = 1;
                        $element_job->production_id = $production_id;
                        $element_job->save();  
                    }

                    $elements_productions = \App\Models\ElementProduction::where('date_production', $date->date_production)->get();
                    foreach($elements_productions as $element_prod)
                    {
                        $element_prod->production_id = $production_id;
                        $element_prod->status = 1;
                        $element_prod->save();

                        $order = Order::find($element_prod->order_id);
                        $order->status = 2;
                        $order->save();
                    }

                    if($dates_all == '')
                    {
                        $dates_all = $date->date_production;
                    }
                    else
                    {
                        $dates_all = $dates_all.';'.$date->date_production;
                    }
                    

                }

            }
            
        }

        $sum_elements = ElementJob::where('production_id', $production_id)->sum('sum_amount');
        $production->sum_elements = $sum_elements;
        $production->dates_all = $dates_all;
        $materials = \App\Models\ElementJob::select('material')->distinct()->get();
        $string_total = '';
        
        foreach ($materials as $material)
        {
            $sum_weight = ElementJob::where('production_id', $production_id)->where('material', $material->material)->sum('sum_weight');

            if($string_total == '')
            {
                $string_total = $material->material.'='.$sum_weight;
            }
            else
            {
                $string_total = $string_total.';'.$material->material.'='.$sum_weight;
            }

        }

        $production->done = \App\Models\ElementJob::where('production_id', $production->id)->sum('done');
        $production->total = $string_total;
        $production->save();

       
        $message = 'Pomyślnie utworzono zakres produkcyjny: '.$production->dates_textcode;
        return redirect()->route('production.show')->with('message', $message);
    }

    public function production_select($id)
    {

        
        $production = Production::find($id);

        ProductionController::production_procent_done($id);
        $dates = explode(";", $production->dates_all);
        $materials = explode(";", $production->total);
    
        $totals = array ();
        $total_number = 0;

       
        foreach($materials as $material)
        {

            $total_material = explode("=", $material);
           
            $sum_material = ElementProduction::where('material', $total_material[0])->sum('amount');
            
            if ($material != null)
            {
                $totals[$total_number] = $total_material[0] . ': ' . $total_material[1] . ' kg' . ' [' . $sum_material .']';
            }
            
            $total_number = $total_number + 1;            
        }
    
        asort($dates);

        return view('production-select', compact(['production', 'dates', 'totals']));

    }

    public function production_procent_done($id)
    {
        $production = Production::find($id);
     
        if ($production->done != 0)
        {
            $done_procent = $production->done / $production->sum_elements*100.0;
            $production->done_procent = $done_procent;
            $production->save();
        }                  
    }

    public function production_delete($id)
    {
        $production = Production::find($id);
        $dates = explode(";", $production->dates_all);
        $production->delete();

        foreach($dates as $date)
        {
            $elements_production = ElementProduction::where('date_production', $date)->get();

            foreach ($elements_production as $element_production)
            {
                $element_production->delete();
            }

            $orders = Order::where('date_production', $date)->where('status', 2)->get();

            foreach($orders as $order)
            {
                $order->status = 0;
                $order->save();
            }
        }

        $message = 'Usunięto zakres produkcyjny.';
        return redirect()->route('production.show')->with('message', $message);
    }


    public function production_accept($id)
    {
        $production = Production::find($id);
        

        

        $element_jobs = ElementJob::where('status', 1)->where('production_id', $id)->select('production_id', 'machine_id', 'job_group_id', 'element_id')->distinct()->get();
       
        
        foreach($element_jobs as $element_job)
        {
            $element = \App\Models\Element::find($element_job->element_id);

            $element_jobs_records = ElementJob::where('status', 1)
            ->where('production_id', $id)
            ->where('production_id', $id)
            ->where('machine_id', $element_job->machine_id)
            ->where('job_group_id', $element_job->job_group_id)
            ->where('element_id', $element_job->element_id)
            ->get();

            $sum_amount = ElementJob::where('status', 1)
            ->where('production_id', $id)
            ->where('machine_id', $element_job->machine_id)
            ->where('job_group_id', $element_job->job_group_id)
            ->where('element_id', $element_job->element_id)
            ->sum('sum_amount');
        
            $sum_weight = ElementJob::where('status', 1)->where('production_id', $id)
            ->where('machine_id', $element_job->machine_id)
            ->where('job_group_id', $element_job->job_group_id)
            ->where('element_id', $element_job->element_id)
            ->sum('sum_weight');
        
            $element_job_order = new ElementJob();

                    foreach($element_jobs_records as $element_job_record)
                    {

                        $element_job_order->sum_weight = $sum_weight;
                        $element_job_order->sum_amount = $sum_amount;
                        $element_job_order->done = 0;
                        $element_job_order->element_id = $element_job->element_id;

                        $element_job_order->code = \App\Models\Company::where('id', auth()->user()->company_id)->first()->flexim_id;

                        $element_job_order->name = $element->name;
                        $element_job_order->date_production = $production->date_first;
                        $element_job_order->production_id = $production->id;
                        $element_job_order->status = 3;
                        $element_job_order->length = $element->length;
                        $element_job_order->width = $element->width;
                        $element_job_order->height = $element->height;
                        $element_job_order->material = $element->material->name;
                        

                        $element_job_order->material_id = $element->material_id;
                        $element_job_order->machine_id = $element->machine_id;
                        $element_job_order->job_group_id = $element->job_group_id;

                        $element_job_order->save();
                        $element_job_order_id = $element_job_order->id;

                        

                        $element_productions = ElementProduction::where('status', 1)
                        ->where('production_id', $id)
                        ->where('element_id', $element_job_order->element_id)
                        ->get();

                        foreach($element_productions as $element_production)
                        {
                            $element_production->element_job_id = $element_job_order_id;
                            $element_production->status = 3;
                            $element_production->save();
                        }

                            $element_job_record->status = 2;
                            $element_job_record->save();
      
                    }
                        
        }

        if(ElementProduction::where('production_id', $id)->sum('amount') != ElementJob::where('production_id', $id)->where('status', 2)->sum('sum_amount')
        || ElementProduction::where('production_id', $id)->sum('amount') != ElementJob::where('production_id', $id)->where('status', 3)->sum('sum_amount')
        || ElementJob::where('production_id', $id)->where('status', 2)->sum('sum_amount') != ElementJob::where('production_id', $id)->where('status', 3)->sum('sum_amount'))
        {
            $message = 'Wykryto niezgodność w wartościach sumy elementów. Proces generowania został przerwany.';
            return redirect()->route('production.show')->with('message', $message);
        }

        ElementJob::where('production_id', $id)->where('status', 2)->delete();

        $production->status = 1;
        $production->save();

        $message = 'Generowanie zleceń produkcyjnych zakończono pomyślnie. Zakres zatwierdzony do realizacji.';
        return redirect()->route('production.select', ['id' => $id])->with('message', $message);

    }



    public function job_order_create($id)
    {
      
        $production = Production::find($id);
        

        $elements_job = ElementJob::where('status', 3)->where('production_id', $production->id)->select('job_group_id')->distinct()->get();
        
        
        foreach($elements_job as $job)
        {   
            
            $job_order = new JobOrder();

            $job_order->production_id = $production->id;
            $job_order->job_group_id = $job->job_group_id;

            $job_order->sum_elements_amount = ElementJob::where('status', 3)->where('production_id', $production->id)->where('job_group_id', $job->job_group_id)->sum('sum_amount');
            $job_order->done = 0;
            $job_order->status = 0;

            $job_order->name = 'test2';

            $job_order->save();     
            
        }

        $job_orders = JobOrder::where('status', 0)->where('production_id', $production->id)->get();

        foreach($job_orders as $job_order)
        {
            $element_job = ElementJob::where('status', 3)->where('production_id', $production->id)->where('job_group_id', $job_order->job_group_id)->get();

            foreach($element_job as $element)
            {
                $element->status = 4;
                $element->save();
            }
        
        }

        $production->status = 2;
        $production->save();

        if ($production->name == null)
        {
            $message = 'Zlecenie '. $production->dates_textcode . ' przekazano do realizacji.';
        }
        else
        {
            $message = 'Zlecenie'.' ('.$production->name.') '. $production->dates_textcode . ' przekazano do realizacji.';
        }
        
        
        return redirect()->route('production.show')->with('message', $message);

    }


}
 