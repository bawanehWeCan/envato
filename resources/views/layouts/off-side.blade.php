<div class="tak-off">
        <div class="tak-close">
            
            <!-- ICON BACK ARROW -->
            <svg class="icon-back-arrow">
            <use xlink:href="#svg-back-arrow"></use>
            </svg>
            <!-- /ICON BACK ARROW -->
        </div>
        @auth
        <div class="tak-off-profile">
             <!-- USER AVATAR -->
            <a class="user-avatar small no-outline " href="{{ url('/u') }}/{{ Auth::user()->username }}">
                <!-- USER AVATAR CONTENT -->
                <div class="user-avatar-content">
                    <!-- HEXAGON -->
                    <div class="hexagon-image-30-32" data-src="{{ Auth::user()->image }}"></div>
                    <!-- /HEXAGON -->
                </div>
                <!-- /USER AVATAR CONTENT -->
            
                <!-- USER AVATAR PROGRESS -->
                <div class="user-avatar-progress">
                    <!-- HEXAGON -->
                    <div class="hexagon-progress-40-44-{{ Auth::user()->id }}-small"></div>
                    <!-- /HEXAGON -->
                </div>
                <!-- /USER AVATAR PROGRESS -->
            
                <!-- USER AVATAR PROGRESS BORDER -->
                <div class="user-avatar-progress-border">
                    <!-- HEXAGON -->
                    <div class="hexagon-border-40-44"></div>
                    <!-- /HEXAGON -->
                </div>
                <!-- /USER AVATAR PROGRESS BORDER -->
            
                <!-- USER AVATAR BADGE -->
                <div class="user-avatar-badge">
                    <!-- USER AVATAR BADGE BORDER -->
                    <div class="user-avatar-badge-border">
                    <!-- HEXAGON -->
                    <div class="hexagon-22-24"></div>
                    <!-- /HEXAGON -->
                    </div>
                    <!-- /USER AVATAR BADGE BORDER -->
            
                    <!-- USER AVATAR BADGE CONTENT -->
                    <div class="user-avatar-badge-content">
                    <!-- HEXAGON -->
                    <div class="hexagon-dark-16-18"></div>
                    <!-- /HEXAGON -->
                    </div>
                    <!-- /USER AVATAR BADGE CONTENT -->
            
                    <!-- USER AVATAR BADGE TEXT -->
                    <?php 
                                        $avg = Auth::user()->avgRating()*100/5;
                                        $avg = number_format((float)$avg, 1, '.', '');
                                        $avgp = $avg/100;
                                        ?>
                                
                    <!-- USER AVATAR BADGE TEXT -->
                    <p class="user-avatar-badge-text">{{number_format((float)Auth::user()->avgRating(), 1, '.', '')}}</p>
                    <!-- /USER AVATAR BADGE TEXT -->
                </div>
                <!-- /USER AVATAR BADGE -->
            </a>

            <div class="d-flex justify-content-center flex-column">
                <h1 class="profile-name"><a href="{{ url('/u') }}/{{ Auth::user()->username }}">{{Auth::user()->name}}</a></h1>
                <h5 class="profile-username">{{Auth::user()->username}}</h5>
            </div>

            <!-- /USER AVATAR -->
        </div>
        <a class="button small secondary logout" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            تسجيل الخروج
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        
        @if( $avgp > 0)
                    @push('script')
                    app.plugins.createHexagon({
            container: '.hexagon-progress-40-44-{{ Auth::user()->id }}-small',
            width: 40,
            height: 44,
            lineWidth: 3,
            roundedCorners: true,
            roundedCornerRadius: 1,
            gradient: {
                colors: ['#41efff', '#615dfa']
            },
            scale: {
                start: 0,
                end: 1,
                stop:{{ $avgp}}
            }
            });
                            @endpush
            @endif

        @endauth

        <ul class="side-menu">
            <li>عن تقييم</li>
            <li>سياسه الاستخدام</li>
            <li>للاتصال بنا</li>
        </ul>
        <div class="copy-right">
            صنع ب 
            <i class="fa fa-heart"></i>
            والكثير من 
            <i class="fa fa-coffee"></i>
            
        </div>
    </div>