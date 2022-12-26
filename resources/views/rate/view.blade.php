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
                    $hide = 'no';
                    @endphp
                    
                    @include('user.profile-header')

                    
                </div>
                <div class="col-12">
                    <div class="profile-body">
                        @if(count($user->rates()) > 0)
                            @include('rate.card')
                        @else
                            <div class=" not-found  d-flex justify-content-center flex-column">
                                <div>
                                    <svg class="rating-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <circle cx="256" cy="256" r="256" fill="#ffd93b"/>
                                    <path d="M512 256c0 141.44-114.64 256-256 256-80.48 0-152.32-37.12-199.28-95.28 43.92 35.52 99.84 56.72 160.72 56.72 141.36 0 256-114.56 256-256 0-60.88-21.2-116.8-56.72-160.72C474.8 103.68 512 175.52 512 256z" fill="#f4c534"/>
                                    <ellipse transform="scale(-1) rotate(31.21 715.433 -595.455)" cx="166.318" cy="199.829" rx="56.146" ry="56.13" fill="#fff"/>
                                    <ellipse transform="rotate(-148.804 180.87 175.82)" cx="180.871" cy="175.822" rx="28.048" ry="28.08" fill="#3e4347"/>
                                    <ellipse transform="rotate(-113.778 194.434 165.995)" cx="194.433" cy="165.993" rx="8.016" ry="5.296" fill="#5a5f63"/>
                                    <ellipse transform="scale(-1) rotate(31.21 715.397 -1237.664)" cx="345.695" cy="199.819" rx="56.146" ry="56.13" fill="#fff"/>
                                    <ellipse transform="rotate(-148.804 360.25 175.837)" cx="360.252" cy="175.84" rx="28.048" ry="28.08" fill="#3e4347"/>
                                    <ellipse transform="scale(-1) rotate(66.227 254.508 -573.138)" cx="373.794" cy="165.987" rx="8.016" ry="5.296" fill="#5a5f63"/>
                                    <path d="M370.56 344.4c0 7.696-6.224 13.92-13.92 13.92H155.36c-7.616 0-13.92-6.224-13.92-13.92s6.304-13.92 13.92-13.92h201.296c7.696.016 13.904 6.224 13.904 13.92z" fill="#3e4347"/>
                                    </svg>
                                </div>

                                <h2>لا يوجد اي تقيم</h3>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


