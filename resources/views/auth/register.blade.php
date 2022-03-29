@extends('layouts.form')
@section('content')
    
<div class="col-lg-6">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h3 class="text-center font-weight-light my-4"><img src="img/Fleximapp_logo.png" /><br />
                @if (session()->has('message'))

            <div class="alert alert-success text-center" role="alert">
                <h5>Wygenerowano nowe Flexim ID:</h5><h4 class="alert-heading">{{ Session::get('message') }}</h4>
                <hr>
  <h6>Utwórz teraz pierwszego użytkownika dla swojej organizacji.</h6>
              </div> 

            @endif

                {{ __('Nowy użytkownik') }}
                </h3>
          </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <input name="role_id" type="hidden" value="2" /> 
                <div class="row mb-3">
                    <div class="card text-left py-3">
                        <h5><i class="far fa-question-circle"></i> Informacja</h5>
                        <p>Tag to nazwa za pomocą której inni użytkownicy mogą identyfikować siebie w organizacji. Flexim ID to unikatowy kod umożliwający dołączenie nowego użytkownika do istniejącej organizacji.
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-8">
                        <div class="form-floating mb-3 mb-md-0">
                            <input id="tag_user" type="text" class="form-control @error('tag_user') is-invalid @enderror" name="tag_user" value="{{ old('tag_user') }}" required autocomplete="tag_user" autofocus placeholder="Tag użytkownika" />
                            <label for="tag_user">{{ __('Tag użytkownika') }}</label>
                            @error('tag_user')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input id="company_id" type="text" class="form-control @error('company_id') is-invalid @enderror" name="company_id" value="{{ old('company_id') ?? Session::get('message') }}"required autocomplete="company_id" autofocus placeholder="Flexim ID" />
                            <label for="company_id">{{ __('Flexim ID') }}</label>
                            @error('company_id')
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
                            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus placeholder="Imię" />
                            <label for="first_name">{{ __('Imię') }}</label>
                            @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus placeholder="Nazwisko" />
                            <label for="last_name">{{ __('Nazwisko') }}</label>
                            @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail" autofocus />
                    <label for="email">{{ __('E-mail') }}</label>
                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password" placeholder="Hasło" autofocus />
                            <label for="password">{{ __('Hasło') }}</label>
                            @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="password-confirm" placeholder="Powtórz hasło" autofocus />
                            <label for="password-confirm">{{ __('Powtórz hasło') }}</label>
                        </div>
                    </div>
                </div>
                <div class="mt-4 mb-0">
                    <div class="d-grid"><button type="submit" class="btn btn-primary btn-block" href="login.html"><i class="fas fa-plus"></i> {{ __('Dodaj') }}</button></div>
                </div>
            </form>
        </div>
        <div class="card-footer text-center py-3">
            <div class="small">Nie posiadasz Flexim ID?<br /><a href="{{ route('add.company')}}"><i class="fas fa-suitcase"></i> Zarejestruj firmę</a></div>
            <div class="text-left py-3"><a class="small" href="{{ route('login')}}"><i class="far fa-arrow-alt-circle-left"></i> Powrót do logowania</a></div>
        </div>
    </div>
</div>

@endsection




