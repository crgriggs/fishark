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
					<div class="panel-heading">Add a Species</div>
					<div class="panel-body">

						{!! Form::open(['url' => 'species']) !!}
						<div class = "form-group">
							{!! Form::label('scientific name', 'Scientific Name:', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::text('id', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class = "form-group">
							{!! Form::label('description', 'Description:', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::textarea('description', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class = "form-group">
							<div class="col-md-6 col-md-offset-4">
								{!! Form::submit('Add Fish', ['class' => 'btn btn-primary form-control']) !!}
							</div>
						</div>

						{!!Form::close() !!}

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