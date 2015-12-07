@extends('app')

@section('content')
<style>
	body {
    background-image: url("../image/background.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center; 
}
ul {
    margin-right: 4%;
    margin-left: 4%;
    list-style-type: none;
}
form {
    float: left;
    margin-left: 12px;
}
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$id}}'s Colonies</div>
                <div class="panel-body">
                	<ul>
						@foreach ($breeders as $breeder)
							<li><p>{{$breeder->speciesID}} {{$breeder->numFish}}</p>
                                <div>
        							<button style="float: left" type="button" class="btn btn-default small" value="Edit {{$breeder->id}}" title="Edit {{$breeder->id}}" onclick="location.href='/breeder/{{$breeder->username}}/{{$breeder->id}}/edit'">Edit</button>
        							{!! Form::open( ['method' => 'DELETE', 'action' => ['BreederController@destroy', $breeder->id]]) !!}
        											
        								{!! Form::submit('Delete', ['class' => 'btn btn-default small']) !!}

        							{!!Form::close() !!}	
                                    
                                    <br>
                                    <br>
                                    <br>
                                </div>
							</li>

						@endforeach
					</ul>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
