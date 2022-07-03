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

            




                

                {{-- <div class="row mb-3">
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="inputGroupSelect01">Artykuł</label>
                        <select name="article_id" class="form-select" id="inputGroupSelect01">
                            @foreach (\App\Models\Article::all() as $article)
                            <option value="{{ $article->id }}">{{ $article->name }}</option>
                            @endforeach
                        </select>
                      </div>
                      
                </div> --}}
{{--                 
                <div class="form-floating">
                    <select name="article_id" class="form-select" id="floatingSelect" aria-label="Wybierz element...">
                        
                        <option selected>{{ $article->name }}</option>
                      @foreach (\App\Models\Article::all() as $article)
                        <option value="{{ $article->id }}">{{ $article->name }}</option>
                        @endforeach
                        
                    </select>
                    <label for="floatingSelect">Wybierz element...</label>
                  </div>     --}}


                  
                  <div class="form-floating">
                    <input id="article_id" type="text" class="form-control" value="{{$article->name}}" placeholder="Artykuł" disabled/>
                    <label for="article_id">Nazwa</label>
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
                Dodaj element
            </h4>
          </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-primary text-center" role="alert">         
                <h6>{{ Session::get('message') }}</h6>
                </div> 
            @endif


            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <nav class="navbar navbar-expand-lg navbar-light">
                    
                            <form class="d-flex" method="post" action="{{route('job.search')}}" >
                              @csrf
                              @method('put')
                              <input name="search" class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Wyszukaj">
                <datalist id="datalistOptions">
                    @foreach (\App\Models\Element::all() as $element)
                  <option value="{{$element->code}}&nbsp;&nbsp;{{$element->name}}">
                    @endforeach
                </datalist>
                              <button class="btn btn-outline-dark" type="submit" action="search"><i class="fas fa-search"></i></button>
                            </form>
                        
                      </nav>
                    
                </div>
                
            </div>
            <form method="POST" action="{{ route('articles_elements.add') }}">
                @csrf
                @method('put')
            <div class="row mb-3">
                
    
                <div class="col-md-3">
                    <div class="form-floating mb-3 mb-md-0">
                        <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required autocomplete="amount" autofocus placeholder="Ilość" />
                        <label for="amount">Ilość</label>
                        @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-9">                  
                        <div class="form-floating">
                            <input name="article_id" value="{{$article->id}}" type="hidden">
                            <select name="element_id" class="form-select" id="floatingSelect" aria-label="Lista elementów">
                                
                                
                              <option selected></option>
                              @foreach (\App\Models\Element::all() as $element)
                                <option value="{{ $element->id }}">{{$element->code}}&nbsp;&nbsp;{{$element->name}}</option>
                                @endforeach
                                
                            </select>
                            <label for="floatingSelect">Wybierz</label>
                          </div>         
                </div>
            </div>


            <div class="row mb-3">
                
            </div>
                




                <div class="row mt-4 mb-4">
                    <input name="article_id" value="{{$article->id}}" type="hidden">
                   <div class="text-right"><button type="submit" class="btn btn-primary btn-lg" href="login.html"><i class="far fa-check-circle"></i> Zatwierdź</button></div>
                </div>
             
            </form>
        </div>
        <div class="card-footer text-center py-3">
            
        </div>
    </div>
</div>

</div>


@endsection




