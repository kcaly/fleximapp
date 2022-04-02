@extends('layouts.app')
@section('content')
<div class="row mb-3">




<div class="col-lg-4">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h4 class="text-center font-weight-light my-4">
                Zamówienie<br /><div class="small mt-3 greeniconcolor">@if ($order->status !=0) <i class="far fa-check-circle"></i> Wygenerowano @else @endif</div>
            </h4>
          </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-primary text-center" role="alert">         
                <h6>{{ Session::get('message') }}</h6>
                </div> 
            @endif

     



                <div class="row mb-3">
                    <form method="POST" action="{{ route('order.update') }}">
                        @csrf
                        @method('put')
                        <input name="id" value="{{ $order->id }}" type="hidden">
                        <input name="date" value="{{ $order->date }}" type="hidden">
                        <input name="date_production" value="{{ $order->date_production }}" type="hidden">
        
        
        
                        <div class="form-floating mb-4">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $order->name }}" placeholder="Nazwa"/>
                            <label for="name">Nazwa</label>
                                    @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                        </div>

                        <div class="form-floating mb-4">
                            <input id="date_order" type="date" class="form-control @error('date_order') is-invalid @enderror" name="date_order" value="{{ old('date_order') ?? $order->date_order }}" placeholder="Data zamówienia" disabled/>
                            <label for="date_order">Data zamówienia</label>
                                    @error('date_order')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                        </div>
                        
                        <div class="form-floating mb-4">
                            <input id="date_production" type="date" class="form-control @error('date_production') is-invalid @enderror" name="date_production" value="{{ old('date_production') ?? $order->date_production }}" placeholder="Data produkcji" @if ($order->status !=0) disabled @else @endif/>
                            <label for="date">Data produkcji</label>
                                    @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                        </div>
                        
                        <div class="row mt-4 mb-4">
        
                           <div class="text-right"><button type="submit" class="btn btn-primary" href="login.html"><i class="far fa-check-circle"></i> Zatwierdź</button></div>
                        </div>
                     
                    </form>
                      
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
                Szczegóły zamówienia
            </h4>
          </div>
        <div class="card-body">
            @if (session()->has('message'))
                <div class="alert alert-primary text-center" role="alert">         
                <h6>{{ Session::get('message') }}</h6>
                </div> 
            @endif



            <table class="table table-striped table-sm table-hover">
                <thead>
                  <tr>
                    <th scope="col">Ilość</th>
                    <th scope="col">Indeks</th>
                    <th scope="col">Nazwa</th>          
                    <th scope="col"><form method="get" action={{route('orders.products.new', ['order_id' => $order->id] )}} >
                        @csrf
                        @method('get')
                        <button type="submit" class="btn btn-primary btn-sm" @if ($order->status > 0) disabled @endif><i class="fas fa-plus"></i></button>
                    </form></th>
                    
                  </tr>
                </thead>
                <tbody>
                   
@foreach ($order_products as $product)
<tr>
  
    <td>{{ $product->pivot->amount }}</td>
    <td>{{ $product->id }}</td>
    <td><a href="{{route('product.details.show', ['id' => $product->id]) }}"><i class="	fas fa-search"></i></a> {{ $product->name}}</td>
    <td>
        <form method="get" action={{route('order.product.delete', ['order_id' => $product->pivot->order_id, 'product_id' => $product->pivot->product_id, 'amount' => $product->pivot->amount])}} >
            @csrf
            @method('get')
            <button type="submit" class="btn btn-danger btn-sm" @if ($order->status > 0) disabled @endif><i class="far fa-trash-alt"></i></button>
        </form>
    </td>
    
</tr>   
@endforeach
       
            </tbody>
        </table> 
                




                <div class="row mt-4 mb-4">

                   
                </div>
             

        </div>
        <div class="card-footer text-center py-3">
            
        </div>
    </div>
</div>

</div>


@endsection




