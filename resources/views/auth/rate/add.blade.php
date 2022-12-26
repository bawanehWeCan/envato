@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="main-container row ">
                <div class="col-12">
                    @php
                        $hide = 'yes';
                    @endphp
                    
                    @include('user.profile-header')

                    
                </div>
                <div class="col-12">
                    <div class="profile-body">

                    @auth
                    <div class="card tak-card">
                        <div class="card-header">{{ __('اضافه تقييم') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('storeRate') }}">
                                @csrf

                                @foreach($standers as $stander)

                                    <div class="form-group tak-form-flex">
                                        <label for="stander-{{$stander->id}}" class="col-6 col-form-label text-md-right">{{ $stander->name}}</label>

                                            <div class="">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div class="rating d-flex justify-content-center">
                                                        <input type="radio" name="standers[{{$stander->id}}][points]" id="rating-5-{{$stander->id}}" value="5">
                                                        <input type="hidden" name="standers[{{$stander->id}}][name]"  value="{{ $stander->name}}">
                                                        <label for="rating-5-{{$stander->id}}"></label>
                                                        <input type="radio" name="standers[{{$stander->id}}][points]" id="rating-4-{{$stander->id}}" value="4">
                                                        <label for="rating-4-{{$stander->id}}"></label>
                                                        <input type="radio" name="standers[{{$stander->id}}][points]" id="rating-3-{{$stander->id}}" value="3">
                                                        <label for="rating-3-{{$stander->id}}"></label>
                                                        <input type="radio" name="standers[{{$stander->id}}][points]" id="rating-2-{{$stander->id}}" value="2">
                                                        <label for="rating-2-{{$stander->id}}"></label>
                                                        <input type="radio" name="standers[{{$stander->id}}][points]" id="rating-1-{{$stander->id}}" value="1" checked>
                                                        <label for="rating-1-{{$stander->id}}"></label>
                                                    </div>
                                                </div>
                                        
                                        
                                        
                                        </div>
                                    </div>

                                @endforeach

                                <div class="form-group ">

                                    
                                    <div class="checkbox-wrap">
                                        <input type="checkbox" id="anonymous" name="anonymous" checked>
                                        <!-- CHECKBOX BOX -->
                                        <div class="checkbox-box">
                                            <!-- ICON CROSS -->
                                            <svg class="icon-cross">
                                                <use xlink:href="#svg-cross"></use>
                                            </svg>
                                            <!-- /ICON CROSS -->
                                        </div>
                                        <!-- /CHECKBOX BOX -->
                                        <label for="anonymous">{{ __('ارسال كمجهول ؟؟') }}</label>
                                    </div>
                                </div>

                                <div class="form-group form-tak">
                                    <label for="extra" class="col-md-4 col-form-label text-md-right">{{ __('رساله اضافية') }}</label>

                                    <textarea class="form-control" id="extra" name="extra" rows="3"></textarea>
                                </div>

                                

                                <div class="form-group row  mb-0">
                                    <div class="col-12 ">
                                        <button type="submit" class="mb-0 button secondary login-button">
                                            {{ __('ارسال التقييم') }}
                                        </button>

                                        
                                    </div>
                                </div>
                                <input type="hidden" name="user_id"  value="{{ $user->id}}">

                            </form>
                        </div>
                    </div>
                    @else
                    @include('auth.logincard')
                    @endauth

                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


