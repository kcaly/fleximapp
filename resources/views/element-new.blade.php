@extends('layouts.app')
@section('content')
    
<div class="col-lg-6">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h4 class="text-center font-weight-light my-4">
                Nowy element 
            </h4>
          </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-primary text-center" role="alert">         
                <h6>{{ Session::get('message') }}</h6>
                </div> 
            @endif

            <form enctype="multipart/form-data" method="POST" action="{{ route('element.create') }}">
                {{ csrf_field() }}
                



                <div class="form-floating mb-4">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Nazwa" autofocus />
                    <label for="name">Nazwa</label>
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                </div>
                

                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-floating mb-3 mb-md-0">
                            <input id="length" type="text" class="form-control @error('length') is-invalid @enderror" name="length" value="{{ old('length') }}" autofocus placeholder="Długość" />
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
                            <input id="width" type="text" class="form-control @error('width') is-invalid @enderror" name="width" value="{{ old('width') }}" autofocus placeholder="Szerokość" />
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
                            <input id="height" type="text" class="form-control @error('height') is-invalid @enderror" name="height" value="{{ old('height') }}" autofocus placeholder="Wysokość" />
                            <label for="height">Wysokość</label>
                            @error('height')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3"></div>

                <div class="form-floating mb-4">
                    <select name="material_id" class="form-select" id="inputGroupSelect01">
                        @foreach (\App\Models\Material::all() as $material)
                        <option value="{{ $material->id }}">{{ $material->name }}</option>
                        @endforeach
                    </select>
                    <label for="material_id">Materiał</label>
                            @error('material_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                </div>


                <div class="form-floating mb-4">

                    <div class="input-group mb-3">
  
                        <label name ="pdf" class="input-group-text" for="pdf">PDF</label>
                        <input id="pdf" name="pdf" type="file" class="form-control" placeholder="Plik PDF" />
                         
    
                    </div>
                </div>

                <div class="form-floating mb-4">

                    <div class="input-group mb-3">
  
                        <label name ="dxf" class="input-group-text" for="pdf">DXF</label>
                        <input id="dxf" name="dxf" type="file" class="form-control" placeholder="Plik DXF" />
                         
    
                    </div>
                </div>


                <div class="row mb-3"></div>








                <div class="row mt-4 mb-4">

                   <div class="text-right"><button type="submit" class="btn btn-primary btn-lg" href="login.html"><i class="far fa-check-circle"></i> Zatwierdź</button></div>
                </div>
             
            </form>
        </div>
        <div class="card-footer text-center py-3">
            
        </div>
    </div>
</div>

@endsection




