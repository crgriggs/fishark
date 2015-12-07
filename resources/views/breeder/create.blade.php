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
					<div class="panel-heading">Add a Colony</div>
					<div class="panel-body">

						{!! Form::open(['url' => 'breeder']) !!}
						<div class = "form-group">
							{!! Form::label('speciesID', 'Scientific Name:', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::text('speciesID', null, ['class' => 'form-control','id' => 'typeahead', 'v-model' => 'query', 'keyup: search']) !!}
							</div>
						</div>

						<div class = "form-group">
							{!! Form::label('numFish', 'Number of Fish in Colony:', ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::text('numFish', null, ['class' => 'form-control']) !!}
							</div>
						</div>

						<div class = "form-group">
							<div class="col-md-6 col-md-offset-4">
								{!! Form::submit('Add Colony', ['class' => 'btn btn-primary form-control']) !!}
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

<script src="//cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/vue/0.12.1/vue.js"></script>
<script src= "https://cdn.jsdelivr.net/jquery/3.0.0-alpha1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/typeahead.js/0.11.1/typeahead.jquery.js"></script>

<script>
    new Vue({
        el: 'div.col-md-6',

        data: { query: '', users: [] },

        ready: function() {
            this.client = algoliasearch('DBIES9IHYQ', 'b4738e16087452a193206a6c674e79c2');
            this.index = this.client.initIndex('species');


        $('#typeahead').typeahead(null, {
			source: this.index.ttAdapter(),
			displayKey: 'id'/*,
			templates: {
				suggestion: function(hit) {
					return "<a href = 'http://fishark.biology.unc.edu/species/" + hit.id +'>' +hit.id+ '</a>';
				}
			}*/
		})
		.on('typeahead:select', function(e, suggestion){
			this.query = suggestion.id;

		}.bind(this));

        }

    });
</script>

<style>
em {
    background: yellow;
    font-style: normal;

}
* {
    box-sizing: border-box;
}

.tt-input {
	width: 100% !important;
}

span.twitter-typeahead {
	width: 100%;
}

.tt-suggestion {
	padding: 20px 10px;
	background: white;
	border-bottom: 1px #e3e3e3;
}

.tt-cursor{
	background: #e3e3e3;
}


</style>
@endsection