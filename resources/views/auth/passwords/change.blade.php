@extends('layouts.app')
@section('content')
    
<div class="col-lg-6">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h4 class="text-center font-weight-light my-4">
                

                Zmiana hasła

                
            </h4>
          </div>
        <div class="card-body">
            @if (session()->has('message'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                  Hasło zmieniono pomyślnie
                </div>
              </div>

                @endif
            <form method="POST" action="{{ route('user-password.update') }}">
                @csrf
                @method('put')
                <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <input id="current_password" type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" name="current_password" required autocomplete="new-password" placeholder="Aktualne hasło" autofocus />
                        <label for="current_password">{{ __('Aktualne hasło') }}</label>
                        @error('current_password', 'updatePassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row mb-3"></div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <input id="password" type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Hasło" autofocus />
                            <label for="password">{{ __('Nowe hasło') }}</label>
                            @error('password', 'updatePassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Powtórz hasło" autofocus />
                            <label for="password-confirm">{{ __('Powtórz hasło') }}</label>
                        </div>
                    </div>
                </div>
                
          
                
                <div class="mt-4 mb-4">
                    <div class="text-right"><button type="submit" class="btn btn-primary btn-lg" href="login.html"><i class="far fa-check-circle"></i> Zatwierdź</button></div>
                </div>
            </form>
        </div>
        <div class="card-footer text-center py-3">
       
        </div>
    </div>
</div>

@endsection




