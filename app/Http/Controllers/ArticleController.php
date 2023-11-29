<?php

namespace App\Http\Controllers;

use App\Imports\ArticlesImport;
use App\Imports\ElementsImport;
use App\Models\Article;
use App\Models\Element;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;


class ArticleController extends Controller
{
    public function create(Request $request)
    {
        
        $article = new Article();
        $article->name = $request->name;


        $user_company = \App\Models\Company::where('id', auth()->user()->company_id)->first();
        $flexim_id = $user_company->flexim_id;

        for($i=0;$i<strlen($flexim_id);$i++)
        {
                
        }        
        $code = $flexim_id;
        $article->code = $code;
        $article->save();
            
        $now = Carbon::now()->format('Y-m-d');
    
        $yyyy = Carbon::parse($now)->year;
        $mm = Carbon::parse($now)->month;
        $dd = Carbon::parse($now)->day;



        $article_add_id_to_code = Article::where('name', $request->name)->orderBy('id', 'DESC')->first();
        $article_add_id_to_code->code = $mm . $article_add_id_to_code->id . '/' . $yyyy . '/A';
        $article_add_id_to_code->save();

        // $article->time = 0;
        // $article->price = 0;

        

        return redirect()->route('article.list')->with('message', 'Pomyślnie dodano nowy artykuł.');

    }

    public function show()
    {
        
        $articles = Article::paginate(100);
        return view('article-list', compact('articles'));
    }


    public function edit($id)
    {
        $article = Article::find($id);
        return view('article-edit', compact('article'));
    }


    public function update(Request $request)
    {
        $article = Article::find($request->id);
        $article->name = $request->name;
        $article->save();





        return redirect()->route('article.list')->with('message', 'Pomyślnie zapisano artykuł.');

    }

    public function articles_elements_new($article_id)
    {
        $article = Article::find($article_id);


        return view('article-element-add', compact('article'));



    }


    public function articles_elements_add(Request $request)
    {
        
        $article = Article::find($request->article_id);
        
        $article->elements()->attach($request->element_id, array('amount' => $request->amount));
        
        $element = Element::find($request->element_id);
        $price_now = ($element->weight * $element->material->price)*$request->amount;

        $article = Article::find($request->article_id);
        $article->price = $article->price + $price_now;
        $article->save();
    
        
        




        $article_elements = $article->elements;

        return view('article-details ', compact('article_elements'), compact('article'));

            

    }

    public function articles_elements_show($id)
    {
        $article = Article::find($id);
        ArticleController::rekalkulacja_wyceny_artykylu($article->id);

        $article = Article::find($id);
        $article_elements = $article->elements;
        
        return view('article-details', compact('article_elements'), compact('article'));
    }

    public function articles_elements_delete($article_id, $element_id, $amount)
    {


        $article = Article::find($article_id);
        $article->elements()->where('id', $element_id)->wherePivot('element_id', $element_id)->wherePivot('amount', $amount)->detach();
        $article->save();
        
        ArticleController::rekalkulacja_wyceny_artykylu($article_id);
    
        $article = Article::find($article_id);
        $article_elements = $article->elements;


        return view('article-details', compact('article_elements'), compact('article'));


    }

    public function rekalkulacja_wyceny_artykylu($article_id)
    {
        $article = Article::find($article_id);
        $article->price = 0;
        $article_elements = $article->elements;
        
        
        foreach ($article_elements as $element)
        {
            
            $price_for_element = $element->weight * $element->material->price * $element->pivot->amount;
            
            $article->price = $article->price + $price_for_element;

        }
        
        $article->save();
        
    }



    public function article_delete($id)
    {
      
        Article::where('id', $id)->delete();

        return view('article-list')->with('message', 'Usunięto artykuł.');

    }

    public function article_import ()
    {
        return view('article-import');
    }

    public function article_upload(Request $request)
    {
        
        Excel::import(new ArticlesImport, $request->file);
 
        return redirect()->route('article.list')->with('message', 'Pomyślnie zaimportowano listę artykułów.');
    }



}
