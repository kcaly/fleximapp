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
                    <form method="POST" action="{{ route('element.filter') }}">
                        @csrf
                        @method('post')

                        <th scope="col" style="width: 5%">
                        <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-filter"></i> Filtruj</button></th>

                        <th scope="col" style="width: 5%">

                            {{-- <div class="form-check form-check-inline">
                            <input name="pdf" class="form-check-input" type="checkbox" id="inlineCheckbox1">
                            <label class="form-check-label" for="inlineCheckbox1"><i class="far fa-file-pdf"></i> PDF</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input name="dxf" class="form-check-input" type="checkbox" id="inlineCheckbox2">
                            <label class="form-check-label" for="inlineCheckbox2"><i class="far fa-file"></i> DXF</label>
                          </div> --}}

                        </th>

                        <th scope="col" style="width: 10%">
                            <select name="material_id" class="form-select">
                                <option selected value="{{$active_filter['material_id']}}">
                                    
                                    @if (isset($active_filter['material_id']))
                                    @if ($active_filter['material_id'] != 0)

                                    {{\App\Models\Material::find($active_filter['material_id'])->name}}
                                    <option value="0"></option>
                                    
                                    @else
                                    
                                    @endif
                                    @endif
                                </option>
                               
                                @foreach(\App\Models\Material::all() as $material)
                                <option value="{{ $material->id }}">{{ $material->name }}</option>
                                @endforeach
                            </select>
                        </th>


                        <th scope="col" style="width: 18%">
                            <select name="job_group" class="form-select">
                                {{-- <option selected value="{{$active_filter['material_id']}}">
                                    
                                    @if (isset($active_filter['material_id']))
                                    @if ($active_filter['material_id'] != 0)

                                    {{\App\Models\Material::find($active_filter['material_id'])->name}}
                                    <option value="0"></option>
                                    
                                    @else
                                    
                                    @endif
                                    @endif
                                </option>
                               
                                @foreach(\App\Models\Material::all() as $material)
                                <option value="{{ $material->id }}">{{ $material->name }}</option>
                                @endforeach --}}
                            </select>
                        </th>



                        <th scope="col" style="width: 8%"><input name="id" type="text" class="form-control" value="{{$active_filter['id']}}"></th>

                        <th scope="col" style="width: 20%"><input name="name" type="text" class="form-control" value="{{$active_filter['name']}}"></th>

                        <th scope="col" style="width: 8%">
                            <select name="length_type" class="form-select form-select-sm">
                                <option selected>
                                    @if (isset($active_filter['length_type']))
                                    {{$active_filter['length_type']}}
                                    @else
                                    =
                                    @endif
                                </option>
                                <option value="=">(=) Równe:</option>
                                <option value=">">(>) Większe od:</option>
                                <option value="<">(<) Mniejsze od:</option>
                                <option value=">=">(>=) Większe lub równe:</option>
                                <option value="<=">(<=) Mniejsze lub równe:</option>
                            </select>
                                <input name="length_value" type="text" class="form-control" value="{{$active_filter['length_value']}}"></th>

                        <th scope="col" style="width: 8%">
                            <select name="width_type" class="form-select form-select-sm">
                                <option selected>
                                    @if (isset($active_filter['width_type']))
                                    {{$active_filter['width_type']}}
                                    @else
                                    =
                                    @endif
                                </option>
                                <option value="=">(=) Równe:</option>
                                <option value=">">(>) Większe od:</option>
                                <option value="<">(<) Mniejsze od:</option>
                                <option value=">=">(>=) Większe lub równe:</option>
                                <option value="<=">(<=) Mniejsze lub równe:</option>
                            </select>
                                <input name="width_value" type="text" class="form-control" value="{{$active_filter['width_value']}}"></th>

                        <th scope="col" style="width: 8%">
                            <select name="height_type" class="form-select form-select-sm" >
                                <option selected>
                                    @if (isset($active_filter['height_type']))
                                    {{$active_filter['height_type']}}
                                    @else
                                    =
                                    @endif
                                </option>
                                <option value="=">(=) Równe:</option>
                                <option value=">">(>) Większe od:</option>
                                <option value="<">(<) Mniejsze od:</option>
                                <option value=">=">(>=) Większe lub równe:</option>
                                <option value="<=">(<=) Mniejsze lub równe:</option>
                            </select>
                                <input name="height_value" type="text" class="form-control" value="{{$active_filter['height_value']}}">
                        </th>

                        <th scope="col" style="width: 10%">
                            <select name="machine_id" class="form-select">
                                {{-- <option selected value="{{$active_filter['material_id']}}">
                                    
                                    @if (isset($active_filter['material_id']))
                                    @if ($active_filter['material_id'] != 0)

                                    {{\App\Models\Material::find($active_filter['material_id'])->name}}
                                    <option value="0"></option>
                                    
                                    @else
                                    
                                    @endif
                                    @endif
                                </option>
                               
                                @foreach(\App\Models\Material::all() as $material)
                                <option value="{{ $material->id }}">{{ $material->name }}</option>
                                @endforeach --}}
                            </select>
                        </th>

                    </tr>
                    </form>

                    <tr>
                    <th scope="col"><a href="{{route('element.new')}}"><i class="fas fa-plus"></i></a></th>
                    <th scope="col">PDF/DXF</th>
                    <th scope="col">Materiał</th>
                    <th scope="col">Grupa</th>
                    <th scope="col">ID</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col">DŁ</th>
                    <th scope="col">SZER</th>
                    <th scope="col">WYS</th>
                    <th scope="col">Maszyna</th>
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
      <a href="{{ Storage::url($pdffile->path) }}"><button class="btn btn-link btn-sm"><i class="far fa-file-pdf"></i></button></a>
      @else
      <button class="btn btn-link" disabled></button>
      @endif
     
        <input type="hidden" value="{{$dxffile = $element->elementfiles->where('type', 'dxf')->first()}}">
        @if($element->elementfiles->where('type', 'dxf')->first())
        <a href="{{ Storage::url($dxffile->path) }}"><button class="btn btn-link btn-sm"><i class="far fa-file"></i></button></a>
        @endif
      </td>
    <td>{{ $element->material->name }}</td>
    <td>Oparcia</td>
    <td>{{ $element->id }}</td>
    <td>{{ $element->name }}</td>
    <td>{{ $element->length }}</td>
    <td>{{ $element->width }}</td>
    <td>{{ $element->height }}</td>
    <td>OFS-HE3</td>
    

</tr>   
@endforeach
       
            </tbody>
            <tfoot>
            </tfoot>
        </table> 
        </div>

        {{-- <div class="card-footer text-center py-3 small">
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
        </div> --}}

        <div class="card-footer text-center py-3 small">
            {{ $elements->links() }}
        </div>
    </div>
</div>



@endsection