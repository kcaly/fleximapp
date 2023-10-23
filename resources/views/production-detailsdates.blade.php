@extends('layouts.app')
@section('content')

  <div class="mt-1">
    <div class="card shadow-lg border-0 rounded-lg bg-light my-2">
      <div class="card-header">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item small active"><i class="fas fa-toolbox"></i>&nbsp;&nbsp;<a href="{{route('production.panel')}}">Produkcja</a></li>
            <li class="breadcrumb-item small active" aria-current="page"><strong>{{$date_start}} — {{$date_end}}</strong></li>
          </ol>
        </nav>
        <div class="row">
          <div class="col-md-7">

          </div>
          <div class="col-md-5">
        @if (session()->has('message'))
        <div class="alert alert-light alert-dismissible fade show mt-1 mb-2" role="alert">
          <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
            </symbol>
          </svg>
          <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
  
    {{ Session::get('message') }} {{ Session::get('order_records') }}
  
        
        <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
  @endif   
      </div>
       
      </div>
      <div class="row text-right">
      <button class="btn btn-light border-0 bg-transparent text-muted" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        <i class="fas fa-arrows-alt-v"></i> <i class="far fa-window-maximize"></i>
      </button>
    </div>
    <div class="collapse" id="collapseExample">
      <div class="border-bottom-0">

        <div class="border-bottom-0">
        
     
      
           
          <div class="row mb-3 font-weight-light">
            
            <div class="col-md-6">
              <div class="row mb-3 font-weight-light">
                           
                <div class="col-md-6">
                  <form method="post" action="{{route('data.elementproduction') }}" >
                    @csrf
                    @method('post')
                    <input name="temp_date" value="{{Session::get('date')}}" type="hidden">
                    <div class="row">
                    <h6 class="text-left font-weight-light mt-4 mb-1 grey800color">
                      <i class="fas fa-drafting-compass grey700color"></i>&nbsp;&nbsp;<strong>Przeglądaj rekordy</strong>
                    </h6>  </div>
                    <div class="row">
                    <div class="col-md-6">
                    <div class="form mb-2">
                      <label for="date_start" class="small mt-2 mb-1 text-muted">Data od:</label>
                      <input id="date_start" type="date" class="form-control @error('date_start') is-invalid @enderror" name="date_start" value="{{ old('date_start') ?? $date_start }}" placeholder="Data (RRRR-MM-DD)" autofocus />
                      
                              @error('date_start')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                              @enderror
                      
                     
                  </div>
                    </div>
                    <div class="col-md-6">
                  <div class="form mb-2">
                    <label for="date_end" class="small mt-2 mb-1 text-muted">do:</label>
                    <input id="date_end" type="date" class="form-control @error('date_end') is-invalid @enderror" name="date_end" value="{{ old('date_end') ?? $date_end }}" placeholder="Data (RRRR-MM-DD)" autofocus />
                    
                            @error('date_end')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                    
                  </div>
                </div>
                </div>
    
    
                </div>
                <div class="col-md-6">
                    
                      
    
    
                    
    
                  </div>
                
                 
                    <div class="d-flex justify-content mt-2">
                    
                    <button type="submit" value="loadmass" class="btn btn-outline-dark btn-sm">Wczytaj</button>
                    </div>
             
    
          
                  </form>
                    
                  
                
    
                  
              </div>
              
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3 mt-2 mb-md-0">
                  <h6 class="text-left font-weight-light mb-3 grey800color">
                    <i class="fas fa-database grey700color"></i>&nbsp;&nbsp;<strong>Generowanie danych</strong>  
                  </h6>   
    
                  <div class="row mb-3 font-weight-light mb-4">
                   
                    <div class="col-md-5">
                      <form method="post" action="{{ route('production')}}" >
                        @csrf
                        @method('put')
                        
                        <div class="form-floating">
                      
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
    
                      <div class="form-floating">
                      
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
    
                <button type="submit" name="action" value="generate" class="btn btn-primary btn-sm">Generuj</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="action" value="load" class="btn btn-primary btn-sm">Wczytaj</button>
    
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

     
      </div>








    </div>
      </div>

     


      

      <div class="card-body mt-2">


        <table class="table table-sm table-striped table-bordered small" id="elementproduction">        

            <thead class="">
                <tr>
                    <th>Data</th>
                    <th>Materiał</th>
                    {{-- <th>Waga</th> --}}
                    <th>Ilość</th>
                    <th>Kod(E)</th>
                    <th>Nazwa</th>
                    <th>X(dł.)</th>
                    <th>Y(szer.)</th>
                    <th>Z(wys.)</th>
                    <th>Artykuł</th>
                    <th>Produkt</th>
                    <th>Zamówienie</th>
                    {{-- <th>Maszyna</th>
                    <th>Grupa</th> --}}
                </tr>                                
            </thead>
        </table>

        <script>
            $(function() {
               
                






                $('#elementproduction').DataTable({
                    processing: true,
                    serverSide: true,
                    pageLength: 25,
                    
                    
                    ajax : '{!! route('DataElementProduction', ['date_start'=>$date_start, 'date_end'=>$date_end]) !!}',
                
               
                    columns: [
                        
                       
                        {data: 'date_production', name: 'date_production'}, 
                        {data: 'material', name: 'material'}, 
                        // {data: 'weight', name: 'weight'}, 

                        {data: 'amount', name: 'amount'}, 
                        {data: 'element.code', name: 'element.code' },
                        {data: 'element.name', name: 'element.name'},

                        {data: 'element.length', name: 'element.length'},
                        {data: 'element.width', name: 'element.width'},
                        {data: 'element.height', name: 'element.height'},                             
                        
                        {data: 'article_info', name: 'articel_info'},
                        {data: 'product_info', name: 'product_info'},
                        {data: 'order_info', name: 'order_info'},

                        // {data: 'machine', name: 'machine'}, 
                        // {data: 'job_group', name: 'job_group'},
                    ]
                });
            });
            </script>

    </div>


</div>
     
        </div>

@endsection
