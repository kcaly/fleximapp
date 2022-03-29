<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    

    public function user_edit($company_id, $id)
    {

        $company = Company::find($company_id);
        if(auth()->user()->company_id != $company->id)
        {
            abort(403);
        }

        $user = User::find($id);
        
        return view('admin.user-edit', compact('user'), compact('company'));

    }

    public function user_save(Request $request){


        $user = User::find($request->id);
        
        $user->tag_user = $request->tag_user;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;

        $user->save();
        return redirect()->route('panel');


    }

    public function company_edit($id)
    {

        if(auth()->user()->company_id != $id)
        {
            abort(403);
        }

        $company = Company::find($id);
        return view('admin.company-edit', compact('company'));

    }

    public function company_save(Request $request)
    {

        $company = Company::find($request->id);
        $company->name = $request->name;
        $company->nip = $request->nip;
        $company->contact = $request->contact;
        $company->address = $request->address;
        $company->postcode = $request->postcode;
        $company->city = $request->city;

        $company->save();
        
        return redirect()->route('panel');


    }

    public function user_status($user_id)
    {
        if (!auth()->check())
        {
            abort(403);
            return;
        }

        $user = \App\Models\User::findOrFail($user_id);
        $user->status = !$user->status;
        $user->save();

        return redirect()->route('panel')->with('message', 'Zmieniono status');

    }

}
