@extends('layouts.app')
@section('content')


<div class="row mb-3">

    <div class="col-lg-6">


        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h4 class="text-center font-weight-light my-4">
                    Edytuj element <br />ID {{ $element->id}}
                </h4>
              </div>
            <div class="card-body">
                @if (session()->has('message'))
                    <div class="alert alert-primary text-center" role="alert">         
                    <h6>{{ Session::get('message') }}</h6>
                    </div> 
                @endif
    
                <form enctype="multipart/form-data" method="POST" action="{{ route('element.update') }}">
                    {{ csrf_field() }}
                    
                    <input name="id" value="{{ $element->id }}" type="hidden">
    
    
    
                    <div class="form-floating mb-4">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $element->name }}" placeholder="Nazwa" />
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
                                <input id="length" type="text" class="form-control @error('length') is-invalid @enderror" name="length" value="{{ old('length') ?? $element->length }}" placeholder="Długość" />
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
                                <input id="width" type="text" class="form-control @error('width') is-invalid @enderror" name="width" value="{{ old('width') ?? $element->width }}" placeholder="Szerokość" />
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
                                <input id="height" type="text" class="form-control @error('height') is-invalid @enderror" name="height" value="{{ old('height') ?? $element->height }}" placeholder="Wysokość" />
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


                    <div class="row mb-3">
                        <div class="col-md-3">
                            <div class="form-floating mb-3 mb-md-0">
                                <input id="weight" type="text" class="form-control @error('weight') is-invalid @enderror" name="weight" value="{{ old('weight') ?? $element->weight }}" placeholder="Waga (kg)" disabled/>
                                <label for="weight">Waga (kg)</label>
                                @error('weight')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-floating mb-3 mb-md-0">
                                <select name="material_id" class="form-select" id="inputGroupSelect01" value="{{ old('material_id') ?? $element->material_id }}">
                                    <option selected value="{{$element->material_id}}">{{ $element->material->name }}</option>
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
                        </div>

                    </div>















                    
                    <div class="form-floating mb-4">
                        

                    </div>


                    <div class="form-floating mb-4">
                        <div class="input-group mb-3">
                            
                            @if($element->elementfiles->where('type', 'pdf')->first())

                            

                            @else
                            <label name ="pdf" class="input-group-text" for="pdf">PDF</label>
                            <input id="pdf" name="pdf" type="file" class="form-control" placeholder="Plik PDF" />
                            @endif
        
                        </div>
                    </div>
                        <div class="form-floating mb-4">
                            <div class="input-group mb-3">
                                @if($element->elementfiles->where('type', 'dxf')->first())

                                @else

                                <label name ="dxf" class="input-group-text" for="pdf">DXF</label>
                                <input id="dxf" name="dxf" type="file" class="form-control" placeholder="Plik DXF" />
                                @endif      
            
                            </div>
                        </div>

                    


                    <div class="row mb-3"></div>

                    <div class="row mt-4 mb-4">
                               <div class="text-right"><button type="submit" class="btn btn-primary btn-lg" href="login.html"><i class="far fa-check-circle"></i> Zatwierdź</button></div>
                    </div>
                 
                </form>

              
                @if($element->elementfiles->where('type', 'pdf')->first())

        
                <form method="post" action={{ route('elementfilepdf.delete', ['id' => $element->id ]) }}>
                    @csrf             
                     <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-file-excel"></i> Usuń plik PDF</button>
                 </form>          
                            @else
                            @endif


                            <div class="row mb-3"></div>
                            
                            @if($element->elementfiles->where('type', 'dxf')->first())
            
                    
                            <form method="post" action={{ route('elementfiledxf.delete', ['id' => $element->id ]) }}>
                                @csrf             
                                 <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-file-excel"></i> Usuń plik DXF</button>
                             </form>          
                            @else
                                        
                                        @endif
            


                



            </div>
            <div class="card-footer text-center py-3">
                
            </div>
        </div>

 </div>


<div class="col-lg-6">

    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h4 class="text-center font-weight-light my-4">
         
            </h4>
          </div>
        <div class="card-body">
       
            <table class="table table-striped table-sm table-hover">
                <thead>
                  <tr>
                    <th scope="col"><i class="fas fa-exclamation-triangle"></i> Tworzy strukturę dla artykułów: </th>
                  </tr>
                </thead>
                
                    
                
                <tbody>
                    <tr>
                        @foreach ($articles as $article)
                        @foreach ($article->elements as $element_in_article)
                            @if($element_in_article->id != $element->id)
                            @else
                                <td>
                                    <a href="{{route('article.details.show', ['id' => $article->id]) }}"><i class="	fas fa-search"></i></a> {{ $article->name }}</td>          
                                </td>
                            @endif
                        @endforeach
                    </tr>   
                    @endforeach
            </tbody>
        </table>
        
        <form method="get" action="{{ route('element.delete', ['id' => $element->id])}}" >
            @csrf
            @method('get')
            <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-ban"></i> Usuń trwale element</button>

        </form>
        
        </div>
        <div class="card-footer text-center py-3">
            
        </div>
    </div>
    
</div>
</div>
@endsection




