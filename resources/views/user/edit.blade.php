@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">


        @if (\Session::has('success'))
            

            <div class="alert alert-dismissible alert-success fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>               
                <p class="mb-0">{!! \Session::get('success') !!}</p>
            </div>
        @endif

        @if (\Session::has('warning'))
            <div class="alert alert-dismissible alert-warning fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>               
                <p class="mb-0">{!! \Session::get('warning') !!}</p>
            </div>
        @endif
            <div class="main-container row ">
                <div class="col-12">
                    @php 
                    $hide = 'yes';
                    @endphp
                    
                    @include('user.profile-header')

                    
                </div>
                <div class="col-12">
                    <div class="profile-body">


                    <div class="card tak-card login-tab">
                        <div class="card-header">{{ __('تعديل حسابي') }}</div>

                        <div class="card-body">
                        <form method="POST" action="{{ route('editProfile') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group form-tak tak-active">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('الاسم الكامل ') }}</label>

                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>


                            <div class="form-group form-tak tak-active">
                                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('اسم المستخدم') }}</label>

                                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ Auth::user()->username }}" required autocomplete="username" autofocus>

                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group form-tak tak-active">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('البريد الالكتروني') }}</label>

                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="images">
                                <div class="pic">
                                اضافة صوره
                                </div>
                            </div>
                            <input id="userimage" type="file"  name="userimage" value="{{ Auth::user()->image }}" >

                            <div class="form-group form-tak">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('كلمة المرور') }}</label>

                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>

                            <div class="form-group form-tak">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('تاكيد كلمة المرور') }}</label>

                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>

                            <div class="form-group row  mb-0">
                                <div class="col-12 ">
                                    <button type="submit" class="button secondary login-button">
                                        {{ __('تعديل') }}
                                    </button>

                                    
                                </div>
                            </div>

                        </form>
                            
                        </div>
                    </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


