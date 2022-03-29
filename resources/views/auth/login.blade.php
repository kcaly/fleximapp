@extends('layouts.form')
@section('content')
    
<div class="col-lg-5">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h3 class="text-center font-weight-light my-4"><img src="img/Fleximapp_logo.png" /><br />{{ __('Zaloguj') }}</h3></div>
            
        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
            @csrf

                <div class="form-floating mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E-mail" />
                    <label for="inputEmail">{{ __('E-mail') }}</label>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Hasło" />
                    <label for="inputPassword">{{ __('Hasło') }}</label>

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                



                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                    <label class="form-check-label" for="remember">{{ __('Zapamiętaj') }}</label>
                </div>


                @if (session()->has('message'))

                <div class="alert alert-danger text-center" role="alert">
                    
      <h6>{{ Session::get('message') }}</h6>
                  </div> 
    
                @endif
                <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                    @if (Route::has('password.request'))
                    <a class="small" href="{{ route('password.request') }}">{{ __('Zapomniałeś hasła?') }}</a>
                    @endif
                    <button type="submit" class="btn btn-primary" href="index.html">{{ __('Zaloguj') }}</button>
                </div>




            </form>
        </div>
        <div class="card-footer text-center py-3">
            <div class="small"><a href="{{ route('add.company')}}"><i class="fas fa-suitcase"></i> Zarejestruj firmę</a>&nbsp;&nbsp;&nbsp;<a href="{{ route('add.user')}}"><i class="fas fa-user fa-fw"></i> Dodaj użytkownika</a></div>
        </div>
    </div>
</div>

@endsection
