<?php

namespace App\Http\Controllers;

use App\Imports\ElementsImport;
use App\Imports\ProductsImport;
use App\Models\Product;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    public function create(Request $request)
    {
        
        $product = new Product();
        $product->name = $request->name;

        // $product->time = 0;
        // $product->price_actual = 0;
        // $product->price_factual = 0;

        $user_company = \App\Models\Company::where('id', auth()->user()->company_id)->first();
        $flexim_id = $user_company->flexim_id;           
         
        for($i=0;$i<strlen($flexim_id);$i++)
        {
                
        }        
        $code = '10'.$flexim_id[1].$flexim_id[2].'3';
        $product->code = $code;
        $product->save();
            
        $product_add_id_to_code = Product::where('name', $request->name)->orderBy('id', 'DESC')->first();
        $product_add_id_to_code->code = $code . $product_add_id_to_code->id;
        $product_add_id_to_code->save();

        return redirect()->route('product.list')->with('message', 'Pomyślnie dodano nowy produkt.');

    }

    public function show()
    {
        
        $products = Product::paginate(100);
        return view('product-list', compact('products'));
    }


    public function products_articles_show($id)
    {
        {
            $product = Product::find($id);
            $product_articles = $product->articles;
            
            return view('product-details', compact('product_articles'), compact('product'));
    
    
        }

    }


    public function products_articles_new($product_id)
    {
            $product = Product::find($product_id);


            return view('product-article-add', compact('product'));

    }


    public function products_articles_add(Request $request)
    {

        $product = Product::find($request->product_id);
        
        $product->articles()->attach($request->article_id, array('amount' => $request->amount));



        $product_articles = $product->articles;
        


        return view('product-details', compact('product_articles'), compact('product'));


    }

    
    public function product_article_delete($product_id, $article_id, $amount)
    {


        $product = Product::find($product_id);
        $product->articles()->where('id', $article_id)->wherePivot('article_id', $article_id)->wherePivot('amount', $amount)->detach();


        $product_articles = $product->articles;
        return view('product-details', compact('product_articles'), compact('product'));


    }


    public function product_delete($id)
    {
      
        Product::where('id', $id)->delete();

        return view('product-list')->with('message', 'Usunięto artykuł.');

    }

    public function update(Request $request)
    {
        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->save();

        return redirect()->route('product.list')->with('message', 'Pomyślnie edytowano produkt.');

    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('product-edit', compact('product'));
    }

    public function product_import ()
    {
        return view('product-import');
    }

    public function product_upload(Request $request)
    {
        
        Excel::import(new ProductsImport, $request->file);
 
        return redirect()->route('product.list')->with('message', 'Pomyślnie zaimportowano listę produktów.');
    }
    
}
