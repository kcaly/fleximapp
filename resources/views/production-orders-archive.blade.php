@extends('layouts.app')
@section('content')

  <div class="mt-1">
    <div class="card shadow-lg border-0 rounded-lg bg-light my-2">
      <div class="card-header">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item small active"><i class="fas fa-toolbox"></i>&nbsp;&nbsp;<a href="{{route('production.panel')}}">Produkcja</a></li>
            <li class="breadcrumb-item small active" aria-current="page"><strong>Archiwum zleceń</strong></li>
          </ol>
        </nav>
        <div class="row">
          <div class="col-md-7">

          </div>
          <div class="col-md-5">
        @if (session()->has('message'))
        <div class="alert alert-light alert-dismissible fade show mt-1 mb-2" role="alert">
          <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>
          </svg>
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
  
    {{ Session::get('message') }} {{ Session::get('order_records') }}
  
        
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
  @endif   
      </div>
       
      </div>
    
      </div>

        
          <div class="card text-center bg-light border border-2 border-white rounded border-bottom-0">
            <div class="card-header bg-light">

              <table class="table table-sm">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">ID</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col"></th>
                    <th scope="col">Ilość elementów</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach(\App\Models\Production::where('status', 99)->get() as $production)
                  <tr>
                    <td>
                      <form method="get" action={{route('production.select', ['id' => $production->id ])}} >
                      @csrf
                      @method('get')
                      <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-sign-in-alt"></i></button>
                      </form>
                </td>
                    <td>{{$production->id}}</td>
                    <td>{{$production->name}}</td>
                    <td>{{$production->dates_textcode}}</td>
                    <td>{{$production->sum_elements}}</td>
                    <td>{{$production->updated_at}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>


            </div>
          </div>

        </div>
        </div>
@endsection
