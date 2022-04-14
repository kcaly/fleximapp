<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{



    public function store(Request $request)
    {
        $company = new Company();
        $company->name = $request->name;
        $company->nip = $request->nip;
        $company->contact = $request->contact;
        $company->address = $request->address;
        $company->postcode = $request->postcode;
        $company->city = $request->city;

        
        $flexim_id=CompanyController::random_flexim_id();
        

        $already_id=(Company::where('flexim_id', '=', $flexim_id)->exists());
        

        while($already_id == true)
        {

            $flexim_id=CompanyController::random_flexim_id();

        }
        
        $company->flexim_id = $flexim_id;
        $company->save();

        return redirect()->route('register')->with('message', $flexim_id);
    }

    public static function random_flexim_id()
        {

        // $tablica_liter= range('a','z');
        // $wylosowana_litera = mt_rand(0,25);
        // $litera = $tablica_liter[$wylosowana_litera];
        // $wylosowana_liczba = mt_rand( 1000, 2000 );
        // $flexim_id = $litera . $wylosowana_liczba;

        $litera = 'X';
        $wylosowana_liczba = mt_rand( 10, 99 );
        $flexim_id = $litera . $wylosowana_liczba;
        

        return $flexim_id;
            
        }

}