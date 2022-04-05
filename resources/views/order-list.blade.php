@extends('layouts.app')
@section('content')



<div class="col-lg-12">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            


            <div class="row mb-3 font-weight-light my-4">
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <h4 class="text-center font-weight-light my-4">
                            Lista zamówień
                        </h4>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">     
                    @if (session()->has('message'))
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
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
                    <th scope="col"><a href="{{route('order.new')}}"><i class="fas fa-plus"></i></a></th>
                    <th scope="col"></th>
                    <th scope="col">Nazwa</th>
                    <th scope="col">Data zam.</th>
                    <th scope="col">Data prod.</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
@foreach ($orders as $order)
<tr>
    <td>
        <form method="get" action={{route('order.edit', ['id' => $order->id]) }} >
            @csrf
            @method('get')
            <button type="submit" class="btn btn-light btn-sm"><i class="fas fa-info"></i></button></form>
    </td>
    <td>@if ($order->date_production == null)
        <i class="fas fa-circle rediconcolor"></i>
    @else
    @if ($order->status < 1)
    <i class="fas fa-circle greeniconcolor"></i>
    @else
    <i class="far fa-check-circle greeniconcolor"></i>
    @endif
    @endif</td>
    <td>{{ $order->name }}</td>
    <td>{{ $order->date_order}}</td>
    <td>{{ $order->date_production}}</td>
    <td>
        <form method="get" action={{route('order.details.show', ['id' => $order->id]) }} >
            @csrf
            @method('get')
            <button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-dice-d6"></i>&nbsp;<i class="fas fa-dolly-flatbed"></i></button></form>
    </td>
    
</tr>
@endforeach
       
            </tbody>
        </table> 
        </div>
        <div class="card-footer text-center py-3 small">
            {{ $orders->links() }}
        </div>
    </div>
</div>



@endsection