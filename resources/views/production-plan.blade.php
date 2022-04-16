@extends('layouts.app')
@section('content')
<div class="row mb-3">



    <div class="col-lg-8">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h6 class="text-left font-weight-light my-1">
                    Planowanie <i class="fas fa-chart-line"></i>
                </h6>
              </div>
            <div class="card-body">

                
                <div class="row mb-3 font-weight-light mb-4">
  
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <h5><i class="fas fa-tools"></i>&nbsp;&nbsp;Ustaw roboczy zakres produkcji do pracy</h5>
            
                          <div class="row mb-3 font-weight-light my-4">
                            
                            <div class="col-md-6">
                              <form method="post" action="{{ route('production')}}" >
                                @csrf
                                @method('put')
                                
                                <div class="form-floating mb-2">
                              
                                  <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') ?? Session::get('date') }}" placeholder="Data (RRRR-MM-DD)" autofocus />
                                  <label for="date">Data produkcji od:</label>
                                          @error('date')
                                                  <span class="invalid-feedback" role="alert">
                                                      <strong>{{ $message }}</strong>
                                                  </span>
                                          @enderror
                                  
                                 
                              </div>
          
          
          
                            </div>
                            <div class="col-md-6">
                                <form method="post" action="{{ route('production')}}" >
                                  @csrf
                                  @method('put')
                                  
                                  <div class="form-floating mb-2">
                                
                                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') ?? Session::get('date') }}" placeholder="Data (RRRR-MM-DD)" autofocus />
                                    <label for="date">Data produkcji do:</label>
                                            @error('date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                            @enderror
                                    
                                   
                                </div>
            
            
                                
    
                              </div>
                            
                             
                                <div class="d-flex justify-content my-2">
                                <button type="submit" name="action" value="generate" class="btn btn-outline-danger"><h3><i class="fas fa-low-vision"></i></h3><h6 class="small">Zamknij</h6></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="submit" name="action" value="generate" class="btn btn-warning"><h3><i class="fas fa-drafting-compass"></i></h3><h6 class="small">Wczytaj</h6></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <button type="submit" name="action" value="generate" class="btn btn-success"><h2><i class="fas fa-route"></i> <i class="fas fa-clipboard-check"></i></h2><h6 class="small">Zapisz stany plan.</h6></button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </div>
                         
        
                      

                                
                              
                            

                              
                          </div>
                        </div>
          
                        
                          
                        {{-- <button type="submit" name="action" value="refresh" class="btn btn-light btn-sm" ><i class="fas fa-sync-alt"></i></button> --}}
          
                        
                        </div>
                    <div class="col-md-6">
  
                        <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    <i class="fas fa-spinner"></i>&nbsp;&nbsp;Status gotowości procesu planowania
                                </button>
                              </h2>
                              <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                                  50 % grupą produktu,<br />20% zlecenia na mszynę<br />30% zlecenia grupami elementów
                                </div>
                              </div>
                            </div>
                       
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                              </div>
                          </div>
  
                    </div>
    
                  </div>

                <div class="row mb-3">
                    
                    
                </div>











                    <div class="row mb-6">
    
                        
                        <div class="btn-group mb-4">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                              <i class="fas fa-bell"></i>&nbsp;&nbsp;Istnieje otwarty zakres roboczy. Rekordy zamówień są zablokowane.
                            </button>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#">Action</a></li>
                              <li><a class="dropdown-item" href="#">Another action</a></li>
                              <li><a class="dropdown-item" href="#">Something else here</a></li>
                              <li><hr class="dropdown-divider"></li>
                              <li><a class="dropdown-item" href="#">Separated link</a></li>
                            </ul>
                          </div>
                        <div class="card text-center">
                           
                            <div class="card-body">
                              <h6 class="card-title greeniconcolor">Wygeneruj zaplanowany zakres roboczy <i class="fas fa-leaf"></i></h6>
                              <p class="card-text small grey600color text-left">Procesy technologiczne oraz faktyczna wartość wszystkich zamówień jest wiążąca na stan czasu generowania produkcji. Modyfikowanie pojedynczych zamówień nie jest już możliwe.</p>
                              <a href="#" class="btn btn-outline-dark btn-sm">Generuj i zleć do pracy<h6><i class="fas fa-lock grey600color"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-hourglass grey600color"></i>&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-play grey600color"></i></h6></a>
                              <p class="card-text small"></p>
                            </div>
                            
                          </div>
               


                    </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="list-group">
                <label class="list-group-item">
                  <input class="form-check-input me-1" type="checkbox" value="">
                  Zamówienia
                </label>
                <label class="list-group-item">
                  <input class="form-check-input me-1" type="checkbox" value="">
                  Kontrahenci
                </label>
              
              </div>
            
            <div class="card-body">
                
                    <div class="row mb-2">
                        <button class="btn btn-light mb-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample2" aria-controls="offcanvasExample">
                            <i class="fas fa-compress-arrows-alt"></i>&nbsp;Sprawdź informacje o zleceniu
                          </button>
                        
                        <div class="row mb-2">
                  

                            <select class="form-select" multiple aria-label="multiple select example">
                                <option selected>Open this select menu</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                              </select>
        
               
                
                                        
                        </div>   


                    </div>
            </div>
        </div>
    </div>





    <div class="col-lg-4">
    
        <div class="card-body mt-2">
            
          <h5 class="card-title"><i class="fas fa-print"></i> Grupa produktu</h5>
          
            
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <button type="button" class="btn-close btn-sm" aria-label="Close"></button>
              <div class="ms-2 me-auto">
                <div class="fw-bold">Subheading</div>
                Cras justo odio
              </div>
              <h5 class="blueiconcolor">14</h5>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <button type="button" class="btn-close btn-sm" aria-label="Close"></button>
              <div class="ms-2 me-auto">
                <div class="fw-bold">Subheading</div>
                Cras justo odio
              </div>
              <h5 class="blueiconcolor">14</h5>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <button type="button" class="btn-close btn-sm" aria-label="Close"></button>
              <div class="ms-2 me-auto">
                <div class="fw-bold">Subheading</div>
                Cras justo odio
              </div>
              <h5 class="blueiconcolor">14</h5>
            </li>
          
          
        </div>
      
    <div class="card shadow-lg border-0 rounded-lg mt-3">
        
        
        <div class="card-body">
            <div class="row mb-3">
              

                <select class="form-select" multiple aria-label="multiple select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>

   
    
                    <div class="row mt-4 ">
    
                       <div class="text-right">
                        {{-- <button type="submit" class="btn btn-dark" href="login.html"><h5><i class="fas fa-folder-plus"></i></h5>Wyczyść</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                        <button type="submit" class="btn btn-light" href="login.html"><h3><i class="fas fa-link"></i></h3>Połącz</button>	
                    </div>
                    </div>                       
            </div>   
    </div>
    </div>
</div>



<div class="col-lg-4">
    
    <div class="card-body mt-2">
        
      <h5 class="card-title"><i class="fas fa-chalkboard-teacher"></i> Stanowisko maszyny</h5>
      
        
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <button type="button" class="btn-close btn-sm" aria-label="Close"></button>
          <div class="ms-2 me-auto">
            <div class="fw-bold">Subheading</div>
            Cras justo odio
          </div>
          <h5 class="blueiconcolor">14</h5>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <button type="button" class="btn-close btn-sm" aria-label="Close"></button>
          <div class="ms-2 me-auto">
            <div class="fw-bold">Subheading</div>
            Cras justo odio
          </div>
          <h5 class="blueiconcolor">14</h5>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-start">
            <button type="button" class="btn-close btn-sm" aria-label="Close"></button>
          <div class="ms-2 me-auto">
            <div class="fw-bold">Subheading</div>
            Cras justo odio
          </div>
          <h5 class="blueiconcolor">14</h5>
        </li>
      
      
    </div>
  
<div class="card shadow-lg border-0 rounded-lg mt-3">
    
    <div class="card-body">
        <div class="row mb-3">
          

            <select class="form-select" multiple aria-label="multiple select example">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>



                <div class="row mt-4 ">

                   <div class="text-right">
                    {{-- <button type="submit" class="btn btn-dark" href="login.html"><h5><i class="fas fa-folder-plus"></i></h5>Wyczyść</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                    <button type="submit" class="btn btn-light" href="login.html"><h3><i class="fas fa-link"></i></h3>Połącz</button>	
                </div>
                </div>                       
        </div>   
</div>
</div>
</div>



<div class="col-lg-4">
    
        <div class="card-body mt-2">
            
          <h5 class="card-title"><i class="fas fa-inbox"></i> Grupy elementów</h5>
          
            
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <button type="button" class="btn-close btn-sm" aria-label="Close"></button>
              <div class="ms-2 me-auto">
                <div class="fw-bold">Subheading</div>
                Cras justo odio
              </div>
              <h5 class="blueiconcolor">14</h5>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <button type="button" class="btn-close btn-sm" aria-label="Close"></button>
              <div class="ms-2 me-auto">
                <div class="fw-bold">Subheading</div>
                Cras justo odio
              </div>
              <h5 class="blueiconcolor">14</h5>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <button type="button" class="btn-close btn-sm" aria-label="Close"></button>
              <div class="ms-2 me-auto">
                <div class="fw-bold">Subheading</div>
                Cras justo odio
              </div>
              <h5 class="blueiconcolor">14</h5>
            </li>
          
          
        </div>
      
    <div class="card shadow-lg border-0 rounded-lg mt-3">
        
        
        <div class="card-body">
                <div class="row mb-3">
                  

                    <select class="form-select" multiple aria-label="multiple select example">
                        <option selected>Open this select menu</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                      </select>

       
        
                        <div class="row mt-4 ">
        
                           <div class="text-right">
                            {{-- <button type="submit" class="btn btn-dark" href="login.html"><h5><i class="fas fa-folder-plus"></i></h5>Wyczyść</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; --}}
                            <button type="submit" class="btn btn-light" href="login.html"><h3><i class="fas fa-link"></i></h3>Połącz</button>	
                        </div>
                        </div>                       
                </div>   
        </div>
     
    </div>
</div>











</div>
@endsection




