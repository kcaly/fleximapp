@extends('layouts.app')
@section('content')



<div class="col-lg-12">
  <div class="card shadow-lg border-0 rounded-lg mt-4">
    <div class="card-header">
      <h6 class="text-left font-weight-light my-1 grey700color small">
        <i class="fas fa-toolbox grey700color"></i>&nbsp;&nbsp;Produkcja
      </h6>
    </div>
      <div class="card-header">
        
        @if (session()->has('message'))
              <div class="alert alert-info alert-dismissible fade show mt-2" role="alert">
              <h6>{{ Session::get('message') }} {{ Session::get('order_records') }}</h6>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
        @endif 
        <h6 class="text-left font-weight-light mt-3 mb-2 grey800color ">
          <i class="fas fa-calendar-alt"></i> <i class="fas fa-drafting-compass"></i>&nbsp;&nbsp;<strong>Przeglądaj rekordy wykonania</strong>    
        </h6>   
             
        <div class="row mb-3 font-weight-light mt-2">
          <div class="col-md-6">
            <div class="row mb-3 font-weight-light mt-2">
              <h6 class="text-right font-weight-light mb-2">
                @if(Session::get('date') == null)                
                
                @else
                {{-- <i class="fas fa-bell greeniconcolor"></i>&nbsp;&nbsp;<strong class="greeniconcolor">Wczytano: {{Session::get('date')}}</strong>    --}}
                @endif      
              </h6>             
              <div class="col-md-6">
                <form method="post" action="{{route('data.elementproduction') }}" >
                  @csrf
                  @method('post')
                  <input name="temp_date" value="{{Session::get('date')}}" type="hidden">
                  
                  <div class="form mb-2">
                    <label for="date_start" class="small mb-1">Data od:</label>
                    <input id="date_start" type="date" class="form-control @error('date_start') is-invalid @enderror" name="date_start" value="{{ old('date_start') ?? Session::get('date_start') }}" placeholder="Data (RRRR-MM-DD)" autofocus />
                    
                            @error('date_start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    
                   
                </div>
                <div class="form mb-2">
                  <label for="date_end" class="small mb-1">Data do:</label>
                  <input id="date_end" type="date" class="form-control @error('date_end') is-invalid @enderror" name="date_end" value="{{ old('date_end') ?? Session::get('date_end') }}" placeholder="Data (RRRR-MM-DD)" autofocus />
                  
                          @error('date_end')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                          @enderror
                  
                 
              </div>



              </div>
              <div class="col-md-6">
                  
                    


                  

                </div>
              
               
                  <div class="d-flex justify-content mt-3">
                  
                  <button type="submit" value="loadmass" class="btn btn-outline-success btn-sm"><h6 class="mt-2"><i class="fas fa-coins"></i> <i class="fas fa-cart-arrow-down"></i>&nbsp;&nbsp;Wczytaj</h6></button>
                  </div>
           

        
                </form>
                  
                
              

                
            </div>
            
          </div>
          <div class="col-md-6">
              <div class="form-floating mb-3 mt-2 mb-md-0">
                <h6 class="text-left font-weight-light mb-4 grey800color">
                  <i class="fas fa-spray-can"></i> <i class="fas fa-database"></i>&nbsp;&nbsp;<strong>Wygeneruj dane produkcyjne</strong>    
                </h6>   
  
                <div class="row mb-3 font-weight-light mb-4">
  
                  <div class="col-md-6">
                    <form method="post" action="{{ route('production')}}" >
                      @csrf
                      @method('put')
                      
                      <div class="form-floating mb-2">
                    
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

                    <div class="form-floating mb-2">
                    
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

              <button type="submit" name="action" value="generate" class="btn btn-primary btn-sm"><i class="fas fa-fire-alt"></i>&nbsp;Generuj</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="action" value="load" class="btn btn-primary btn-sm">Wczytaj</button>

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








      @if(Session::get('date') == null)                
 
      

      
      <div class="card-body">
        
        <div class="card text-center">
          <div class="card-header">
            {{-- <h6 class="card-title"><i class="fas fa-link"></i> <i class="fas fa-th-list"></i>&nbsp;&nbsp;Utwórz zlecenia produkcyjne</h6> --}}
            <ul class="nav nav-pills card-header-pills">
              <li class="nav-item">
                {{-- <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><h6 class="small"><i class="fas fa-bullhorn"></i> Procesu scalania nie można cofnąć. Usuń i ponownie wygeneruj.</h6></a> --}}
                {{-- <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><h6 class="font-weight-light mb-4 grey800color"><i class="fas fa-stopwatch"></i> <i class="fas fa-rocket"></i>&nbsp;&nbsp;<strong>Generowanie zleceń produkcyjnych</strong></h6></a> --}}
              </li>
            </ul>
            <div class="list-group">
              @foreach (\App\Models\Production::where('status',0)->orwhere('status',1)->get() as $production)

              {{-- class="list-group-item list-group-item-action active"  KLASA ZMIANY KOLORU NA NIEBIESKI --}}
              <a href="{{route('production.select', ['id' => $production->id ])}}" class="list-group-item list-group-item-action">



                <div class="d-flex w-100 justify-content-between">
                  <h5 class="mb-1">{{$production->dates_textcode}}</h5>
                  <p class="mb-1"> <div class="text-right mb-2 mt-1">
                    
                    </div>{{$production->name}}</p>
                  {{-- <small class="">
                    <button href="#" class="btn btn-light"><i class="fas fa-clipboard-check"></i> Checklisty</button>
                    <button href="{{route('production.select', ['id' => $production->name ])}}" class="btn btn-light"><i class="fab fa-digital-ocean"></i> Otwórz</button>
                  </small> --}}
                </div>
                
                <small class="text-muted text-left">
                  <div class="text-left mt-1 mb-2 small">
                    Utworzono: {{ (\App\Models\Production::where('id', $production->id)->first())->created_at->toDateTimeString()}}</div>
                  <div class="progress mt-2">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{$production->done_procent}}%;" aria-valuenow="{{$production->done_procent}}" aria-valuemin="0" aria-valuemax="100">{{ $production->done}} / {{$production->sum_elements}} [{{$production->done_procent}}%]</div>
                  </div>
                </small>
              </a>
              @endforeach
            </div>
            <div class="text-left mt-4 mb-2">
              <form method="post" action="{{ route('production.create')}}" >
                @csrf
                @method('put')
                <input id="production_name" type="text" name="production_name" class="form-floating small mt-3" value="{{ old('name') }}" placeholder="Nazwa (opcjonalnie)" autofocus @if(\App\Models\ElementProduction::where('status', 0)->select('date_production')->first() != null) @else disabled @endif/>
            <button type="submit" class="btn btn-primary btn-sm mb-1" id="{{$check_number=0}}" @if(\App\Models\ElementProduction::where('status', 0)->select('date_production')->first() != null) @else disabled @endif><i class="fas fa-snowplow"></i> <i class="fas fa-suitcase"></i>&nbsp;&nbsp;Utwórz zakres produkcyjny</button>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#" class="btn btn-outline-dark btn-sm mb-1"><i class="fas fa-book"></i> <i class="fas fa-mug-hot"></i>&nbsp;Archiwum</a>
            

            {{-- <a href="#" class="btn btn-outline-dark"><i class="fas fa-stopwatch"></i> <i class="fas fa-rocket"></i>&nbsp;&nbsp;Utwórz zlecenia</a> --}}
           
          
            
              
          </div>
          @if(\App\Models\ElementProduction::where('status', 0)->select('date_production')->first() != null)
          <div class="card-body">            
            <table class="table table-sm table-borderless">
              
            

              <thead class="card-text grey600color small text-left">
                <tr>
                  <th scope="col" ><h5><i class="fas fa-medkit blueiconcolor"></i></h5></th>
                  <th scope="col" >Data prod.</th>
                  {{-- <th scope="col"><i class="fas fa-language"></i> Alias</th> --}}
                  <th scope="col" ><i class="fas fa-folder"></i> Wygenerowano</th>
                  {{-- <th scope="col"></th> --}}                  
                </tr>
              </thead>
              
              <tbody>
              
                @foreach (\App\Models\ElementProduction::where('status', 0)->select('date_production')->distinct()->get() as $date_production)
               
                <tr>
                  {{-- <th scope="row"></th> --}}
                  <td>
                    <div class="form-check">
                      
                    <input class="form-check-input" type="checkbox" id="{{$check_number = $check_number+1}}" name="check{{$check_number}}" value="{{$date_production->date_production}}">
                    
                    <label class="form-check-label" for="defaultCheck1">                    
                    </label>
                  </div>
                </td>
                  <td class="text-left blueiconcolor">
                   
                    {{-- <form method="post" action="{{ route('production')}}" >
                      @csrf
                      @method('put')
                      <input name="date" value="{{ $date_production->date_production }}" type="hidden">
                    {{ $date_production->date_production }}&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="action" value="load" class="btn btn-primary btn-sm"><i class="far fa-folder-open"></i></button>
                    </form> --}}

                    {{ $date_production->date_production }}&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ route('production.get', ['action' => 'load', 'date' => $date_production->date_production])}}" type="submit" name="action" value="load" class="btn btn-primary btn-sm"><i class="far fa-folder-open"></i></a>
                  </td>
                  <td class="text-left small">{{ (\App\Models\ElementProduction::where('date_production', $date_production->date_production)->first())->created_at->toDateTimeString()}}</td>
                  {{-- <td class="text-left"><button type="submit" name="action" value="load" class="btn btn-sm">@if ((\App\Models\ElementProduction::where('date_production', $date_production->date_production)->first())->status == 0)<i class="fas fa-lock-open"></i> @else<i class="fas fa-lock"></i> @endif</button></td> --}}
                </tr>
              
                @endforeach
                <input name="check_number" value="{{$check_number}}" type="hidden">
              </form>
              </tbody>
            </table>
            @endif
          </div>
        </div>
      </div> 
      
      @else
     
        <div class="card-body">
          <div class="row">
            <div class="col-sm-6">
              
              <div class="card mb-3">
                <div class="card-body">
                  
                  <div class="card" style="width: 18rem;">
                    <ul class="list-group list-group-flush">
                      {{-- <li class="list-group-item small"><i class="far fa-clock grey700color"></i>&nbsp;Pierwsze gen. {{(\App\Models\ElementProduction::where('date_production', Session::get('date'))->first())->created_at->toDateTimeString()}}@endif</li>
                      <li class="list-group-item small"><i class="far fa-bell grey700color"></i>&nbsp;Ostatnie gen. {{(\App\Models\ElementProduction::where('date_production', Session::get('date')))->updated_at->toDateTimeString()}}</li>
                      <li class="list-group-item small"><i class="far fa-lightbulb grey700color"></i>&nbsp;&nbsp;Najnowsze zam. {{(\App\Models\Order::where('date_production', Session::get('date'))->orderBy('created_at', 'DESC')->first())->code}}</li> --}}
              
                    </ul>
                    <div class="card-footer">
                      {{-- <h6 class="card-title"><h6 class="card-title rediconcolor"><i class="fas fa-fire"></i> {{Session::get('date')}}</h6></h6> --}}
                      <h6 class="card-title"><h6 class="card-title"><i class="fas fa-hockey-puck grey700color"></i>&nbsp;&nbsp;{{Session::get('date')}}</h6></h6>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="">
                <div class="card-body">
                  <div class="row">
                    <div class="col-4 mb-4">
                      <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-home-list" data-bs-toggle="list" href="#list-home" role="tab" aria-controls="list-home"><i class="fas fa-chart-pie cookiecolor"></i> Podsumowanie</a>
                        <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="list-profile"><i class="fas fa-spell-check cookiecolor"></i> Zapotrzebowanie</a>
                        
                        
                      </div>
                    </div>
                    
                    <div class="col-8">
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">

                          <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Ilość zamówień
                              <span class="">{{\App\Models\Order::with(['product', 'articel'])->where('date_production', Session::get('date'))->count() }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Ilość elementów
                              <span class="">{{\App\Models\ElementProduction::where('date_production', Session::get('date'))->sum('amount') }}</span>
                            </li>
                            
                            

                          </ul>

                        </div>
                        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">

                          <ul class="list-group">
                            @foreach (\App\Models\Material::all() as $material)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              <h6><i class="fas fa-bookmark grey700color"></i>&nbsp;&nbsp;{{$material->name}}</h6>
                               @if (\App\Models\Element::where('material_id', $material->id)->count() > 0)<h6>{{\App\Models\ElementProduction::where('date_production', Session::get('date'))->where('material', $material->name)->sum('weight') }} kg</h6> @else @endif
                            </li>
                            @endforeach
                          </ul>

                        </div>
                        
                        
                      </div>
                    </div>
                    {{-- <div role="tabpanel" >
                      <!-- List group -->
                      <div class="list-group" id="myList" role="tablist" style="width: 6rem;">
                        
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#messages" role="tab"><h6 class="mt-1"><i class="fas fa-th-list grey700color"></i>&nbsp;Tab.1</h5></a>
                        <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#settings" role="tab"><h6 class="mt-1"><i class="fas fa-table grey700color"></i>&nbsp;Tab.2</h5></a>
                      </div>
                  </div> --}}
                    
                  </div>
              </div>
            </div>
          </div>


                      <!-- Tab panes -->
                      <div class="tab-content">
              
                        <div class="tab-pane" id="messages" role="tabpanel">
                          <table class="table table-striped table-hover">
                            <thead>
                              <tr>
                                <th scope="col"></th>
                                <th scope="col">Materiał</th>
                                <th scope="col">Kod</th>
                                <th scope="col">Nazwa</th>
                                <th scope="col">Ilość</th>
                                <th scope="col">X(dł.)</th>
                                <th scope="col">Y(szer.)</th>
                                <th scope="col">Z(wys.)</th>
                                <th scope="col"><i class="far fa-file-pdf"></i> PDF</i></th>
                                <th scope="col">Maszyna</th>
                                <th scope="col">Grupa zlecenia</th>
                              </tr>
                            </thead>
                            <tbody>
                    
                    
                    @foreach (\App\Models\ElementJob::with(['element'])->where('date_production', Session::get('date'))->orderBy('material_id', 'DESC')->orderBy('length', 'DESC')->orderBy('width', 'DESC')->orderBy('height', 'DESC')->get() as $element_job)
                    <tr>
                    <td></td>
                    <td>{{$element_job->material}}</td>
                    <td>
                      <form method="get">
                        @csrf
                        <td><a href="{{route('element.edit', ['id' => $element_job->element_id]) }}" target="_blank"><div class="blackcolor">{{$element_job->element->name}}</div></a></td>
                      </form>
                    </td>
                    <td>{{$element_job->sum_amount}}</td>
            
                    <td>{{$element_job->length}}</td>
                    <td>{{$element_job->width}}</td>
                    <td>{{$element_job->height}}</td>
                    <td><input type="hidden" value="{{$pdffile = $element_job->element->elementfiles->where('type', 'pdf')->first()}}">
                      @if($element_job->element->elementfiles->where('type', 'pdf')->first()) 
                      <a href="{{ Storage::url($pdffile->path) }}" target="_blank"><i class="	fas fa-search"></i></a>
                      
                      @endif</td>
                    
                    <td>@if (\App\Models\Machine::find($element_job->machine_id) != null) {{\App\Models\Machine::find($element_job->machine_id)->name}} @endif</td>
                    <td>@if (\App\Models\JobGroup::find($element_job->job_group_id) != null) {{\App\Models\JobGroup::find($element_job->job_group_id)->name}} @endif</td>
                    </tr>   
                        
                    @endforeach
                    
                    </tbody>
                    </table> 
                        </div>
                        <div class="tab-pane" id="settings" role="tabpanel">
                        </div>
                      </div>

          <input value="{{$date_start = Session::get('date')}}" type="hidden">
          <input value="{{$date_end = Session::get('date')}}" type="hidden">

          <table class="table table-sm table-striped table-bordered small" id="elementjob">                   
            <thead class="">
                <tr>
                    <th>Materiał</th>
                    <th>Kod</th>
                    <th>Nazwa</th>
                    <th>X(dł.)</th>
                    <th>Y(szer.)</th>
                    <th>Z(wys.)</th>
                    <th>Waga</th>
                    <th>Ilość</th>                                     
                    <th>Grupa</th>
                    <th>Maszyna</th> 
                </tr>                                
            </thead>
        </table>



<script>
          $(function() {
             
              $('#elementjob').DataTable({
                  processing: true,
                  serverSide: true,
                  

                  ajax : '{!! route('DataElementJob', ['date_start'=>$date_start, 'date_end'=>$date_end]) !!}',
              
             
                  columns: [
                      {data: 'material.name', name: 'material.name'},
                      
                      {data: 'element.code', name: 'element.code'},  
                      {data: 'element.name', name: 'element.name'},
                    
                      {data: 'element.length', name: 'element.length'}, 
                      {data: 'element.width', name: 'element.width'}, 
                      {data: 'element.height', name: 'element.height'},  
                      {data: 'sum_weight', name: 'sum_weight'},                                           
                      {data: 'sum_amount', name: 'sum_amount'}, 
                      {data: 'job_group.name', name: 'job_group.name'},
                      {data: 'machine.name', name: 'machine.name'},
                  ]
              });
          });
          </script>

        

          </div>

      </div>
      @endif 
      <div class="card-footer text-center py-3">
        {{-- <h6 class="text-left font-weight-light mt-2 small greeniconcolor">
          @if(Session::get('date') == null)                
          
          @else
          <i class="fas fa-bell"></i>&nbsp;&nbsp;Wczytano dane prod. {{Session::get('date')}}
          @endif      
        </h6>  --}}
      </div>   
  </div>
</div>






























@endsection
