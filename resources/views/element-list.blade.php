@extends('layouts.app')
@section('content')



<div class="col-lg-12">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            


            <div class="row mb-3 font-weight-light my-4">
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <h4 class="text-center font-weight-light my-4">
                            Lista elementów
                        </h4>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">     
                    @if (session()->has('message'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
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
                    <th scope="col"><a href="{{route('element.new')}}"><i class="fas fa-plus"></i></a></th>
                    <th scope="col"></th>
                    <th scope="col">Materiał</th>
                    <th scope="col">ID</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col">DŁ</th>
                    <th scope="col">SZER</th>
                    <th scope="col">WYS</th>
                  </tr>
                </thead>
                <tbody>
@foreach ($elements as $element)	
<tr>
    <td>
        <form method="get" action={{route('element.edit', ['id' => $element->id]) }} >
            @csrf
            @method('get')
            <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-sign-in-alt"></i></button></form>
    </td>
    <td>  
    <input type="hidden" value="{{$pdffile = $element->elementfiles->where('type', 'pdf')->first()}}">
      @if($element->elementfiles->where('type', 'pdf')->first())
      <a href="{{ Storage::url($pdffile->path) }}"><button class="btn btn-info btn-sm"><i class="far fa-file-pdf"></i> PDF</i></button></a>
      @endif
     
        <input type="hidden" value="{{$dxffile = $element->elementfiles->where('type', 'dxf')->first()}}">
        @if($element->elementfiles->where('type', 'dxf')->first())
        <a href="{{ Storage::url($dxffile->path) }}"><button class="btn btn-info btn-sm"><i class="far fa-file"></i> DXF</i></button></a>
        @endif
      </td>
    <td>{{ $element->material->name }}</td>
    <td>{{ $element->id }}</td>
    <td>{{ $element->name }}</td>
    <td>{{ $element->length }}</td>
    <td>{{ $element->width }}</td>
    <td>{{ $element->height }}</td>

    

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