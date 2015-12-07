@extends('app')

@section('content')
<style>
    body {
    background-image: url("../../image/background.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center; 
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @foreach ($users as $user)
                <div class="panel-heading">Send {!! $user->name !!} a Message</div>
                @endforeach
                <div class="panel-body">
                        {!! Form::open(['route' => 'messages.store']) !!}
                        <div class="col-md-6">
                            <!-- Subject Form Input -->
                            <div class="form-group">
                                {!! Form::label('subject', 'Subject', ['class' => 'control-label']) !!}
                                {!! Form::text('subject', null, ['class' => 'form-control']) !!}
                            </div>

                            <!-- Message Form Input -->
                            <div class="form-group">
                                {!! Form::label('message', 'Message', ['class' => 'control-label']) !!}
                                {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                            </div>
                            
                             <input name="recipients[]" type="hidden" value="{!! $user->id !!}">
                             
                             
                            <!-- Submit Form Input -->
                            <div class="form-group">
                                {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                        @if ($errors ->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors -> all() as $error)
                                    <li> {{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
