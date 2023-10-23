@extends('layouts.app')
@section('content')
  <div class="col-lg-12">
    <div class="card shadow-lg border-0 rounded-lg mt-3">
            <div class="card-header small text-muted">
                  <i class="fas fa-list-alt"></i>&nbsp;<i class="fas fa-map-marker-alt"></i>&nbsp;&nbsp;Lista maszyn
            </div>
            <div class="card-body">
                <div class="row mb-3 font-weight-light mb-4">
                  <div class="col-md-8">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col" class="text-right">
                            <form method="post" action="{{route('machine.create')}}">
                              @csrf
                              @method('post')
                              @if ($selector['id'] != 0)
                            
                              @else
                              <button class="btn btn-outline-dark btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample3" aria-controls="offcanvasExample">
                                &nbsp;&nbsp;<i class="fas fa-plus-circle"></i>&nbsp;&nbsp;
                              </button>
                              @endif
                          </th>
                          <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample3" aria-labelledby="offcanvasExampleLabel">
                            <div class="offcanvas-header">
                              <h5 class="offcanvas-title" id="offcanvasExampleLabel"><i class="fas fa-plus-circle"></i> Nowa maszyna</h5>
                              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                              <div class="form mt-3 mb-4">
                                <label class="mb-2 small" for="titel_new_machine">Tytuł (etykieta):</label>
                                <input id="titel_new_machine" type="text" class="form-control @error('titel_new_machine') is-invalid @enderror" name="titel_new_machine" value="{{ old('titel_new_machine') }}" placeholder=""  autofocus />
                            </div>
                                <div class="form-floating my-4 mb-4">
                                  <input id="name_new_machine" type="text" class="form-control @error('name_new_machine') is-invalid @enderror" name="name_new_machine"  placeholder="Nazwa maszyny"  autofocus required />
                                  <label for="name_new_machine">Nazwa maszyny</label>
                                </div>
                            <div class="row mb-3">
                              <div class="col-md-4">
                                  <div class="form-floating my-3 mb-md-0 px-2">
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="status_new_machine" value="1" id="flexRadioDefault1" checked>
                                      <label class="form-check-label" for="flexRadioDefault1">
                                        Włącz
                                      </label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" type="radio" name="status_new_machine" value="0" id="flexRadioDefault2">
                                      <label class="form-check-label" for="flexRadioDefault2">
                                        Wyłącz
                                      </label>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-md-4">
                                
                            </div>
                          </div>
                          <div class="row mb-3 my-4 mt-5">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                  <div class="form-check form-switch">
                                    <input name="export_new_machine" class="form-check-input" type="checkbox" value="1" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Eksport</label>
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                  <div class="form-check form-switch">
                                    <input name="execute_new_machine" class="form-check-input" type="checkbox" value="1" id="flexSwitchCheckChecked" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Zlecenia</label>
                                  </div>
                                </div>
                            </div>
                          </div>
                            <div class="form-floating my-4">
                              <p class="mb-2" for="default_sort">Domyślne sortowanie:</p>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="default_sort" id="inlineRadio1" value="1" checked>
                                <label class="form-check-label small" for="inlineRadio1">Długość</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="default_sort" id="inlineRadio2" value="2">
                                <label class="form-check-label small" for="inlineRadio2">Szerokość</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="default_sort" id="inlineRadio3" value="3">
                                <label class="form-check-label small" for="inlineRadio3">Wysokość</label>
                              </div>
                            </div>
                              <button type="submit" class="btn btn-outline-success btn-lg mt-4" name="action" value="1"><i class="fas fa-check-square"></i> Utwórz</button>
                            </div>
                          </div>
                        </form>
                          <th scope="col" style="width: 30%" class="small">Nazwa maszyny</th>
                          @if($selector['id'] != 0)

                          @else
                          <th scope="col" class="small">Tytuł</th>
                          <th scope="col" class="small">Eksport</th>
                          <th scope="col" class="small">Zlecenia</th>
                          <th scope="col" class="small">Sort.</th> 
                          <th scope="col" class="small text-center"><i class="fas fa-filter"></i> Filtr</th>
                          <th scope="col" class="small">Pos.</th> 
                          @endif
                          <th scope="col"></th>                 
                        </tr>
                      </thead>      
                      <tbody>
                        @foreach ($records as $record)
                        <tr @if($selector['id'] != 0) class="p-3 mb-2 bg-light" @endif>
                          <td class="text-right">
                            @if($selector['id'] != 0)
                            <h5><i class="fas fa-pencil-alt blueiconcolor"></i></h5>
                            @else
                            @if($record->status == 0)
                            <a href="{{route('machine.status', ['id' => $record->id]) }}" class="btn btn-outline-dark"><h4><i class="fas fa-power-off rediconcolor"></i></h4></a>
                            @else
                            <a href="{{route('machine.status', ['id' => $record->id]) }}" class="btn btn-outline-dark"><h4><i class="fas fa-power-off greeniconcolor"></i></h4></a>
                            @endif
                            @endif
                          </td>
                          <td>@if ($selector['id'] != 0) <h5 class="blueiconcolor">{{ $record->name }}</h5> @else {{ $record->name }} @endif</td>
                          @if($selector['id'] != 0)

                          @else
                          <td>{{ $record->titel }}</td>
                          <td class="text-center">
                            @if($record->export == 0)
                           
                            @else
                            <i class="far fa-check-circle"></i>
                            @endif
                          </td>
                          <td class="text-center">
                            @if($record->execute == 0)
                            
                            @else
                            <i class="far fa-check-circle"></i>
                            @endif                         
                          </td>  
                          <td>
                            @if ($record->default_sort == 1)
                              X(dł.)
                            @endif
                            @if ($record->default_sort == 2)
                              Y(szer.)
                            @endif
                            @if ($record->default_sort == 3)
                              Z(wys.)
                            @endif
                          </td>
                          <td>
                            @if($record->default_filter != ';;;;;;;;;')                           
                            <a href="{{route('machine.run.filter', ['id' => $record->id])}}" class="btn btn-outline-dark btn-sm small"><i class="fab fa-sistrix"></i></a>
                            @else
                            
                            @endif 
                          </td>
                          <td style="width: 7%" class="text-center">
                            <input type="text" class="form-control form-control-sm" id="formGroupExampleInput2" placeholder="{{ $record->position }}" disabled>
                          </td>
                          @endif
                          <td class="text-right">
                            @if ($selector['id'] != 0)
                            <h5><i class="fas fa-edit grey800color"></i></h5>
                            @else
                            <a href="{{route('machine.select', ['id' => $record->id]) }}"><h5><i class="fas fa-edit"></i></h5></a>
                            @endif                  
                          </td>
                        </tr>
                        @endforeach  
                      </tbody>
                    </table>
                    @if($selector['id'] != 0)
                    <div class="card border-1 border-primary rounded-lg mt-5 bg-light">
                    <table class="table table-borderless">
                      <tbody>
                        <thead>
                          <tr>
                            <th scope="col" class="text-right"></th>
                            <th scope="col" style="width: 18%"></th>
                            <th scope="col" style="width: 14%"></th>
                            <th scope="col" style="width: 22%"></th>
                            <th scope="col" style="width: 14%"></th>
                            <th scope="col" style="width: 14%"></th>
                            <th scope="col" style="width: 14%"></th>
                          </tr>
                        </thead>
                        <tr>
                          <td><h6 class="text-right"><i class="fas fa-filter blueiconcolor"></i></h6></td>
                          <td class="small blueiconcolor">Materiał</td>
                          <td class="small blueiconcolor">Kod</td>
                          <td class="small blueiconcolor">Nazwa</td>
                          <td class="small blueiconcolor">Długość</td>
                          <td class="small blueiconcolor">Szerokość</td>
                          <td class="small blueiconcolor">Wysokość</td>
                        </tr>
                        <tr>
                          <td></td>                     
                          <td><input type="text" class="form-control form-control-sm" @if ($filter['material_id'] != null) value="{{ \App\Models\Material::find($filter['material_id'])->name  }}" @endif disabled></td>
                          <td><input type="text" class="form-control form-control-sm" @if ($filter['id'] != null) value="{{ $filter['id'] }}" @endif disabled></td>
                          <td><input type="text" class="form-control form-control-sm" @if ($filter['name'] != null) value="{{ $filter['name'] }}" @endif disabled></td>
                          <td><input type="text" class="form-control form-control-sm" @if($filter['length_value'] != null) value="{{ $filter['length_operator'] . $filter['length_value'] }}" @else @endif disabled></td>
                          <td><input type="text" class="form-control form-control-sm" @if($filter['width_value'] != null) value="{{ $filter['width_operator'] . $filter['width_value'] }}" @else @endif disabled></td>
                          <td><input type="text" class="form-control form-control-sm" @if($filter['height_value'] != null) value="{{ $filter['height_operator'] . $filter['height_value'] }}" @else @endif disabled></td>
                        </tr>                    
                      </tbody>
                    </table>  
                    <a href="{{route('machine.filter.nulls', ['id' => $record->id])}}"><h6 class="grey600color small text-center mb-2 mt-3">&nbsp;&nbsp;<i class="fas fa-eraser"></i> Wyczyść</h6></a>
                  </div>
                  @else

                  @endif
                  </div>
                    
                  <div class="col-md-4 @if ($selector['id'] != 0) @else text-muted @endif ">              
                  <form method="post" action="{{route('machine.edit')}}">
                    @csrf
                    @method('post')
                    <div class="form mt-5 mb-4">
                      <label class="mb-2 small" for="titel">Tytuł (etykieta):</label>
                      <input id="titel" type="text" class="form-control @error('titel') is-invalid @enderror" name="titel" placeholder="" value="@if ($selector['id'] != 0){{\App\Models\Machine::find($selector['id'])->titel}}@else @endif" @if ($selector['id'] != 0) @else disabled @endif/>                   
                  </div>                   
                      <div class="form-floating my-4 mb-4">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="@if ($selector['id'] != 0){{\App\Models\Machine::find($selector['id'])->name}}@else @endif" placeholder="" required @if ($selector['id'] != 0) @else disabled @endif/>
                        <label for="name">Nazwa maszyny</label>
                    </div>                 
                  <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-floating my-3 mb-md-0">
                            <input name="position" type="number" class="form-control" required autofocus placeholder="Pos." @if ($selector['id'] != 0) value="{{\App\Models\Machine::find($selector['id'])->position}}" @else disabled @endif/>
                            <label for="position">Pos.</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-floating my-3 mb-md-0 px-2">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="status" value="1" id="flexRadioDefault1" @if ($selector['id'] != 0) @if (\App\Models\Machine::find($selector['id'])->status == 1) checked @else @endif @endif @if ($selector['id'] != 0) @else disabled @endif>
                          <label class="form-check-label" for="flexRadioDefault1">
                            Włącz
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="status" value="0" id="flexRadioDefault2" @if ($selector['id'] != 0) @if (\App\Models\Machine::find($selector['id'])->status == 0) checked @else @endif @endif @if ($selector['id'] != 0) @else disabled @endif>
                          <label class="form-check-label" for="flexRadioDefault2">
                            Wyłącz
                          </label>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="row my-4">
                  <div class="col-md-6">
                      <div class="form-floating mb-2">
                        <div class="form-check form-switch">
                          <input name="export" class="form-check-input" type="checkbox" value="1" id="flexSwitchCheckDefault" @if ($selector['id'] != 0) @if (\App\Models\Machine::find($selector['id'])->export == 1) checked @else @endif @endif @if ($selector['id'] != 0) @else disabled @endif>
                          <label class="form-check-label" for="flexSwitchCheckDefault">Eksport</label>
                        </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-floating mb-2">
                        <div class="form-check form-switch">
                          <input name="execute" class="form-check-input" type="checkbox" value="1" id="flexSwitchCheckChecked" @if ($selector['id'] != 0) @if (\App\Models\Machine::find($selector['id'])->execute == 1) checked @else @endif @endif @if ($selector['id'] != 0) @else disabled @endif>
                          <label class="form-check-label" for="flexSwitchCheckChecked">Zlecenia</label>
                        </div>
                      </div>
                  </div>
              </div>      
            <div class="form-floating mt-2 mb-5">
              <p class="mb-2" for="default_sort">Domyślne sortowanie:</p>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="default_sort" id="inlineRadio1" value="1" @if ($selector['id'] != 0) @if (\App\Models\Machine::find($selector['id'])->default_sort == 1) checked @else @endif @endif @if ($selector['id'] != 0) @else disabled @endif>
                <label class="form-check-label small" for="inlineRadio1">Długość</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="default_sort" id="inlineRadio2" value="2" @if ($selector['id'] != 0) @if (\App\Models\Machine::find($selector['id'])->default_sort == 2) checked @else @endif @endif @if ($selector['id'] != 0) @else disabled @endif>
                <label class="form-check-label small" for="inlineRadio2">Szerokość</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="default_sort" id="inlineRadio3" value="3" @if ($selector['id'] != 0) @if (\App\Models\Machine::find($selector['id'])->default_sort == 3) checked @else @endif @endif @if ($selector['id'] != 0) @else disabled @endif>
                <label class="form-check-label small" for="inlineRadio3">Wysokość</label>
              </div>
            </div>
            <div class="mt-4 mb-4">
              <input name="id" value="{{$selector['id']}}" type="hidden">
              <div class="d-grid"><button type="submit" @if ($selector['id'] != 0) class="btn btn btn-primary btn-block" @else class="btn btn-secondary btn-block" disabled @endif><i class="fas fa-pen-square"></i>&nbsp;&nbsp;Zapisz</button></div>
            </div>
            </form>
            </div>
            </div>       
            </div>
        </div>
    </div>

@endsection




