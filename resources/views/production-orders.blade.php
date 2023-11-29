@extends('layouts.app')
@section('content')

  <div class="mt-1">
    <div class="card shadow-lg border-0 rounded-lg bg-light my-2">
      <div class="card-header">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item small active"><i class="fas fa-toolbox"></i>&nbsp;&nbsp;<a href="{{route('production.panel')}}">Produkcja</a></li>
            <li class="breadcrumb-item small active" aria-current="page"><strong>Lista aktywnych zleceń</strong></li>
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
              {{-- <h6 class="card-title"><i class="fas fa-link"></i> <i class="fas fa-th-list"></i>&nbsp;&nbsp;Utwórz zlecenia produkcyjne</h6> --}}
              <ul class="nav nav-pills card-header-pills mt-2">
                <li class="nav-item">
                  {{-- <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><h6 class="small"><i class="fas fa-bullhorn"></i> Procesu scalania nie można cofnąć. Usuń i ponownie wygeneruj.</h6></a> --}}
                  {{-- <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><h6 class="font-weight-light mb-4 grey800color"><i class="fas fa-stopwatch"></i> <i class="fas fa-rocket"></i>&nbsp;&nbsp;<strong>Generowanie zleceń produkcyjnych</strong></h6></a> --}}
                </li>
              </ul>
              <div class="list-group">
                @foreach (\App\Models\Production::where('status',0)->orwhere('status',1)->orwhere('status',2)->get() as $production)
  
                {{-- class="list-group-item list-group-item-action active"  KLASA ZMIANY KOLORU NA NIEBIESKI --}}
                
                @if ($production->status == 0 || $production->status == 1)
                <a href="{{route('production.select', ['id' => $production->id ])}}" class="list-group-item list-group-item-action border border-dark">
                @endif
                @if ($production->status == 2 && $production->done < $production->sum_elements)
                <a href="{{route('production.select', ['id' => $production->id ])}}" class="list-group-item list-group-item-action active border border-dark">
                @endif
                @if ($production->status == 2 && $production->done == $production->sum_elements)
                <a href="{{route('production.select', ['id' => $production->id ])}}" class="list-group-item list-group-item-action active border border-success bg-success border border-dark">
                @endif
  
  
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{$production->dates_textcode}}</h5>
                    <p class="mb-1">
                      @if ($production->done == $production->sum_elements)
                      <div class="text-right mb-2 mt-1 text-black">
                        <strong>Zrealizowano <i class="fas fa-award"></i></strong>
                      </div>
                      @else
                      <div class="text-right mb-2 mt-1 text-black">
                        <strong>0 <i class="fas fa-user-lock"></i></strong>&nbsp;&nbsp;&nbsp;&nbsp;{{ $production->done}} / {{$production->sum_elements}}
                      </div>
                      @endif
  
                      {{$production->name}}
                    </p>
                    {{-- <small class="">
                      <button href="#" class="btn btn-light"><i class="fas fa-clipboard-check"></i> Checklisty</button>
                      <button href="{{route('production.select', ['id' => $production->name ])}}" class="btn btn-light"><i class="fab fa-digital-ocean"></i> Otwórz</button>
                    </small> --}}
                  </div>
                  
                  <small class="text-left">
                    <div class="text-left mt-1 mb-2 small">
                      Utworzono: {{ (\App\Models\Production::where('id', $production->id)->first())->created_at->toDateTimeString()}}</div>
  
  
                    
                      
                      @if ($production->done < $production->sum_elements && $production->status >= 2)
                      <div class="progress mt-2">                
                      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{$production->done_procent}}%;" aria-valuenow="{{$production->done_procent}}" aria-valuemin="0" aria-valuemax="100">{{$production->done_procent}}% [{{ $production->done}}/{{$production->sum_elements}}]</div></div>
                      @endif
                      
  
                      @if ($production->done == $production->sum_elements && $production->status >= 2)
                      <div class="progress mb-1" style="height: 1px;">
                        <div class="progress-bar bg-light" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <div class="progress">
                      <div class="progress-bar bg-success text-left" role="progressbar" style="width: {{$production->done_procent}}%;" aria-valuenow="{{$production->done_procent}}" aria-valuemin="0" aria-valuemax="100">Wykonano wszystkie rekordy.&nbsp;&nbsp;&nbsp;&nbsp;{{$production->done_procent}}% [{{ $production->done}}/{{$production->sum_elements}}]</div></div>
                      @endif
  
                      
  
                      @if ($production->done == 0 && $production->status < 2)
                      <div class="progress mt-2">
                      <div class="progress-bar bg-white text-muted" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"><strong>Oczekujące.</strong></div></div>
                      @endif
                      @if ($production->done != 0 && $production->status < 2)
                      <div class="progress mt-2">
                      <div class="progress-bar bg-transparent" role="progressbar" style="width: 100%" aria-valuenow="{{$production->done_procent}}" aria-valuemin="0" aria-valuemax="100"><h6 class="rediconcolor small mt-2"><strong>Wstrzymano.&nbsp;&nbsp;&nbsp;&nbsp;{{$production->done_procent}}% [{{ $production->done}}/{{$production->sum_elements}}]</strong></h6></div></div>
                      @endif
                      
  
                    
                  </small>
                </a>
                @endforeach
              </div>

        </div>
     
        </div>
@endsection
