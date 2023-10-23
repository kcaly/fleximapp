@extends('layouts.app')
@section('content')

  <div class="mt-1">
    <div class="card shadow-lg border-0 rounded-lg bg-light my-2">
      <div class="card-header">
        <small class="text-muted"><i class="fas fa-toolbox"></i>&nbsp;&nbsp;Produkcja</small>
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
      {{-- <div class="row text-right">
      <button class="btn btn-light border-0 bg-transparent text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        <i class="fas fa-arrows-alt-v"></i> <i class="far fa-window-maximize"></i>
      </button>
    </div>
    <div class="collapse" id="collapseExample"> --}}
    <div>
      <div class="border-bottom-0">
        
     
      
           
      <div class="row mb-3 font-weight-light">
        
        <div class="col-md-6">
          <div class="row mb-3 font-weight-light">
                       
            <div class="col-md-6">
              <form method="post" action="{{route('data.elementproduction') }}" >
                @csrf
                @method('post')
                <input name="temp_date" value="{{Session::get('date')}}" type="hidden">
                <div class="row">
                <h6 class="text-left font-weight-light mt-4 mb-1 grey800color">
                  <i class="fas fa-drafting-compass grey700color"></i>&nbsp;&nbsp;<strong>Przeglądaj rekordy</strong>
                </h6>  </div>
                <div class="row">
                <div class="col-md-6">
                <div class="form mb-2">
                  <label for="date_start" class="small mt-2 mb-1 text-muted">Data od:</label>
                  <input id="date_start" type="date" class="form-control @error('date_start') is-invalid @enderror" name="date_start" value="{{ old('date_start') ?? Session::get('date_start') }}" placeholder="Data (RRRR-MM-DD)" autofocus />
                  
                          @error('date_start')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                          @enderror
                  
                 
              </div>
                </div>
                <div class="col-md-6">
              <div class="form mb-2">
                <label for="date_end" class="small mt-2 mb-1 text-muted">do:</label>
                <input id="date_end" type="date" class="form-control @error('date_end') is-invalid @enderror" name="date_end" value="{{ old('date_end') ?? Session::get('date_end') }}" placeholder="Data (RRRR-MM-DD)" autofocus />
                
                        @error('date_end')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                
              </div>
            </div>
            </div>


            </div>
            <div class="col-md-6">
                
                  


                

              </div>
            
             
                <div class="d-flex justify-content mt-2">
                
                <button type="submit" value="loadmass" class="btn btn-outline-dark btn-sm">Wczytaj</button>
                </div>
         

      
              </form>
                
              
            

              
          </div>
          
        </div>
        <div class="col-md-6">
            <div class="form-floating mb-3 mt-2 mb-md-0">
              <h6 class="text-left font-weight-light mb-3 grey800color">
                <i class="fas fa-database grey700color"></i>&nbsp;&nbsp;<strong>Generowanie danych</strong>  
              </h6>   

              <div class="row mb-3 font-weight-light mb-4">
               
                <div class="col-md-5">
                  <form method="post" action="{{ route('production')}}" >
                    @csrf
                    @method('put')
                    
                    <div class="form-floating">
                  
                      <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') ?? Session::get('date') }}" placeholder="Data (RRRR-MM-DD)" autofocus />
                      <label for="date">Data prod.</label>
                              @error('date')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                              @enderror
                      
                     
                  </div>



                </div>
                <div class="col-md-6">

                  <div class="form-floating">
                  
                    {{-- <select name="grupe" class="form-select" id="inputGroupSelect01" disabled>
                      <option value="1">Elementy</option>
                      <option value="2">Artykuły</option>
                      <option value="3">Produkty</option>
                  </select>
                  <label for="grupe">Obszar tech.</label>
                          @error('grupe')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                          @enderror
                     --}}
                   
                </div>

                </div>

              </div>
            </div>

            
              
            {{-- <button type="submit" name="action" value="refresh" class="btn btn-light btn-sm" ><i class="fas fa-sync-alt"></i></button> --}}

            <button type="submit" name="action" value="generate" class="btn btn-primary btn-sm">Generuj</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="action" value="load" class="btn btn-primary btn-sm">Wczytaj</button>

            <div class="form-check mt-3 small">
              
              <label class="form-check-label" for="flexCheckDefault">
                <input class="form-check-input" type="checkbox" name="refresh" value="1" id="flexCheckDefault">
                <span class="badge bg-light rounded-pill text-dark">
                  
                  <i class="fas fa-exclamation-triangle"></i> Wygeneruj ponownie</span>&nbsp;&nbsp;
              </label>  
                <button type="submit" name="action" value="delete" class="btn btn-outline-danger btn-sm"><div class="small">Usuń</div></button>
              </div></form>
            </div>
           
            
        </div>

     
      </div>
    </div>
      </div>

     


      

        <div class="card-body">
          
<div class="row">
  

  <div class="col-md-3">
    {{-- <form method="post" action="{{route('production.panel.set.date') }}" >
      @csrf
      @method('post')
      <input name="current_month" value="{{$mm}}" type="hidden">
      <input name="current_year" value="{{$yyyy}}" type="hidden">
    <button type="submit" name="action" value="up" class="btn btn-sm btn-outline-secondary border-0 routed"><i class="fas fa-chevron-left"></i></button>
    <button type="submit" name="action" value="down" class="btn btn-sm btn-outline-secondary border-0 routed"><i class="fas fa-chevron-right"></i></button>
    <button class="btn" disabled><strong>{{$month_names_PL[$mm]}} {{$yyyy}}</strong></button>
    </form> --}}
  </div>

  

  <div class="col-md-2">
  
  </div>

  


  <div class="col-md-7">
    
   
  <button type="submit" id="{{$check_number=0}}" @if(\App\Models\ElementProduction::where('status', 0)->select('date_production')->first() != null) class="btn btn-primary btn-sm mb-1" @else class="btn btn-outline-secondary btn-sm mb-1" disabled @endif><i class="fas fa-snowplow"></i> <i class="fas fa-suitcase"></i>&nbsp;&nbsp;Utwórz zakres</button>&nbsp;&nbsp;&nbsp;&nbsp;
  <a href="#" class="btn btn-outline-dark btn-sm mb-1"><i class="fas fa-vote-yea"></i> <i class="fas fa-list"></i>&nbsp;&nbsp;Lista</a>&nbsp;&nbsp;
  <a href="#" class="btn btn-outline-dark btn-sm mb-1"><i class="fas fa-book"></i> <i class="fas fa-mug-hot"></i>&nbsp;&nbsp;Archiwum</a>
  </div>
</div>
         

          <div class="card-footer rounded-3 border-start border-end border-bottom mt-3">
            <div class="row">
              
            </div>
            <div class="row">
              <div class="col-md-3">
                
              </div>
              <div class="col-md-7">
                
              </div>
              <div class="col-md-2">
                
              </div>
            </div>
            {{-- <div class="row align-items-center border-bottom border-light border-2 my-1">
              <div class="col-md-1">
                
              </div>
              <div class="col-md-3 mx-auto">
                <button class="btn" disabled><small><i class="far fa-clock"></i> Wygenerowano</small></button>
              </div>

              
              <div class="col-md-1">
                
              </div>
              <div class="col-md-3">
                
              </div>
             
              <div class="col-md-3">
                
              </div>
             
            </div> --}}
            
            
            <div class="row align-items-center border-bottom border-light border-2 my-1">
            
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
            
           
          </form>

           


            



     
            
            
          



          </div>
                
        </div>
      
     
  </div>

@endsection
