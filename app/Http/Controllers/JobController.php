<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobOrder;
use App\Models\JobGroup;
use App\Models\ElementJob;
use App\Models\ElementProduction;

class JobController extends Controller
{
    public function index()
    {           
        return redirect()->route('job');
    }

    public function list($id)
    {   
        $production = \App\Models\Production::find($id);
        
        $title = $production->name;    
        $dates = $production->dates_textcode;
        
        return redirect()->route('job.list')->with(['jobs_id' => $id, 'title' => $title, 'prod_id' => $production->id, 'dates' => $dates]);
    }


    public function open(Request $request)
    {
        $job_order = JobOrder::find($request->job_id);

        if ($job_order->status != 0)
        {

        if ($job_order->protection_user_id == null || $job_order->protection_user_id == 0)
        {
            if(JobOrder::where('protection_user_id', auth()->user()->id)->count() > 0)
            {
                $last_job_order = JobOrder::where('protection_user_id', auth()->user()->id)->first();
                $last_job_order->protection_user_id = null;
                $last_job_order->save();
            }

            $job_order->protection_user_id = auth()->user()->id;
            $job_order->save();
        }
        else
        { 
            if ($job_order->protection_user_id != auth()->user()->id)
            {
                $id = $job_order->production_id;
                return redirect()->route('list.get', compact('id'));
            }      
        }
                         
            $job_group = $job_order->job_group;

            $default_quantity = 0;
            if ($request->element_id != null || $request->element_id != 0)
            {
                $active_status = 1;
                $element_active = ElementJob::find($request->element_id);
                $element_active_id = $element_active->id;
            }
            else
            {
                $active_status = 0;
                $element_active = 0;
                
            }         


            switch ($request->action)
            {
                case 2:
                    if ($request->done_amount != null || $request->done_amount != 0)
                    {
                        $limit = $element_active->sum_amount - $element_active->done;
                        if ($request->done_amount <= $limit || $element_active->sum_amount)
                        {
                            $new_record_element = new ElementJob();
                            $new_record_element->code = $element_active->id;
                            $new_record_element->name = $element_active->name;
                            $new_record_element->length = $element_active->length;
                            $new_record_element->width = $element_active->width;
                            $new_record_element->height = $element_active->height;
                            $new_record_element->status = 10;
                            $new_record_element->sum_amount = $request->done_amount;
                            $new_record_element->sum_weight = \App\Models\Element::find($element_active->element_id)->weight * $request->done_amount;
                            $new_record_element->done = 0;  
                            $new_record_element->date_production = date("Y-m-d");
                            $new_record_element->job_order_id = $element_active->job_order_id;
                            $new_record_element->machine_id = $request->machine_id;
                            $new_record_element->element_id = $element_active->element_id;
                            $new_record_element->material_id = $element_active->material_id;
                            $new_record_element->production_id = $element_active->production_id ;
                            $new_record_element->material = $element_active->material;
                            $new_record_element->save();
        
                            $new_record_element->code = $new_record_element->code.$new_record_element->id;
                            $new_record_element->save();
                            
                            if ($element_active->sum_amount - $new_record_element->sum_amount == 0)
                            {
                                $element_active->sum_amount = 0;
                            }
                            else
                            {   
                                $element_active->sum_amount = $element_active->sum_amount - $new_record_element->sum_amount;
                            }
                            $element_active->save();
        
                            $default_quantity = -1;
                        }
                    }
                    break;


                case 1:
                    if ($request->done_amount != null || $request->done_amount != 0)
                    {
                        $limit = $element_active->sum_amount - $element_active->done;
                        if ($request->done_amount <= $limit)
                        {
                            $element_active->done = $element_active->done + $request->done_amount;
                            $element_active->save();
                            $default_quantity = $element_active->sum_amount - $element_active->done;
                        }
                    }
                    break;
            }
            

            if ($request->element_id != null || $request->element_id != 0)
            {
                if ($default_quantity == -1)
                {
                    $default_quantity = 0;
                }
                else
                {
                    $default_quantity = $element_active->sum_amount - $element_active->done;
                }
                

                $primary_element_id = $element_active->element_id;
                return redirect()->route('job.active')->with(['job_order_id' => $job_order->id, 'job_group_id' => $job_group->id, 'active_status' => $active_status, 'element_active_id' => $element_active_id, 'primary_element_id' => $primary_element_id, 'default_quantity' => $default_quantity]);
            }
            else
            {
                $default_quantity = 0;
                return redirect()->route('job.active')->with(['job_order_id' => $job_order->id, 'job_group_id' => $job_group->id, 'active_status' => $active_status, 'default_quantity' => $default_quantity]);     
            }
        }
        return redirect()->route('job.index');
    }
 

    public function out(Request $request)
    {
        $job_order = JobOrder::find($request->job_id);
        $id = $job_order->production_id;
        
        $sum_done = ElementJob::where('job_order_id', $job_order->id)->where('status','>=', 4)->where('status','<', 10)->sum('done');
        $job_order->done = $sum_done;
        $job_order->save();
        

        if ($job_order->protection_user_id == auth()->user()->id)
        {
            $job_order->protection_user_id = null;
            $job_order->save();

          return redirect()->route('list.get', compact('id'));          
        }

        return redirect()->route('list.get', compact('id'));
    }


    public function search(Request $request)
    {
        dd($request);

        $element_job = ElementJob::where('code', $request->search)->first();
        $element = ElementJob::where('job_order_id', $element_job->job_order_id)->where('element_id', $element_job->element_id)->where('status',4 )->first();

        $default_quantity = $element_job->sum_amount - $element_job->done;
        $active_status = 3;
        $element_active_id = $element_job->id;

        $primary_element_id = $element->element_id;
        return redirect()->route('job.active')->with(['job_order_id' => $element_job->job_order_id, 'job_group_id' => $element_job->job_group_id, 'active_status' => $active_status, 'element_active_id' => $element_active_id, 'primary_element_id' => $primary_element_id, 'default_quantity' => $default_quantity]);       
    }










    
    public function read($job_order_id, $element_id)
    {
        $job_order = JobOrder::find($job_order_id);
        $job_group = $job_order->job_group;

        $elements = ElementJob::where('job_order_id', $job_order->id)
                                ->orderBy('length', 'ASC')
                                ->orderBy('width', 'ASC')
                                ->orderBy('height', 'ASC')
                                ->get();

        $element_job = ElementJob::find($element_id);
        $element_details = ElementProduction::where('element_job_id', $element_job->id)->orderBy('date_production', 'ASC')->get();


        
       return view('workstation', compact(['job_order', 'job_group', 'elements', 'element_job', 'element_details']));

    }





    public function show(Request $request)
    {
            
        if ($request->select != null)
        {
            return redirect()->route('job.show')->with('select', $request->select)->with('message', 'TEST select 0-0-0-1');
        }
        else
        {
            return redirect()->route('job')->with('message', 'TEST select 0-0-0-2');
        }
    }

}
