@extends('app')

@section('content')

<link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.1/css/lightbox.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.1/js/lightbox-plus-jquery.js"></script>
<style>
body {
    background-image: url("../image/background.jpg");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center; 
}
p {
    margin-right: 4%;
    margin-left: 4%;
}

</style>

<input type="hidden" id="refreshed" value="no">
<script type="text/javascript">
    onload=function(){
        var e=document.getElementById("refreshed");
        if(e.value=="no")e.value="yes";
        else{e.value="no";location.reload();}
    }
</script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">{{$species->id}}</div>
                <div class="panel-body">
                    <p> {{$species->description}} </p>

                    <p> There are {{$numFish}} in captivity</p>

             
                    @if($photos != null)
                        <p><b> Images </b></p>
                        
                            @foreach ($photos as $photo)
                                <div class="col-sm-3 form-group">
                                    <a href='{{str_replace("/var/lib/openshift/561d4c89da16db1109000455/app-root/runtime/repo/public/", "../", $photo)}}' data-lightbox="{{$species->id}}">
                                        <img src = '{{str_replace("/var/lib/openshift/561d4c89da16db1109000455/app-root/runtime/repo/public/", "../", $photo)}}'  class="img-responsive">
                                    </a>
                                    @if (!Auth::guest())
                                        @if (Auth::user()->isAdmin)
                                            {!! Form::open( ['method' => 'DELETE', 'action' => 'SpeciesController@destroyResource']) !!}
                                                <input name="path" type="hidden" value="{{$photo}}">
                                                {!! Form::submit('Delete', ['class' => 'btn btn-default small']) !!}
                                            {!!Form::close() !!}
                                        @endif  
                                    @endif
                                </div>

                            @endforeach
                          
                    @endif
                   


                    @if($notes != null)
                    <div class = "col-sm-12">
                    <p><b> Breeder Notes </b></p>
                        @foreach ($notes as $note)
                            <p>
                                <a href='{{str_replace("/var/lib/openshift/561d4c89da16db1109000455/app-root/runtime/repo/public/", "../", $note)}}'>
                                    {{substr(str_replace("/var/lib/openshift/561d4c89da16db1109000455/app-root/runtime/repo/public/speciesResources/" . $species->id . "/notes/", "", $note), 10)}}
                                </a>
                                    @if (!Auth::guest())
                                    @if (Auth::user()->isAdmin)
                                       {!! Form::open( ['method' => 'DELETE', 'action' => 'SpeciesController@destroyResource']) !!}
                                            <input name="path" type="hidden" value="{{$note}}">
                                            {!! Form::submit('Delete', ['class' => 'btn btn-default small']) !!}
                                        {!!Form::close() !!}
                                     @endif  
                                @endif
                            </p>
                        @endforeach
                    </div>
                    @endif

                    <br>

                    @if(Auth::check())
                        @if (count($breeders) > 0)
                        <div class = "col-sm-12">
                        <p><b> Breeders </b></p>
                            @foreach ($breeders as $breeder)
                                <article style="margin-left:4%;">
                                    <a href="{{ action('BreederController@show', [$breeder->username]) }}">{{$breeder->username}}</a>
                                </article>  
                            @endforeach
                        </div>
                        @endif
                    @endif

                    <br>

                    @if (!Auth::guest())
                    <div class = "col-sm-12">
                    <button type="button" class="btn btn-default small" onclick="location.href='/species/{{$species->id}}/edit'">Edit {{$species->id}}</button>
                    <button type="button" class="btn btn-default small" onclick="location.href='/species/{{$species->id}}/addImage'">Add photos of {{$species->id}}</button>
                    <button type="button" class="btn btn-default small" onclick="location.href='/species/{{$species->id}}/addNotes'">Add breeder notes for {{$species->id}}</button>
                    <button type="button" class="btn btn-default small" data-toggle="modal" data-target="#myModal">Widget</button>
                    @if (Auth::user()->isAdmin)
                        {!! Form::open( ['method' => 'DELETE', 'action' => ['SpeciesController@destroy', $species->id]]) !!}
                                        
                            {!! Form::submit('Delete', ['class' => 'btn btn-default small']) !!}

                        {!!Form::close() !!}
                    @endif
                     </div> 
                    @endif


  <!-- Trigger the modal with a button -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Copy this html into your site</h4>
        </div>
        <div class="modal-body">
          <p><xmp><a href = "http://fishark.biology.unc.edu/species/{{$species->id}}">
   <style>
      a:link {
      color: white;
      text-decoration: none;
      }
      a:visited {
      color: white;
      text-decoration: none;
      }
   </style>
   <div style="width: 100px;
      height: 50px;
      border-style: solid;
      border-width: 2px;
      border-color: black;
      background-image: url(http://fishark.biology.unc.edu/image/background.jpg)">
      <img src="http://fishark.biology.unc.edu/image/pupfish.png" alt="Pupfish"
       style="width: 50px; height: 50px; float: left;" >
      <div>
         <p style="text-align: center; font-family: Roboto, Helvetica, Arial, sans-serif;">{{$numFish}}</p>
      </div>
   </div>
</a></xmp></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection