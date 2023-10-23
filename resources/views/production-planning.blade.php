@extends('layouts.app')
@section('content')
            <div class="mt-1">
                <div class="card shadow-lg border-0 rounded-lg bg-light my-2">
                  <div class="card-header small text-muted">
                    <i class="fas fa-calendar-alt"></i>&nbsp;&nbsp;Planowanie produkcji
                  </div>
                    <div class="card-body">
                    @if ($status == 0)
                    <div class="row mt-3">
                      <div class="col-md-8">
                        <form method="post" action="{{route('production.planning.loader')}}">
                          @csrf
                          @method('put')
                      <select name="production_id" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                        <option selected value="0"></option>
                        @foreach (\App\Models\Production::where('status','<=', 1)->get() as $production)
                        @if (\App\Models\JobOrder::where('production_id', $production->id)->count() > 0)

                        @else
                        <option value="{{$production->id}}">{{$production->dates_textcode}}&nbsp;&nbsp;&nbsp;{{$production->name}} @if(\App\Models\ElementJob::where('production_id', $production->id)->where('status', 1)->count()) @else &nbsp;&nbsp;&nbsp;&nbsp; BRAK DANYCH @endif</option>
                        @endif
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-4">
                      <button class="btn btn-lg btn-outline-primary border" type="submit"><i class="fas fa-cloud-download-alt"></i> Pobierz dane</button>
                    </div>
                  </form>
                    </div>
                    @endif
                    @if ($status != 0)
                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                      <div class="container-fluid small">
                        <a class="navbar text-muted mt-2"><h6><small>{{$prod->dates_textcode}}</small><br />{{$prod->name}}</h6></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarScroll">
                          <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                            <li class="nav-item">
                              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">@if(\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->count())<small>Last update:</small><br />{{\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->orderBy('updated_at', 'DESC')->first()->updated_at->toDateTimeString()}}@else Obszar roboczy jest pusty.<br />Wygeneruj dane i utwórz ponownie. @endif</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
                            </li>
                            <li class="nav-item">

                              @if(\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->count())<a class="nav-link" href="{{route('production.select', ['id' => $prod->id])}}"><i class="fas fa-door-open"></i> Zamknij</a>@else <a class="nav-link" href="{{route('production.delete', ['id' => $prod->id, 'list' => 'main'])}}"><i class="far fa-trash-alt"></i> Usuń pusty zakres</a> @endif</a>


                              

                              
                              

                            </li>
                            @if(\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->count())
                            {{-- <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Szablony widoku
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                                <li><a class="dropdown-item" href="#">Grupami elementów</a></li>
                                <li><a class="dropdown-item" href="#">Stanowiskowe (maszyny)</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item small" href="#">Podsumowanie materiałowe</a></li>
                              </ul>
                            </li> --}}
                            <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="#"><i class="fas fa-print"></i> Drukuj</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
                            </li>
                            <form method="POST" action="{{ route('production.planning.save') }}">
                              @csrf
                              @method('put')
                            <li class="nav-item">
                              <button type="submit" class="btn btn-outline-dark btn-sm mt-1 border border-secondary border-1 routed-3"><i class="fas fa-wrench"></i>&nbsp;Zapisz zmiany</button>
                            </li>
                            @endif
                          </ul>
                          {{-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                            <div class="input-group">
                                <input class="form-control form-control-sm bg-light border border-secondary border-1 rounded-start" type="text" placeholder="" aria-label=".form-control-sm example" aria-describedby="btnNavbarSearch" />
                                <button class="btn btn-outline-secondary border border-secondary border-1 border-start-0" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                            </div>
                        </form> --}}
                        </div>
                      </div>
                    </nav>
                    <div class="card-footer rounded-3 border-start border-end border-bottom mt-3"> 
                      <div class="table-responsive-xxl">
                      <table class="table table-borderless table-responsive-lg">
                        <thead>
                            <tr>
                              <th scope="col"></th>
                              @foreach ($dates as $date)
                              <th scope="col"></th>
                              @endforeach
                            </tr>
                          </thead>
                          <tbody>
                          @foreach ($job_groups_ids as $job_group_id)
                          
                          <input type="hidden" value="{{$temp2 = 1}}">
                          <input type="hidden" value="{{$dates2 = \App\Models\ElementJob::where('production_id', $prod->id)->where('job_group_id', $job_group_id->job_group_id)->select('date_production')->distinct()->orderBy('date_production', 'ASC')->get()}}">
                            <tr class="border-bottom border-dark">
                              <th scope="row"><h6 class="small">
                                <a class="btn btn-light border routed bg-transparent btn-sm" data-bs-toggle="collapse" href="#multiCollapseExample{{$job_group_id->job_group_id}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fas fa-grip-lines"></i> <i class="fas fa-angle-double-down"></i></a>&nbsp;&nbsp;
                                <a class="btn btn-light border routed bg-transparent btn-sm" href="{{route('production.planning.ingroup', ['job_group_id' => $job_group_id->job_group_id, 'production_id' => $prod->id])}}" role="button"><i class="fas fa-bars"></i> <i class="fas fa-search"></i></a></h6><h6 class="mt-2">{{\App\Models\JobGroup::find($job_group_id->job_group_id)->name}}</h6>
                                <div class="collapse multi-collapse mt-2" id="multiCollapseExample{{$job_group_id->job_group_id}}">
                                  <div class="bg-transparent">
                                  </div>
                                </div>
                              </th>

                              
                              @foreach ($dates2 as $date)
                              
                              
                              <input type="hidden" value="{{$temp = 0}}">
                              
                              <input type="hidden" value="{{$this_date_virtual = \App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->where('job_group_id', $job_group_id->job_group_id)->where('date_production', $date->date_production)->first()->date_production_virtual}}">
                              <input type="hidden" value="{{$this_date = \App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->where('job_group_id', $job_group_id->job_group_id)->where('date_production', $date->date_production)->first()->date_production}}">
                              
                              
                              <td>
                                <div class="row text-left blueiconcolor">
                                  <button class="btn btn-sm" disabled><small class="grey800color"><strong>{{$date->date_production}}</strong></small></button>
                                  
                                  
                                </div>
                                
                                <div class="row">
                                  
                                <div class="col-md-5 text-right">
                                  <strong>{{\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->where('job_group_id', $job_group_id->job_group_id)->where('date_production','=', $date->date_production)->sum('sum_amount')}}</strong>
                              </div>
                              <div class="col-md-7 text-right small">
                                &nbsp;&nbsp;&nbsp;{{\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->where('job_group_id', $job_group_id->job_group_id)->where('date_production','=', $date->date_production)->sum('sum_weight')}}&nbsp;<small>kg</small></div>
                                </div>
                                <div class="collapse multi-collapse mt-2" id="multiCollapseExample{{$job_group_id->job_group_id}}">
                                  <div class="card card-body bg-transparent border">
                                    <div class="row">
                                      <div class="col-md-2 text-left">
                                        <button class="btn btn-sm" disabled><h6>@if (\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->where('job_group_id', $job_group_id->job_group_id)->where('date_production', $date->date_production)->first()->date_production_virtual != \App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->where('job_group_id', $job_group_id->job_group_id)->where('date_production', $date->date_production)->first()->date_production)<i class="fas fa-snowplow blueiconcolor">@else<i class="fas fa-snowplow">@endif</i></h6></button>
                                      </div>
                                      <div class="col-md-10">
                                        <select name="{{$job_group_id->job_group_id}}_{{$this_date}}" class="form-select form-select-sm" id="autoSizingSelect">
                                          @if (\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->where('job_group_id', $job_group_id->job_group_id)->where('date_production', $date->date_production)->first()->date_production_virtual != \App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->where('job_group_id', $job_group_id->job_group_id)->where('date_production', $date->date_production)->first()->date_production)
                                          <option selected value="{{$this_date_virtual }}">{{$this_date_virtual}}</option>
                                          @foreach($dates as $date)
                                        <option value="{{$date->date_production}}" id="{{$temp = $temp + 1}}"><small>{{$date->date_production}}</small></option>                              
                                          @endforeach
                                          @else                                       
                                          <option selected value="{{$this_date}}">{{$this_date}}</option>                                         
                                          @foreach($dates as $date)
                                          @if ($this_date == $date->date_production)
                                          <small id="{{$temp = $temp + 1}}"></small>
                                          @else
                                          <option value="{{$date->date_production}}" id="{{$temp = $temp + 1}}"><small>{{$date->date_production}}</small></option>
                                          @endif
                                          @endforeach
                                          @endif
                                        </select>
                                        <input name="production_id" type="hidden" value="{{$prod->id}}">
                                      </div>
                                    </div>
                                    <input type="hidden" value="{{$temp2 = $temp2 + 1}}">
                                  </div>
                                  <div class="card-body bg-light">
                                    <div class="small">
                                      <table class="table table-borderless table-sm">
                                        <thead class="">
                                          <tr>
                                            <th scope="col" style="width: 55%"></th>
                                            <th scope="col" ></th>
                                            <th scope="col" style="width: 25%"></th>
                                          </tr>
                                        </thead>
                                      @foreach(\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->where('job_group_id', $job_group_id->job_group_id)->where('date_production', $this_date)->select('material')->distinct()->get() as $material)
                                      <tbody>
                                        <tr class="border-bottom">
                                          <td class="text-right">{{$material->material}}: </td>
                                          <td class="text-right">{{\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->where('job_group_id', $job_group_id->job_group_id)->where('date_production', $this_date)->where('material', $material->material)->sum('sum_amount')}}</td>
                                          <td class="small text-right">{{\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->where('job_group_id', $job_group_id->job_group_id)->where('date_production', $this_date)->where('material', $material->material)->sum('sum_weight')}}</td>                                          
                                        </tr>
                                      @endforeach
                                      </table>
                                      <table class="table table-sm">
                                        <thead class="">
                                          <tr>
                                            <th scope="col" style="width: 80%"></th>
                                            <th scope="col"></th>
                                          </tr>
                                        </thead>
                                      
                                      @foreach (\App\Models\ElementProduction::where('production_id', $prod->id)->where('status', 1)->where('date_production', $this_date)->select('product_info', 'product_quantity')->distinct()->get() as $product)
                                      <tr class="small border-bottom">
                                        
                                        <td class="text-left border-bottom" style="width: 80%">{{$product->product_info}}</td>
                                        <td class="text-right border-bottom"><strong>{{$product->product_quantity}}</strong></td>
                                        
                                      </tr>
                                      @endforeach
                                    </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              
                              
                              @endforeach
                            </tr>
                            
                          @endforeach
                          </tbody>
                      </table>
                    </form>
                </div>
                    </div>
                    
                    {{-- <div class="card-footer text-muted">
                      <div class="progress">
                        <div class="progress-bar bg-light" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"><h6 class="grey600color small mt-2">Oczekujące</h6></div>
                      </div>
                    </div> --}}
                  </div>
                  @else

                  @endif
        </div>

@endsection
