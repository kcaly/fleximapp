<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="manufacturing web app-system" />
        <title>Fleximapp</title>
        <link rel="shortcut icon" href="{{ asset('favicon/fleximapp.ico')}}">
    	<link rel="icon" sizes="16x16 32x32 64x64" href="{{ asset('favicon/fleximapp.ico')}}">
    	<link rel="icon" type="image/png" sizes="196x196" href="{{ asset('favicon/fleximapp-192.png')}}">
    	<link rel="icon" type="image/png" sizes="160x160" href="{{ asset('favicon/fleximapp-160.png')}}">
    	<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/fleximapp-96.png')}}">
    	<link rel="icon" type="image/png" sizes="64x64" href="{{ asset('favicon/fleximapp-64.png')}}">
    	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/fleximapp-32.png')}}">
    	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/fleximapp-16.png')}}">
    	<link rel="apple-touch-icon" href="{{ asset('favicon/fleximapp-57.png')}}">
    	<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/fleximapp-114.png')}}">
    	<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/fleximapp-72.png')}}">
    	<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/fleximapp-144.png')}}">
    	<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/fleximapp-60.png')}}">
    	<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/fleximapp-120.png')}}">
	    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/fleximapp-76.png')}}">
    	<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/fleximapp-152.png')}}">
	    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/fleximapp-180.png')}}">
	    <meta name="msapplication-TileColor" content="#FFFFFF">
	    <meta name="msapplication-TileImage" content="{{ asset('favicon/fleximapp-144.png')}}">
	    <meta name="msapplication-config" content="{{ asset('favicon/browserconfig.xml')}}">
        <link href="{{ asset('css/styles-flex.css')}}" rel="stylesheet" />
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>




        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>


    </head>
    <body class="sb-nav-fixed bg-flex-grey">
       @if (session()->has('job_order_id'))
        <nav class="sb-topnav navbar-custom navbar-expand navbar-dark bg-flex-grey">
            
            <div class="navbar-brand ps-3 mt-5"><img src="{{ asset('img/Fleximapp_logo_light_150.png')}}"></div>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <form method="post" action="{{route('job.out')}}" >
                        @csrf
                        @method('put')
                        <input name="job_id" type="hidden" value="{{\App\Models\JobOrder::find(Session::get('job_order_id'))->id}}">
                        <a class="small" href="#" tabindex="-1" aria-disabled="true"><button type="submit" class="btn btn-outline-dark"><i class="fas fa-unlock"></i>&nbsp;&nbsp;Zakończ</button></a>
                    </form>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"> </a>
                <li class="nav-item">
                  {{-- <a class="nav-link" href="#"><button type="button" class="btn btn-outline-secondary btn-lg"><i class="far fa-check-circle"></i> Wykonaj</button></a> --}}
                </li>
              </ul>

              
        </nav>
        <div id="layoutSidenav">
        @guest
        @else 
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark sidenav-bg-light" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav mt-3">

                           
                            
                            <div class="sb-sidenav-menu-heading my-3">
                                
                                @if(Session::get('active_status') != 0)
                                
                                {{\App\Models\ElementJob::find(Session::get('element_active_id'))->code}}
                             
                                @if(\App\Models\ElementFile::where('element_id', \App\Models\ElementJob::find(Session::get('element_active_id'))->element_id)->where('type', 'pdf')->first())
                                {{-- {{$element_pdf = \App\Models\Element::find(\App\Models\ElementJob::find(Session::get('element_active_id'))->element_id)->name}}
                                {{\App\Models\ElementFile::where('element_id', \App\Models\ElementJob::find(Session::get('element_active_id'))->element_id)->first()->path}} --}}
                                <a target="_blank" rel="noopener noreferrer" href="{{ Storage::url(\App\Models\ElementFile::where('element_id', \App\Models\ElementJob::find(Session::get('element_active_id'))->element_id)->where('type', 'pdf')->first()->path) }}">
                                &nbsp;&nbsp;<strong>PDF</strong> <i class="fas fa-search"></i></a>
                                @endif
                                
                                 <br />{{\App\Models\ElementJob::find(Session::get('element_active_id'))->name}}
                                @else
                                <small>&nbsp;</small><br />&nbsp;<br />
                                @endif
                            </div>
                            
                            <div class="card-footer">
                                @if(Session::get('active_status') != 0)
                                <form method="post" action="{{route('job.open')}}" >
                                    @csrf
                                    @method('put')
                                    <input name="job_id" type="hidden" value="{{\App\Models\JobOrder::find(Session::get('job_order_id'))->id}}">
                                    <input name="job_status" type="hidden" value="{{\App\Models\JobOrder::find(Session::get('job_order_id'))->status}}">
                                    <input name="user_id" type="hidden" value="{{Auth::user()->id}}">
                                    <input name="element_id" type="hidden" value="{{\App\Models\ElementJob::find(Session::get('element_active_id'))->id}}">
                                @else
                                @endif
                                
                            <div class="row mt-3 mb-2">
                                <div class="col-md-4">
                                    <h5 class="text-black">Ilość do wykonania:<h5>
                                </div>
                                <div class="col-md-2">
                                    <h4 class="text-black">
                                        @if(Session::get('active_status') != 0)
                                        <strong>{{\App\Models\ElementJob::find(Session::get('element_active_id'))->sum_amount - \App\Models\ElementJob::find(Session::get('element_active_id'))->done}}</strong>
                                        @else
                                        <strong>0</strong>
                                        @endif
                                    </h4>
                                </div>
                                <div class="col-md-4">
                                    <input name="done_amount" class="form-control form-control-lg mt-2" type="number" @if(Session::get('active_status') != 0)value="@if(Session::get('default_quantity')==0)@else{{Session::get('default_quantity')}}@endif"@endif placeholder="Ilość" aria-label=".form-control-lg example">
                                    
                                </div>
                                <div class="col-md-2">
                                    
                                    
                                </div>
                            </div>
                            <div class="row mt-4">
                                
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-4">
                                    <button type="submit" name="action" value="1" class="btn btn-outline-success btn-lg mt-2"><i class="fas fa-check-square"></i> <strong>Zatwierdź</strong> jako gotowe</button>
                                </div>
                                <div class="col-md-2">
                                    
                                    
                                </div>
                                {{-- <div class="col-md-6">
                                    <button type="submit" name="action" value="2" class="btn btn-outline-primary btn-lg mt-2"><i class="fas fa-external-link-square-alt"></i> <strong>Wykonaj</strong> do wykończenia</button>
                                </div> --}}
                                
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-4">
                                    
                                    
                                </div>
                                <div class="col-md-6">
                                   
                                    {{-- <select disabled name="machine_id" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                        @if ((\App\Models\JobGroup::find((\App\Models\JobOrder::find(Session::get('job_order_id'))->job_group_id))->autoselect_machine_id) != null)
                                        <option selected value="{{\App\Models\JobGroup::find(\App\Models\JobOrder::find(Session::get('job_order_id'))->job_group_id)->autoselect_machine_id}}">{{\App\Models\Machine::find(\App\Models\JobGroup::find(\App\Models\JobOrder::find(Session::get('job_order_id'))->job_group_id)->autoselect_machine_id)->name}}</option>
                                        @else
                                        <option selected></option>
                                        @endif
                                        @foreach(\App\Models\Machine::where('status', 1)->orderBy('position', 'ASC')->get() as $machine)
                                        @if ((\App\Models\JobGroup::find((\App\Models\JobOrder::find(Session::get('job_order_id'))->job_group_id))->autoselect_machine_id) != $machine->id)
                                        <option value="{{$machine->id}}">{{$machine->name }}</option>
                                        @else
                                        <option value="null"><small>(puste)</small></option>
                                        @endif
                                        @endforeach
                                        
                                      </select> --}}
                                </div>
                            </div>
                        @if(Session::get('active_status') != 0)
                        </form>
                        @else
                        @endif

                        <table class="table table-borderless mb-5">
                            <thead>
                              <tr>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\ElementJob::where('job_order_id', Session::get('job_order_id'))->where('status', 10)->where('element_id', Session::get('primary_element_id'))->get() as $element)
                              <tr class="border-bottom">
                                <td><strong>{{$element->code}}</strong></td>
                                <td class="text-right">{{$element->sum_amount}}</td>
                                <td class="text-right">@if($element->machine_id != null)
                                    {{\App\Models\Machine::find($element->machine_id)->name}}
                                    @else
                                    @endif
                                </td>
                                <td class="text-right small">{{$element->created_at->toDateTimeString()}}</td>
                              </tr>
                              @endforeach
                             
                            </tbody>
                          </table>

                            </div>
                            <a class="nav-link collapsed mt-3" href="#" data-bs-toggle="collapse" data-bs-target="#articles" aria-expanded="false" aria-controls="articles">
                                
                                <h6><i class="fas fa-info-circle"></i> <i class="fas fa-tasks"></i>&nbsp;Informacje szczegółowe</h6>
                                
                            </a>
                            <div class="collapse" id="articles" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    
                                    <table class="table table-sm table-striped table-borderless mb-2">
                                        <thead class="border-bottom border-secondary grey800color">
                                            <tr>
                                            <th scope="col" style="width: 15%" class="text-left"><h6 class="small">Data prod.</h6></th>
                                            <th scope="col" style="width: 15%" class="text-left"><h6 class="small">Prod.</h6></th>
                                            <th scope="col" style="width: 15%" class="text-left"><h6 class="small">Art.</h6></th>
                                            <th scope="col" style="width: 10%" class="text-left"><h6 class="small">Wyk.</h6></th>
                                            <th scope="col" style="width: 10%" class="text-left"><h6 class="small">Zam.</h6></th>
                                            </tr>
                                        </thead>
                                        <tbody class="small">
                                            @if(Session::get('active_status') != 0)

                                        @foreach (\App\Models\ElementProduction::where('element_job_id', Session::get('element_active_id'))->where('production_id', \App\Models\JobOrder::find(Session::get('job_order_id'))->production_id)->orderBy('date_production', 'ASC')->get() as $element)  
                                          <tr class>
                                              <td>{{ $element->date_production}}</td>
                                              <td>{{ $element->product_info}}</td>
                                              <td>{{ $element->article_info}}</td>
                                              <td>{{ $element->amount}}</td>
                                              <td>{{ $element->order_info}}</td>
                                              {{-- <td>{{ $element->done }} / {{ $element->amount}}</td> --}}
                                          </tr>   
                                        @endforeach
                                        
                                        @else
                                        @endif      
                                        </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table> 
                                    
                                </nav>


                            </div>

               




                        </div>
                    </div>
                    
                    <div class="sb-sidenav-footer text-white">
                        <small>Produkcja: {{\App\Models\Production::find(\App\Models\JobOrder::find(Session::get('job_order_id'))->production_id)->dates_textcode}} <strong>{{\App\Models\Production::find(\App\Models\JobOrder::find(Session::get('job_order_id'))->production_id)->name}}</strong></small>
                        <h6><small>Zlecenie: </small>NAZWA ZLECENIA</h6>




                     



                        <div class="small mt-3">

                            {{ \App\Models\Company::where('id', Auth::User()->company_id)->first()->name }}
                        </div>
                           {{Auth::user()->tag_user}}
                        
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container bg-flex-grey">
                        <div class="row justify-content-center">



                            <div class="row d-flex w-100 justify-content-between my-2 mb-2">

                                <div class="col-md-2">
                                    Materiał
                                </div>
                                <div class="col-md-2">
                                    Ilość
                                </div>
                                <div class="col-md-2">
                                    Kod
                                </div>
                                <div class="col-md-3">
                                    Nazwa
                                </div>
                                <div class="col-md-1">
                                    X(dł.)
                                </div>
                                <div class="col-md-1">
                                    Y(szer.)
                                </div>
                                <div class="col-md-1">
                                    Z(wys.)
                                </div>
                                
            
            
            
            
                            </div>



                            @foreach (\App\Models\ElementJob::where('job_order_id', Session::get('job_order_id'))
                            ->where('status', 4)
                            ->orderBy('length', 'ASC')
                            ->orderBy('width', 'ASC')
                            ->orderBy('height', 'ASC')
                            ->get() as $element)

              {{-- class="list-group-item list-group-item-action active"  KLASA ZMIANY KOLORU NA NIEBIESKI --}}
              
             
              
              
              
              {{-- @if ($production->status == 2 && $production->done == $production->sum_elements)
              <a href="{{route('production.select', ['id' => $production->id ])}}" class="list-group-item list-group-item-action active border border-success bg-success border border-dark">
              @endif --}}

              <form method="post" action="{{route('job.open')}}" >
                @csrf
                @method('put')
                
                <input name="job_id" type="hidden" value="{{\App\Models\JobOrder::find(Session::get('job_order_id'))->id}}">
                <input name="job_status" type="hidden" value="{{\App\Models\JobOrder::find(Session::get('job_order_id'))->status}}">
                <input name="user_id" type="hidden" value="{{Auth::user()->id}}">
                <input name="element_id" type="hidden" value="{{$element->id}}">
            @if(Session::get('active_status') != 0 && $element->id == \App\Models\ElementJob::find(Session::get('element_active_id'))->id)
            <button class="list-group-item list-group-item-action active border">
            @else
            @if ($element->done != $element->sum_amount)
            <button class="list-group-item list-group-item-action border">
            @else
            <button class="list-group-item list-group-item-action border bg-secondary">
            @endif
            @endif
                <div class="row d-flex w-100 justify-content-between my-2">

                    <div class="col-md-2">
                        {{ $element->material }}
                    </div>
                    <div class="col-md-2">
                        <h6><strong>
                            @if(Session::get('active_status') != 0 && $element->id == \App\Models\ElementJob::find(Session::get('element_active_id'))->id)
                            {{ \App\Models\ElementJob::find(Session::get('element_active_id'))->sum_amount - \App\Models\ElementJob::find(Session::get('element_active_id'))->done}}
                            @else
                            {{ $element->sum_amount - $element->done}}
                            @endif
                        </strong></h6>
                    </div>
                    <div class="col-md-2">
                        {{ $element->code }}

                        @if(\App\Models\ElementFile::where('element_id', $element->element_id)->where('type', 'pdf')->first())
                        <small>&nbsp;<i class="far fa-file-pdf"></i></small>
                        @endif

                    </div>
                    <div class="col-md-3">
                        {{ $element->name }}
                    </div>
                    <div class="col-md-1">
                        <h6>{{ $element->length }}</h6>
                    </div>
                    <div class="col-md-1">
                        <h6>{{ $element->width }}</h6>
                    </div>
                    <div class="col-md-1">
                        <h6>{{ $element->height }}</h6>
                    </div>
      

                </div>
              
            </button>
          </form>
              @endforeach














    
                            

                        





                        

                        {{-- class="list-group-item list-group-item-action active"  KLASA ZMIANY KOLORU NA NIEBIESKI --}}
                        
                       
                        
                        
                        
                        {{-- @if ($production->status == 2 && $production->done == $production->sum_elements)
                        <a href="{{route('production.select', ['id' => $production->id ])}}" class="list-group-item list-group-item-action active border border-success bg-success border border-dark">
                        @endif --}}
                        
                          



                      
                       














                            @yield('content')
                        </div>
                    </div>
                </main>
                {{-- <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Fleximapp 2022</div>
                            {{-- <div class="small">
                                <a href="#"><i class="fas fa-user-secret"></i> privacy</a>
                                &nbsp;&nbsp;&nbsp;
                                <a href="#"><i class="fas fa-user-secret"></i> privacy</a>
                            </div> --}}
                        </div>
                    </div>
                </footer>
            </div>
            @endguest
        </div>
        @endif

        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>
            <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
              <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
            </symbol>
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
          </svg>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/scripts.js')}}"></script>

        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <!-- jQuery -->
        <script src="//code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    </body>
</html>
