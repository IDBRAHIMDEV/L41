@extends('layouts.admin')

@section('content')

<script type="text/javascript">

 function details(id){
    	
             var idReclamation = id;
                $.ajax({
                   	type: "post",
                   	data: "idreclam="+idReclamation,
					url: "{{ URL::to('demande/details') }}",
					context: document.body
			    }).done(function(data) {         
                   $("#details").html(data);
                });

    }


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
		<h3 id="myModalLabel">Détails</h3>
	</div>
	<div class="modal-body" id="">


		<div class="box">
			<div class="box-title">

				<h3>
					<i class="icon-paper-clip"></i>
					Pièce jointe
				</h3>
			</div>
			<div class="box-content nopadding">
				<table class="table table-hover table-nomargin table-striped">
					<thead>
						<tr>
							<th></th>
							<th>Documents</th>
							<th>Télecharger</th>

						</tr>
					</thead>
					<tbody id="details">

					</tbody>
				</table>
			</div>
		</div>

	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Fermer</button>
	</div>
</div>




<div id="modal-2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Fermeture de demande</h3>
		<br>
	</div>
	<div class="modal-body" id="">
		
		<div class="box">
			
			<div class="box-content nopadding">
				
				<form action="demandes/fermeture" method="POST" class='form-horizontal form-bordered'>
				  <input type="hidden" name="idreclamation" id="idreclamation" value="">
					<div class="control-group">
						<label for="textfield" class="control-label">Motif</label>
						<div class="controls">
							<select name="motif" id="motif">
								<option value=""></option>
								@foreach($motifs as $motif)
								<option value="{{ $motif->idmotif }}-{{ $motif->motif }}">{{ $motif->motif }}</option>

								@endforeach
							</select>
						</div>
					</div>


					<div class="control-group">
						<label for="textarea" class="control-label">Commentaire</label>
						<div class="controls">
							<textarea name="commentaire" id="commentaire" rows="5" class="input-block-level"></textarea>
						</div>
					</div>
					<br>
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Valider</button>
						<button type="button" class="btn" data-dismiss="modal">Annuler</button>
					</div>
				</form>


			</div>
		</div>
	</div>
</div>



<div id="modal-3" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
									<i class="glyphicon-circle_question_mark"></i> Liste des demandes
								</h3>
								<div class="actions">
										<a href="{{ URL::to('demandes') }}" class="btn btn-mini "><i class="icon-refresh" rel="tooltip" data-original-title="Actualise"></i></a>
										<a href="#" class="btn btn-mini content-slideUp"  ><i class="icon-angle-down"></i></a>
									</div>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered usertable">
									<thead>
										
										<tr>
											<th># Demande</th>
											<th class="hidden-1024"># Contrat</th>
											<th class="hidden-1024">Nom complet</th>
											<th>Motif</th>
											<th class='hidden-350'>Etat</th>
											<th class='hidden-480'>Action</th>
											<th class="hidden-1024">Date</th>
										</tr>
									</thead>
									<tbody>

									  @foreach($demandes as $demande)
										<tr>
											
											<td>{{ $demande->reference_id }}</td>
											<td class="hidden-1024">{{ $demande->contrat->contratecg }}</td>
											<td class="hidden-1024">{{ $demande->contrat->user->prenom }} {{ $demande->contrat->user->nom }}</td>
											<td>{{ $demande->motif->libelle }}</td>

											<?php
                                               $etat = "En cours";
                                               $etat_color = ""; 
											   switch ($demande->etat) {
											    	case 'E':
											    		$etat = 'En cours';
											    		$etat_color = "blue";
											    		break;

											    	case 'T':
											    		$etat = 'Traitée';
											    		$etat_color = "green";
											    		$demande->lu = 2;
											    		break;

											    	
											    	default:
											    		$etat = 'Refusée';
											    		$etat_color = "orange";
											    		$demande->lu = 3;
											    		break;
											    } 

											 ?>

											<td class='hidden-350'><span class="label label-{{ $etat_color }}">{{ $etat }}</span></td>
											
											<td class='hidden-480' align="center">
												<a href="#modal-3" onclick="recupIdcontrat({{ $demande->contrat_id }})" role="button" class="btn " data-toggle="modal" rel="tooltip" title="Envoyer un message"><i class="icon-envelope"></i></a>

												@if($demande->lu == 0)
												<a href="#modal-2" onclick="recupId({{ $demande->reference_id }})" role="button" class="btn " data-toggle="modal" rel="tooltip" title="Refuse"><i class="icon-remove"></i></a>
												@endif
												<a href="#modal-1" onclick="details({{ $demande->id }})" role="button" class="btn idreclam" data-toggle="modal" id="{{ $demande->id }}" rel="tooltip" title="Voir"><i class="icon-search"></i></a>
											</td>
											<td class="hidden-1024">{{ date('d/m/Y H:s', strtotime($demande->updated_at)) }}</td>
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