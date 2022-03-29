@extends('layouts.app')
@section('content')
<div class="row mb-3">




<div class="col-lg-4">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h4 class="text-center font-weight-light my-4">
                Zamówienie
            </h4>
          </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-primary text-center" role="alert">         
                <h6>{{ Session::get('message') }}</h6>
                </div> 
            @endif

            <form method="POST" action="{{ route('orders_products.add') }}">
                @csrf
                @method('put')

                  <input name="order_id" value="{{$order->id}}" type="hidden">
                  <div class="form-floating">
                    <input id="order_id" type="text" class="form-control" value="{{$order->name}}" placeholder="Zamówienie" disabled/>
                    <label for="order_id">Nazwa</label>
                </div>
              
           
        </div>
        <div class="card-footer text-center py-3">
            
        </div>
    </div>
</div>



<div class="col-lg-8">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h4 class="text-center font-weight-light my-4">
                Dodaj produkt
            </h4>
          </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-primary text-center" role="alert">         
                <h6>{{ Session::get('message') }}</h6>
                </div> 
            @endif



            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-floating mb-3 mb-md-0">
                        <input id="amount" type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required autocomplete="amount" autofocus placeholder="Ilość" />
                        <label for="amount">Ilość</label>
                        @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-9">                  
                        <div class="form-floating">
                            
                            <select name="product_id" class="form-select" id="floatingSelect" aria-label="Wybierz produkt">
                                
                                
                              <option selected></option>
                              @foreach (\App\Models\Product::all() as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                                
                            </select>
                            <label for="floatingSelect">Wybierz produkt</label>
                          </div>         
                </div>
            </div>


            <div class="row mb-3">
                
            </div>
                




                <div class="row mt-4 mb-4">

                   <div class="text-right"><button type="submit" class="btn btn-primary btn-lg" href="login.html"><i class="far fa-check-circle"></i> Zatwierdź</button></div>
                </div>
             
            </form>
        </div>
        <div class="card-footer text-center py-3">
            
        </div>
    </div>
</div>

</div>


@endsection




