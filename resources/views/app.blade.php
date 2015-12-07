<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Fish Ark</title>

	
	<link href="{{ asset('/image/pupfish.png') }}"rel="shortcut icon">

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/all.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/home') }}"><img src="/image/pupfish.png" height="50"> </a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/species') }}">View Fish Ark Database</a></li>
					@if (!Auth::guest())
					<li><a href="{{ route('messages') }}">Messages @include('messenger.unread-count')</a></li>
					@endif
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
								<li><a href="{{ url('/breeder/create') }}">Add New Colony</a></li>
								<li><a href="{{ url('/breeder') }}">Your Colonies</a></li>
								<li><a href="{{ route('messages.create') }}">Send New Message</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="{{ asset('/js/all.js') }}" type="text/javascript"></script>
    @if(Auth::check())
        <script src="//js.pusher.com/2.2/pusher.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            var pusher = new Pusher('{{Config::get('pusher.appKey')}}');
            var channel = pusher.subscribe('for_user_{{Auth::id()}}');
            channel.bind('new_message', function(data) {
                var thread = $('#' + data.div_id);
                var thread_id = data.thread_id;
                var thread_plain_text = data.text;
                if (thread.length) {
                    // add new message to thread
                    thread.append(data.html);
                    // make sure the thread is set to read
                    $.ajax({
                        url: "/messages/" + thread_id + "/read"
                    });
                } else {
                    var message = '<p>' + data.sender_name + ' said: ' + data.text + '</p><p><a href="' + data.thread_url + '">View Message</a></p>';
                    // notify the user
                    $.growl.notice({ title: data.thread_subject, message: message });
                    // set unread count
                    $.ajax({
                        url: "{{route('messages.unread')}}"
                    }).success(function( data ) {
                        var div = $('#unread_messages');
                        var count = data.msg_count;
                        if (count == 0) {
                            $(div).addClass('hidden');
                        } else {
                            $(div).text(count).removeClass('hidden');
                            // if on messages.index - add alert class and update latest message
                            $('#thread_list_' + thread_id).addClass('alert-info');
                            $('#thread_list_' + thread_id + '_text').html(thread_plain_text);
                        }
                    });
                }
            });
        </script>
    @endif
</body>
</html>
