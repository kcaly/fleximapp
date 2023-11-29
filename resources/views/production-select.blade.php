@extends('layouts.app')
@section('content')


        
            <div class="mt-2">
                <div class="card shadow-lg border-0 rounded-lg bg-light my-2">
                  <div class="card-header">
                    

                    <h6 class="mt-2 small grey700color"><a href="{{route('production.panel')}}"><i class="fas fa-reply"></i> Produkcja</a> zakres: {{$production->dates_textcode}}&nbsp;&nbsp;&nbsp;&nbsp;{{$production->name}}</h6>
               
                  </div>
                    <div class="card-body">



                      <div class="row ">
                        <div class="col-md-4">
          
          
                          <div class="list-group mt-2">
                           
                            
                              @if($production->status != 0)
                              <button class="list-group-item list-group-item-action bg-light" type="button" disabled>
                              <h5 class="mt-4 mb-4 text-center grey800color"><i class="fas fa-lock grey800color"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-database grey700color"></i> <i class="fas fa-chalkboard-teacher grey700color"></i>&nbsp;&nbsp;{{$production->dates_textcode}}</h5>
                              
                              @else
                              <button class="list-group-item list-group-item-action active" type="button">
                              <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                              <h5 class="mb-2 text-center"><i class="fas fa-box-open white-text"></i> {{$production->dates_textcode}}</h5>
                            </button>
                            <button type="button" class="list-group-item list-group-item-action active text-center" aria-current="true" disabled>
                             
                            </button>
                              @endif
                            
                           
                            @foreach ($dates as $date)
                            @if ($date != null)
                            @if($production->status != 0)
                            <button type="button" class="list-group-item list-group-item-action" disabled><h6 class="small grey800color mt-1">&nbsp;<i class="far fa-dot-circle grey600color"></i>&nbsp;&nbsp;&nbsp;&nbsp;{{$date}}</h6></button>
                            @else
                            <a href="{{ route('production.get', ['action' => 'load', 'date' => $date, 'temp_prod_id' => $production->id])}}"><button type="button" class="list-group-item list-group-item-action"><i class="fas fa-hockey-puck grey600color"></i>&nbsp;&nbsp;{{$date}}</button></a>
                            @endif
                            @endif
                            @endforeach
                            {{-- <button type="button" class="list-group-item list-group-item-action" disabled> </button> --}}
                          </div>
          
          
                          <div class="row">
                          <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                              

                              @if ($production->status == 0) 
                              <a href="{{route('production.accept', ['id' => $production->id])}}"><button type="button" class="btn btn-outline-dark">
                              @else
                              <button type="button" class="btn btn-light" disabled>
                              @endif

                              @if ($production->status == 0)
                              <h6 class="mt-2"><i class="fas fa-exclamation-circle rediconcolor"></i>&nbsp;&nbsp;Zatwierdź dane</h6>
                              @endif

                              @if ($production->status == 1 && \App\Models\ElementJob::where('production_id', $production->id)->first()->status < 4)
                              <h6 class="mt-2 greeniconcolor"><i class="fas fa-check-circle greeniconcolor"></i>&nbsp;&nbsp;<strong>Zatwierdzono</strong></h6>
                              @endif
                              @if ($production->status == 1 && \App\Models\ElementJob::where('production_id', $production->id)->first()->status == 4)
                              <h6 class="mt-2 grey800color"><i class="fas fa-hourglass grey800color"></i>&nbsp;&nbsp;<strong>Wstrzymano</strong></h6>
                              @endif
                              
                              @if ($production->status == 2 && $production->done < $production->sum_elements)
                              <h6 class="mt-2 rediconcolor"><i class="fas fa-exclamation-triangle rediconcolor"></i>&nbsp;&nbsp;<strong>W trakcie realizacji</strong></h6>
                              @endif
                              @if ($production->status == 2 && $production->done == $production->sum_elements)
                              <h6 class="mt-2 blueiconcolor"><i class="fas fa-check-circle blueiconcolor"></i>&nbsp;&nbsp;<strong>Zrealizowano</strong></h6>
                              @endif

                              @if ($production->status == 0)
                              </button></a> 
                              @else
                              </button>
                              @endif

                              {{-- <form method="post" action="{{ route('job.order.create')}}" >
                                @csrf
                                @method('put')
                                <input name="production_id" value="{{$production->id}}" type="hidden"> --}}
                            @if ($production->status == 0)                               
                            <button type="button" class="btn btn-secondary" disabled>
                            <h6 class="mt-2"><i class="fas fa-calendar-check"></i>&nbsp;&nbsp;Przekaż do realizacji</h6>  
                            </button>                    
                            @endif
                            @if ($production->status == 1 && \App\Models\ElementJob::where('production_id', $production->id)->first()->status < 4)    
                            <a href="{{route('job.order.create', ['id' => $production->id])}}">
                            <button type="button" class="btn btn-success">
                            <h6 class="mt-2"><i class="fas fa-calendar-check"></i>&nbsp;&nbsp;Przekaż do realizacji</h6>  
                            </button>
                            </a>
                            @endif
                            @if ($production->status == 1 && \App\Models\ElementJob::where('production_id', $production->id)->first()->status == 4)    
                            <a href="{{route('job.order.start', ['id' => $production->id])}}">
                            <button type="button" class="btn btn-success">
                            <h6 class="mt-2"><i class="fas fa-calendar-check"></i>&nbsp;&nbsp;Wznów</h6>  
                            </button>
                            </a>
                            @endif
                            @if ($production->status == 2 && $production->done < $production->sum_elements) 
                            <a href="{{route('job.order.stop', ['id' => $production->id])}}">
                            <button type="button" class="btn btn-danger">
                            <h6 class="mt-2"><i class="far fa-calendar-times"></i>&nbsp;&nbsp;Wstrzymaj</h6>  
                            </button>
                            </a>
                            @endif
                            @if ($production->status == 2 && $production->done == $production->sum_elements) 
                            <a href="">
                            <button type="button" class="btn btn-light" disabled>
                            <h6 class="mt-2"><i class=""></i>&nbsp;&nbsp;</h6>  
                            </button>
                            </a>
                            @endif
                            

                              {{-- </form> --}}

                            
                            <div class="btn-group" role="group">
                              <button id="btnGroup Drop1" type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                @if ($production->status != 2)
                                <li><a class="dropdown-item small" href="{{route('production.delete', ['id' => $production->id, 'list' => 'all'])}}"><i class="far fa-trash-alt"></i> Usuń</a></li>
                                @endif
                                @if (\App\Models\ElementJob::where('production_id', $production->id)->first()->status == 4) 
                                <li><a class="dropdown-item small" href="{{route('production.end', ['id' => $production->id])}}"><i class="fas fa-flag-checkered"></i> Zakończ</a></li>
                                @endif
                              </ul>
                            </div>
                           

                       


                           
                          </div>
                        </div>
                          
                        </div>
                      <div class="col-md-3">


                        <ul class="nav nav-pills nav-justified mt-2">
                          @if (\App\Models\JobOrder::where('production_id', $production->id)->count() > 0)           
                          <li class="nav-item">
                            <a class="nav-link disabled btn border border-2 routed" aria-current="page" aria-disabled="true" href="{{route('production.planning.load.get', ['production_id' => $production->id])}}"><i class="fas fa-poll-h"></i>&nbsp;&nbsp;Planowanie zleceń</a>
                          </li>
                          @else
                          <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('production.planning.load.get', ['production_id' => $production->id])}}"><i class="fas fa-poll-h"></i>&nbsp;&nbsp;Planowanie zleceń</a>
                          </li>
                          {{-- <li class="nav-item">
                            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                          </li> --}}
                          @endif
                        </ul>
        









                     
                        {{-- <select class="form-select form-select-sm mt-2 border-secondary" multiple aria-label="multiple select example" size="8" aria-label="size 3 select example">
                          <option value=""> - - - </option>
                      </select>
                      
                      <div class="text-left mt-2"><a href=""><button type="submit" class="btn btn-primary btn-sm" href=""><i class="far fa-hand-pointer"></i> Wybierz</button></a>&nbsp;&nbsp;<a class="btn btn-secondary btn-sm" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fas fa-calculator"></i> Kalkulacja</a></div> --}}
                       
          
                      </div>
                      <div class="col-md-4">
                        
                        
                        
                        <form method="post" action="{{route('production.select.edit')}}" class="row mt-2">
                          @csrf
                          @method('put')
                          <input name="production_id" type="hidden" value="{{$production->id}}"> 
                          <input name="production_name" class="form-control" placeholder="Nazwa zlecenia" value="{{$production->name}}">
                         
                          {{-- <div class="row mt-2 mb-3">
                            <div class="col-6">
                          <button class="btn" disabled><small class="grey800color text-left">Wykonanie:</small></button>
                            <select disabled class="form-select form-select-sm" id="floatingSelect" aria-label="Floating label select example">
                              <option value="1" selected>(nieaktywne)</option>
                              <option value="2">Grupy elementów</option>
                              <option value="3">Stanowiska (maszyny)</option>
                            </select>
                            </div>
                            <div class="col-6">
                              <button class="btn" disabled><small class="grey800color text-left">Kompletowanie:</small></button>
                                <select disabled class="form-select form-select-sm" id="floatingSelect" aria-label="Floating label select example">
                                  <option value="1" selected>(nieaktywne)</option>
                                  <option value="2">Grupy produktów</option>
                                  <option value="3">Zamówienia</option>
                                </select>
                                </div>
                          </div> --}}
                          <button type="submit" class="btn btn-primary btn-sm mt-3 mb-2"><i class="fas fa-pencil-alt"></i>&nbsp;&nbsp;Zapisz</button>
                          
                      </form>
          
                      
          
          
                        
                          <div class="row">
                            <div class="col">
                              <div class="collapse multi-collapse mt-2" id="multiCollapseExample1">
                                <div class="card card-body">
                                  <div class="small">
                                    @foreach ($totals as $total)
                                    {{$total}}<br>
                                    @endforeach
                                  </div>
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

                    @if ($production->status != 0)
                    <div class="card-footer">
                      
                      <div class="row mt-3 mb-4">
                        <div class="col-1">
                          <div class="list-group text-center" id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-elements-list" data-bs-toggle="list" href="#list-elements" role="tab" aria-controls="list-elements"><i class="fas fa-layer-group"></i></a>
                            <a class="list-group-item list-group-item-action" id="list-articles-list" data-bs-toggle="list" href="#list-articles" role="tab" aria-controls="list-articles"><i class="fas fa-clone"></i></a>
                            <a class="list-group-item list-group-item-action" id="list-products-list" data-bs-toggle="list" href="#list-products" role="tab" aria-controls="list-products"><i class="fas fa-archive"></i></a>
                          </div>
                        </div>
                        <div class="col-11">
                          <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="list-elements" role="tabpanel" aria-labelledby="list-elements-list">
                              
                              
                
                                
                                  
                                    
                                  <div class="row mb-1">
                                    <div class="col-md-5">
                                      <form method="POST" action="{{route('production.data')}}">
                                        @csrf
                                        @method('put')                  
                                      {{-- <div class="form-floating">
                                          <select disabled name="machine_id" class="form-select form-select-sm" aria-label=".form-select-sm example" id="floatingSelectMachine">
                                            @if ($machine_select != null)                                              
                                              <option selected value={{$machine_select['id']}}>{{$machine_select['name']}}</option>
                                            @else
                                              <option selected></option>
                                            @endif
                                            
                                          </select>
                                          <label for="floatingSelectMachine">Maszyna</label>
                                        </div> --}}
                                        <div class="form-floating mt-2">
                                          <select name="job_order_id" class="form-select form-select-sm" aria-label=".form-select-sm example" id="floatingSelectJob">
                                            @if ($job_order_select != null)                                              
                                              <option selected value={{$job_order_select['id']}}>{{$job_order_select['name']}}</option>
                                            @else
                                              <option selected></option>
                                            @endif
                                            @foreach ($job_orders as $job_order)
                                              <option value="{{ $job_order->id }}">{{ $job_order->job_group->name }} {{ $job_order->date_production }}</option>
                                            @endforeach
                                          </select>
                                          <label for="floatingSelectJob">Zlecenie</label>

                                          <div class="d-grid gap-2 col-12 mx-auto">
                                            <button class="btn btn-light mt-2 border rounded" type="submit"><i class="fab fa-get-pocket"></i> Wczytaj</button>
                                          </div>
                                        </div>
                                      </form>
                                    </div>
                                    <div class="col-md-7">                  
                                              
                                      {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light border rounded">
                                        <div class="container-fluid">
                                          <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                              <li class="nav-item">
                                                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><i class="fas fa-paste"></i>&nbsp;&nbsp;&nbsp;Wyszukaj po kodzie / nazwie elementu</a>
                                              </li>
                                              <li class="nav-item">
                                                
                                              </li>
                                            </ul>
                                            <form class="d-flex">
                                              <input disabled name="search" class="form-control me-2" type="search" placeholder="" aria-label="Search">
                                              <button disabled class="btn btn-outline-secondary" type="submit" action="search"><i class="fas fa-search"></i></button>
                                            </form>
                                          </div>
                                        </div>
                                      </nav> --}}


                                    </div>
                                  @if ($elements != null)
                                  <div class="row mt-5 mb-2 bg-light border rounded">
                                    
                                  <table class="table table-sm table-striped table-hover table-borderless mt-3 mb-2">
                                    <thead class="border-bottom border-dark">
                                        <tr>
                                        <th scope="col" style="width: 13%" class="text-left"><h6 class="small">Materiał</h6></th>
                                        

                                        
                                        
                                        
                                        <th scope="col" style="width: 5%" class="text-right"></th>
                                        <th scope="col"></th>
                                        <th scope="col" style="width: 10%" class="text-left"><h6 class="small">Wykonanie</h6></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        
                                                                      
                                        <th scope="col" style="width: 8%" class="text-left"><h6 class="small">Kod</h6></th>
                                        <th scope="col"><h6 class="small">Nazwa</h6></th>

                                        
                                        
                                        <th scope="col" style="width: 7%" class="text-left"><h6 class="small">X(dł.)</h6></th>
                                        <th scope="col" style="width: 7%" class="text-left"><h6 class="small">Y(szer.)</h6></th>
                                        <th scope="col" style="width: 7%" class="text-left"><h6 class="small">Z(wys.)</h6></th>
                                        {{-- <th scope="col"><h6 class="small">Maszyna</h6></th>
                                        <th scope="col"><h6 class="small">Grupa zlecenia</h6></th> --}}
                                        </tr>
                                    </thead>
                                    <tbody class="small">
                                    @foreach ($elements as $element)  
                                      <tr class>
                                          <td>{{ $element->material }}</td>
                                                                                    
                                          <td class="text-right">
                                            {{-- <h6><a href="{{route('production.details.element', ['production_id' => $production->id, 'element_id' => $element->id])}}" type="button" class="btn btn-outline-dark border-0 bg-transparent"><i class="fas fa-business-time"></i></a></h6> --}}
                                          </td>

                                          <td></td>
                                          <td>{{ $element->done }} / {{ $element->sum_amount}}</td>
                                          @if ($element->status >= 10)
                                          <td><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><small>{{$element->created_at->toDateTimeString()}}</small></a></td>
                                          
                                          @else
                                          @if ($element->done != 0)
                                          <td><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><small>{{$element->updated_at->toDateTimeString()}}</small></a></td>
                                          @else
                                          <td></td>
                                          @endif
                                          @endif
                                          <td></td>
                                          <td>{{ $element->code }}</td>
                                          <td>{{ $element->name }}</td>
                                          <td>{{ $element->length }}</td>
                                          <td>{{ $element->width }}</td>
                                          <td>{{ $element->height }}</td>
                                          {{-- <td>{{ \App\Models\Machine::find($element->machine_id)->name }}</td>
                                          <td>{{ \App\Models\JobGroup::find($element->job_group_id)->name }}</td> --}}
                                      </tr>   
                                    @endforeach      
                                    </tbody>
                                <tfoot>
                                </tfoot>
                            </table> 
                          </div>
                          @endif
                          </div>

                        </div>
                            <div class="tab-pane fade" id="list-articles" role="tabpanel" aria-labelledby="list-articles-list">
                              <div class="card text-center bg-light border border-1 border-white rounded border-bottom-0">
                                <div class="card-header bg-light">
                    
                                  <table class="table table-sm">
                                    <thead>
                                      <tr>
                                        <th scope="col">Data prod.</th>

                                        <th scope="col">Ilość (szt.)</th>
                                        <th scope="col">Nazwa artykułu</th>
                                        <th scope="col">Zamówienie</th>
                                       
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach(\App\Models\ArticleProduction::where('production_id', $production->id)->get() as $article)
                                      <tr>
                                        <td>{{$article->date_production}}</td>

                                        <td><strong><h5>{{$article->amount}}x</h5></strong></td>

                                        <td>{{$article->article_info}}</td>
                                        <td>
                                          {{\App\Models\Order::find($article->order_id)->first()->code}}
                                          <small>{{\App\Models\Order::find($article->order_id)->first()->date_order}}</small>
                                        </td>

                                      </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                    
                    
                                </div>
                              </div>
                            </div>

                            <div class="tab-pane fade" id="list-products" role="tabpanel" aria-labelledby="list-products-list">
                              <div class="card text-center bg-light border border-1 border-white rounded border-bottom-0">
                                <div class="card-header bg-light">
                    
                                  <table class="table table-sm">
                                    <thead>
                                      <tr>
                                        <th scope="col">Data prod.</th>

                                        <th scope="col">Ilość (szt.)</th>
                                        <th scope="col">Nazwa produktu</th>
                                        <th scope="col">Zamówienie</th>
                                       
                                      </tr>
                                    </thead>
                                    <tbody>
                                      @foreach(\App\Models\ProductProduction::where('production_id', $production->id)->get() as $product)
                                      <tr>
                                        <td>{{$product->date_production}}</td>

                                        <td><strong><h5>{{$product->amount}}x</h5></strong></td>

                                        <td>{{$product->product_info}}</td>
                                        <td>
                                          {{\App\Models\Order::find($product->order_id)->first()->code}}
                                          <small>{{\App\Models\Order::find($product->order_id)->first()->date_order}}</small>
                                          
                                        </td>
                                        {{-- <td>
                                          <form method="get" action={{route('order.edit', ['id' => $product->order_id]) }}>
                                            @csrf
                                            @method('get')
                                            <button type="submit" class="btn btn-light btn-sm"><i class="fas fa-info"></i></button>
                                        </form>
                                      </td> --}}
                                        </td>

                                      </tr>
                                      @endforeach
                                    </tbody>
                                  </table>
                    
                    
                    
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>
                      
                      
                      







                    
                    </div>
                    @endif
                    <div class="card-footer text-muted">
                    </div>
                    {{-- <div class="card-footer text-muted">
                      <div class="progress">
                        <div class="progress-bar bg-light" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"><h6 class="grey600color small mt-2">Oczekujące</h6></div>
                      </div>
                    </div> --}}
                  </div>
        </div>




















@endsection
