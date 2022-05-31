@extends('layouts.form')
@section('content')
    
<div class="col-lg-6">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h3 class="text-center font-weight-light my-4"><img src="img/Fleximapp_logo.png" /><br />{{ __('Nowa organizacja') }}</h3></div>
        <div class="card-body">
            <form method="POST" action="{{ route('company.store') }}">
                {{ csrf_field() }}
                
                <div class="form-floating mb-3">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Nazwa firmy" autofocus />
                    <label for="name">{{ __('Nazwa firmy') }}</label>
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                </div>
                <div class="form-floating mb-3">
                    <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip') }}" required autocomplete="nip" placeholder="NIP" autofocus />
                    <label for="nip">{{ __('NIP') }}</label>
                            @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                </div>
                <div class="form-floating mb-3">
                    <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') }}" required autocomplete="contact" placeholder="Telefon" autofocus />
                    <label for="contact">{{ __('Telefon') }}</label>
                            @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                </div>

      

                <div class="py-3"></div>
                <div class="form-floating mb-3">
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" placeholder="Adres pocztowy" autofocus/>
                    <label for="address">{{ __('Adres pocztowy') }}</label>
                            @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                </div>
                <div class="row mb-3">
                    
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input id="postcode" type="text" class="form-control @error('postcode') is-invalid @enderror" name="postcode" value="{{ old('postcode') }}" required autocomplete="postcode" autofocus placeholder="Kod" />
                            <label for="postcode">{{ __('Kod') }}</label>
                            @error('postcode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-floating mb-3 mb-md-0">
                            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus placeholder="Miejscowość" />
                            <label for="city">{{ __('Miejscowość') }}</label>
                            @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- <div class="row mb-3">
                    
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select class="form-select" aria-label="1">
                                <option value="1">Polska</option>
                              </select>
                            <label for="country">{{ __('Kraj') }}</label>
                            @error('country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
   
                </div> --}}
                




                <div class="row mb-3"></div>
                <div class="row mb-3">
                    <div class="card text-left py-3">
                        <h5><i class="far fa-question-circle"></i> Informacja</h5>
                        <p>Po zatwierdzeniu formularza niezbędne jest utworzenie pierwszego użytkownika powiązanego z organizacją. Będzie on administratorem zarządzającym uprawnieniami kolejnych członków organizacji. Podczas bieżącej sesji zostanie automatycznie wygenerowany Flexim ID.</p>
                    </div>
                </div>





                {{-- <div class="row mb-3">
                    <h3 class="text-center font-weight-light my-4">{{ __('Nowy użytkownik') }}</h3></div>
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
                            <input class="form-control" placeholder="Flexim ID" disabled/>
                            <label for="flexim_id">{{ __('Flexim ID') }}</label>
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
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-mail" />
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
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" autofocus placeholder="Hasło" />
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
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Powtórz hasło" autofocus />
                            <label for="password-confirm">{{ __('Powtórz hasło') }}</label>
                        </div>
                    </div>
                </div> --}}



                <div class="mt-4 mb-0">
                    <div class="d-grid"><button type="submit" class="btn btn-primary btn-block" href="login.html"><i class="far fa-check-circle"></i> {{ __('Zatwierdź') }}</button></div>
                </div>
            </form>
        </div>
        <div class="card-footer text-center py-3">
            <div class="small">Twoje Flexim ID już istnieje?<br /> Skontaktuj się z administratorem lub <a href="{{ route('add.user')}}"><i class="fas fa-user fa-fw"></i> Dodaj użytkownika</a></div>
            <div class="text-left py-3"><a class="small" href="{{ route('login')}}"><i class="far fa-arrow-alt-circle-left"></i> Powrót do logowania</a></div>
        </div>
    </div>
</div>

@endsection




