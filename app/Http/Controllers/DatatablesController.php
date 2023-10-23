<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\ElementJob;
use App\Models\ElementProduction;
use App\User;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;


class DatatablesController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function ViewElementProduction(Request $request)
    {  

       return view('production-detailsdates')->with('date_start', $request->date_start)->with('date_end', $request->date_end);
        
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function DataElementProduction($date_start, $date_end)
    {
        $query = ElementProduction::with(['element'])->whereBetween('date_production', [$date_start, $date_end]);
        return DataTables::of($query)->make(true);

       // return DataTables::of(ElementProduction::where('date_production','>=', $date_start)->where('date_production','<=', $date_end))->toJson();   
    }



    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function DataElementJob($date_start, $date_end)
    {
        $query = ElementJob::with(['element', 'material', 'machine', 'job_group'])->whereBetween('date_production', [$date_start, $date_end]);
        return DataTables::of($query)->make(true);

       // return DataTables::of(ElementProduction::where('date_production','>=', $date_start)->where('date_production','<=', $date_end))->toJson();   
    }

    


}