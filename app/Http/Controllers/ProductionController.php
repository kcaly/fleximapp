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
                    return redirect()->route('production.panel')->with('message', $message);
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
                        if($element->job_group_id == null || $element->machine_id == null)
                        {
                            return redirect()->route('production.panel')->with('message', 'Nie wszystkie elementy mają przydzieloną grupę lub maszynę. Sprawdź dane i wygeneruj ponownie.');
                        }
                        
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
                        $element_production_record->article_quantity = $amount_article;
                        $element_production_record->product_info = $product->name;
                        $element_production_record->product_quantity = $amount_product;
                        $element_production_record->order_info = $order->code.' ['.$order->date_order.']';
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
                    $element_job->date_production_virtual = $date;
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
            return redirect()->route('production.panel')->with('message', $message);

                    break;
                                      

                case "load":
                    return redirect()->route('production.show')->with('date', $request->date);
                    break;
                
            }

        }
        else
        {
            return redirect()->route('production.panel')->with('message', 'Brak rekordu daty dla wybranego działania.');
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
            $dates_sorted = $request['check1'];
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
            $number = 0;

            foreach($sort_dates as $date)
            {
                if ($date == null || $date == 0)
                {
                    $dates_sorted[0] = $date;
                }
                else
                {
                    $dates_sorted[$number] = $date;
                    $sort_number = $sort_number + 1;
                    $number = $number + 1;
                }               
                
            }
           
            $production->date_first = $dates_sorted[0];
            $production->date_last = end($dates_sorted);
            $production->dates_textcode = $dates_sorted[0] . ' — ' . end($dates_sorted);
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

            if(is_array($dates_sorted))
            {

                foreach($dates_sorted as $date_prod)
                {

                    if ($date_prod == $date->date_production)
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
            else
            {
                if ($dates_sorted == $date->date_production)
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
        // return redirect()->route('production.show')->with('message', $message);

        return redirect()->route('production.select', ['id' => $production->id])->with('message', $message);

    }

    public function production_select_edit(Request $request)
    {
        $production = Production::find($request->production_id);
        $production->name = $request->production_name;
        $production->save();
        $id = $production->id;

        return redirect()->route('production.select', compact('id'));
    }

    public function production_select($id)
    {
        $production = Production::find($id);
        ProductionController::production_done_calc($id);

        $dates = explode(";", $production->dates_all);
        $materials = explode(";", $production->total);
        $totals = array();
        $temp = 0;
        foreach($materials as $material)
        {

            $total_material = explode("=", $material);
            $sum_material = ElementProduction::where('material', $total_material[0])->sum('amount');
            
            if ($material != null)
            {
                $totals[$temp] = $total_material[0] . ': ' . $total_material[1] . ' kg' . ' [' . $sum_material .']';
            }
            
            $temp = $temp + 1;            
        }
        asort($dates);

        $job_orders = $production->job_orders;
        $temp = 1;
        $elements = null;
        $job_order_select = null;
        $machine_select = null;

        
        return view('production-select', compact(['production', 'dates', 'totals', 'job_orders', 'temp', 'elements', 'job_order_select', 'machine_select']));
    }


    public function production_data(Request $request)
    {     
        $job_order = JobOrder::find($request->job_order_id);
        $production = Production::find($job_order->production_id);

        $dates = explode(";", $production->dates_all);
        $materials = explode(";", $production->total);
        $totals = array();
        $temp = 0;
        foreach($materials as $material)
        {

            $total_material = explode("=", $material);
            $sum_material = ElementProduction::where('material', $total_material[0])->sum('amount');
            
            if ($material != null)
            {
                $totals[$temp] = $total_material[0] . ': ' . $total_material[1] . ' kg' . ' [' . $sum_material .']';
            }
            
            $total_number = $temp + 1;            
        }
        asort($dates);
        
        $job_orders = $production->job_orders;
        $temp = 1;
        
        $job_order_select = array(
            'id' => $job_order->id,
            'name' => $job_order->job_group->name
        );

        $machine_select = null;

        $elements = ElementJob::where('job_order_id', $request->job_order_id)->get();
       

        return view('production-select', compact(['production', 'dates', 'totals', 'job_orders', 'temp', 'elements', 'job_order_select', 'machine_select']));
    }

    public function production_done_calc($id)
    {
        $production = Production::find($id);

        $done_1 = ElementJob::where('production_id', $production->id)->where('status','>=', 4)->where('status','<', 10)->sum('done');
        $done_2 = ElementJob::where('production_id', $production->id)->where('status', 10)->sum('sum_amount');
        $production->done = $done_1 + $done_2;
        $production->save();

        $job_orders = $production->job_orders;
        foreach($job_orders as $job_order)
        {
            $sum_done = ElementJob::where('job_order_id', $job_order->id)->where('status','>=', 4)->where('status','<', 10)->sum('done');
            $job_order->done = $sum_done;
            $job_order->save();
        }
    
        if ($production->done != 0)
        {
            $done_procent = $production->done / $production->sum_elements*100.0;           

            if ($done_procent < 100 && $done_procent > 99.5 && $production->done != $production->sum_elements)
            {
                $done_procent = 99;
            }

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
        
        $element_jobs = ElementJob::where('status', 1)->where('production_id', $id)->select('production_id', 'machine_id', 'job_group_id', 'element_id', 'date_production_virtual')->distinct()->orderBy('date_production_virtual', 'ASC')->get();

        $dates = ElementJob::where('status', 1)->where('production_id', $id)->select('date_production_virtual')->distinct()->get();
       
        foreach($element_jobs as $element_job)
        {
            foreach($dates as $date)
            {
            $element = \App\Models\Element::find($element_job->element_id);

            $element_jobs_records = ElementJob::where('status', 1)
            ->where('production_id', $id)
            ->where('machine_id', $element_job->machine_id)
            ->where('job_group_id', $element_job->job_group_id)
            ->where('element_id', $element_job->element_id)
            ->where('date_production_virtual', $date->date_production_virtual)
            ->get();

            $sum_amount = ElementJob::where('status', 1)
            ->where('production_id', $id)
            ->where('machine_id', $element_job->machine_id)
            ->where('job_group_id', $element_job->job_group_id)
            ->where('element_id', $element_job->element_id)
            ->where('date_production_virtual', $date->date_production_virtual)
            ->sum('sum_amount');
        
            $sum_weight = ElementJob::where('status', 1)->where('production_id', $id)
            ->where('machine_id', $element_job->machine_id)
            ->where('job_group_id', $element_job->job_group_id)
            ->where('element_id', $element_job->element_id)
            ->where('date_production_virtual', $date->date_production_virtual)
            ->sum('sum_weight');
        
            $element_job_order = new ElementJob();

                    foreach($element_jobs_records as $element_job_record)
                    {

                        $element_job_order->sum_weight = $sum_weight;
                        $element_job_order->sum_amount = $sum_amount;
                        $element_job_order->done = 0;
                        $element_job_order->element_id = $element_job->element_id;

                        $element_job_order->code = $element->code;

                        $element_job_order->name = $element->name;

                        $element_job_order->date_production = $date->date_production_virtual;
                                           
                        $element_job_order->production_id = $production->id;
                        $element_job_order->status = 3;
                        $element_job_order->length = $element->length;
                        $element_job_order->width = $element->width;
                        $element_job_order->height = $element->height;
                        $element_job_order->material = $element->material->name;
                        

                        $element_job_order->material_id = $element->material_id;
                        $element_job_order->machine_id = $element_job_record->machine_id;
                        $element_job_order->job_group_id = $element_job_record->job_group_id;

                        $element_job_order->save();
                        $element_job_order_id = $element_job_order->id;

                        

                        $element_productions = ElementProduction::where('status', 1)
                        ->where('production_id', $id)
                        ->where('element_id', $element_job_order->element_id)
                        ->where('date_production', $element_job_record->date_production)
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
        }

        if(ElementProduction::where('production_id', $id)->sum('amount') != ElementJob::where('production_id', $id)->where('status', 2)->sum('sum_amount')
        || ElementProduction::where('production_id', $id)->sum('amount') != ElementJob::where('production_id', $id)->where('status', 3)->sum('sum_amount')
        || ElementJob::where('production_id', $id)->where('status', 2)->sum('sum_amount') != ElementJob::where('production_id', $id)->where('status', 3)->sum('sum_amount'))
        {
            $message = 'Wykryto niezgodność w wartościach sumy elementów. Proces generowania został przerwany.';
            return redirect()->route('production.panel')->with('message', $message);
        }

        ElementJob::where('production_id', $id)->where('status', 2)->delete();

        $elements_job = ElementJob::where('status', 3)->where('production_id', $production->id)->select('job_group_id', 'date_production')->distinct()->get();
            
        foreach($elements_job as $job)
        {            
            $job_order = new JobOrder();

            $job_order->production_id = $production->id;
            $job_order->date_production = $job->date_production;
            $job_order->job_group_id = $job->job_group_id;

            $job_order->sum_elements_amount = ElementJob::where('status', 3)->where('production_id', $production->id)->where('date_production', $job->date_production)->where('job_group_id', $job->job_group_id)->sum('sum_amount');
            $job_order->done = 0;
            $job_order->status = 1;

            $job_order->save();               
        }

        $production->status = 1;
        $production->save();

        $message = 'Generowanie zleceń produkcyjnych zakończono pomyślnie. Zakres zatwierdzony do realizacji.';
        return redirect()->route('production.select', ['id' => $id])->with('message', $message);

    }


    public function job_order_stop($id)
    {
        
        $production = Production::find($id);
        $production->status = 1;

        foreach ($production->job_orders->all() as $job_order)
        {
            $job_order->status = 0;

            $job = JobOrder::find($job_order->id);
            
            $job_order->save();
                    
        }

        $production->save();

        $message = 'Zlecenie zostało wstrzymane.';
        return redirect()->route('production.select', ['id' => $id])->with('message', $message);
    }


    public function job_order_start($id)
    {
        
        $production = Production::find($id);
        $production->status = 2;

        foreach ($production->job_orders->all() as $job_order)
        {
            $job_order->status = 1;

            $job = JobOrder::find($job_order->id);
            
            $job_order->save();
                    
        }

        $production->save();

        $message = 'Zlecenie zostało wznowione.';
        return redirect()->route('production.select', ['id' => $id])->with('message', $message);
    }


    public function job_order_create($id)
    {
      
        $production = Production::find($id);
        
        $job_orders = JobOrder::where('status', 1)->where('production_id', $production->id)->get();

        foreach($job_orders as $job_order)
        {
            $element_job = ElementJob::where('status', 3)->where('production_id', $production->id)->where('date_production', $job_order->date_production)->where('job_group_id', $job_order->job_group_id)->get();

            foreach($element_job as $element)
            {
                $element->status = 4;
                $element->job_order_id = $job_order->id;
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
        
        
        return redirect()->route('production.select', ['id' => $id])->with('message', $message);

    }


    public function details_element($production_id, $element_id)
    {

        dd($element_id);
    }


    public function production_planning_view()
    {
        $status = 0;
        return view('production-planning', compact('status'));
    }


    public function production_planning_loader(Request $request)
    {
        if ($request->production_id != 0)
        {                   
            $prod = Production::find($request->production_id);

            if (JobOrder::where('production_id', $prod->id)->count() > 0)           
            {
                $status = 0;
                return view('production-planning', compact('status'));
            }
            else
            {
                $status = 1;
                $elements = ElementJob::where('production_id', $prod->id)->where('status', 1)->get();
                $job_groups_ids = ElementJob::where('production_id', $prod->id)->select('job_group_id')->distinct()->get();
                $days = $job_groups_ids->count();
                $dates = ElementJob::where('production_id', $prod->id)->where('status', 1)->select('date_production')->distinct()->orderBy('date_production', 'ASC')->get();
                
                $temp = 1;
                $temp2 = 1;
                
                return view('production-planning', compact('status', 'prod', 'elements', 'job_groups_ids', 'dates', 'temp', 'temp2', 'days'));
            }         
            
                $status = 0;
                return view('production-planning', compact('status'));
        }    
        else
        {
            $status = 0;
            return view('production-planning', compact('status'));
        }
    }


    public function production_planning_load_get($production_id)
    {
        $prod = Production::find($production_id);

        if (JobOrder::where('production_id', $production_id)->count() > 0)           
        {
            $status = 0;
            return view('production-planning', compact('status'));
        }
        else
        {
            $status = 1;
            $elements = ElementJob::where('production_id', $prod->id)->where('status', 1)->get();
            $job_groups_ids = ElementJob::where('production_id', $prod->id)->select('job_group_id')->distinct()->get();
            $days = $job_groups_ids->count();
            $dates = ElementJob::where('production_id', $prod->id)->where('status', 1)->select('date_production')->distinct()->orderBy('date_production', 'ASC')->get();
            $temp = 1;
            $temp2 = 1;

            return view('production-planning', compact('status', 'prod', 'elements', 'job_groups_ids', 'dates', 'temp', 'temp2', 'days'));
        }
    }


    public function production_planning_save(Request $request)
    {
        $dates = ElementJob::where('production_id', $request->production_id)->where('status', 1)->select('date_production')->distinct()->orderBy('date_production', 'ASC')->get();
        $job_groups_ids = ElementJob::where('production_id', $request->production_id)->select('job_group_id')->distinct()->get();

        foreach($job_groups_ids as $job_group_id)
        {
            foreach($dates as $date)
            {
                $check = $job_group_id->job_group_id.'_'.$date->date_production;
               
                if ($request[$check] != $date->date_production)
                {
                    $elements_job = ElementJob::where('production_id', $request->production_id)->where('status', 1)->where('job_group_id', $job_group_id->job_group_id)->where('date_production', $date->date_production)->get();

                    foreach($elements_job as $element)
                    {
                            if ($element->date_production == $request[$check])
                            {
                                $element->date_production_virtual = $element->date_production;
                                $element->save();
                            }
                            else
                            {
                                $element->date_production_virtual = $request[$check];
                                $element->save();
                            }
                    }
                }
                else
                {
                    $elements_job = ElementJob::where('production_id', $request->production_id)->where('status', 1)->where('job_group_id', $job_group_id->job_group_id)->where('date_production', $date->date_production)->get();

                    foreach($elements_job as $element)
                    {
                           
                                $element->date_production_virtual = $element->date_production;
                                $element->save();
                    }
                            
                }
            }
        }  

        $status = 1;
        $prod = Production::find($request->production_id);
        $elements = ElementJob::where('production_id', $prod->id)->where('status', 1)->get();
        $job_groups_ids = ElementJob::where('production_id', $prod->id)->select('job_group_id')->distinct()->get();    
        $days = $job_groups_ids->count();
        $dates = ElementJob::where('production_id', $prod->id)->where('status', 1)->select('date_production')->distinct()->orderBy('date_production', 'ASC')->get();    
        $temp = 1;
        $temp2 = 1;

        return view('production-planning', compact('status', 'prod', 'elements', 'job_groups_ids', 'dates', 'temp', 'temp2', 'days'));
    }


    public function production_planning_ingroup($production_id, $job_group_id)
    {
        $prod = Production::find($production_id);

        if (JobOrder::where('production_id', $production_id)->count() > 0)           
        {
            $status = 0;
            return view('production-planning', compact('status'));
        }
        else
        {
            $status = 1;
            $job_group = JobGroup::find($job_group_id);
            $element_ids = ElementJob::where('production_id', $production_id)->where('status', 1)->where('job_group_id', $job_group_id)->select('element_id')->distinct()->get();
            $temp = 1;
            $temp2 = 1;
            $job_groups = JobGroup::orderBy('position', 'ASC')->get();

            return view('production-planning-ingroup', compact('status', 'prod', 'job_group', 'element_ids', 'temp', 'temp2', 'job_groups'));
        }
    }


    public function production_planning_ingroup_save(Request $request)
    {
        $dates = ElementJob::where('production_id', $request->production_id)->where('status', 1)->where('job_group_id', $request->job_group_id)->select('date_production')->distinct()->orderBy('date_production', 'ASC')->get();       
        $element_ids = ElementJob::where('production_id', $request->production_id)->where('status', 1)->where('job_group_id', $request->job_group_id)->select('element_id')->distinct()->get();
            
            foreach($element_ids as $element)
            {

                foreach($dates as $date)
                { 
                    $check = $element->element_id.'_'.$date->date_production;
               
                    $elements_job = ElementJob::where('production_id', $request->production_id)->where('status', 1)->where('date_production', $date->date_production)->where('job_group_id', $request->job_group_id)->where('element_id', $element->element_id)->get();
                
                    foreach ($elements_job as $element_job)
                    {
                            if($element_job->job_group_id != $request[$check])
                            {
                            $element_job->job_group_id = $request[$check];
                            $element_job->date_production_virtual = null;
                            $element_job->save();
                            } 
                    }
                }
            }
                
        $status = 1;
        $prod = Production::find($request->production_id);
        $job_group = JobGroup::find($request->job_group_id);
        $element_ids = ElementJob::where('production_id', $request->production_id)->where('status', 1)->where('job_group_id', $request->job_group_id)->select('element_id')->distinct()->get();
        $temp = 1;
        $temp2 = 1;
        $job_groups = JobGroup::orderBy('position', 'ASC')->get();
        
        if (ElementJob::where('production_id', $request->production_id)->where('status', 1)->where('job_group_id', $request->job_group_id)->sum('sum_amount') != 0)
        {
            return view('production-planning-ingroup', compact('status', 'prod', 'job_group', 'element_ids', 'temp', 'temp2', 'job_groups'));
        }
        else
        {
            $elements = ElementJob::where('production_id', $prod->id)->where('status', 1)->get();
            $job_groups_ids = ElementJob::where('production_id', $prod->id)->select('job_group_id')->distinct()->get();
            $days = $job_groups_ids->count();
            $dates = ElementJob::where('production_id', $prod->id)->where('status', 1)->select('date_production')->distinct()->orderBy('date_production', 'ASC')->get();
            return view('production-planning', compact('status', 'prod', 'elements', 'job_groups_ids', 'dates', 'temp', 'temp2', 'days'));
        }
    }

    public function production_panel()
    {
        $now = Carbon::now()->format('Y-m-d');
    
        $yyyy = Carbon::parse($now)->year;
        $mm = Carbon::parse($now)->month;
        $dd = Carbon::parse($now)->day;

        if ($mm < 10)
        {
            $mm2 = '0'."$mm";
        }
        if ($dd < 10)
        {
            $dd = '0'."$dd";
        }

        $month_names_PL = array (
            1 => 'Styczeń',
            2 => 'Luty',
            3 => 'Marzec',
            4 => 'Kwiecień',
            5 => 'Maj',
            6 => 'Czerwiec',
            7 => 'Lipiec',
            8 => 'Sierpień',
            9 => 'Wrzesień',
            10 => 'Październik',
            11 => 'Listopad',
            12 => 'Grudzień',
        );

        $day_names_PL = array (
            1 => 'pon.',
            2 => 'wt.',
            3 => 'śr.',
            4 => 'czw.',
            5 => 'pt.',
            6 => 'sob.',
            7 => 'niedz.', 
        );

        $year = strtotime(Carbon::parse($now)->year);
        $month = strtotime(Carbon::parse($now)->month);
        $week = strtotime(Carbon::parse($now)->week);
        $day = strtotime(Carbon::parse($now)->day);

        $firstDay = Carbon::now()->startOfMonth();
        $lastDay = Carbon::now()->endOfMonth()->day;

        $last_str = substr($lastDay,0);
        $last_int = (int)$last_str;
        $first_int = 1;

        $now_name_day = Carbon::now()->format('l');
        $first_name_day = Carbon::now()->startOfMonth()->format('l');
        $first_int_day = 0;

        $days = array();
        $start_day = 1;
        
        switch ($first_name_day) {
            case "Monday":
                $number_day = 1;
                for ($i=1; $i <= $last_int; $i++)
                {
                    if ($i < 10)
                    {
                        $dd2 = '0'."$i";
                    }
                    else
                    {
                        $dd2 = $i;
                    }
                    $days[$i] = [
                        'day' => $i,
                        'name' => $day_names_PL[$number_day],
                        'date' => $yyyy.'-'.$mm2.'-'.$dd2,
                        'status' => 0,         
                    ];                    
                    $number_day = $number_day + 1;
                    if ($number_day > 7)
                    {
                        $number_day = 1;
                    }  
                }
                break;
            case "Tuesday":
                $number_day = 2;
                for ($i=1; $i <= $last_int; $i++)
                {
                    if ($i < 10)
                    {
                        $dd2 = '0'."$i";
                    }
                    else
                    {
                        $dd2 = $i;
                    }
                    $days[$i] = [
                        'day' => $i,
                        'name' => $day_names_PL[$number_day],
                        'date' => $yyyy.'-'.$mm2.'-'.$dd2,
                        'status' => 0,         
                    ];                    
                    $number_day = $number_day + 1;
                    if ($number_day > 7)
                    {
                        $number_day = 1;
                    }  
                }
                break;
            case "Wednesday":
                $number_day = 3;
                for ($i=1; $i <= $last_int; $i++)
                {
                    if ($i < 10)
                    {
                        $dd2 = '0'."$i";
                    }
                    else
                    {
                        $dd2 = $i;
                    }
                    $days[$i] = [
                        'day' => $i,
                        'name' => $day_names_PL[$number_day],
                        'date' => $yyyy.'-'.$mm2.'-'.$dd2,
                        'status' => 0,         
                    ];                    
                    $number_day = $number_day + 1;
                    if ($number_day > 7)
                    {
                        $number_day = 1;
                    }  
                }
                break;
            case "Thursday":
                $number_day = 4;
                for ($i=1; $i <= $last_int; $i++)
                {
                    if ($i < 10)
                    {
                        $dd2 = '0'."$i";
                    }
                    else
                    {
                        $dd2 = $i;
                    }
                    $days[$i] = [
                        'day' => $i,
                        'name' => $day_names_PL[$number_day],
                        'date' => $yyyy.'-'.$mm2.'-'.$dd2,
                        'status' => 0,         
                    ];                    
                    $number_day = $number_day + 1;
                    if ($number_day > 7)
                    {
                        $number_day = 1;
                    }  
                }
                break;
            case "Friday":
                $number_day = 5;
                for ($i=1; $i <= $last_int; $i++)
                {
                    if ($i < 10)
                    {
                        $dd2 = '0'."$i";
                    }
                    else
                    {
                        $dd2 = $i;
                    }
                    $days[$i] = [
                        'day' => $i,
                        'name' => $day_names_PL[$number_day],
                        'date' => $yyyy.'-'.$mm2.'-'.$dd2,
                        'status' => 0,         
                    ];                    
                    $number_day = $number_day + 1;
                    if ($number_day > 7)
                    {
                        $number_day = 1;
                    }  
                }
                break;
            case "Saturday":
                $number_day = 6;
                for ($i=1; $i <= $last_int; $i++)
                {
                    if ($i < 10)
                    {
                        $dd2 = '0'."$i";
                    }
                    else
                    {
                        $dd2 = $i;
                    }
                    $days[$i] = [
                        'day' => $i,
                        'name' => $day_names_PL[$number_day],
                        'date' => $yyyy.'-'.$mm2.'-'.$dd2,
                        'status' => 0,         
                    ];                    
                    $number_day = $number_day + 1;
                    if ($number_day > 7)
                    {
                        $number_day = 1;
                    }  
                }
                break;
            case "Sunday":
                $number_day = 7;
                for ($i=1; $i <= $last_int; $i++)
                {
                    if ($i < 10)
                    {
                        $dd2 = '0'."$i";
                    }
                    else
                    {
                        $dd2 = $i;
                    }
                    $days[$i] = [
                        'day' => $i,
                        'name' => $day_names_PL[$number_day],
                        'date' => $yyyy.'-'.$mm2.'-'.$dd2,
                        'status' => 0,         
                    ];                    
                    $number_day = $number_day + 1;
                    if ($number_day > 7)
                    {
                        $number_day = 1;
                    }  
                }
                break;
        }
      
        if (ElementProduction::where('status', 0)->select('date_production')->first() != null)
        {
            foreach(ElementProduction::where('status', 0)->select('date_production')->distinct()->get() as $date_production)
            {
                $date_for_day = explode("-", $date_production->date_production);
                
                if ($date_for_day[2] < 10)
                {
                    $d1 = explode("0", $date_for_day[2]);
                    $d2 = $d1[1];
                }
                else
                {
                    $d2 = $date_for_day[2];
                }
                
                $days[$d2] = [
                    'day' => $days[$d2]['day'],
                    'name' => $days[$d2]['name'],
                    'date' => $days[$d2]['date'],
                    'status' => 1,   
                ];
            }
        }

        $check_number = 1;

        return view('production-panel', compact('yyyy', 'mm', 'month_names_PL', 'days', 'day_names_PL', 'first_name_day', 'first_int_day', 'last_int', 'check_number'));
    }


    public function production_panel_set_date(Request $request)
    {

 
    }

}
 