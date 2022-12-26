
<div class="intro">
<center>
<h1>
    مع
<svg class="rating-icon icon-star">
                            <use xlink:href="#svg-star"></use>
                        </svg>
                        تقييم
</h1>    

</center>
<center>احصل على نقد بناء بسرية تامة من زملائك في العمل وأصدقائك.</center>

</div>
<ul class="auth-tabs">
               <li class="login-tab-link @if( Session::get('reg') != 'reg' ) tab-active @endif">دخول</li>
               <li class="reg-tab-link @if( Session::get('reg') == 'reg' ) tab-active @endif">تسجيل</li>
           </ul>
           <div class="card tak-card login-tab" @if( Session::get('reg') == 'reg' ) style="display:none" @endif>
                <div class="card-header">{{ __('تسجيل الدخول') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group  form-tak">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('البريد الالكتروني') }}</label>

                                <input id="email" type="email" class="tak-input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" >

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group  form-tak">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('كلمة المرور') }}</label>

                                <input id="password" type="password" class="tak-input form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row align-items-center">
                            <div class="col-6">
                                <div class="checkbox-wrap">
                                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <!-- CHECKBOX BOX -->
                                    <div class="checkbox-box">
                                        <!-- ICON CROSS -->
                                        <svg class="icon-cross">
                                            <use xlink:href="#svg-cross"></use>
                                        </svg>
                                        <!-- /ICON CROSS -->
                                    </div>
                                    <!-- /CHECKBOX BOX -->
                                    <label for="remember">{{ __('تذكرني') }}</label>
                                </div>

                            </div>
                            <div class="col-6">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link login-link" href="{{ route('password.request') }}">
                                        {{ __('هل نسيت كلمة المرور') }}
                                    </a>
                                @endif

                            </div>
                        </div>

                        <div class="form-group row  mb-0">
                            <div class="col-12 ">
                                <button type="submit" class="button secondary login-button">
                                    {{ __('دخول') }}
                                </button>

                                
                            </div>
                        </div>

                    </form>
                    <h3 class="social-head">او سجل الدخول باستخدام </h3>
                    <div class="social-login">
                        <?php Session::put('redirect', 'new') ?>
                        <form method="get" action="{{ url('/login/facebook') }}">
                            @csrf
                            <button type="submit" class="facebook-login">
                                
                                <!-- ICON FACEBOOK -->
                                <svg class="icon-facebook">
                                <use xlink:href="#svg-facebook"></use>
                                </svg>
                                <!-- /ICON FACEBOOK -->

                            </button>
                        </form>
                        <form method="get" action="{{ url('/login/twitter') }}">
                            @csrf
                            <button type="submit" class="twitter-login">
                                
                            
                                <!-- ICON TWITTER -->
                                <svg class="icon-twitter">
                                <use xlink:href="#svg-twitter"></use>
                                </svg>
                                <!-- /ICON TWITTER -->
                            </button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="card tak-card reg-tab" @if( Session::get('reg') == 'reg' ) style="display:block" @endif>
                <div class="card-header">{{ __('تسجيل حساب جديد') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group form-tak">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('الاسم الكامل ') }}</label>

                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>


                        <div class="form-group form-tak">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('اسم المستخدم') }}</label>

                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group form-tak">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('البريد الالكتروني') }}</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                        <input id="userimage" type="file"  name="userimage" >

                        <div class="form-group form-tak">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('كلمة المرور') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group form-tak">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('تاكيد كلمة المرور') }}</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-group row  mb-0">
                            <div class="col-12 ">
                                <button type="submit" class="button secondary login-button">
                                    {{ __('تسجيل') }}
                                </button>

                                
                            </div>
                        </div>

                    </form>
                    <h3 class="social-head">او سجل الدخول باستخدام </h3>
                    <div class="social-login">
                    <form method="get" action="{{ url('/login/facebook') }}">
                            @csrf
                            <button type="submit" class="facebook-login">
                                
                                <!-- ICON FACEBOOK -->
                                <svg class="icon-facebook">
                                <use xlink:href="#svg-facebook"></use>
                                </svg>
                                <!-- /ICON FACEBOOK -->

                            </button>
                        </form>
                        <form method="get" action="{{ url('/login/twitter') }}">
                            @csrf
                            <button type="submit" class="twitter-login">
                                
                            
                                <!-- ICON TWITTER -->
                                <svg class="icon-twitter">
                                <use xlink:href="#svg-twitter"></use>
                                </svg>
                                <!-- /ICON TWITTER -->
                            </button>
                        </form>
                    </div>
                </div>
            </div>
<?php \Session::put('reg','login'); ?>
