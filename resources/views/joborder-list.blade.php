@extends('layouts.app')
@section('content')

<div class="mt-1">
  <div class="card shadow-lg border-0 rounded-lg bg-light my-2">
      <div class="card-header small text-muted">
        <i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Zlecenia produkcyjne     
      </div>
        <div class="card-body">
          <nav class="navbar navbar-expand-lg navbar-light bg-light border rounded">
            <div class="container-fluid">
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"><h5 class="mt-2">{{Session::get('dates')}}</h5></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">@if(Session::get('title') != null)<h4 class="mt-1 grey600color"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;{{Session::get('title')}}</h4>@endif</a>                  
                  </li>
                </ul>
                
                  
                
                
                  {{-- <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0" method="post" action="{{route('job.search')}}" >
                    @csrf
                    @method('put')
                    <div class="input-group">
                        <input name="search" class="form-control border border-secondary border-1 rounded-start" type="text" placeholder="" aria-label=".form-control-sm example" aria-describedby="btnNavbarSearch" />
                        <button class="btn btn-lg btn-outline-secondary border border-secondary border-1 border-start-0" id="btnNavbarSearch" type="button"><i class="fas fa-pencil-ruler"></i></button>
                    </div>
               
                </form> --}}




              </div>
            </div>
          </nav>
          @foreach (\App\Models\JobOrder::where('production_id', Session::get('prod_id'))->select('date_production')->distinct()->orderBy('date_production', 'ASC')->get() as $date)
          <div class="row mt-1 bg-transparent text-dark">
            
            <div class="col-md-6">
              <button class="btn" disabled><h5>&nbsp;<i class="far fa-calendar"></i>&nbsp;&nbsp;{{$date->date_production}}</h5></button>
              
            </div>
            <div class="col-md-4">
         
            </div>
            <div class="col-md-2">

            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              
              @foreach (\App\Models\JobOrder::where('production_id',Session::get('prod_id'))->where('date_production', $date->date_production)->orderBy('date_production', 'ASC')->get() as $job)

              {{-- class="list-group-item list-group-item-action active"  KLASA ZMIANY KOLORU NA NIEBIESKI --}}
              
              {{-- @if ($production->status == 2 && $production->done == $production->sum_elements)
              <a href="{{route('production.select', ['id' => $production->id ])}}" class="list-group-item list-group-item-action active border border-success bg-success border border-dark">
              @endif --}}
              <form method="post" action="{{route('job.open')}}" >
                @csrf
                @method('put')
                <input name="job_id" type="hidden" value="{{$job->id}}">
                <input name="job_status" type="hidden" value="{{$job->status}}">
                <input name="user_id" type="hidden" value="{{Auth::user()->id}}">
              @if($job->protection_user_id != null || $job->protection_user_id != 0)
              @if($job->protection_user_id != Auth::user()->id)
              <button class="list-group-item list-group-item-action bg-dark" disabled>
              @endif
              @if ($job->protection_user_id == Auth::user()->id)
              @if ($job->done != $job->sum_elements_amount - \App\Models\ElementJob::where('job_order_id', $job->id)->where('status', 10)->select('sum_amount')->sum('sum_amount'))
              <button class="list-group-item list-group-item-action">
              @else
              <button class="list-group-item list-group-item-action bg-secondary">
              @endif
              @endif
              @else
              @if ($job->done != $job->sum_elements_amount - \App\Models\ElementJob::where('job_order_id', $job->id)->where('status', 10)->select('sum_amount')->sum('sum_amount'))
              <button class="list-group-item list-group-item-action">
              @else
              <button class="list-group-item list-group-item-action bg-secondary">
              @endif
              @endif

                @if ($job->done != $job->sum_elements_amount - \App\Models\ElementJob::where('job_order_id', $job->id)->where('status', 10)->select('sum_amount')->sum('sum_amount'))
                <div class="row d-flex w-100 justify-content-between my-2">
                @else
                <div class="row d-flex w-100 justify-content-between my-2">
                @endif
                  <div class="col-md-2 small">
                    {{-- Flaga, gdy zlecenie jest wolne
                    <h4><i class="far fa-flag"></i></h4>
                    Flaga, gdy zlecenie jest zajęte lub rozpoczęte ale nie skończone
                    <h4><i class="fas fa-flag"></i></h4>
                    Flaga, gdy zlecenie jest gotowe
                    <h4><i class="fas fa-flag-checkered"></i></h4> --}}
                  </div>
                  <div class="col-md-2">
                    <div class="text-left">
                      <h5>{{ $job->done}} / {{$job->sum_elements_amount - (\App\Models\ElementJob::where('job_order_id', $job->id)->where('status', 10)->select('sum_amount')->sum('sum_amount'))}}</h5>
                    </div>
                    
                  {{-- <small class="">
                    <button href="#" class="btn btn-light"><i class="fas fa-clipboard-check"></i> Checklisty</button>
                    <button href="{{route('production.select', ['id' => $production->name ])}}" class="btn btn-light"><i class="fab fa-digital-ocean"></i> Otwórz</button>
                  </small> --}}
                 
                  </div>
                  <div class="col-md-8">
                    <h5 class="text-left mb-2">{{$job->job_group->name}}</h5>
                </div>
               
                
                
              </div> 
              <div class="row my-2">
                <div class="col-md-4">
                  @if (\App\Models\ElementJob::where('job_order_id', $job->id)->where('status', 10)->count() > 0)
                  <small class="text-dark"><i class="fas fa-code-branch"></i> {{\App\Models\ElementJob::where('job_order_id', $job->id)->where('status', 10)->select('done')->sum('done')}} / {{\App\Models\ElementJob::where('job_order_id', $job->id)->where('status', 10)->select('sum_amount')->sum('sum_amount')}}</small>
                  @endif
              </div>
                <div class="col-md-8">
                  <div class="text-left text-black text-muted">
                    
                    {{-- <i class="fas fa-user-lock"></i>&nbsp;&nbsp;

                    <i class="fas fa-user-clock"></i>&nbsp;&nbsp; --}}

                    

                    {{-- <i class="fas fa-flag-checkered"></i>&nbsp;&nbsp; --}}

                    

                   
                    
                    
                      @if ($job->done != $job->sum_elements_amount - \App\Models\ElementJob::where('job_order_id', $job->id)->where('status', 10)->select('sum_amount')->sum('sum_amount'))
                      @if($job->protection_user_id != null || $job->protection_user_id != 0)
                      <h6><i class="fas fa-user-lock"></i>&nbsp;&nbsp;Zablokowane przez <strong>{{\App\Models\User::find($job->protection_user_id)->tag_user}}</strong> <small>(w trakcie pracy)</small></h6>
                      @endif

                      {{-- Tech002 jest zalogowany (nieaktywny) --}}
                      @if($job->protection_user_id == null || $job->protection_user_id == 0)
                      <h6><i class="fas fa-unlock-alt"></i>&nbsp;&nbsp;Otwarte <small>(zaloguj do wykonania)</small></h6>
                      @endif
                      @else
                      @if($job->protection_user_id != null || $job->protection_user_id != 0 || $job->protection_user_id == Auth::user()->id)
                      <h6 class="text-white"><i class="far fa-check-circle"></i>&nbsp;&nbsp;Zakończone (zablokowane przez {{\App\Models\User::find($job->protection_user_id)->tag_user}})</h6>
                      @endif
                      @if($job->protection_user_id == null || $job->protection_user_id == 0)
                      <h6 class="text-white"><i class="far fa-check-circle"></i>&nbsp;&nbsp;Zakończone</h6>
                      @endif
                      @endif
                    
                  </div>
                </div>
              </div>
            </button>
          </form>
              
              @endforeach

              </div>
          </div>
          @endforeach
        </div>   
  </div>
</div>
@endsection
