@extends('layouts.app')
@section('content')
    
<div class="col-lg-6">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h4 class="text-center font-weight-light my-4">
                Import elementów
            </h4>
          </div>
        <div class="card-body">
            

            <form enctype="multipart/form-data" method="POST" action="{{ route('element.upload') }}">

                @csrf
                @method('post')
                



                



                <div class="form-floating mb-4">

                    <div class="input-group mt-4 mb-3">
  
                        <label name ="file" class="input-group-text" for="file"><i class="fas fa-file-upload"></i></label>
                        <input id="file" name="file" type="file" class="form-control" placeholder="Plik" />
                         
    
                    </div>
                </div>

                


                <div class="row mb-3"></div>








                <div class="row mt-2 mb-4">

                   <div class="text-right"><button type="submit" class="btn btn-primary" href="login.html"><i class="far fa-check-circle"></i> Zatwierdź</button></div>
                </div>
             
            </form>
        </div>
        <div class="card-footer py-3 muted">
            <small class="text-muted"><i class="fas fa-info-circle"></i> <strong>Schemat pliku</strong></small><h6 class="grey800color">kod ; nazwa ; długość ; szerokość ; wysokość ; ID materiału</h6>
        </div>
    </div>
</div>

@endsection
                  



