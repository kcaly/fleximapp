@extends('layouts.app')
@section('content')



<div class="col-lg-12">
  <div class="card shadow-lg border-0 rounded-lg mt-4">
    

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
