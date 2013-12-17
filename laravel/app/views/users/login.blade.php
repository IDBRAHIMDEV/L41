<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>ECG PEREIRE - CONNECTION</title>

	<!-- Bootstrap -->
	{{ HTML::style('css/bootstrap.min.css') }}
	<!-- Bootstrap responsive -->
	{{ HTML::style('css/bootstrap-responsive.min.css') }}
	<!-- icheck -->
	{{ HTML::style('css/plugins/icheck/all.css') }}
	<!-- Theme CSS -->
	{{ HTML::style('css/style.css') }}
	<!-- Color CSS -->
	{{ HTML::style('css/themes.css') }}


	<!-- jQuery -->
	{{ HTML::script('js/jquery.min.js') }}
	
	<!-- Nice Scroll -->
	{{ HTML::script('js/plugins/nicescroll/jquery.nicescroll.min.js') }}
	<!-- Validation -->
	{{ HTML::script('js/plugins/validation/jquery.validate.min.js') }}
	{{ HTML::script('js/plugins/validation/additional-methods.min.js') }}
	
	<!-- icheck -->
	{{ HTML::script('js/plugins/icheck/jquery.icheck.min.js') }}
	<!-- Bootstrap -->
	{{ HTML::script('js/bootstrap.min.js') }}
	{{ HTML::script('js/eakroko.js') }}

	<!--[if lte IE 9]>
		<script src="js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
	

	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

</head>

<body class='login'>
	<div class="wrapper">
		<h1><a href="#"><img src="img/logo-big.png" alt="" class='retina-ready' width="59" height="49">ECG PEREIRE</a></h1>

		<div class="login-body">

			<h2>CONNECTION</h2>

			      @if (Session::has('flash_error'))
				    <div class="alert alert-error">
						<button data-dismiss="alert" class="close" type="button">×</button>
						<strong>Problème! </strong> {{ Session::get('flash_error') }}
					</div>
	 			 @endif
			
			    {{ Form::open(array('url' => 'login')) }}
    
				<div class="control-group">
					<div class="email controls">
	   				    {{ Form::text('username','', array('id'=>'login', 'class'=>'input-block-level', 'placeholder'=>'Login')) }}					
                    </div>
				</div>
				<div class="control-group">
					<div class="pw controls">
						{{ Form::password('password', array('id'=>'password', 'class'=>'input-block-level', 'placeholder'=>'Mot de passe')) }}
					</div>
				</div>
				<div class="submit">
					
					<button class="btn btn-primary btn-block"><i class="glyphicon-power"></i> Connexion</button>
				</div>

			    {{ Form::close() }}

			<div class="forget">
				<a href="#"><span>Mot de passe oublié ?</span></a>
			</div>
		</div>
	</div>
</body>

</html>
