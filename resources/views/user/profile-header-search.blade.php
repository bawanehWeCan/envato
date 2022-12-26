<div class="profile-header search-header">
                        <div class="row">
                            <div class="col-12 profile-cover"></div>
                            <div class="col-12 profile-hexagon">
                                <!-- USER SHORT DESCRIPTION AVATAR -->
                                <a class="user-short-description-avatar user-avatar medium" href="{{ url('/u') }}/{{ $user->username }}">
                                  <!-- USER AVATAR BORDER -->
                                  <div class="user-avatar-border">
                                    <!-- HEXAGON -->
                                    <div class="hexagon-120-132"></div>
                                    <!-- /HEXAGON -->
                                  </div>
                                  <!-- /USER AVATAR BORDER -->
                              
                                  <!-- USER AVATAR CONTENT -->
                                  <div class="user-avatar-content">
                                    <!-- HEXAGON -->
                                    <div class="hexagon-image-82-90" data-src="{{ $user->image }}"></div>
                                    <!-- /HEXAGON -->
                                  </div>
                                  <!-- /USER AVATAR CONTENT -->
                              
                                  <!-- USER AVATAR PROGRESS -->
                                  <div class="user-avatar-progress">
                                    <!-- HEXAGON -->
                                    <div class="hexagon-progress-100-110-{{ $user->id }}"></div>
                                    <!-- /HEXAGON -->
                                  </div>
                                  <!-- /USER AVATAR PROGRESS -->
                              
                                  <!-- USER AVATAR PROGRESS BORDER -->
                                  <div class="user-avatar-progress-border">
                                    <!-- HEXAGON -->
                                    <div class="hexagon-border-100-110"></div>
                                    <!-- /HEXAGON -->
                                  </div>
                                  <!-- /USER AVATAR PROGRESS BORDER -->
                              
                                  <!-- USER AVATAR BADGE -->
                                  <div class="user-avatar-badge">
                                    <!-- USER AVATAR BADGE BORDER -->
                                    <div class="user-avatar-badge-border">
                                      <!-- HEXAGON -->
                                      <div class="hexagon-32-36"></div>
                                      <!-- /HEXAGON -->
                                    </div>
                                    <!-- /USER AVATAR BADGE BORDER -->
                              
                                    <!-- USER AVATAR BADGE CONTENT -->
                                    <div class="user-avatar-badge-content">
                                      <!-- HEXAGON -->
                                      <div class="hexagon-dark-26-28"></div>
                                      <!-- /HEXAGON -->
                                    </div>
                                    <!-- /USER AVATAR BADGE CONTENT -->

                                    <?php 
                                    $avg = $user->avgRating()*100/5;
									$avg = number_format((float)$avg, 1, '.', '');
                                    $avgp = $avg/100;
                                    ?>
                              
                                    <!-- USER AVATAR BADGE TEXT -->
                                    <p class="user-avatar-badge-text">{{number_format((float)$user->avgRating(), 2, '.', '')}}</p>
                                    <!-- /USER AVATAR BADGE TEXT -->
                                  </div>
                                  <!-- /USER AVATAR BADGE -->
                                </a>
                                <!-- /USER SHORT DESCRIPTION AVATAR -->
                            
                            </div>
                            <div class="col-12 d-flex justify-content-center flex-column">
                                <h1 class="profile-name"><a href="{{ url('/u') }}/{{ $user->username }}">{{$user->name}}</a></h1>
                                <h5 class="profile-username">{{$user->username}}</h5>
                            </div>

                            <div class="col-12 profile-share ">
                                

                                <div id="share">
                                    @php 
                                    $url = url('/u') . "/" . $user->username;
                                    $title = "قم بتقيمي ";
                                    @endphp

                                    @if( $hide != 'yes' )
                                    <div class="col-12 profile-header-info-actions">
                                        <!-- PROFILE HEADER INFO ACTION -->
                                        <a href="{{ url('/u') }}/{{ $user->username }}/rate" class="profile-header-info-action button secondary"> قيمني</a>
                                        <!-- /PROFILE HEADER INFO ACTION -->

                                    </div>
                                    @endif
                                    
									<div class="user-counter">
                                      <span>{{number_format((float)$user->avgRating(), 2, '.', '')}} / 5  <p>اجمالي التقييم</p></span>
                                      <span>{{$user->countRating()}}<p>عدد التقيمات</p></span>

                                    </div>
                                </div>
                            </div>
							
                        </div>
                    </div>
					@if( $avgp > 0)
                    @push('script')
						app.plugins.createHexagon({ 
							container: '.hexagon-progress-100-110-{{ $user->id }}',
							width: 100,
							height: 110,
							lineWidth: 6,
							roundedCorners: true,
							gradient: {
								colors: ['#41efff', '#615dfa']
							},
							scale: {
								start: 0,
								end: 1,
								stop:{{ $avgp }}
							}
						});
					@endpush
					@endif


                    