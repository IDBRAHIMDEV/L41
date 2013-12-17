@extends('layouts.master')


@section('content')

<br>
<br>
<br>
<div class="container nav-hidden" id="content">
	  

	  

		<div id="main">
			<div class="container-fluid">
             
             <div class="page-header">
					<div class="pull-left">
						<h1>Accès au Remboursement</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="{{ URL::to('home') }}">Acceuil</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#">Remboursement</a>
							
						</li>
						
						
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i></a>
					</div>
				</div><br>



			  <div class="row-fluid">
			  	<div class="span12">
			  		

			  		<div class="bs-docs-example">
			  		  @foreach($contrats as $contrat)
			  		     @if(isset($contrat->remboursement->login))	
			  		  <br> 
			  			<div class="media">
			  				<a class="pull-left" href="{{ $contrat->gamme->compagnie->site }}" target="_blank">
			  					<img class="media-object"  style="width: 200px; height: 100px;" src="{{ asset($contrat->gamme->compagnie->chemin) }}">
			  				</a>
			  				<div class="media-body">
			  					<h4 class="media-heading">{{ $contrat->gamme->compagnie->libelle }} {{ $contrat->contratecg }}</h4>
			  					 
                                 <br>
			  					 <table class="table table-hover table-nomargin">
									
									<tbody>
										<tr>
											<td width="320px"><h5>Login</h5></td>
											<td >
												<h5><span class="label label-success">{{ $contrat->remboursement->login }}</span></h5>
											</td>
											
										</tr>

										<tr>
											<td width="320px"><h5>Mot de passe : </h5></td>
											<td >
												<h5><span class="label label-success">{{ $contrat->remboursement->password }}</span></h5>
											</td>
											
										</tr>

										<tr>
											<td width="320px"><h5>Site</h5></td>
											<td>
												{{ HTML::link($contrat->gamme->compagnie->site, 'Accèder', array('target' => '_blank')) }}
											</td>
											
										</tr>
										
									</tbody>
								</table>


			  				</div>
			  			</div>
			  			@else
			  			  <div align="center"><br>
			  			    <span class="label label-inverse"><h3>Indisponible <i class="icon-exclamation-sign"></i> </h3></span><br><br>
                            {{ HTML::link('home', 'Retour') }}
			  			  </div>
			  			@endif
			  		  @endforeach
			  		</div>


			  	</div>
			  </div>
			</div>
		</div>
</div>

@stop