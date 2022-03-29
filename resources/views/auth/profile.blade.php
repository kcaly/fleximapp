@extends('layouts.app')
@section('content')
    
<div class="col-lg-6">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h4 class="text-center font-weight-light my-4">
                

                Profil użytkownika

                
            </h4>
          </div>
        <div class="card-body">
            @if (session()->has('message'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                  Zapisano
                  
                </div>
              </div>

                @endif
            <form method="POST" action="{{ route('user-profile-information.update') }}">
                @csrf
                @method('put')
                

                

         

                <div class="row mb-3">
                    <div class="col-md-8">
                        <div class="form-floating mb-3 mb-md-0">
                            <input id="tag_user" type="text" class="form-control @error('tag_user') is-invalid @enderror" name="tag_user" value="{{ old('tag_user') ?? Auth::user()->tag_user}}" required autocomplete="tag_user" autofocus placeholder="Tag użytkownika" />
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
                            <input id="company_id" type="text" class="form-control @error('company_id') is-invalid @enderror" name="company_id" value="{{ \App\Models\Company::where('id', Auth::User()->company_id)->first()->flexim_id }}" required autocomplete="company_id" autofocus placeholder="Flexim ID" disabled/>
                            <label for="company_id">Flexim ID</label>
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
                            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') ?? Auth::user()->first_name }}" required autocomplete="first_name" autofocus placeholder="Imię" />
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
                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') ?? Auth::user()->last_name }}" required autocomplete="last_name" autofocus placeholder="Nazwisko" />
                            <label for="last_name">{{ __('Nazwisko') }}</label>
                            @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-floating mb-4">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? Auth::user()->email }}" required autocomplete="email" placeholder="E-mail" autofocus />
                    <label for="email">{{ __('E-mail') }}</label>

                            @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                </div>
          
                <div class="row mt-4 mb-4">

                   <div class="text-right"><button type="submit" class="btn btn-primary btn-lg" href="login.html"><i class="far fa-check-circle"></i> Zatwierdź</button></div>
                </div>
             
            </form>
        </div>
        <div class="card-footer text-center py-3">
            
        </div>
    </div>
</div>

@endsection




