@extends('layouts.app')
@section('content')



<div class="col-lg-12">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            


            <div class="row mb-3 font-weight-light my-4">
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <h5 class="text-center font-weight-light mb-md-0">
                            <i class="fas fa-couch"></i><i class="fas fa-chalkboard"></i><i class="fas fa-bars"></i> Lista produktów<br>
                            {{-- <span class="badge text-dark mb-2"><a href="{{route('product.import')}}"><button class="btn btn-outline-link btn-sm" ><i class="far fa-file-alt grey700color"></i> <i class="fas fa-exchange-alt grey700color"></i> <i class="far fa-hdd grey700color"></i></button></a></span><br>
                          </h5> --}}
                        
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">     
                    @if (session()->has('message'))
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <h6>{{ Session::get('message') }}</h6>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif           
                    </div>
                </div>
            </div>     
          </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col"><a href="{{route('product.new')}}"><i class="fas fa-plus"></i> Nowy produkt</a></th>
                    <th scope="col">ID</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
@foreach ($products as $product)
<tr>
    <td>
        <form method="get" action={{route('product.edit', ['id' => $product->id]) }} >
            @csrf
            @method('get')
            <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-sign-in-alt"></i></button></form>
    </td>
    <td>{{ $product->id }}</td>
    <td>{{ $product->name }}</td>
    <td>
        <form method="get" action={{route('product.details.show', ['id' => $product->id]) }} >
            @csrf
            @method('get')
            <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-wrench"></i>&nbsp;<i class="fas fa-sitemap"></i></button></form>
    </td>
    
</tr>
@endforeach
       
            </tbody>
        </table> 
        </div>
        <div class="card-footer text-center py-3 small">
            {{ $products->links() }}
        </div>
    </div>
</div>



@endsection