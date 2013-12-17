@extends('layouts.master')

@section('content')
<br>
<br>
<br>

<script>



$(function(){
    

	$('.response').click(function(){
		var id = $(this).attr('id');
		var contrat = $('#'+id+'m').val();

		$('#contrat').val(contrat);
		idcontrat = $('#contrat').val();

	});


 setInterval(function() {
          reclamation() ;
        }, 10000);

setInterval(function() {
          message() ;
        }, 30000);

});

function reclamation(){
	$.ajax({
                   	type: "get",
                   	data: "",
					url: "reclamation",
					context: document.body
			    }).done(function(data) {         
                   //var obj = jQuery.parseJSON(data);
                   $('#reclamations').html(data);
                });
}


function message(){
	$.ajax({
                   	type: "get",
                   	data: "",
					url: "message",
					context: document.body
			    }).done(function(data) {         
                   //var obj = jQuery.parseJSON(data);
                   $('#messages').html(data);
                });
}
</script>

<div id="modal-1" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	{{ Form::open(array('url' => 'mail', 'class' => 'form-horizontal form-striped', 'files' => true, 'data-validate'=>'parsley')) }}

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Nouveau message</h3>
	</div>
	<div class="modal-body">
		
		<p>

			<input type="hidden" id="contrat" name="contrat" value="">
			<div class="control-group">
				<label class="control-label" for="objet" data-required="true">Objet</label>
				<div class="controls">
					<input type="text" class="input-xlarge" placeholder="" id="objet" name="objet">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="message">Votre message</label>
				<div class="controls">
					<textarea class="input-block-level" rows="5" id="message" name="message"></textarea>
				</div>
			</div>

		</p>


	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
		<button type="submit" class="btn btn-primary" >Envoyer</button>
	</div>

</form>
</div>



<div class="container nav-hidden" id="content">
	
	<div id="main">
		<div class="container-fluid">
			<div class="page-header">
				<div class="pull-left">
					<h1>Acceuil</h1>
				</div>
				<div class="pull-center hidden-phone">
					<ul class="tiles tiles-center nomargin">


						<li class="lightred">
							<span class="label label-info">{{ $cmessage }}</span>
							<a href="{{ URL::to('mail') }}"><span><i class=" glyphicon-envelope"></i></span><span class="name">Mail</span></a>
						</li>
						
						<li class="blue">
							<span class="label label-important">{{ $cdemande }}</span>
							<a href="{{ URL::to('demande') }}"><span><i class="glyphicon-circle_question_mark"></i></span><span class="name">Demande</span></a>
						</li>
						
						<li class="lime">
							
							<a href="{{ URL::to('acces') }}"><span><i class="glyphicon-euro"></i></span><span class="name">Remboursement</span></a>
						</li>
						<li class="lightgrey">
							<span class="label label-info">{{ $crejet }}</span>
							<a href="{{ URL::to('demande/rejet') }}"><span><i class="glyphicon-circle_exclamation_mark"></i></span><span class="name">Rejets</span></a>
						</li>
					</ul>

				</div>
			</div>
			<div class="breadcrumbs">
				<ul>
					<li>
						<a href="{{ URL::to('home') }}">Acceuil</a>
						<i class="icon-angle-right"></i>
					</li>

				</ul>
				<div class="close-bread">
					<a href="#"><i class="icon-remove"></i></a>
				</div>
			</div>
			<div class="row-fluid">
				<div class="span6">

					<div class="box box-color">
						<div class="box-title">
							<h3>
								<i class=" glyphicon-envelope"></i>
								Derniers messages
							</h3>
							<div class="actions">
								<a href="{{ URL::to('mail') }}" class="btn btn-mini" rel="tooltip" data-original-title="Nouveau message"><i class="icon-plus"></i></a>
								<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
							</div>
						</div>
						<div class="box-content" style="display: block;">
							<table class="table table-hover table-nomargin table-colored-header">
								<thead>

								</thead>
								<tbody id="messages">

									@foreach($messages as $message)
									<tr>
										<td>
											<h5 class="media-heading"> {{ $message->objet }} <small class="pull-right">&nbsp; le {{ date('d/m/Y', strtotime($message->updated_at)) }} à {{ date('H:i', strtotime($message->updated_at)) }}</small></h5>
											
											 
											<p class="well">
												{{ $message->message }}
												<br>
												<span class="pull-right"><small><b>{{ $message->destinataire }}</b></small></span>
											</p>

											<div class="media-actions pull-right">
												<input type="hidden" id="{{ $message->contrat_id }}m" value="{{ $message->contrat_id }}">
												<a id="{{ $message->contrat_id }}" class="btn btn-small response" data-toggle="modal" role="button" href="#modal-1"><i class="icon-reply"></i> Répondre</a>
											</div>
										</td>


									</tr>
									@endforeach   
                                     <tr>
                                    	<td colspan="2"><div class="pull-left"><a href="{{ URL::to('mail') }}" class="btn ">Suite...</a></div></td>
                                    </tr>
								</tbody>
							</table>
						</div>
					</div>

				</div>



				<div class="span6">

					<div class="box box-color">
						<div class="box-title">
							<h3>
								<i class=" glyphicon-charts"></i>
								Etat d'avancement
							</h3>
							<div class="actions">
								<a href="{{ URL::to('demande/create') }}" class="btn btn-mini" rel="tooltip" data-original-title="Nouvelle demande"><i class="icon-plus"></i></a>
								<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
							</div>
						</div>



						<div class="box-content" style="display: block;">



							<table class="table table-hover table-nomargin table-colored-header">
								<thead>

								</thead>
								<tbody id="reclamations">

									@foreach($demandes as $demande) 

									@if ($demande->etat == 'E')
                                
									<?php 
									$etat        = 'En cours';
									$progress    = 'primary'; 
									$label       = 'info';
									$pourcentage = 30;
									?>
									  @if($demande->lu == 1)
									    <?php $pourcentage = 50; ?>
									  @endif

									   @if($demande->lu == 2)
									    <?php $pourcentage = 70; ?>
									  @endif
									@elseif ($demande->etat == 'T')

									<?php
									$etat        = 'Traitée'; 
									$progress    = 'success'; 
									$label       = 'success';
									$pourcentage = 100;
									?>
									@else

									<?php 
									$etat        = 'Refusée';
									$progress    = 'danger'; 
									$label       = 'warning';
									$pourcentage = 100;
									?>
									@endif 
									<tr>
										<td class="well">
                                            <div><b>{{ $demande->motif->libelle }}</b> </div>
											<p>
												<div class="progress progress-{{ $progress }} progress-striped active ">
													<div class="bar img-rounded" style="width: {{ $pourcentage }}%;">{{ $pourcentage }}%</div>
												</div>
											</p>
											
											
											@if(!empty($demande->commentaire))
											<p>
												<i class="glyphicon-comments"></i> {{ $demande->commentaire }}
											</p>
											@endif
										</td>
										<td><blockquote><span class="label label-{{ $label }}">{{ $etat }}</span> <br>N° {{ $demande->reference_id }} <br> {{ date('d/m/y H:i', strtotime($demande->updated_at)) }} </blockquote></td>

									</tr>
									@endforeach   
                                    <tr>
                                    	<td colspan="2"><div class="pull-right"><a href="{{ URL::to('demande') }}" class="btn ">Suite...</a></div></td>
                                    </tr>
								</tbody>
							</table>

						</div>
					</div>

				</div>




			</div>


			<hr>

		</div></div>

		@stop