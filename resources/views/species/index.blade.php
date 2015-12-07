@extends('app')

@section('content')

<style>
	body {
    background-image: url("image/background.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center; 
}
article {
    margin-right: 8%;
    margin-left: 8%;
}

</style>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Species</div>
				<div class="panel-body">
					@foreach ($species as $species)
						<article>
							<a href="{{ action('SpeciesController@show', [$species->id]) }}">{{$species->id}}</a>
					    </article>  
					@endforeach

					@if(Auth::check())
					@if(Auth::user()->isAdmin == 1)
						<button type="button" class="btn btn-primary" value="Create Species" title="Create Species" onclick="location.href='/species/create'">Create Species</button>

				</div>
			</div>
		</div>
	</div>
</div>

@endif
@endif

@endsection 		
