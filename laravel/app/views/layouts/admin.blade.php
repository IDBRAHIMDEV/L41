<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ECG PEREIRE ASSURANCES</title>
    
    <!-- Bootstrap -->
	{{ HTML::style('css/bootstrap.min.css') }}
	<!-- Bootstrap responsive -->
	{{ HTML::style('css/bootstrap-responsive.min.css') }}
	<!-- jQuery UI -->
	{{ HTML::style('css/plugins/jquery-ui/smoothness/jquery-ui.css') }}
	{{ HTML::style('css/plugins/jquery-ui/smoothness/jquery.ui.theme.css') }}
	<!-- PageGuide -->
	{{ HTML::style('css/plugins/pageguide/pageguide.css') }}
	<!-- Fullcalendar -->
	{{ HTML::style('css/plugins/fullcalendar/fullcalendar.css') }}
	{{ HTML::style('css/plugins/fullcalendar/fullcalendar.print.css') }}
	<!-- chosen -->
	{{ HTML::style('css/plugins/chosen/chosen.css') }}
	<!-- select2 -->
	{{ HTML::style('css/selectric.css') }}
	<!-- icheck -->
	{{ HTML::style('css/plugins/icheck/all.css') }}
	<!-- Theme CSS -->
	{{ HTML::style('css/style.css') }}
	<!-- Color CSS -->
	{{ HTML::style('css/themes.css') }}
    <!-- Datepicker -->
	{{ HTML::style('css/plugins/datepicker/datepicker.css') }}
	<!-- Daterangepicker -->
	{{ HTML::style('css/daterangepicker-bs2.css') }}
   


	<!-- jQuery -->
	{{ HTML::script('js/jquery.min.js') }}
	
	{{ HTML::script('js/i18n/messages.fr.js') }}
	{{ HTML::script('js/parsley.js') }}


	
	
	<!-- Nice Scroll -->
	{{ HTML::script('js/plugins/nicescroll/jquery.nicescroll.min.js') }}
	<!-- imagesLoaded -->
	{{ HTML::script('js/plugins/imagesLoaded/jquery.imagesloaded.min.js') }}
	<!-- jQuery UI -->
	{{ HTML::script('js/plugins/jquery-ui/jquery.ui.core.min.js') }}
	{{ HTML::script('js/plugins/jquery-ui/jquery.ui.widget.min.js') }}
	{{ HTML::script('js/plugins/jquery-ui/jquery.ui.mouse.min.js') }}
	{{ HTML::script('js/plugins/jquery-ui/jquery.ui.draggable.min.js') }}
	{{ HTML::script('js/plugins/jquery-ui/jquery.ui.resizable.min.js') }}
	{{ HTML::script('js/plugins/jquery-ui/jquery.ui.sortable.min.js') }}
	<!-- Touch enable for jquery UI -->
	{{ HTML::script('js/plugins/touch-punch/jquery.touch-punch.min.js') }}
	<!-- slimScroll -->
	{{ HTML::script('js/plugins/slimscroll/jquery.slimscroll.min.js') }}
	<!-- Bootstrap -->
	{{ HTML::script('js/bootstrap.min.js') }}
	<!-- vmap -->
	{{ HTML::script('js/plugins/vmap/jquery.vmap.min.js') }}
	{{ HTML::script('js/plugins/vmap/jquery.vmap.world.js') }}
	{{ HTML::script('js/plugins/vmap/jquery.vmap.sampledata.js') }}
	<!-- Bootbox -->
	{{ HTML::script('js/plugins/bootbox/jquery.bootbox.js') }}
	<!-- Flot -->
	{{ HTML::script('js/plugins/flot/jquery.flot.min.js') }}
	{{ HTML::script('js/plugins/flot/jquery.flot.bar.order.min.js') }}
	{{ HTML::script('js/plugins/flot/jquery.flot.pie.min.js') }}
	{{ HTML::script('js/plugins/flot/jquery.flot.resize.min.js') }}
	<!-- imagesLoaded -->
	{{ HTML::script('js/plugins/imagesLoaded/jquery.imagesloaded.min.js') }}
	<!-- PageGuide -->
	{{ HTML::script('js/plugins/pageguide/jquery.pageguide.js') }}
	<!-- FullCalendar -->
	{{ HTML::script('js/plugins/fullcalendar/fullcalendar.min.js') }}
	<!-- Chosen -->
	{{ HTML::script('js/plugins/chosen/chosen.jquery.min.js') }}
	<!-- select2 -->
	{{ HTML::script('js/jquery.selectric.min.js') }}
	<!-- icheck -->
	{{ HTML::script('js/plugins/icheck/jquery.icheck.min.js') }}
	<!-- moment -->
	{{ HTML::script('js/moment.js') }}
<!-- Datepicker -->
	{{ HTML::script('js/plugins/datepicker/bootstrap-datepicker.js') }}
	<!-- Daterangepicker -->
	{{ HTML::script('js/daterangepicker.js') }}

	<!-- Theme framework -->
	{{ HTML::script('js/eakroko.min.js') }}
	<!-- Theme scripts -->
	{{ HTML::script('js/application.min.js') }}
	<!-- Just for demonstration -->
	{{ HTML::script('js/demonstration.js') }}

	{{ HTML::script('js/plugins/jquery-ui/jquery.ui.spinner.js') }}


<script>
	
	$(document).ready(function(){
           
           $('.themeColor').click(function(){
               id = $(this).attr('id');
                $.ajax({
                   	type: "get",
                   	data: "theme="+id,
					url: "{{ URL::to('theme') }}",
					context: document.body
			    }).done(function(data) {
			        $('.themeColor').addClass('theme-'+id);
                });
           });

	});

</script>
	
</head>
<body class="theme-{{ Auth::User()->theme }}">
     
     <div id="navigation" class="navbar-fixed-top">
		<div class="container-fluid">
			<a href="#" id="brand">ECG PEREIRE</a>
			<ul class='main-nav'>
				<li class='active'>
					<a href="{{ URL::to('home') }}">
						<span><i class="glyphicon-charts"></i> Statistique</span>
					</a>
				</li>
				<li>
					<a href="#"  data-toggle="dropdown" class='dropdown-toggle'>
						<span><i class="glyphicon-cogwheel"></i> Paramètrage</span>
						<span class="caret"></span>
						
					</a>
					<ul class="dropdown-menu">
						<li>
							<a href="{{ URL::to('users') }}" ><i class="glyphicon-parents"></i> Utilisateur</a>
						</li>
						<li>
							<a href="{{ URL::to('parametrage') }}" ><i class="glyphicon-cogwheels"></i> Réglages</a>
						</li>
						
					</ul>
					
				</li>
				
				<li>
					<a href="{{ URL::to('demandes') }}"  class='dropdown-toggle'>
						<span><i class="glyphicon-circle_question_mark"></i> Demandes</span>
						
					</a>
					
				</li>

				<li>
					<a href="{{ URL::to('messages') }}"  class='dropdown-toggle'>
						<span><i class="glyphicon-message_empty"></i> Messages</span>
						
					</a>
					
				</li>
				
			</ul>
			<div class="user">
				<ul class="icon-nav">
					
					<li class='dropdown colo'>
						<a href="#" class='dropdown-toggle' data-toggle="dropdown"><i class="icon-tint"></i></a>
						<ul class="dropdown-menu pull-right theme-colors">
							<li class="subtitle">
								Choix du couleur
							</li>
							<li>
								<span class='red themeColor' id="red"></span>
								<span class='orange themeColor' id="orange"></span>
								<span class='green themeColor' id="green"></span>
								<span class="brown themeColor" id='brown'></span>
								<span class="blue themeColor" id="blue"></span>
								<span class='lime themeColor' id="lime"></span>
								<span class="teal themeColor" id="teal"></span>
								<span class="purple themeColor" id="purple"></span>
								<span class="pink themeColor" id="pink"></span>
								<span class="magenta themeColor" id="magenta"></span>
								<span class="grey themeColor" id="grey"></span>
								<span class="darkblue themeColor" id="darkblue"></span>
								<span class="lightred themeColor" id="lightred"></span>
								<span class="lightgrey themeColor" id="lightgrey"></span>
								<span class="satblue themeColor" id="satblue"></span>
								<span class="satgreen themeColor" id="satgreen"></span>
							</li>
						</ul>
					</li>
					
				</ul>
				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown"> {{ Auth::User()->prenom }} {{ Auth::User()->nom }} {{ HTML::image(Auth::User()->image, 'profile', array('height' => 27, 'width' => 27)) }}</a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="{{ URL::to('profile') }}">Profile</a>
						</li>
						<li>
							<a href="{{ URL::to('logout') }}">Déconnexion</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>


    <div id="clock" class="light">
			<div class="display">
				<div class="weekdays"></div>
				<div class="ampm"></div>
				<div class="alarm"></div>
				<div class="digits"></div>
			</div>
		</div>
       
     @yield('content')
     
</body>
</html>