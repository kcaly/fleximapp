@extends('layouts.app')
@section('content')
<div class="row mb-3">




<div class="col-lg-4">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h4 class="text-center font-weight-light my-4">
                Artykuł
            </h4>
          </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-primary text-center" role="alert">         
                <h6>{{ Session::get('message') }}</h6>
                </div> 
            @endif

     



                <div class="row mb-3">
                    <form method="POST" action="{{ route('article.update') }}">
                        @csrf
                        @method('put')
                        <input name="id" value="{{ $article->id }}" type="hidden">
        
        
        
                        <div class="form-floating mb-4">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $article->name }}" placeholder="Nazwa"/>
                            <label for="name">Nazwa</label>
                                    @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                        </div>
                        <div class="form-floating mb-4">
                            <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') ?? $article->price }}" placeholder="Cena" disabled/>
                            <label for="price">Wartość (PLN)</label>
                                    @error('price')
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
                Struktura artykułu
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
                    <th scope="col">Materiał</th>
                    <th scope="col">Indeks</th>
                    <th scope="col">Nazwa</th>          
                    <th scope="col">Dł.</th>
                    <th scope="col">Szer.</th>
                    <th scope="col">Wys.</th>
                    <th scope="col"><form method="get" action={{route('articles.elements.new', ['article_id' => $article->id] )}} >
                        @csrf
                        @method('get')
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></button>
                    </form></th>
                    
                  </tr>
                </thead>
                <tbody>
                   
@foreach ($article_elements as $element)
<tr>

    <td>{{ $element->pivot->amount }}</td>
    <td>{{ $element->material->name }}</td>
    <td>{{ $element->id }}</td>
    <td><a href="{{route('element.edit', ['id' => $element->id]) }}"><i class="	fas fa-search"></i></a> {{ $element->name}}</td>
  
    <td>{{ $element->length }}</td>
    <td>{{ $element->width }}</td>
    <td>{{ $element->height }}</td>
    <td>
        <form method="get" action={{route('article.elements.delete', ['article_id' => $element->pivot->article_id, 'element_id' => $element->pivot->element_id, 'amount' => $element->pivot->amount])}} >
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




