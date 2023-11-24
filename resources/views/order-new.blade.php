@extends('layouts.app')
@section('content')



<div class="col-lg-6">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h4 class="text-center font-weight-light my-4">
                Nowe zamówienie
            </h4>
          </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-primary text-center" role="alert">         
                <h6>{{ Session::get('message') }}</h6>
                </div> 
            @endif

            <form method="POST" action="{{ route('order.create') }}">
                @csrf
                @method('put')

                <div class="form-floating mb-4">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nazwa" autofocus required />
                    <label for="name">Nazwa</label>
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                </div>

                <div class="form-floating mb-4">
                    
                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') ?? date("Y-m-d")}}" placeholder="Data (RRRR-MM-DD)" autofocus required />
                    <label for="date">Data zamówienia</label>
                            @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                                  
                </div>

                {{-- <div class="row mb-3">
                    
                    <div class="col-md-9">
                        
                        <input id="csv" name="csv" type="file" class="form-control" placeholder="Plik CSV" />
                        
                    </div>
                    <div class="col-md-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Import CSV</label>
                          </div>
                    </div>

                </div> --}}


                <div class="row mt-4 mb-4">

                   <div class="text-right"><button type="submit" class="btn btn-primary btn-lg" ><i class="far fa-check-circle"></i> Zatwierdź</button></div>
                </div>
             
            </form>
        </div>
        <div class="card-footer text-center py-3">
            
        </div>
    </div>
</div>

@endsection




