@extends('layouts.app')
@section('content')



<div class="col-lg-12">
    <div class="card shadow-lg border-0 rounded-lg mt-5">
        <div class="card-header">
            


            <div class="row mb-3 font-weight-light my-4">
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        <h4 class="text-center font-weight-light my-4">
                            <img src="{{ asset('img/Fleximapp_logo_150.png')}}" /><br />Flexim ID: {{ \App\Models\Company::where('id', Auth::User()->company_id)->first()->flexim_id }}
                        </h4>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3 mb-md-0">
                        {{ \App\Models\Company::where('id', Auth::User()->company_id)->first()->name }}<br />
                        {{ \App\Models\Company::where('id', Auth::User()->company_id)->first()->nip }}<br />
                        {{ \App\Models\Company::where('id', Auth::User()->company_id)->first()->address }}<br />
                        {{ \App\Models\Company::where('id', Auth::User()->company_id)->first()->postcode }}&nbsp;&nbsp;
                        {{ \App\Models\Company::where('id', Auth::User()->company_id)->first()->city }}<br /><div class="small mt-3"><a href="{{route('company.edit', ['id' => Auth::user()->company_id]) }}">Edytuj dane organizacji</a></div>
                   
                    </div>
                </div>
            </div>     
          </div>
        <div class="card-body">
            <table class="table table-striped table-hover table-borderless">
                <thead class="border-bottom border-dark">
                  <tr>
                    <th scope="col"><h6 class=""><i class="fas fa-hammer"></i><i class="fas fa-street-view"></i></h6></th>
                    <th scope="col"></th>
                    <th scope="col"><h6 class="small">Tag</h6></th>
                    <th scope="col"></th>
                    <th scope="col"><h6 class="small">Imię i nazwisko</h6></th>
                    <th scope="col"><h6 class="small">E-mail</h6></th>
                    
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
@foreach (\App\Models\User::where('company_id', Auth::user()->company_id)->get() as $user)
<tr>
    <td scope="row"><form method="post" action={{route('change.status', ['user_id' => $user->id]) }} >
        @csrf
        @method('put')
        @if($user->status == 0)<button type="submit" class="btn btn-success btn-sm"><i class="fas fa-user-check"></i></button></form>@else<button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-user-times"></i></button></form>@endif</td>
        <td>@if($user->role_id == 1)<div class="small">Administrator</div>@endif</td>
    <td>{{$user->tag_user}}</td>
    <td>
        <form method="get" action={{route('user.edit', ['company_id' => Auth::user()->company_id, 'id' => $user->id]) }} >
        @csrf
        @method('get')
        <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fas fa-pencil-alt"></i> Edytuj</button></form>
        
    </td>
    <td>{{$user->first_name}} {{$user->last_name}}</td>
    <td>{{$user->email}}</td>

    <td>
    </td>
</tr>   
@endforeach
       
            </tbody>
        </table> 
        </div>
        <div class="card-footer text-center py-3">
       
        </div>
    </div>
</div>



@endsection