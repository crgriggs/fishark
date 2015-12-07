@extends('app')

@section('content')
<script src = "https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.js"></script>
<script>

Dropzone.options.addPhotosForm = {
  paramName: "file", // The name that will be used to transfer the file
  maxFilesize: 10, 
  acceptedFiles: '.jpg, .jpeg, .png, bmp',
}

</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/dropzone.css">
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
                    <div class="panel-heading">Add photos of {{$id}}</div>
                    <div class="panel-body">
                    <p><small>Drag and drop photos below or click within box for typical file upload</small></p> 
                       <form id = "addPhotosForm" class="dropzone" method="POST" action="http://fishark.biology.unc.edu/species/addImage" accept-charset="UTF-8" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input name="id" type="hidden" value="{{ $id }}">
                        </form>
                        @if ($errors ->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors -> all() as $error)
                                    <li> {{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <br>
                        <button style="display: block; width: 100%;" type="button" class="btn btn-primary" value="Return to Page" title="Return to Page" onClick="history.go(-1);return true;">Return to Page</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


