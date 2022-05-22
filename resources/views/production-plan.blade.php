@extends('layouts.app')
@section('content')



<div class="col-lg-12">
  <div class="card shadow-lg border-0 rounded-lg mt-4">
    
      <div class="card-header">
        @if (session()->has('message'))
              <div class="alert alert-info alert-dismissible fade show mt-2" role="alert">
              <h6>{{ Session::get('message') }} {{ Session::get('order_records') }}</h6>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
        @endif 
        {{-- <h6 class="text-left font-weight-light mt-3 mb-2 grey800color ">
          <i class="fas fa-calendar-alt"></i> <i class="fas fa-drafting-compass"></i>&nbsp;&nbsp;<strong>Przeglądaj rekordy wykonania</strong>    
        </h6>    --}}
             
        <div class="row mb-3 font-weight-light mt-2">


          <div class="list-group">
            <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">List group item heading</h5>
                <small>3 days ago</small>
              </div>
              <p class="mb-1">Some placeholder content in a paragraph.</p>
              <small>And some small print.</small>
            </a>
            <a href="#" class="list-group-item list-group-item-action">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">List group item heading</h5>
                <small class="text-muted">3 days ago</small>
              </div>
              <p class="mb-1">Some placeholder content in a paragraph.</p>
              <small class="text-muted">And some muted small print.</small>
            </a>
            <a href="#" class="list-group-item list-group-item-action">
              <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">List group item heading</h5>
                <small class="text-muted">3 days ago</small>
              </div>
              <p class="mb-1">Some placeholder content in a paragraph.</p>
              <small class="text-muted">And some muted small print.</small>
            </a>
          </div>



          <div class="card bg-light my-3">
            <div class="card-header bg-light">
              <ul class="nav nav-pills card-header-pills">
                <li class="nav-item">
                  <a class="nav-link active" href="#">Active</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <h5 class="card-title">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
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
            <div class="text-left my-4">
            <a href="#" class="btn btn-primary"><i class="fas fa-snowplow"></i> <i class="fas fa-suitcase"></i>&nbsp;&nbsp;Utwórz zlecenie</a>&nbsp;&nbsp;&nbsp;&nbsp;
            
            <a href="#" class="btn btn-outline-dark"><i class="fas fa-book"></i> <i class="fas fa-mug-hot"></i> Baza zleceń</a>

            {{-- <a href="#" class="btn btn-outline-dark"><i class="fas fa-stopwatch"></i> <i class="fas fa-rocket"></i>&nbsp;&nbsp;Utwórz zlecenia</a> --}}
            </div>
            {{-- <div class="text-right mb-1 mt-1">
              <input type="radio" class="btn-check" name="options-outlined" id="danger-outlined" autocomplete="off">
              <label class="btn btn-outline-danger btn-sm" for="danger-outlined"><i class="fas fa-hammer"></i></label>
              </div> --}}
              
          </div>
          <div class="card-body">
            {{-- <h6 class="card-title grey700color">Wygenerowane dni produkcyjne</h6> --}}
            {{-- <p class="card-text grey600color small">Modyfikacje przekazanych zleceń nie są możliwe. Dezaktywuj i ponownie wprowadź dane.</p>           --}}
            
            
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
                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label" for="defaultCheck1">
                      
                    </label>
                  </div>
                </td>
                  <td class="text-left blueiconcolor">
                    <form method="post" action="{{ route('production')}}" >
                      @csrf
                      @method('put')
                      <input name="date" value="{{ $date_production->date_production }}" type="hidden">
                    {{ $date_production->date_production }}&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="action" value="load" class="btn btn-primary btn-sm"><i class="far fa-folder-open"></i></button>
                    </form>
                  </td>

                  <td class="text-left small">{{ (\App\Models\ElementProduction::where('date_production', $date_production->date_production)->first())->created_at->toDateTimeString()}}</td>
                  {{-- <td class="text-left"><button type="submit" name="action" value="load" class="btn btn-sm">@if ((\App\Models\ElementProduction::where('date_production', $date_production->date_production)->first())->status == 0)<i class="fas fa-lock-open"></i> @else<i class="fas fa-lock"></i> @endif</button></td> --}}
                </tr>
                @endforeach
              </tbody>
            </table>

          </div>
        </div>
        
        {{-- TUTAJ START GEN. JobOrder --}}

        <div class="card bg-light my-2">
          <div class="card-header">
           
          </div>
          <div class="card-body">
            <div class="row ">
              <div class="col-md-4">


                <div class="list-group mt-2">
                 
                  <button class="list-group-item list-group-item-action active" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <h5 class="mb-2 text-center"><i class="fas fa-box-open white-text"></i> 2022-04-29 — 2022-05-02</h5></button>
                  <button type="button" class="list-group-item list-group-item-action active text-center" aria-current="true">
                   
                  </button>
                  <button type="button" class="list-group-item list-group-item-action"><i class="fas fa-hockey-puck grey600color"></i>&nbsp;&nbsp;2022-04-29</button>
                  <button type="button" class="list-group-item list-group-item-action"><i class="fas fa-hockey-puck grey600color"></i>&nbsp;&nbsp;2022-04-29</button>
                  <button type="button" class="list-group-item list-group-item-action"><i class="fas fa-hockey-puck grey600color"></i>&nbsp;&nbsp;2022-04-29</button>
                  <button type="button" class="list-group-item list-group-item-action" disabled> </button>
                </div>


                <div class="row">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                  <button type="button" class="btn btn-secondary">Wyczyść</button>
                  <button type="button" class="btn btn-dark"><i class="fas fa-database"></i>&nbsp;&nbsp;Zatwierdź</button>
                
                  <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                      <li><a class="dropdown-item" href="#"></a></li>
                      <li><a class="dropdown-item" href="#"></a></li>
                    </ul>
                  </div>
                </div>
              </div>
                
              </div>
            <div class="col-md-3">
              <div class="text-center mt-2">



                





            </div>

              <select class="form-select form-select-sm mt-2 border-secondary" multiple aria-label="multiple select example" size="8" aria-label="size 3 select example">
                @foreach ($production_data = \App\Models\ElementProduction::select('date_production')->distinct()->orderBy('date_production', 'ASC')->get() as $date_production_for_list)
                <option value="{{$date_production_for_list->date_production}}">{{$date_production_for_list->date_production}}</option>
                @endforeach
            </select>
            
            <div class="text-left mt-2"><button type="submit" class="btn btn-primary btn-sm" href=""><i class="far fa-hand-pointer"></i> Wybierz</button>&nbsp;&nbsp;<a class="btn btn-secondary btn-sm" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Szczegóły</a></div>
             

            </div>
            <div class="col-md-4">


              
              <form class="row mt-2">
                
                
                <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Nazwa zlecenia">
                <datalist id="datalistOptions">
                  <option value="San Francisco">
                  <option value="New York">
                  <option value="Seattle">
                  <option value="Los Angeles">
                  <option value="Chicago">
                </datalist>
                
                <button type="submit" class="btn btn-primary btn-sm">Zapisz</button>
            </form>

            


              
                <div class="row">
                  <div class="col">
                    <div class="collapse multi-collapse mt-2" id="multiCollapseExample1">
                      <div class="card card-body">
                        Some placeholder content for the first collapse component of this multi-collapse example. This panel is hidden by default but revealed when the user activates the relevant trigger.
                      </div>
                    </div>
                  </div>
                </div>   
            </div>

            <div class="col-md-1">
              
              <div class="btn-group-vertical">
                
                
              </div>
            </div>

          </div>
          </div>
          <div class="card-footer text-muted">
            <div class="progress">
              <div class="progress-bar bg-light" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"><h6 class="grey600color small mt-2">Oczekujące</h6></div>
            </div>
          </div>
        </div>
        



{{-- TUTAJ KONIEC INTERFEJSU DLA GENEROWANIA JobOrder --}}




          </div>   
                @else
                
        <div class="card-body">

          <div class="row">
            <div class="col-sm-6">
              



              <div class="card mb-3">
                <div class="card-body">
                  
                  <div class="card" style="width: 18rem;">
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item small"><i class="far fa-clock grey700color"></i>&nbsp;Pierwsze gen. {{(\App\Models\ElementProduction::where('date_production', Session::get('date'))->first())->created_at->toDateTimeString()}}</li>
                      <li class="list-group-item small"><i class="far fa-bell grey700color"></i>&nbsp;Ostatnie gen. {{(\App\Models\ElementProduction::where('date_production', Session::get('date'))->orderBy('updated_at', 'DESC')->first())->updated_at->toDateTimeString()}}</li>
                      <li class="list-group-item small"><i class="far fa-lightbulb grey700color"></i>&nbsp;&nbsp;Najnowsze zam. {{(\App\Models\Order::where('date_production', Session::get('date'))->orderBy('created_at', 'DESC')->first())->code}}</li>
              
                    </ul>
                    <div class="card-footer">
                      <h6 class="card-title"><h6 class="card-title rediconcolor"><i class="fas fa-fire"></i> {{Session::get('date')}}</h6></h6>
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
                    
                    <td>{{\App\Models\Machine::find($element_job->machine_id)->name}}</td>
                    <td>{{\App\Models\JobGroup::find($element_job->job_group_id)->name}}</td>
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
                    
                    
                    {{-- <th>Materiał</th> --}}
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
