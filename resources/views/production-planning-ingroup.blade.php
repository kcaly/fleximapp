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
                        <option value="{{$production->id}}">{{$production->dates_textcode}}&nbsp;&nbsp;{{$production->name}}</option>
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
                              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><small>Last update:</small><br />{{\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->orderBy('updated_at', 'DESC')->first()->updated_at->toDateTimeString()}}</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{route('production.select', ['id' => $prod->id])}}"><i class="fas fa-door-open"></i> Zamknij</a>
                            </li>
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
                            <form method="POST" action="{{ route('production.planning.ingroup.save') }}">
                              @csrf
                              @method('put')
                            <li class="nav-item">
                              <button type="submit" class="btn btn-outline-dark btn-sm mt-1 border border-secondary border-1 routed-3"><i class="fas fa-wrench"></i>&nbsp;Zapisz zmiany</button>
                            </li>
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
                      <div class="row">
                        <div class="col-md-3">
                        <a class="btn btn-light border-0 routed bg-transparent btn-sm mb-1" role="button" aria-expanded="false" href="{{route('production.planning.load.get', ['production_id' => $prod->id])}}"><i class="fas fa-angle-double-left"></i> Powrót do listy zleceń</a>
                        </div>
                      </div>
                      <div class="row">
                        <input name="production_id" type="hidden" value="{{$prod->id}}">
                        <input name="job_group_id" type="hidden" value="{{$job_group->id}}">
                        @foreach ($element_ids as $element_id)
                        <input type="hidden" value="{{$element = \App\Models\Element::find($element_id)->first()}}">
                        <div class="collapse multi-collapse mt-2" id="multiCollapseExample{{$temp}}">
                          
                            <div class="card card-footer border-0 shadow-sm p-3 bg-body rounded border-top border-1 mt-2 bg-light">
                              <div class="table-responsive-xxl">
                       
                        <table class="table table-sm table-borderless">
                          
                            
                        
                          <thead>
                            
                            <tr class="border-bottom border-dark">
                              &nbsp;<small>{{\App\Models\Material::find($element->material_id)->name}}</small>
                              <th scope="col" style="width: 25%">{{$element->code}}&nbsp;&nbsp;{{$element->name}}</th>
                              <th scope="col" style="width: 10%"></th>
                              <th scope="col"></th>
                              <th scope="col"></th>
                              <th scope="col" class="text-right"><a class="btn btn-light border-0 routed bg-transparent" data-bs-toggle="collapse" href="#multiCollapseExample{{$temp}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><i class="fas fa-low-vision"></i></a></th>
                            </tr>
                            @foreach (\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->where('job_group_id', $job_group->id)->select('date_production')->distinct()->get() as $date)
                            <tr class="border-bottom">
                              <th scope="col"></th>
                              <th scope="col" class="text-right">
                                <button class="btn border-0 routed btn-outline-dark" disabled><h5>{{$date->date_production}}</h5></button>
                              </th>
                              <th scope="col"></th>
                              <th scope="col"></th>
                              <th scope="col">
                                <select name="{{$element->id}}_{{$date->date_production}}" class="form-select mt-2 mb-2">

                                  
                                  <option selected value="{{\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->where('date_production', $date->date_production)->where('element_id', $element->id)->select('job_group_id')->first()->job_group_id}}">
                                    
                                    {{\App\Models\JobGroup::find(\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->where('date_production', $date->date_production)->where('element_id', $element->id)->select('job_group_id')->first()->job_group_id)->name}}

                                  </option>

                                  @foreach ($job_groups as $job_group_record)
                                  @if(\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->where('date_production', $date->date_production)->where('element_id', $element->id)->select('job_group_id')->first()->job_group_id != $job_group_record->id)
                                  
                                <option value="{{$job_group_record->id}}"><small>{{$job_group_record->name}}</small></option>
                                @else
                                @endif  
                                
                                @endforeach
                                </select>
                              </th>
                            </tr>
                          </thead>
                          <tbody class="border-bottom">
                            <td></td>
                            <td></td>
                            @foreach(\App\Models\ElementProduction::where('production_id', $prod->id)->where('status', 1)->where('element_id', $element->id)->where('date_production', $date->date_production)->select('product_info')->distinct()->get() as $product)
                            <tr>
                              <td class="text-right">
                                {{\App\Models\ElementProduction::where('production_id', $prod->id)->where('status', 1)->where('element_id', $element->id)->where('date_production', $date->date_production)->where('product_info', $product->product_info)->select('article_quentity')->sum('article_quantity')}}x
                              </td>
                              <td class="text-left"> {{$product->product_info}}</td>
                              <td class="text-right">
                                {{\App\Models\ElementProduction::where('production_id', $prod->id)->where('status', 1)->where('element_id', $element->id)->where('date_production', $date->date_production)->where('product_info', $product->product_info)->select('amount')->sum('amount')}}
                              </td>
                              <td></td>
                              <td></td>
                            </tr>
                           
                            @endforeach
                          </tbody>
                          @endforeach
                            <tbody>
                             <tr>
                              <td class="text-right"></td>
                              <td class="text-right"></td>
                              <td class="text-right">
                                <strong>{{\App\Models\ElementProduction::where('production_id', $prod->id)->where('status', 1)->where('element_id', $element->id)->select('amount')->sum('amount')}}</strong>
                              </td>
                              <td></td>
                              <td></td>
                            </tr>
                          </tbody>



                          
                        </table>
                        
                              </div>
                            </div>
                          
                        </div>
                        <input type="hidden" value="{{$temp=$temp+1}}">
                        @endforeach


                       

                      {{-- <div class="form-floating mt-2">
                        <select name="job_group_id" class="form-select form-select-sm" aria-label=".form-select-sm example" id="floatingSelectJob">
                        <option selected value={{$job_group->id}}>{{$job_group->name}}</option>
                        @foreach (\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->select('job_group_id')->distinct()->get() as $job_group_list)
                        @if ($job_group->id != $job_group_list->job_group_id)
                        <option value="{{$job_group_list->job_group_id}}">{{\App\Models\JobGroup::find($job_group_list->job_group_id)->name}}</option>
                        @endif
                        @endforeach
                        </select>
                        <label for="floatingSelectJob">Zlecenie</label>
                        <div class="d-grid gap-2 col-12 mx-auto">
                          <button class="btn btn-light mt-2 border rounded" type="submit"><i class="fab fa-get-pocket"></i> Wczytaj</button>
                        </div>
                      </div> --}}

                      

                      </div>
                      
                </form>
                </div>
                <table class="table table-responsive-lg border-bottom border-dark">
                  <thead class="">
                      <tr>
                        <th scope="col">{{$job_group->name}}</th>
                        
                      </tr>
                    </thead>
                  </table>
                <table class="table table-sm table-striped table-hover table-borderless mt-3 mb-2">
                  <thead class="border-bottom border-dark">
                      <tr>
                      <th scope="col" style="width: 13%" class="text-left"><h6 class="small">Materiał</h6></th>

                      <th scope="col" style="width: 5%" class="text-right"></th>
                      <th scope="col"></th>
                      
                      <th scope="col"></th>                             
                      <th scope="col" style="width: 8%" class="text-left"><h6 class="small">Kod</h6></th>
                      <th scope="col"><h6 class="small">Nazwa</h6></th>
                      <th scope="col" style="width: 5%" class="text-left"><h6 class="small">X(dł.)</h6></th>
                      <th scope="col" style="width: 5%" class="text-left"><h6 class="small">Y(szer.)</h6></th>
                      <th scope="col" style="width: 5%" class="text-left"><h6 class="small">Z(wys.)</h6></th>
                      <th scope="col"></th>
                      <th scope="col" style="width: 10%" class="text-right"><h6 class="small">Suma</h6></th>
                      @foreach (\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->where('job_group_id', $job_group->id)->select('date_production')->distinct()->get() as $date)
                      <th scope="col" style="10%" class="text-right"><h6 class="small">{{substr($date->date_production, 5)}}</h6></th>
                      

                      @endforeach
                      {{-- <th scope="col"><h6 class="small">Maszyna</h6></th>
                      <th scope="col"><h6 class="small">Grupa zlecenia</h6></th> --}}
                      </tr>
                  </thead>
                  <tbody class="small">
                  @foreach ($element_ids as $element_id)
                  <input type="hidden" value="{{$element = \App\Models\Element::find($element_id)->first()}}">
                    <tr class>
                        <td>{{\App\Models\Material::find($element->material_id)->name}}</td>
                                                                  
                        <td class="text-right"></td>

                        <td></td>
                        <td>
                          
                          <a class="btn btn-light border-0 routed bg-transparent btn-sm" data-bs-toggle="collapse" href="#multiCollapseExample{{$temp2}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"><h6><i class="fas fa-eye"></i></h6></a>
                                                  
                        </td>
                        <td>{{ $element->code }}</td>
                        <td>{{ $element->name }}</td>
                        <td>{{ $element->length }}</td>
                        <td>{{ $element->width }}</td>
                        <td>{{ $element->height }}</td>
                        <td></td>
                        <td class="text-right"><strong>{{(\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->where('job_group_id', $job_group->id)->where('element_id', $element->id)->select('sum_amount')->sum('sum_amount'))}}</strong></td>
                        @foreach (\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->where('job_group_id', $job_group->id)->select('date_production')->distinct()->get() as $date)
                        <td class="text-right">{{(\App\Models\ElementJob::where('production_id', $prod->id)->where('status', 1)->where('job_group_id', $job_group->id)->where('element_id', 
                        $element->id)->where('date_production', $date->date_production)->select('sum_amount')->sum('sum_amount'))}}</td>
                        @endforeach
                      </tr>
                             
                        {{-- <td>{{ \App\Models\Machine::find($element->machine_id)->name }}</td>
                        <td>{{ \App\Models\JobGroup::find($element->job_group_id)->name }}</td> --}}
                    
                        <input type="hidden" value="{{$temp2=$temp2+1}}">
                  @endforeach      
                  </tbody>
              <tfoot>
              </tfoot>
          </table> 
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
