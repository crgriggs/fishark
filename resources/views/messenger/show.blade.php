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
                <div class="panel-heading">{!! $thread->subject !!}</div>
                <div class="panel-body">
                        <div class="col-md-6">
                            <div id="thread_{{$thread->id}}">
                                @foreach($thread->messages()->latest()->get() as $message)
                                    @include('messenger.html-message', $message)
                                @endforeach
                            </div>

                            <h2>Add a new message</h2>
                            
                            {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
                            
                            <!-- Message Form Input -->
                            <div class="form-group">
                                {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                            </div>

                            <!-- Submit Form Input -->
                            <div class="form-group">
                                {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
