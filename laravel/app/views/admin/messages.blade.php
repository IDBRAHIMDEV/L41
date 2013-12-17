@extends('layouts.admin')

@section('content')

<script type="text/javascript">

 


function recupIdcontrat(id) {
$('#idcontrat').val(id);
}


 function recupId(id) {
 	$('#idreclamation').val(id);
 }

   
 </script>

<!-- dataTables -->
	{{ HTML::script('js/plugins/datatable/jquery.dataTables.min.js') }}
	{{ HTML::script('js/plugins/datatable/TableTools.min.js') }}
	{{ HTML::script('js/plugins/datatable/ColReorderWithResize.js') }}
	{{ HTML::script('js/plugins/datatable/ColVis.min.js') }}
	{{ HTML::script('js/plugins/datatable/jquery.dataTables.columnFilter.js') }}
	{{ HTML::script('js/plugins/datatable/jquery.dataTables.grouping.js') }}

<style>
	.actualiser {
		margin-right: 5px;
	}
</style>



<div id="modal-1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel"><i class="icon-envelope"></i> Envoi de message</h3>
		<br>
	</div>
	<div class="modal-body" id="">
		
		<div class="box">
			
			<div class="box-content nopadding">
				
				<form action="demandes/message" method="POST" class='form-horizontal form-bordered'>
				  <input type="hidden" name="idcontrat" id="idcontrat" value="">
				  <input type="hidden" name="mode" id="idcontrat" value="1">
					<div class="control-group">
						<label for="objet" class="control-label">Objet</label>
						<div class="controls">
							<input type="text" name="objet" class="x-large">
						</div>
					</div>


					<div class="control-group">
						<label for="message" class="control-label">Message</label>
						<div class="controls">
							<textarea name="message" id="message" rows="5" class="input-block-level"></textarea>
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



<br><br>
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
						<div class="box  box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-envelope"></i> Liste des messages
								</h3>
								<div class="actions">
										<a href="{{ URL::to('messages') }}" class="btn btn-mini "><i class="icon-refresh" rel="tooltip" data-original-title="Actualise"></i></a>
										<a href="#" class="btn btn-mini content-slideUp"  ><i class="icon-angle-down"></i></a>
									</div>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered usertable">
									<thead>
										
										<tr>
											<th># Contrat</th>
											<th class="hidden-1024">Nom complet</th>
											<th>Objet</th>
											<th class="hidden-1024">Message</th>
											<th class='hidden-350'>Genre</th>
											
											<th class='hidden-480'>Action</th>
											<th class="hidden-1024">Responsable</th>
											<th class="hidden-1024">Date</th>
										</tr>
									</thead>
									<tbody>
                                      

									  @foreach($messages as $message)
										<tr>
											
											<td>{{ $message->contrat->contratecg }}</td>
											<td class="hidden-1024">{{ $message->contrat->user->prenom }} {{ $message->contrat->user->nom }}</td>
											<td >{{ $message->objet }}</td>
											<td class="hidden-1024">{{ substr($message->message, 0, 80) }}...</td>

											<?php 
											   if($message->genre == 1) {
                                                    $genre = "Sortant";
                                                    $genre_color = "magenta";
											   }else{
                                                    $genre = "Entrant";
                                                    $genre_color = "purple";
											   }
											?>
                                                 
											<td class='hidden-350'><span class="label label-{{ $genre_color}}">{{ $genre }}</span></td>
											
											<td class='hidden-480' align="center">

												<a href="#modal-1" onclick="recupIdcontrat({{$message->contrat_id}})" role="button" class="btn btn-large" data-toggle="modal" id="" rel="tooltip" title="Envoyer un message"><i class="icon-envelope"></i></a>
											</td>
											<td class="hidden-1024">{{ $message->destinataire }}</td>
											<td class="hidden-1024">{{ date('d/m/Y H:s', strtotime($message->updated_at)) }}</td>
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