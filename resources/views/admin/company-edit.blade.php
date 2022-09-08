@extends('layouts.app')
@section('content')
    
<div class="col-lg-6">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            <h4 class="text-center font-weight-light my-4"><small>Edycja organizacji</small><br />Flexim ID: {{ $company->flexim_id  }}</h4></div>
        <div class="card-body">
            <form method="POST" action="{{ route('company.save') }}">
                @csrf
                @method('put')
                <input name="id" type="hidden" value="{{ $company->id }}"/>
                <div class="form-floating mb-3">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? $company->name }}" required autocomplete="name" placeholder="Nazwa firmy" autofocus />
                    <label for="name">{{ __('Nazwa firmy') }}</label>
                            @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                </div>
                <div class="form-floating mb-3">
                    <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip') ?? $company->nip}}" required autocomplete="nip" placeholder="NIP" autofocus />
                    <label for="nip">{{ __('NIP') }}</label>
                            @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                </div>
                <div class="form-floating mb-3">
                    <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ old('contact') ?? $company->contact }}" required autocomplete="contact" placeholder="Telefon" autofocus />
                    <label for="contact">{{ __('Telefon') }}</label>
                            @error('contact')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                </div>

      

                <div class="py-3"></div>
                <div class="form-floating mb-3">
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') ?? $company->address }}" required autocomplete="address" placeholder="Adres pocztowy" autofocus/>
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
                            <input id="postcode" type="text" class="form-control @error('postcode') is-invalid @enderror" name="postcode" value="{{ old('postcode') ?? $company->postcode }}" required autocomplete="postcode" autofocus placeholder="Kod" />
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
                            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') ?? $company->city}}" required autocomplete="city" autofocus placeholder="Miejscowość" />
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

                <div class="mt-4 mb-0">
                    <div class="d-grid"><button type="submit" class="btn btn-primary btn-block"><i class="far fa-check-circle"></i> {{ __('Zatwierdź') }}</button></div>
                </div>
            </form>
        </div>
        <div class="card-footer text-center py-3">

        </div>
    </div>
</div>

@endsection




