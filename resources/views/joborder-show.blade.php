@extends('layouts.app')
@section('content')

  <div class="mt-1">
    <div class="card shadow-lg border-0 rounded-lg bg-light my-2">
      <div class="card-header small text-muted">
        <i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Zlecenia produkcyjne     
      </div>
        <div class="card-body">
          

          
          <div class="row">
              <div class="col-md-12">
                @foreach (\App\Models\Production::where('status',2)->get() as $production)

              {{-- class="list-group-item list-group-item-action active"  KLASA ZMIANY KOLORU NA NIEBIESKI --}}
              
             
              @if ($production->status == 2 && $production->done < $production->sum_elements)
              <a href="{{route('list.get', ['id' => $production->id ])}}" class="list-group-item list-group-item-action">
              @endif
              @if ($production->status == 2 && $production->done == $production->sum_elements)
              <a href="{{route('list.get', ['id' => $production->id ])}}" class="list-group-item list-group-item-action active border border-success bg-success border border-dark">
              @endif


                <div class="d-flex w-100 justify-content-between my-2">
                  <h5 class="mb-1">{{$production->dates_textcode}}&nbsp;&nbsp;&nbsp;&nbsp;{{$production->name}}</h5>
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

                    
                  </p>
                  {{-- <small class="">
                    <button href="#" class="btn btn-light"><i class="fas fa-clipboard-check"></i> Checklisty</button>
                    <button href="{{route('production.select', ['id' => $production->name ])}}" class="btn btn-light"><i class="fab fa-digital-ocean"></i> Otwórz</button>
                  </small> --}}
                </div>
                
                <small class="text-left">
                  {{-- <div class="text-left mt-1 mb-2 small">
                    Utworzono: {{ (\App\Models\Production::where('id', $production->id)->first())->created_at->toDateTimeString()}}</div> --}}


                  
                    
                    @if ($production->done < $production->sum_elements && $production->status >= 2)
                    <div class="progress mb-2" style="height: 1px;">
                      <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="progress my-2">
                    <div class="progress-bar bg-light text-left" role="progressbar" style="width: {{$production->done_procent}}%;" aria-valuenow="{{$production->done_procent}}" aria-valuemin="0" aria-valuemax="100"> </div></div>
                    @endif
                    

                    @if ($production->done == $production->sum_elements && $production->status >= 2)
                    <div class="progress mb-1" style="height: 1px;">
                      <div class="progress-bar bg-light" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="progress mb-2">
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
      
     
  </div>

@endsection
