@extends('layouts.admin')

@section('content')

<!-- dataTables -->
	{{ HTML::script('js/plugins/datatable/jquery.dataTables.min.js') }}
	{{ HTML::script('js/plugins/datatable/TableTools.min.js') }}
	{{ HTML::script('js/plugins/datatable/ColReorderWithResize.js') }}
	{{ HTML::script('js/plugins/datatable/ColVis.min.js') }}
	{{ HTML::script('js/plugins/datatable/jquery.dataTables.columnFilter.js') }}
	{{ HTML::script('js/plugins/datatable/jquery.dataTables.grouping.js') }}





<style>
	td.etat {
		text-align: center;
	}
</style>

<br><br>


<div id="modal-1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel"><i class="glyphicon-old_man"></i> Nouveau Utilisateur</h3>
		<br>
	</div>
	<div class="modal-body" id="">
		
		<div class="box">
			
			<div class="box-content nopadding">
				
				<form action="users/create" id="form" method="POST" class='form-horizontal form-bordered'>
				 
					<div class="control-group">
						<label for="nom" class="control-label">Nom</label>
						<div class="controls">
							<input type="text" name="nom" id="nom" class="x-large">
						</div>
					</div>

					<div class="control-group">
						<label for="prenom" class="control-label">Prénom</label>
						<div class="controls">
							<input type="text" name="prenom" id="prenom" class="x-large">
						</div>
					</div>

					<div class="control-group">
						<label for="login" class="control-label">Login</label>
						<div class="controls">
							<input type="text" name="login" id="login" class="x-large">
						</div>
					</div>
                    <div class="control-group">
						<label for="password" class="control-label">password</label>
						<div class="controls">
							<input type="password" name="password" id="password" class="x-large">
						</div>
					</div>

					<div class="control-group">
						<label for="email" class="control-label">Email</label>
						<div class="controls">
							<input type="text" name="email" id="email" class="x-large">
						</div>
					</div>


					<div class="control-group">
						<label for="profile" class="control-label">Profile</label>
						<div class="controls">
							<select name="profile" id="profile">
								<option value="EXPRT">Expert</option>
								<option value="ADMIN">Administrateur</option>
								
							</select>
						</div>
					</div>

					
					<br>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Envoyer</button>
						<button type="button" class="btn" data-dismiss="modal">Annuler</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<div class="container" >
<div class="row-fluid">
	<div class="span6"></div>
	<div class="span6"></div>
</div>


 <div class="row_fluid">
 	<div class="span10 offset1">
 		@if (Session::has('flash_success'))
 		<div class="alert alert-success">
 			<button data-dismiss="alert" class="close" type="button">×</button>
 			<strong>Succès! </strong> {{ Session::get('flash_success') }}
 		</div>
 		@endif
 	</div>
 </div>

 <div class="row_fluid">
 	<div class="span10 offset1">
 		@if (Session::has('flash_errors'))
 		<div class="alert alert-error">
 			<button data-dismiss="alert" class="close" type="button">×</button>
 			<strong>Succès! </strong> {{ Session::get('flash_errors') }}
 		</div>
 		@endif
 	</div>
 </div>

 @if ( $errors->count() > 0 )
 <br>
 <div class="row-fluid">
 	<div class="span12">
 		<div class="alert alert-error">
 			<button data-dismiss="alert" class="close" type="button">×</button>
 			<strong>Merci de bien remplir tous les champs du formulaire</strong>

 			<ul>
 				@foreach( $errors->all() as $message )
 				<li>{{ $message }}</li>
 				@endforeach
 			</ul>
 		</div>
 	</div>
 </div>
 @endif



			<div class="row-fluid">
				<div class="span12">
					<div class="box ">
						<div class="box-title">
							<h3>
								<i class="glyphicon-group"></i> Liste des Utilisateurs
							</h3>
							<div class="actions">
							   <a href="#modal-1" class="btn btn-mini" role="button" data-toggle="modal" rel="tooltip" data-original-title="Ajouter"><i class="glyphicon-user_add" ></i></a>
								<a href="{{ URL::to('users') }}" class="btn btn-mini " rel="tooltip" data-original-title="Actualise"><i class="icon-refresh" ></i></a>
								<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
								<a href="#" class="btn btn-mini content-slideUp"  ><i class="icon-angle-down"></i></a>
							</div>
						</div>
						<div class="box-content nopadding">
							<table class="table table-hover table-nomargin table-bordered usertable">
								<thead>
									
									<tr>
										<th></th>
										<th>Login</th>
										<th>Nom complet</th>
										<th class='hidden-1024'>Email</th>
										
										<th class='hidden-1024'>Profile</th>
										<th>Action</th>
										<th class="hidden-1024">Date</th>
									</tr>
								</thead>
								<tbody>
									@foreach($users as $user)
                                    
                                    <?php 
                                       $type = 'success';
                                       if($user->type == 'EXPRT') {
                                          $type = 'warning';
                                      }

                                           $title = "";
	                                       if($user->compteur > 0) {
	                                       	  $title =  $user->compteur." fois connecté, Dernière connection le ".date('d/m/Y', strtotime($user->connexion))." à ".date('H:i:s', strtotime($user->connexion));               
	                                       	}
                                       
                                    ?>

									<tr class="{{ $type }}" rel="tooltip" data-original-title="{{ $title }}">
										<td class="etat" >
											@if($user->etat == '1')
											{{ HTML::image('img/on.png') }}
											@else
											{{ HTML::image('img/off.png') }}
											@endif
										</td>
										<td>{{ $user->username }}</td>
										<td>{{ $user->prenom }} {{ $user->nom }}</td>
										<td class='hidden-1024'>
											{{ $user->emailpro }}
										</td>
										<td class='hidden-1024'>@if($user->type == 'ADMIN')
											<h5 align="center"> Admin</h5>
											@else
											<h5 align="center"> Expert</h5>
											@endif
										</td>
										<td class="etat">
										    <a href="{{ URL::to('users/profile') }}/{{ $user->id }}"  role="button" class="btn edit" data-toggle="modal" rel="tooltip" title="" data-original-title="Editer"><i class="icon-edit"></i></a>
											<a href="{{ URL::to('users/etat') }}/{{$user->id}}/{{$user->etat}}"  role="button" class="btn " data-toggle="modal" rel="tooltip" title="" data-original-title="Changer etat"><i class="glyphicon-power"></i></a>
										</td>
										<td class='hidden-1024 etat'>{{ date('d/m/Y  H:i', strtotime($user->updated_at)) }}</td>
									</tr>
									@endforeach
									
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>






			<div class="row-fluid">
				<div class="span12">
					<div class="box ">
						<div class="box-title">
							<h3>
								<i class="glyphicon-parents"></i> Liste des clients
							</h3>
							<div class="actions">
								<a href="{{ URL::to('users') }}" class="btn btn-mini " rel="tooltip" data-original-title="Actualise"><i class="icon-refresh" ></i></a>
								<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
								<a href="#" class="btn btn-mini content-slideUp"  ><i class="icon-angle-down"></i></a>
							</div>
						</div>
						<div class="box-content nopadding">
							<table class="table table-hover table-nomargin table-bordered usertable">
								<thead>
                                       
									<tr>
										<th></th>
										<th>Login</th>
										<th>Nom complet</th>
										<th class='hidden-1024'>Email</th>

										<th class='hidden-1024'>Sexe</th>
										<th>Action</th>
										<th class="hidden-1024">Date</th>
									</tr>
								</thead>
								<tbody>
									@foreach($clients as $client)

									 <?php 
	                                       $type = '';
	                                       if($client->compteur == 0) {
	                                          $type = 'info';
	                                       }
                                           $title = "";
	                                       if($client->compteur > 0) {
	                                       	  $title =  $client->compteur." fois connecté, Dernière connection le ".date('d/m/Y', strtotime($client->connexion))." à ".date('H:i:s', strtotime($client->connexion));               
	                                       	}
	                                    ?>
									<tr class="{{ $type }}" rel="tooltip" data-original-title="{{ $title }}">
										<td class="etat">
											@if($client->etat == '1')
											{{ HTML::image('img/on.png') }}
											@else
											{{ HTML::image('img/off.png') }}
											@endif
										</td>
										<td>{{ $client->username }}</td>
										<td>{{ $client->prenom }} {{ $client->nom }}</td>
										<td class='hidden-1024'>
											{{ $client->emailpro }}
										</td>
										<td class='hidden-1024'>@if($client->sexe == 'F')
											<h5 align="center"><i class="glyphicon-female"></i> Female</h5>
											@else
											<h5 align="center"><i class="glyphicon-male"></i> Male</h5>
											@endif
										</td>
										<td class="etat">
											 <a href="{{ URL::to('users/profile') }}/{{ $client->id }}"  role="button" class="btn edit" data-toggle="modal" rel="tooltip" title="" data-original-title="Editer"><i class="icon-edit"></i></a>
											 <a href="{{ URL::to('users/etat') }}/{{$client->id}}/{{$client->etat}}"  role="button" class="btn " data-toggle="modal" rel="tooltip" title="" data-original-title="Changer etat"><i class="glyphicon-power"></i></a>
                                             <a href="{{ URL::to('user/details/') }}/{{$client->id}}"  role="button" class="btn " data-toggle="modal" rel="tooltip" title="" data-original-title="Détails"><i class="icon-search"></i></a>
										</td>
										<td class='hidden-1024 etat'>{{ date('d/m/Y  H:i', strtotime($client->updated_at)) }}</td>
									</tr>
									@endforeach

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

</div>


@stop