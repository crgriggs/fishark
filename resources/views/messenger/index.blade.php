@extends('app')

@section('content')
<style>
    body {
    background-image: url("../image/background.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center; 
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Messages</div>
                <div class="panel-body">
                        @if (Session::has('error_message'))
                            <div class="alert alert-danger" role="alert">
                                {!! Session::get('error_message') !!}
                            </div>
                        @endif

                        @if($threads->count() > 0)
                            @foreach($threads as $thread)
                                <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
                                <div id="thread_list_{{$thread->id}}" class="media alert {!!$class!!}">
                                    <h4 class="media-heading">{!! link_to('messages/' . $thread->id, $thread->subject) !!}</h4>
                                    <p id="thread_list_{{$thread->id}}_text">{!! $thread->latestMessage->body !!}</p>
                                    <p><small><strong>Participants:</strong> {!! $thread->participantsString(Auth::id(), ['name']) !!}</small></p>
                                </div>
                            @endforeach
                        @else
                            <p>Sorry, no threads.</p>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>

    
@stop
