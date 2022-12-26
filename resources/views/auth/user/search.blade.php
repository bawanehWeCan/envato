@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="main-container row ">
                <div class="col-12">
                    @foreach( $users as $user )
                    @php 
                    $hide = 'no';
                    @endphp
                    
                    @include('user.profile-header-search')

                    @endforeach

                    
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection


