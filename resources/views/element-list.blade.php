@extends('layouts.app')
@section('content')

<div class="col-lg-12">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">

            {{-- <button class="btn btn-light btn-sm mt-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample2" aria-controls="offcanvasExample">
              <i class="fas fa-retweet"></i>&nbsp;Automatyzacja
            </button> --}}

           

            
            


       

            

            <div class="row mt-2 mb-3 font-weight-light">
                <div class="col-md-6">
                    <div class="form-floating mt-2 mb-3 mb-md-0">
                      
                        <h5 class="text-center font-weight-light mb-md-0">
                           <i class="fas fa-shapes"></i><i class="fas fa-chalkboard"></i><i class="fas fa-bars"></i> Lista elementów<br>
                          <span class="badge text-dark">
                        <button class="btn btn-outline-link btn-sm" ><i class="far fa-file-alt"></i> <i class="fas fa-exchange-alt"></i> <i class="far fa-hdd"></i></button></span><br>
                        
                            
                          </h5>

                            
                          <div class=" text-left">
                              
            
                            <a href="{{route('job.group.list')}}" class="btn btn-outline-light"><h5 class="small mt-1 grey800color"><i class="far fa-list-alt grey700color"></i>&nbsp;<i class="far fa-paper-plane grey700color"></i>&nbsp;&nbsp;Zlecenia</h5><div class="small grey800color"></div></a>
                            &nbsp;&nbsp;
                            <a href="{{route('machine.list')}}" class="btn btn-outline-light"><h5 class="small mt-1 grey800color"><i class="fas fa-list-alt grey700color"></i>&nbsp;<i class="fas fa-map-marker-alt grey700color"></i>&nbsp;&nbsp;Maszyny</h5><div class="small grey800color"></div></a>
                          </div>

                        <div class="form small">
                            
                          </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">                        
                        <div class="row mb-3 font-weight-light">                           
                          <div class="col-md-4">
                                           
                          </div>
                          <div class="col-md-8 mt-5">
                            
                            

                            <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal" ><h6 class="text-center mt-1 small"><i class="fas fa-plus-square grey600color"></i> <i class="far fa-folder grey600color"></i> Dodaj do grupy</h6></button>&nbsp;&nbsp;

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
                                        <button type="submit" class="btn btn-primary" name="action" value="0" @if (($active_filter['material_id'] == 0 && $active_filter['id'] == 0 && $active_filter['name'] == 0 && $active_filter['length_value'] == 0 && $active_filter['width_value'] == 0 && $active_filter['height_value'] == 0) || count($elements) == 0 || $active_filter['job_group_id'] != 0 || $active_filter['machine_id'] != 0) disabled @endif><i class="far fa-check-circle"></i> Zatwierdź</button>
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
                                                                               
                                        {{-- <h1 class="d-flex justify-content-center"><i class="fas fa-cookie cookiecolor"></i>&nbsp;&nbsp;<i class="fas fa-cookie cookiecolor"></i>&nbsp;&nbsp;<i class="fas fa-cookie-bite cookiecolor"></i></h1>
                                        <h1 class="d-flex justify-content px-5"><i class="fas fa-highlighter blueiconcolor"></i></h1>
                                        <h3 class="d-flex justify-content px-2"><i class="fas fa-terminal blueiconcolor"></i>&nbsp;&nbsp;&nbsp;<i class="far fa-window-minimize blueiconcolor"></i>&nbsp;&nbsp;&nbsp;<i class="far fa-window-minimize blueiconcolor"></i>&nbsp;&nbsp;&nbsp;<i class="far fa-window-minimize blueiconcolor"></i>&nbsp;&nbsp;&nbsp;<i class="far fa-window-minimize blueiconcolor"></i>&nbsp;&nbsp;&nbsp;<i class="fas fa-coffee blueiconcolor"></i></h2>                                         --}}
                                        
                                      <div class="form mt-3 mb-4">
                                        <label class="mb-2 small" for="titel_new_job_group">Tytuł (etykieta):</label>
                                        <input id="name_new_job_group" type="text" class="form-control @error('name_new_job_group') is-invalid @enderror" name="titel_new_job_group" placeholder=""  autofocus />
                                        
                                    </div>
                                      
                                        <div class="form-floating my-4 mb-4">
                                          <input id="name_new_job_group" type="text" class="form-control @error('name_new_job_group') is-invalid @enderror" name="name_new_job_group" value="Nowa grupa" placeholder="Nazwa" autofocus required />
                                          <label for="name_new_job_group">Nazwa</label>
                                      </div>
                                      
                                    <div class="row mb-3">
                                      <div class="col-md-4">
                                          {{-- <div class="form-floating my-3 mb-md-0">
                                              <input name="position_new_job_group" type="text" class="form-control" value="1" required autofocus placeholder="Pozycja" disabled/>
                                              <label for="position"><i class="fas fa-sort"></i> No.</label>
                                          </div> --}}
                                          <div class="form-floating my-3 mb-md-0 px-2">
                                            <div class="form-check">
                                              <input class="form-check-input" type="radio" name="status_new_job_group" value="1" id="flexRadioDefault1" checked>
                                              <label class="form-check-label" for="flexRadioDefault1">
                                                Włącz
                                              </label>
                                            </div>
                                            <div class="form-check">
                                              <input class="form-check-input" type="radio" name="status_new_job_group" value="0" id="flexRadioDefault2">
                                              <label class="form-check-label" for="flexRadioDefault2">
                                                Wyłącz
                                              </label>
                                            </div>
                                          </div>
                                      </div>
                                      <div class="col-md-4">
                                        
                                    </div>
                                  </div>
                                  <div class="row mb-3 my-4 mt-5">
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                          <div class="form-check form-switch">
                                            <input name="export_new_job_group" class="form-check-input" type="checkbox" value="1" id="flexSwitchCheckDefault">
                                            <label class="form-check-label" for="flexSwitchCheckDefault">Eksport</label>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating mb-3">
                                          <div class="form-check form-switch">
                                            <input name="execute_new_job_group" class="form-check-input" type="checkbox" value="1" id="flexSwitchCheckChecked" checked>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Zlecenia</label>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                                
                              
                              <div class="form-floating my-4">
                                <p class="mb-2" for="default_sort">Domyślne sortowanie:</p>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="default_sort" id="inlineRadio1" value="1" checked>
                                  <label class="form-check-label small" for="inlineRadio1">Długość</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="default_sort" id="inlineRadio2" value="2">
                                  <label class="form-check-label small" for="inlineRadio2">Szerokość</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="default_sort" id="inlineRadio3" value="3">
                                  <label class="form-check-label small" for="inlineRadio3">Wysokość</label>
                                </div>
                              </div>


                              {{-- <div class="row mt-3 mb-3 my-4">                                       
                                <h2 class="d-flex justify-content px-10"><i class="fas fa-qrcode grey800color"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="	fas fa-dice-six blueiconcolor"></i>&nbsp;<i class="	fas fa-dice-six blueiconcolor"></i></h2><h1 class="d-flex justify-content-center px-6"><i class="fas fa-dice blueiconcolor"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-qrcode grey800color"></i></h1>       
                                <div class="form-floating mb-3">
                                  <h5><i class="fas fa-flag-checkered"></i> Kodowanie</h5>                                                                 
                                </div>
                                <div class="col-md-2">
                                  <label class="mb-2 small" for="code_custom">PREFIX</label> 
                                  <button class="btn btn-outline-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample2" aria-controls="offcanvasExample" disabled>
                                  {{ \App\Models\Company::where('id', Auth::User()->company_id)->first()->flexim_id }}
                                  </button>
                                  <div class="mt-6"><img src="{{ asset('img/Fleximapp_form_60x60.png')}}"></div>      
                                </div>
                                <div class="col-md-8">                                                                                                                                     
                                 
                                  <div class="form mb-4">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2"><label class="mb-2" for="code_custom">&nbsp;&nbsp;Użytkownika</label> 
                                  <input id="code_custom" type="text" class="form-control" name="code_custom" value="{{ old('code_custom') }}" placeholder=""/>
                                  </div>
                                  
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                      &nbsp;Systemowe
                                    </label>
                                  
                                  <div class="form-floating mt-2 mb-4">
                                    <input id="code_company" type="text" class="form-control small" name="code_company" value="101409/JG/1 " placeholder="101409/JG/1" checked disabled/>
                                    <label for="code_company">Flexim ID: {{ \App\Models\Company::where('id', Auth::User()->company_id)->first()->flexim_id }}</label>
                                    </div>                                  
                                </div>
                              </div> --}}

                              
                                      <button type="submit" class="btn btn-outline-success btn-lg mt-4" name="action" value="1"><i class="fas fa-check-square"></i> Utwórz</button>
                                      </div>
                                    </div> 
                                  </form>                                 
                                  </div>
                                </div>
                              </div>
                              
                              &nbsp;<button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal2" ><h6 class="text-center mt-1 small"><i class="fas fa-plus-square grey600color"></i> <i class="fas fa-folder grey600color"></i> Przypisz do maszyny</h6></button>&nbsp;&nbsp;<br />

                              
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
                                              <input name="not_null" class="form-check-input" type="checkbox" name="refresh" value="1" id="flexCheckDefault" >
                                                Nadpisz istniejące
                                            </label>  
                                          </div>
     
                                    </div>
                                    <div class="modal-footer">                                    
                                        <button type="submit" class="btn btn-primary" name="action" value="0" @if (($active_filter['material_id'] == 0 && $active_filter['id'] == 0 && $active_filter['name'] == 0 && $active_filter['length_value'] == 0 && $active_filter['width_value'] == 0 && $active_filter['height_value'] == 0) || count($elements) == 0 || $active_filter['job_group_id'] != 0 || $active_filter['machine_id'] != 0) disabled @endif><i class="far fa-check-circle"></i> Zatwierdź</button>
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
                                        <div class="form mt-3 mb-4">
                                          <label class="mb-2 small" for="titel_new_machine">Tytuł (etykieta):</label>
                                          <input id="name_new_machine" type="text" class="form-control @error('name_new_machine') is-invalid @enderror" name="titel_new_machine" value="{{ old('name_new_machine') }}" placeholder=""  autofocus />
                                          
                                      </div>
                                        
                                          <div class="form-floating my-4 mb-4">
                                            <input id="name_new_machine" type="text" class="form-control @error('name_new_machine') is-invalid @enderror" name="name_new_machine" value="Nowa maszyna" placeholder="Nazwa"  autofocus required />
                                            <label for="name_new_machine">Nazwa</label>
                                        </div>
                                        
                                      <div class="row mb-3">
                                        <div class="col-md-4">
                                            {{-- <div class="form-floating my-3 mb-md-0">
                                                <input name="position_new_machine" type="text" class="form-control" value="1" required autofocus placeholder="Pozycja" disabled/>
                                                <label for="position"><i class="fas fa-sort"></i> No.</label>
                                            </div> --}}
                                            <div class="form-floating my-3 mb-md-0 px-2">
                                              <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status_new_machine" value="1" id="flexRadioDefault1" checked>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                  Włącz
                                                </label>
                                              </div>
                                              <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status_new_machine" value="0" id="flexRadioDefault2">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                  Wyłącz
                                                </label>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                          
                                      </div>
                                    </div>
                                    <div class="row mb-3 my-4 mt-5">
                                      <div class="col-md-6">
                                          <div class="form-floating mb-3">
                                            <div class="form-check form-switch">
                                              <input name="export_new_machine" class="form-check-input" type="checkbox" value="1" id="flexSwitchCheckDefault">
                                              <label class="form-check-label" for="flexSwitchCheckDefault">Eksport</label>
                                            </div>
                                          </div>
                                      </div>
                                      <div class="col-md-6">
                                          <div class="form-floating mb-3">
                                            <div class="form-check form-switch">
                                              <input name="execute_new_machine" class="form-check-input" type="checkbox" value="1" id="flexSwitchCheckChecked" checked>
                                              <label class="form-check-label" for="flexSwitchCheckChecked">Zlecenia</label>
                                            </div>
                                          </div>
                                      </div>
                                  </div>
                                  
                                
                                <div class="form-floating my-4">
                                  <p class="mb-2" for="default_sort">Domyślne sortowanie:</p>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="default_sort" id="inlineRadio1" value="1" checked>
                                    <label class="form-check-label small" for="inlineRadio1">Długość</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="default_sort" id="inlineRadio2" value="2">
                                    <label class="form-check-label small" for="inlineRadio2">Szerokość</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="default_sort" id="inlineRadio3" value="3">
                                    <label class="form-check-label small" for="inlineRadio3">Wysokość</label>
                                  </div>
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
                    <th scope="col"><a href="{{route('element.new')}}"><h5><i class="fas fa-plus"></i></h5></a></th>
                    <th scope="col" style="width: 7%"><h5 class="small text-center blueiconcolor">PDF/DXF</h5></th>
                                      
                    
                    <th scope="col">
                      <form method="post" action={{ route('material.create') }}>
                        @csrf
                        @method('post')  
                        <h6><a href="" data-bs-toggle="modal" data-bs-target="#exampleModal5"><i class="fas fa-clipboard-list"></i></a>&nbsp;Materiał</h6>
                    </th>

                    <!-- Modal Material-->
                    <div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-boxes"></i> <i class="fas fa-list"></i> Materiały</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              
                              
                                @foreach (\App\Models\Material::all() as $material)
                                
                                <li class="list-group-item d-flex justify-content-between align-items-start"><h5><i class="far fa-bookmark grey700color"></h5></i>
                                  <div class="ms-2 me-auto">
                                    <div class="" disabled><h5>{{$material->name}}</h5></div>
                                    <div class="small grey800color"><strong>x</strong> {{$material->length}}&nbsp;&nbsp;&nbsp;&nbsp;<strong>y</strong> {{$material->width}}&nbsp;&nbsp;&nbsp;&nbsp;<strong>z</strong> {{$material->height}} </div>
                                  </div>
                                  <span class="badge bg-primary rounded-pill text-dark">@if (\App\Models\Element::where('material_id', $material->id)->count() > 0) <h5>{{\App\Models\Element::where('material_id', $material->id)->count() > 0}}</h5> @else <a href="{{route('material.delete', ['id' => $material->id])}}"><h6 class="rediconcolor small"><i class="fas fa-ban"></i></h6></a>@endif</span>
                                </li>
                                @endforeach
                              </ol>

                              <div class="text-right">
                                <a href="" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample4" aria-controls="offcanvasExample"><button class="btn btn-light btn-sm mt-3" type="button"><i class="fas fa-plus-circle"></i> Nowy materiał</button></a>  </div>    
                              <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample4" aria-labelledby="offcanvasExampleLabel">
                                <div class="offcanvas-header">
                                  <h5 class="offcanvas-title" id="offcanvasExampleLabel"><i class="fas fa-pallet"></i> Nowy materiał</h5>
                                  <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body">
                                  <div class="form-floating mt-3 mb-4">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nazwa"  autofocus required />
                                    <label for="name">Nazwa materiału</label>
                                            @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        {{ $message }}
                                                    </span>
                                            @enderror
                                </div>
                                <div class="row mb-3">
                                  <div class="col-md-6">
                                      <div class="form-floating mb-3 mb-md-0">
                                          <input id="value" type="number" step="0.01" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ old('value') }}" required autocomplete="value" autofocus placeholder="Przelicznik (kg/m³)" />
                                          <label for="value" class="small">Przelicznik (kg/m³)</label>
                                          @error('value')
                                                  <span class="invalid-feedback" role="alert">
                                                      {{ $message }}
                                                  </span>
                                          @enderror
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-floating">
                                          <input id="price" type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" required autocomplete="price" autofocus placeholder="Cena (kg)" />
                                          <label for="price" class="small">Cena (kg)</label>
                                          @error('price')
                                                  <span class="invalid-feedback" role="alert">
                                                      {{ $message }}
                                                  </span>
                                          @enderror
                                      </div>
                                  </div>
                              </div>
                                <h6 class="offcanvas-title mb-2 mt-4" id="offcanvasExampleLabel"><i class="fas fa-ruler-combined"></i> Wymiary bloku</h6>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form mb-3 mb-md-0">
                                            <input id="length" type="number" class="form-control @error('length') is-invalid @enderror" name="length" value="{{ old('length') }}" autofocus placeholder="x" required/>
                                            {{-- <label for="length">Długość</label> --}}
                                            @error('length')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form mb-3 mb-md-0">
                                            <input id="width" type="number" class="form-control @error('width') is-invalid @enderror" name="width" value="{{ old('width') }}" autofocus placeholder="y" required/>
                                            {{-- <label for="width">Szerokość</label> --}}
                                            @error('width')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form mb-3 mb-md-0">
                                            <input id="height" type="number" class="form-control @error('height') is-invalid @enderror" name="height" value="{{ old('height') }}" autofocus placeholder="z" required/>
                                            {{-- <label for="height">Wysokość</label> --}}
                                            @error('height')
                                            <span class="invalid-feedback" role="alert">
                                                {{ $message }}
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-success btn-lg mt-4"><i class="fas fa-check-square"></i> Utwórz</button>
                                </div>
                              </div>
                                                                                                        
                            </div>
                            <div class="modal-footer">                                    
                            
                            </div>                                
                          </div>
                        </div>
                      </div>
                            
                    </th>
                    
                  </form>
                    <th scope="col"><h6>Grupa</h6></th>
                    <th scope="col"><h6>ID</h6></th>
                    <th scope="col"><h6>Nazwa</h6></th>
                    <th scope="col"><h6>DŁ</h6>
                      {{-- <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal3"><i class="fas fa-compress"></i></a> --}}
                    </th>

                    <!-- Modal DŁ-->
                    {{-- <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-compress"></i> Ustaw długość</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">        
                                                                                                                 
                            </div>
                            <div class="modal-footer">                                    
                            
                            </div>                                
                          </div>
                        </div>
                      </div>  --}}

                    </th>
                    <th scope="col"><h6>SZER</h6>
                      {{-- <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal4"><i class="fas fa-compress"></i></a> --}}
                    </th>

                    <!-- Modal SZER-->
                    {{-- <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-compress"></i> Ustaw szerokość</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">        
                                                                                                                 
                            </div>
                            <div class="modal-footer">                                    
                            
                            </div>                                
                          </div>
                        </div>
                      </div> --}}

                    <th scope="col"><h6>WYS</h6>
                      {{-- <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal5"><i class="fas fa-compress"></i></a> --}}
                    </th>

                    <!-- Modal WYS-->
                    {{-- <div class="modal fade" id="exampleModal5" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-compress"></i> Ustaw wysokość</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">        
                                                                                                                 
                            </div>
                            <div class="modal-footer">                                    
                            
                            </div>                                
                          </div>
                        </div>
                      </div> --}}
                      
                    </th>
                    <th scope="col"><h6>Maszyna</h6></th>
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