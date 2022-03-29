@extends('layouts.app')
@section('content')
<div class="row mb-3">




<div class="col-lg-4">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h4 class="text-center font-weight-light my-4">
                Produkt
            </h4>
          </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-primary text-center" role="alert">         
                <h6>{{ Session::get('message') }}</h6>
                </div> 
            @endif

     



                <div class="row mb-3">
                    <form method="POST" action="{{ route('product.update') }}">
                        @csrf
                        @method('put')
                        <input name="id" value="{{ $product->id }}" type="hidden">
        
        
        
                        <div class="form-floating mb-4">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $product->name }}" placeholder="Nazwa"/>
                            <label for="name">Nazwa</label>
                                    @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                        </div>
                        
                        <div class="row mt-4 mb-4">
        
                           <div class="text-right"><button type="submit" class="btn btn-primary" href="login.html"><i class="far fa-check-circle"></i> Zatwierdź</button></div>
                        </div>
                     
                    </form>
                      
                </div>
                




              
             
           
        </div>
        <div class="card-footer text-center py-3">
            
        </div>
    </div>
</div>

<div class="col-lg-8">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h4 class="text-center font-weight-light my-4">
                Struktura produktu
            </h4>
          </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-primary text-center" role="alert">         
                <h6>{{ Session::get('message') }}</h6>
                </div> 
            @endif



            <table class="table table-striped table-sm table-hover">
                <thead>
                  <tr>
                    <th scope="col">Ilość</th>
                    <th scope="col">Indeks</th>
                    <th scope="col">Nazwa</th>          
                    <th scope="col"><form method="get" action={{route('products.articles.new', ['product_id' => $product->id] )}} >
                        @csrf
                        @method('get')
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button>
                    </form></th>
                    
                  </tr>
                </thead>
                <tbody>
                   
@foreach ($product_articles as $article)
<tr>
  
    <td>{{ $article->pivot->amount }}</td>
    <td>{{ $article->id }}</td>
    <td><a href="{{route('article.details.show', ['id' => $article->id]) }}"><i class="	fas fa-search"></i></a> {{ $article->name}}</td>
    <td>
        <form method="get" action={{route('product.article.delete', ['product_id' => $article->pivot->product_id, 'article_id' => $article->pivot->article_id, 'amount' => $article->pivot->amount])}} >
            @csrf
            @method('get')
            <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
        </form>
    </td>
    
</tr>   
@endforeach
       
            </tbody>
        </table> 
                




                <div class="row mt-4 mb-4">

                   
                </div>
             

        </div>
        <div class="card-footer text-center py-3">
            
        </div>
    </div>
</div>

</div>


@endsection




