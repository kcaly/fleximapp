@extends('layouts.app')
@section('content')



<div class="col-lg-12">
  <div class="card shadow-lg border-0 rounded-lg mt-5">
      <div class="card-header">
        @if (session()->has('message'))
              <div class="alert alert-info alert-dismissible fade show" role="alert">
              <h6>{{ Session::get('message') }} {{ Session::get('order_records') }}</h6>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
        @endif      
        <div class="row mb-3 font-weight-light my-4">
          <div class="col-md-6">
            <h4 class="text-center font-weight-light my-4">
              Produkcja<br>{{Session::get('date')}}         
            </h4>
          </div>
          <div class="col-md-6">
              <div class="form-floating mb-3 mb-md-0">
  
  
                <div class="row mb-3 font-weight-light my-4">
  
                  <div class="col-md-6">
                    <form method="post" action="{{ route('production')}}" >
                      @csrf
                      @method('put')
                      
                      <div class="form-floating mb-2">
                    
                        <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') ?? Session::get('date') }}" placeholder="Data (RRRR-MM-DD)" autofocus />
                        <label for="date">Data</label>
                                @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                        
                       
                    </div>



                  </div>
                  <div class="col-md-6">

                    <div class="form-floating mb-2">
                    
                      <select name="grupe" class="form-select" id="inputGroupSelect01">
                        <option value="1">Elementy</option>
                        <option value="2">Artykuły</option>
                        <option value="3">Produkty</option>
                    </select>
                    <label for="grupe">Grupa</label>
                            @error('grupe')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                      
                     
                  </div>

                  </div>
  
                </div>
              </div>

              
                
              {{-- <button type="submit" name="action" value="refresh" class="btn btn-light btn-sm" ><i class="fas fa-sync-alt"></i></button> --}}

              <button type="submit" name="action" value="generate" class="btn btn-primary btn-sm">Generuj</button>&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" name="action" value="load" class="btn btn-primary btn-sm">Wczytaj</button>

              <div class="form-check small mt-3">
                <input class="form-check-input" type="checkbox" name="refresh" value="1" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  {{-- <i class="fas fa-sync-alt"></i> --}}
                  <button type="submit" name="action" value="delete" class="btn btn-outline-danger btn-sm"><div class="small">Usuń</div></button>
                </label></div></form>
              </div>
             
              
          </div>

       
      </div>     




    
        
        <div class="card-body">

          

            <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col">Materiał</th>
                    
                    <th scope="col">Ilość</th>
                    <th scope="col">DŁ.</th>
                    <th scope="col">SZER.</th>
                    <th scope="col">WYS.</th>
                    <th scope="col"><i class="far fa-file-pdf"></i> PDF</i></th>
                    <th scope="col">Nazwa</th>
                  </tr>
                </thead>
                <tbody>
        
        
        @foreach (\App\Models\ElementJob::where('date_production', Session::get('date'))->orderBy('material_id', 'DESC')->orderBy('length', 'DESC')->orderBy('width', 'DESC')->orderBy('height', 'DESC')->get() as $element_job)
        <tr>
        <td></td>
        <td>{{$element_job->material->name}}</td>
        
        <td>{{$element_job->amount}}</td>

        <td>{{$element_job->length}}</td>
        <td>{{$element_job->width}}</td>
        <td>{{$element_job->height}}</td>
        <td><input type="hidden" value="{{$pdffile = $element_job->element->elementfiles->where('type', 'pdf')->first()}}">
          @if($element_job->element->elementfiles->where('type', 'pdf')->first()) 
          <a href="{{ Storage::url($pdffile->path) }}"><i class="	fas fa-search"></i></a>
          {{-- Dodać wyświetlenie PDF w osobnej karcie przeglądarki --}}
          @endif</td>
        <form method="get">
          @csrf
          <td><a href="{{route('element.edit', ['id' => $element_job->element_id]) }}" target="_blank"><div class="blackcolor">{{$element_job->element->name}}</div></a></td>
        </form>
        
        </tr>   
            
        @endforeach
        
        </tbody>
        </table> 





      </div>
      <div class="card-footer text-center py-3">
          
      </div>
    
  </div>
</div>






























@endsection
