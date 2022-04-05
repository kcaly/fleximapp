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
                        <th scope="col"><button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-filter"></i> Filtruj</button></th>

                        <th scope="col">
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                            <label class="form-check-label" for="inlineCheckbox1"><i class="far fa-file-pdf"></i> PDF</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                            <label class="form-check-label" for="inlineCheckbox2"><i class="far fa-file"></i> DXF</label>
                          </div></th>
                        <th scope="col"><input type="text" class="form-control"></th>
                        <th scope="col"><input type="text" class="form-control"></th>
                        <th scope="col"><input type="text" class="form-control"></th>
                        <th scope="col">
                            <select class="form-select form-select-sm" aria-label="Default select example">
                                <option value="1">(=) Równe:</option>
                                <option value="2">(>) Większe od:</option>
                                <option value="3">(<) Mniejsze od:</option>
                                <option value="4">(>=) Większe lub równe:</option>
                                <option value="5">(<=) Mniejsze lub równe:</option>
                            </select>
                                <input type="text" class="form-control"></th>
                        <th scope="col">
                            <select class="form-select form-select-sm" aria-label="Default select example">
                                <option value="1">(=) Równe:</option>
                                <option value="2">(>) Większe od:</option>
                                <option value="3">(<) Mniejsze od:</option>
                                <option value="4">(>=) Większe lub równe:</option>
                                <option value="5">(<=) Mniejsze lub równe:</option>
                            </select>
                                <input type="text" class="form-control"></th>
                        <th scope="col">
                            <select class="form-select form-select-sm" aria-label="Default select example">
                                <option value="1">(=) Równe:</option>
                                <option value="2">(>) Większe od:</option>
                                <option value="3">(<) Mniejsze od:</option>
                                <option value="4">(>=) Większe lub równe:</option>
                                <option value="5">(<=) Mniejsze lub równe:</option>
                            </select>
                                <input type="text" class="form-control"></th>
                    </tr>
                    
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
      <a href="{{ Storage::url($pdffile->path) }}"><button class="btn btn-info btn-sm"><i class="far fa-file-pdf"></i></button></a>
      @endif
     
        <input type="hidden" value="{{$dxffile = $element->elementfiles->where('type', 'dxf')->first()}}">
        @if($element->elementfiles->where('type', 'dxf')->first())
        <a href="{{ Storage::url($dxffile->path) }}"><button class="btn btn-info btn-sm"><i class="far fa-file"></i></button></a>
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
            <tfoot>
            </tfoot>
        </table> 


        
      
        
        </div>
        <div class="card-footer text-center py-3 small">
            <div class="row font-weight-light small">
                <div class="col-md-1">
                    <form method="post" action="{{route('element.list.custom-size')}}">
                        @csrf
                        @method('post')
                        <select onchange="this.form.submit()" name="size" class="form-control form-control-sm" aria-label=".form-select-sm example">
                            <option selected>
                            Ilość /str.
                            </option>
                            <option value="10">10 elementów</option>
                            <option value="50">50 elementów</option>
                            <option value="100">100 elementów</option>
                            <option value="1000">1000 elementów</option>
                          </select> 
                        </form>
                </div>
                <div class="col-md-10">
                        {{ $elements->links() }}
                </div>
            </div>  
        </div>
    </div>
</div>



@endsection