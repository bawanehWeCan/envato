@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif

        @if (\Session::has('info'))
            <div class="alert alert-info">
                <ul>
                    <li>{!! \Session::get('info') !!}</li>
                </ul>
            </div>
        @endif
            <div class="main-container  ">
                <div class="notfications">
                    @foreach( $notes as $note )
                        <div class="note-card" >
                            @if( $note->read == 0 )
                            <span class="new-note"></span>
                            @endif
                            <div class="note-header">{{ $note->senderName() }}</div>
                            <div class="note-body">
                                
                            @if( $note->type == '1' )
                                    <p class="note-text">
                                        لقد قام 
                                        {!! $note->sender() !!}
                                        بتقيمك 
                                        </p>
                                        <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                            <a href="{{ url('/rate')}}/{{ $note->rate_id }}" class="btn btn-success">عرض </a>
                                        </div>
                                        @elseif( $note->type == '3' )
                                    <p class="note-text">
                                        لقد قام 
                                        {!! $note->sender() !!}
                                        بالموافقه على طلبك  
                                        </p>
                                        <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                            <a href="{{ url('/u')}}/{{ $note->sendByUser() }}" class="btn btn-success">عرض </a>
                                        </div>
                                       
                                        @elseif( $note->type == '4' )
                                    <p class="note-text">
                                        تم رفض طلبك لمعرفه الهويه
                                        </p>
                                        <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                            <a href="{{ url('/rate')}}/{{ $note->rate_id }}" class="btn btn-success">عرض </a>
                                        </div>
                                       
                                    @else
                                    <p class="note-text">
                                        يرغب 
                                        {!! $note->sender() !!}
                                        
                                        بمعرفه هويتك 
                                    </p>
                                    <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                    @if($note->approve == "1")
                                        <a  class="btn btn-success disabled" disabled="">تمت الموافقه</a>
                                        @elseif($note->approve == "3")
                                        <a  class="btn btn-success cancel disabled" disabled="">تم الرفض</a>
                                        @else
                                            <a data-id="{{ $note->id }}" class="btn btn-r btn-success approve-whois">نعم </a>
                                            <a data-id="{{ $note->id }}"  class="btn btn-r btn-danger cancel-whois">لا</a>
                                            @endif
                                        </div>
                                        

                                    @endif
                                
                            </div>
                        </div>

                        <?php 
                        $note->read = 1;
                        $note->save(); 
                        ?>
              
                    @endforeach

                    {!! Auth::user()->notifications()->links() !!}
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection


@push('script')
$('.approve-whois').on('click', function(event) {
                $btn = $(this);
                event.preventDefault();
                $.ajax({
                    type:'post',
                    url:'/approve-whois',
                    data:{
                        '_token':'{{ csrf_token() }}',
                        'id' : $(this).data('id')
                    },
                    success: function (data) {
                            //$btn.html(data);
                            $btn.parent(".btn-group-vertical").html('<a class="btn btn-success disabled" disabled>تمت الموافقه</a>');
                            $btn.parent(".btn-group-vertical").find(".btn-r").remove();
                        
                        
                    },
                });
                return false;
            });

            $('.cancel-whois').on('click', function(event) {
                $btn = $(this);
                event.preventDefault();
                $.ajax({
                    type:'post',
                    url:'/cancel-whois',
                    data:{
                        '_token':'{{ csrf_token() }}',
                        'id' : $(this).data('id')
                    },
                    success: function (data) {
                            //$btn.html(data);
                            $btn.parent(".btn-group-vertical").html('<a class="btn btn-success cancel disabled" disabled>تم الرفض</a>');
                            $btn.parent(".btn-group-vertical").find(".btn-r").remove();
                        
                        
                    },
                });
                return false;
            });
@endpush


