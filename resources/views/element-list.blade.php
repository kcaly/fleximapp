@extends('layouts.app')
@section('content')

<div class="col-lg-12">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">

            {{-- <button class="btn btn-light btn-sm mt-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample2" aria-controls="offcanvasExample">
              <i class="fas fa-retweet"></i>&nbsp;Automatyzacja
            </button> --}}

            <div class="row mb-3 font-weight-light my-4">
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <h4 class="text-center font-weight-light my-4">
                            Lista elementów 
                        </h4>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">                        
                        <div class="row mb-3 font-weight-light">                           
                          <div class="col-md-4">
                                           
                          </div>
                          <div class="col-md-8">
                           
                            <button type="button" class="btn btn-primary btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal" @if (($active_filter['material_id'] == 0 && $active_filter['id'] == 0 && $active_filter['name'] == 0 && $active_filter['length_value'] == 0 && $active_filter['width_value'] == 0 && $active_filter['height_value'] == 0) || count($elements) == 0 || $active_filter['job_group_id'] != 0 || $active_filter['machine_id'] != 0) disabled @endif><i class="fas fa-tags"></i> Dodaj do grupy</button> &nbsp;&nbsp;

                            <!-- Modal JobGroup-->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-tags"></i> Dodaj do grupy</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                      <form method="post" action="{{route('addition.elements.jobgroup')}}">
                                        @csrf
                                        @method('post')
                                        <input name="filter_material_id" value="{{$active_filter['material_id']}}" type="hidden">
                                        <input name="filter_id" value="{{$active_filter['id']}}" type="hidden">
                                        <input name="filter_name" value="{{$active_filter['name']}}" type="hidden">
                                        <input name="filter_length_operator" value="{{$active_filter['length_operator']}}" type="hidden">
                                        <input name="filter_length_value" value="{{$active_filter['length_value']}}" type="hidden">
                                        <input name="filter_width_operator" value="{{$active_filter['width_operator']}}" type="hidden">
                                        <input name="filter_width_value" value="{{$active_filter['width_value']}}" type="hidden">
                                        <input name="filter_height_operator" value="{{$active_filter['height_operator']}}" type="hidden">
                                        <input name="filter_height_value" value="{{$active_filter['height_value']}}" type="hidden">

                                        <ul class="list-group list-group-flush mb-3 ">

                                            <li class="list-group-item">
                                                <i class="fas fa-caret-down"></i> <strong>Aktywny filtr</strong>
                                            </li>
                                            
                                                @if (isset($active_filter['material_id']))
                                                @if ($active_filter['material_id'] != 0)
            
                                                <li class="list-group-item">Materiał: {{\App\Models\Material::find($active_filter['material_id'])->name}}</li>
                                                
                                                @else    
                                                @endif
                                                @endif

                                                @if (isset($active_filter['id']))
                                                @if ($active_filter['id'] != 0)
            
                                                <li class="list-group-item">ID: {{$active_filter['id']}}</li>
                                                
                                                @else    
                                                @endif
                                                @endif

                                                @if (isset($active_filter['name']))
                                                @if ($active_filter['name'] != 0)
            
                                                <li class="list-group-item">Nazwa: {{$active_filter['name']}}</li>
                                                
                                                @else    
                                                @endif
                                                @endif

                                                @if (isset($active_filter['length_value']))
                                                @if ($active_filter['length_value'] != 0)
            
                                                <li class="list-group-item">Długość: {{$active_filter['length_operator']}} {{$active_filter['length_value']}}</li>
                                                
                                                @else    
                                                @endif
                                                @endif

                                                @if (isset($active_filter['width_value']))
                                                @if ($active_filter['width_value'] != 0)
            
                                                <li class="list-group-item">Szerokość: {{$active_filter['width_operator']}} {{$active_filter['width_value']}}</li>
                                                
                                                @else    
                                                @endif
                                                @endif

                                                @if (isset($active_filter['height_value']))
                                                @if ($active_filter['height_value'] != 0)
            
                                                <li class="list-group-item">Wysokość: {{$active_filter['height_operator']}} {{$active_filter['height_value']}}</li>
                                                
                                                @else    
                                                @endif
                                                @endif

                                        </ul>

                                        <select name="select_job_group" class="form-select form-select-lg" aria-label=".form-select-lg example">
                                            <option selected></option>
                                            @foreach (App\Models\JobGroup::orderBy('name', 'DESC')->get() as $job_group)
                                            <option value="{{$job_group->id}}">{{$job_group->name}}</option>
                                            @endforeach
                                        </select>

                                          <div class="form-check mt-3 small">
                                            <label class="form-check-label" for="flexCheckDefault">
                                              <input name="default_filter" class="form-check-input" type="checkbox" name="refresh" value="1" id="flexCheckDefault">
                                                Powiąż filtr z grupą
                                            </label>  
                                          </div>

                                          <div class="form-check mt-3 small">
                                            <label class="form-check-label" for="flexCheckDefault">
                                              <input name="not_null" class="form-check-input" type="checkbox" name="refresh" value="1" id="flexCheckDefault">
                                                Nadpisz istniejące
                                            </label>  
                                          </div>
     
                                    </div>
                                    <div class="modal-footer">                                    
                                        <button type="submit" class="btn btn-primary" name="action" value="0"><i class="far fa-check-circle"></i> Zatwierdź</button>
                                    </div>                                  
                                    
                                    <button class="btn btn-light btn-sm mt-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample2" aria-controls="offcanvasExample">
                                      <i class="fas fa-plus-circle"></i>&nbsp;<strong>Nowa grupa</strong>
                                    </button>

                                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample2" aria-labelledby="offcanvasExampleLabel">
                                      <div class="offcanvas-header">
                                        <h5 class="offcanvas-title" id="offcanvasExampleLabel"><i class="fas fa-plus-circle"></i> Nowa grupa</h5>
                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                      </div>
                                      <div class="offcanvas-body">
                                        <div class="form-floating my-4">
                                          <input id="name_new_job_group" type="text" class="form-control @error('name_new_job_group') is-invalid @enderror" name="name_new_job_group" value="{{ old('name_new_job_group') }}" placeholder="Nazwa"  autofocus required />
                                          <label for="name_new_job_group">Nazwa</label>
                                                  @error('name_new_job_group')
                                                          <span class="invalid-feedback" role="alert">
                                                              <strong>{{ $message }}</strong>
                                                          </span>
                                                  @enderror
                                      </div>
                                      <button type="submit" class="btn btn-outline-success btn-lg mt-4" name="action" value="1"><i class="fas fa-check-square"></i> Utwórz</button>
                                      </div>
                                    </div>
                                  </form>                                   
                                  </div>
                                </div>
                              </div>

                            <button type="button" class="btn btn-primary btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal2" @if (($active_filter['material_id'] == 0 && $active_filter['id'] == 0 && $active_filter['name'] == 0 && $active_filter['length_value'] == 0 && $active_filter['width_value'] == 0 && $active_filter['height_value'] == 0) || count($elements) == 0 || $active_filter['job_group_id'] != 0 || $active_filter['machine_id'] != 0) disabled @endif><i class="fas fa-thumbtack"></i> Przypisz maszynę</button> &nbsp;&nbsp;

                            <!-- Modal Machine-->
                            <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-thumbtack"></i> Przypisz maszynę</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">        
                                      <form method="post" action="{{route('addition.elements.machine')}}">
                                        @csrf
                                        @method('post')
                                        <input name="filter_material_id" value="{{$active_filter['material_id']}}" type="hidden">
                                        <input name="filter_id" value="{{$active_filter['id']}}" type="hidden">
                                        <input name="filter_name" value="{{$active_filter['name']}}" type="hidden">
                                        <input name="filter_length_operator" value="{{$active_filter['length_operator']}}" type="hidden">
                                        <input name="filter_length_value" value="{{$active_filter['length_value']}}" type="hidden">
                                        <input name="filter_width_operator" value="{{$active_filter['width_operator']}}" type="hidden">
                                        <input name="filter_width_value" value="{{$active_filter['width_value']}}" type="hidden">
                                        <input name="filter_height_operator" value="{{$active_filter['height_operator']}}" type="hidden">
                                        <input name="filter_height_value" value="{{$active_filter['height_value']}}" type="hidden">                                                                      

                                        <ul class="list-group list-group-flush mb-3 ">

                                            <li class="list-group-item">
                                                <i class="fas fa-caret-down"></i> <strong>Aktywny filtr</strong>
                                            </li>
                                            
                                                @if (isset($active_filter['material_id']))
                                                @if ($active_filter['material_id'] != 0)
            
                                                <li class="list-group-item">Materiał: {{\App\Models\Material::find($active_filter['material_id'])->name}}</li>
                                                
                                                @else    
                                                @endif
                                                @endif

                                                @if (isset($active_filter['id']))
                                                @if ($active_filter['id'] != 0)
            
                                                <li class="list-group-item">ID: {{$active_filter['id']}}</li>
                                                
                                                @else    
                                                @endif
                                                @endif

                                                @if (isset($active_filter['name']))
                                                @if ($active_filter['name'] != 0)
            
                                                <li class="list-group-item">Nazwa: {{$active_filter['name']}}</li>
                                                
                                                @else    
                                                @endif
                                                @endif

                                                @if (isset($active_filter['length_value']))
                                                @if ($active_filter['length_value'] != 0)
            
                                                <li class="list-group-item">Długość: {{$active_filter['length_operator']}} {{$active_filter['length_value']}}</li>
                                                
                                                @else    
                                                @endif
                                                @endif

                                                @if (isset($active_filter['width_value']))
                                                @if ($active_filter['width_value'] != 0)
            
                                                <li class="list-group-item">Szerokość: {{$active_filter['width_operator']}} {{$active_filter['width_value']}}</li>
                                                
                                                @else    
                                                @endif
                                                @endif

                                                @if (isset($active_filter['height_value']))
                                                @if ($active_filter['height_value'] != 0)
            
                                                <li class="list-group-item">Wysokość: {{$active_filter['height_operator']}} {{$active_filter['height_value']}}</li>
                                                
                                                @else    
                                                @endif
                                                @endif

                                          </ul>

                                          <select name="select_machine" class="form-select form-select-lg" aria-label=".form-select-lg example">
                                            <option selected></option>
                                            @foreach (App\Models\Machine::orderBy('name', 'DESC')->get() as $machine)
                                            <option value="{{$machine->id}}">{{$machine->name}}</option>
                                            @endforeach
                                        </select>

                                          <div class="form-check mt-3 small">
                                            <label class="form-check-label" for="flexCheckDefault">
                                              <input name="default_filter" class="form-check-input" type="checkbox" name="refresh" value="1" id="flexCheckDefault">
                                                Powiąż filtr z maszyną
                                            </label>  
                                          </div>

                                          <div class="form-check mt-3 small">
                                            <label class="form-check-label" for="flexCheckDefault">
                                              <input name="not_null" class="form-check-input" type="checkbox" name="refresh" value="1" id="flexCheckDefault">
                                                Nadpisz istniejące
                                            </label>  
                                          </div>
     
                                    </div>
                                    <div class="modal-footer">                                    
                                        <button type="submit" class="btn btn-primary" name="action" value="0"><i class="far fa-check-circle"></i> Zatwierdź</button>
                                    </div>                                

                                    <button class="btn btn-light btn-sm mt-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample3" aria-controls="offcanvasExample">
                                      <i class="fas fa-plus-circle"></i>&nbsp;<strong>Nowa maszyna</strong>
                                    </button>

                                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample3" aria-labelledby="offcanvasExampleLabel">
                                      <div class="offcanvas-header">
                                        <h5 class="offcanvas-title" id="offcanvasExampleLabel"><i class="fas fa-plus-circle"></i> Nowa maszyna</h5>
                                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                      </div>
                                      <div class="offcanvas-body">
                                        <div class="form-floating my-4">
                                          <input id="name_new_machine" type="text" class="form-control @error('name_new_machine') is-invalid @enderror" name="name_new_machine" value="{{ old('name_new_machine') }}" placeholder="Nazwa"  autofocus required />
                                          <label for="name_new_machine">Nazwa</label>
                                                  @error('name_new_machine')
                                                          <span class="invalid-feedback" role="alert">
                                                              <strong>{{ $message }}</strong>
                                                          </span>
                                                  @enderror
                                      </div>
                                      <button type="submit" class="btn btn-outline-success btn-lg mt-4" name="action" value="1"><i class="fas fa-check-square"></i> Utwórz</button>
                                      </div>
                                    </div>
                                  </form>
                                  </div>
                                </div>
                              </div>
                            {{-- <div class="form-check small mt-3">
                                <input class="form-check-input" type="checkbox" name="refresh" value="1" id="flexCheckDefault" @if (($active_filter['material_id'] == 0 && $active_filter['id'] == 0 && $active_filter['name'] == 0 && $active_filter['length_value'] == 0 && $active_filter['width_value'] == 0 && $active_filter['height_value'] == 0) || count($elements) == 0) disabled @endif>
                                <label class="form-check-label" for="flexCheckDefault">
                                    <span class="badge rounded-pill bg-light text-dark"><i class="fas fa-exclamation-triangle"></i> Zastąp istniejące</span>                                 
                                </label></div> --}}        
                          </div>
                        </div>
                    </div>
                </div>
            </div>                 
          </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <form method="POST" action="{{ route('element.filter') }}">
                        @csrf
                        @method('post')

                        <th scope="col" style="width: 5%">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-filter"></i> Filtruj</button></th>

                        <th scope="col" style="width: 5%">
                            {{-- <div class="form-check form-check-inline">
                            <input name="pdf" class="form-check-input" type="checkbox" id="inlineCheckbox1">
                            <label class="form-check-label" for="inlineCheckbox1"><i class="far fa-file-pdf"></i> PDF</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input name="dxf" class="form-check-input" type="checkbox" id="inlineCheckbox2">
                            <label class="form-check-label" for="inlineCheckbox2"><i class="far fa-file"></i> DXF</label>
                          </div> --}}
                        </th>

                        <th scope="col" style="width: 10%">
                            <select name="material_id" class="form-select">
                                <option selected value="{{$active_filter['material_id']}}">
                                    
                                    @if (isset($active_filter['material_id']))
                                    @if ($active_filter['material_id'] != 0)

                                    {{\App\Models\Material::find($active_filter['material_id'])->name}}
                                    <option value="0"></option>
                                    
                                    @else
                                    
                                    @endif
                                    @endif
                                </option>
                               
                                @foreach(\App\Models\Material::orderBy('name', 'DESC')->get() as $material)
                                <option value="{{ $material->id }}">{{ $material->name }}</option>
                                @endforeach
                            </select>
                        </th>

                        <th scope="col" style="width: 18%">
                          <select name="job_group_id" class="form-select">
                            <option selected value="{{$active_filter['job_group_id']}}">
                              @if ($active_filter['job_group_id'] != 0)
                              {{\App\Models\JobGroup::find($active_filter['job_group_id'])->name}}
                              <option value="0"></option>
                              @endif
                          </option>
                            @foreach(\App\Models\JobGroup::orderBy('name', 'DESC')->get() as $job_group)
                            <option value="{{ $job_group->id }}">{{ $job_group->name }}</option>
                            @endforeach
                        </select>
                        </th>

                        <th scope="col" style="width: 8%"><input name="id" type="text" class="form-control" value="{{$active_filter['id']}}" @if($active_filter['job_group_id'] != 0 || $active_filter['machine_id'] != 0) disabled @endif></th>

                        <th scope="col" style="width: 20%"><input name="name" type="text" class="form-control" value="{{$active_filter['name']}}" @if($active_filter['job_group_id'] != 0 || $active_filter['machine_id'] != 0) disabled @endif></th>

                        <th scope="col" style="width: 8%">
                            <select name="length_operator" class="form-select form-select-sm" @if($active_filter['job_group_id'] != 0 || $active_filter['machine_id'] != 0) disabled @endif>
                                <option selected>
                                    @if (isset($active_filter['length_operator']))
                                    {{$active_filter['length_operator']}}
                                    @else
                                    =
                                    @endif
                                </option>
                                <option value="=">(=) Równe:</option>
                                <option value=">">(>) Większe od:</option>
                                <option value="<">(<) Mniejsze od:</option>
                                <option value=">=">(>=) Większe lub równe:</option>
                                <option value="<=">(<=) Mniejsze lub równe:</option>
                            </select>
                                <input name="length_value" type="number" class="form-control" value="{{$active_filter['length_value']}}" @if($active_filter['job_group_id'] != 0 || $active_filter['machine_id'] != 0) disabled @endif></th>

                        <th scope="col" style="width: 8%">
                            <select name="width_operator" class="form-select form-select-sm" @if($active_filter['job_group_id'] != 0 || $active_filter['machine_id'] != 0) disabled @endif>
                                <option selected>
                                    @if (isset($active_filter['width_operator']))
                                    {{$active_filter['width_operator']}}
                                    @else
                                    =
                                    @endif
                                </option>
                                <option value="=">(=) Równe:</option>
                                <option value=">">(>) Większe od:</option>
                                <option value="<">(<) Mniejsze od:</option>
                                <option value=">=">(>=) Większe lub równe:</option>
                                <option value="<=">(<=) Mniejsze lub równe:</option>
                            </select>
                                <input name="width_value" type="number" class="form-control" value="{{$active_filter['width_value']}}" @if($active_filter['job_group_id'] != 0 || $active_filter['machine_id'] != 0) disabled @endif></th>

                        <th scope="col" style="width: 8%">
                            <select name="height_operator" class="form-select form-select-sm" @if($active_filter['job_group_id'] != 0 || $active_filter['machine_id'] != 0) disabled @endif>
                                <option selected>
                                    @if (isset($active_filter['height_operator']))
                                    {{$active_filter['height_operator']}}
                                    @else
                                    =
                                    @endif
                                </option>
                                <option value="=">(=) Równe:</option>
                                <option value=">">(>) Większe od:</option>
                                <option value="<">(<) Mniejsze od:</option>
                                <option value=">=">(>=) Większe lub równe:</option>
                                <option value="<=">(<=) Mniejsze lub równe:</option>
                            </select>
                                <input name="height_value" type="number" class="form-control" value="{{$active_filter['height_value']}}" @if($active_filter['job_group_id'] != 0 || $active_filter['machine_id'] != 0) disabled @endif>
                        </th>

                        <th scope="col" style="width: 10%">
                          <select name="machine_id" class="form-select">
                            <option selected value="{{$active_filter['machine_id']}}">
                              @if ($active_filter['machine_id'] != 0)
                              {{\App\Models\Machine::find($active_filter['machine_id'])->name}}
                              <option value="0"></option>
                              @endif
                          </option>
                            @foreach(\App\Models\Machine::orderBy('name', 'DESC')->get() as $machine)
                            <option value="{{ $machine->id }}">{{ $machine->name }}</option>
                            @endforeach
                        </select>
                        </th>

                    </tr>
                    </form>

                    <tr>
                    <th scope="col"><a href="{{route('element.new')}}"><i class="fas fa-plus"></i></a></th>
                    <th scope="col">PDF/DXF</th>
                                      
                    <form method="post" action={{ route('material.create') }}>
                    <th scope="col">Materiał 
                        @csrf
                        @method('post')
                      <a href="" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample4" aria-controls="offcanvasExample"><i class="fas fa-plus-circle"></i></a>
                      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample4" aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header">
                          <h5 class="offcanvas-title" id="offcanvasExampleLabel"><i class="fas fa-pallet"></i> Nowy materiał</h5>
                          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                          <div class="form-floating mb-4">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nazwa"  autofocus required />
                            <label for="name">Nazwa</label>
                                    @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                        </div>
                        <div class="row mb-3">
                          <div class="col-md-6">
                              <div class="form-floating mb-3 mb-md-0">
                                  <input id="value" type="number" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}" required autocomplete="value" autofocus placeholder="Przelicznik (kg/m³)" />
                                  <label for="value">Przelicznik (kg/m³)</label>
                                  @error('value')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                  @enderror
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-floating">
                                  <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus placeholder="Cena (kg)" />
                                  <label for="price">Cena (kg)</label>
                                  @error('price')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                  @enderror
                              </div>
                          </div>
                      </div>
                        <h5 class="offcanvas-title mb-2 mt-4" id="offcanvasExampleLabel"><i class="fas fa-ruler-combined"></i> Wymiary bloku</h5>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input id="length" type="number" class="form-control @error('length') is-invalid @enderror" name="length" value="{{ old('length') }}" autofocus placeholder="Długość" required/>
                                    <label for="length">Długość</label>
                                    @error('length')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input id="width" type="number" class="form-control @error('width') is-invalid @enderror" name="width" value="{{ old('width') }}" autofocus placeholder="Szerokość" required/>
                                    <label for="width">Szerokość</label>
                                    @error('width')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mb-3 mb-md-0">
                                    <input id="height" type="number" class="form-control @error('height') is-invalid @enderror" name="height" value="{{ old('height') }}" autofocus placeholder="Wysokość" required/>
                                    <label for="height">Wysokość</label>
                                    @error('height')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-success btn-lg mt-4"><i class="fas fa-check-square"></i> Utwórz</button>
                        </div>
                      </div>
                    </form>
                    </th>
                    <th scope="col">Grupa
                      {{-- <a href="" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample5" aria-controls="offcanvasExample"><i class="fas fa-plus-circle"></i></a>
                      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample5" aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header">
                          <h5 class="offcanvas-title" id="offcanvasExampleLabel"><i class="far fa-window-maximize"></i> Nowa grupa</h5>
                          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                          <div>
                            <form method="post" action="{{route('job.group.create')}}">
                              @csrf
                              @method('post')
                            <div class="input-group mt-4">
                              <input type="text" name="name" class="form-control" placeholder="Nazwa grupy" aria-label="Nazwa grupy" aria-describedby="basic-addon2">
                              <div class="input-group-append">
                                <button type="submit" class="btn btn-outline-secondary"><i class="fas fa-check-square"></i> Utwórz</button>
                              </div>
                            </div>
                          </form>
                          </div>
                        </div>
                      </div> --}}
                    </th>
                    <th scope="col">ID</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col">DŁ</th>
                    <th scope="col">SZER</th>
                    <th scope="col">WYS</th>
                    <th scope="col">Maszyna
                      {{-- <a href="" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample6" aria-controls="offcanvasExample"><i class="fas fa-plus-circle"></i></a>
                      <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample6" aria-labelledby="offcanvasExampleLabel">
                        <div class="offcanvas-header">
                          <h5 class="offcanvas-title" id="offcanvasExampleLabel"><i class="far fa-window-maximize"></i> Nowa maszyna</h5>
                          <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                          <div>
                            <form method="post" action="{{route('machine.create')}}">
                            @csrf
                            @method('post')
                            <div class="input-group mt-4">
                              <input type="text" name="name" class="form-control" placeholder="Nazwa maszyny" aria-label="Nazwa maszyny" aria-describedby="basic-addon2">
                              <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-check-square"></i> Utwórz</button>
                              </div>
                            </div>
                           </form>
                          </div>
                        </div>
                      </div> --}}
                    </th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($elements as $element)	
                  <tr>
                      <td>
                          <form method="get" action={{route('element.edit', ['id' => $element->id]) }} >
                              @csrf
                              @method('get')
                              <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-sign-in-alt"></i></button>
                          </form>
                      </td>
                      <td>  
                          <input type="hidden" value="{{$pdffile = $element->elementfiles->where('type', 'pdf')->first()}}">
                          @if($element->elementfiles->where('type', 'pdf')->first())
                          <a href="{{ Storage::url($pdffile->path) }}"><button class="btn btn-link btn-sm"><i class="far fa-file-pdf"></i></button></a>
                          @else
                          <button class="btn btn-link" disabled></button>
                          @endif

                          <input type="hidden" value="{{$dxffile = $element->elementfiles->where('type', 'dxf')->first()}}">
                          @if($element->elementfiles->where('type', 'dxf')->first())
                          <a href="{{ Storage::url($dxffile->path) }}"><button class="btn btn-link btn-sm"><i class="far fa-file"></i></button></a>
                          @endif
                      </td>
                      <td>{{ $element->material->name }}</td>
                      <td>
                          @if ($element->job_group_id == null)
                          @else
                          {{ \App\Models\JobGroup::find($element->job_group_id)->name }}
                          @endif
                      </td>
                      <td>{{ $element->id }}</td>
                      <td>{{ $element->name }}</td>
                      <td>{{ $element->length }}</td>
                      <td>{{ $element->width }}</td>
                      <td>{{ $element->height }}</td>
                      <td>
                          @if ($element->machine_id == null)
                          @else
                          {{ \App\Models\Machine::find($element->machine_id)->name }}
                          @endif
                      </td>                      
                  </tr>   
                  @endforeach
            </tbody>
            <tfoot>
            </tfoot>
        </table> 
        </div>
        {{-- <div class="card-footer text-center py-3 small">
            <div class="row font-weight-light small">
                <div class="col-md-1">
                        <form method="post" action="{{route('element.list.custom-size')}}">
                        @csrf
                        @method('post')
                        <select onchange="this.form.submit()" name="size" class="form-control form-control-sm" aria-label=".form-select-sm example">
                            <option selected>
                            Ilość /str.
                            </option>
                            <option value="10">10 elementów</option>
                            <option value="50">50 elementów</option>
                            <option value="100">100 elementów</option>
                            <option value="1000">1000 elementów</option>
                          </select> 
                        </form>
                </div>
                <div class="col-md-10">
                        {{ $elements->links() }}
                </div>
            </div>  
        </div> --}}
        <div class="card-footer text-center py-3 small">
            {{ $elements->links() }}          
        </div>
    </div>
</div>

@endsection