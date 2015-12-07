@extends('app')

@section('content')
<style>
	body {
    background-image: url("image/background.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center; 
}

</style>

<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					You are logged in! Try adding your colonies <a href="{{ url('/breeder/create') }}">here</a> 
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
