@extends('layouts.app')
@section('content')
    
<div class="col-lg-6">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h4 class="text-center font-weight-light my-4">
                Edytuj produkt <br />ID {{ $product->id}}
            </h4>
          </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-primary text-center" role="alert">         
                <h6>{{ Session::get('message') }}</h6>
                </div> 
            @endif

            <form method="POST" action="{{ route('product.update') }}">
                @csrf
                @method('put')
                <input name="id" value="{{ $product->id }}" type="hidden">



                <div class="form-floating mb-4">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $product->name }}" placeholder="Nazwa" />
                    <label for="name">Nazwa</label>
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                </div>
                
                



                <div class="row mt-4 mb-4">

                   <div class="text-right"><button type="submit" class="btn btn-primary btn-lg" href="login.html"><i class="far fa-check-circle"></i> Zatwierdź</button></div>
                </div>
             
            </form>

            <div class="form-floating mb-4">
                <div class="input-group mb-3">
                 

                    <form method="get" action={{ route('product.delete', ['id' => $product->id]) }}>
                        @csrf             
                         <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-ban"></i> Usuń trwale produkt</button>
                     </form>  

                </div>
            </div>
        </div>
        <div class="card-footer text-center py-3">
            
        </div>
    </div>
</div>

@endsection




