@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="main-container row ">
                
                <div class="col-12">
                    <div class="profile-body">

                    @auth
                    
                    @else
                    @include('auth.logincard2')
                    @endauth

                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


