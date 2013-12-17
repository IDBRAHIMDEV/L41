@extends('layouts.admin')


@section('content')

<!-- dataTables -->
	{{ HTML::script('js/plugins/datatable/jquery.dataTables.min.js') }}
	{{ HTML::script('js/plugins/datatable/TableTools.min.js') }}
	{{ HTML::script('js/plugins/datatable/ColReorderWithResize.js') }}
	{{ HTML::script('js/plugins/datatable/ColVis.min.js') }}
	{{ HTML::script('js/plugins/datatable/jquery.dataTables.columnFilter.js') }}
	{{ HTML::script('js/plugins/datatable/jquery.dataTables.grouping.js') }}

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

<br>
<br>
<br>


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





<div class="container">

	<div class="row-fluid">
		<div class="span12">
	<div class="box ">
		<div class="box-title">
			<h3>
				<i class="glyphicon-user"></i>
				{{ $contrats[0]->user->prenom }} {{ $contrats[0]->user->nom }}
			</h3>
			<ul class="tabs">
				<li class="active">
					<a href="#t1" data-toggle="tab"><i class="glyphicon-more_items"></i> Contrats</a>
				</li>
				<li class="">
					<a href="#t2" data-toggle="tab"><i class="glyphicon-circle_question_mark"></i> Demandes</a>
				</li>
				<li class="">
					<a href="#t3" data-toggle="tab"><i class="icon-envelope"></i> Messages</a>
				</li>
				<li class="">
					<a href="#t4" data-toggle="tab"><i class="glyphicon-conversation"></i> Conversations</a>
				</li>
			</ul>
		</div>
		<div class="box-content">
			<div class="tab-content">
				<div class="tab-pane active" id="t1">
					
					<div class="span12">
							<div class="box box-bordered">
								<div class="box-title">
									<h3>
										<i class="glyphicon-more_items"></i>
										Liste des contrats
									</h3>
									<div class="actions">
										<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
										<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
									</div>
								</div>
								<div class="box-content" style="display: block;">

								    <table class="table table-hover table-nomargin table-bordered usertable">
									<thead>
										
										<tr>
											<th># Contrat</th>
											<th class="hidden-1024"># Compagnie</th>
											<th class="">Gamme</th>
											<th class="hidden-1024">Date effet</th>
											<th class=''>Cotisation</th>
											<th class='hidden-480'></th>
											
										</tr>
									</thead>
									<tbody>
									     @foreach($contrats as $contrat) 
									     <tr>
									     	<td>{{$contrat->contratecg}}</td>
									     	<td class="hidden-1024"><h5>{{$contrat->gamme->compagnie->libelle}}</h5></td>
									     	<td>{{$contrat->gamme->libelle}}</td>
									     	<td class="hidden-1024">{{ date('d/m/Y', strtotime($contrat->dateeffet)) }}</td>
									     	<td><span class="pull-right">{{ number_format($contrat->prime, 2, ',', ' ') }} <i class="icon-euro"></i></span></td>
									     	<td class='hidden-480'>
									     		<a href="{{ URL::to('user/details/contrat') }}/{{ $contrat->id }}"  role="button" class="btn " data-toggle="modal" rel="tooltip" title="" data-original-title="Détails"><i class="icon-search"></i></a>
									     	</td>
									     </tr>
									     @endforeach
									</tbody>
									</table>


								</div>
							</div>
						</div>


				</div>
				<div class="tab-pane" id="t2">
					

					<div class="span12">
							<div class="box box-bordered">
								<div class="box-title">
									<h3>
										<i class="glyphicon-circle_question_mark"></i>
										Liste des demandes
									</h3>
									<div class="actions">
										<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
										<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
									</div>
								</div>
								<div class="box-content" style="display: block;">

								    <table class="table table-hover table-nomargin table-bordered usertable">
									<thead>
										
										<tr>
											<th class="hidden-1024"># Contrat</th>
											<th ># Demande</th>
											<th class="">Motif</th>
											<th class="">Etat</th>
											<th class="hidden-1024">date</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
									     @foreach($contrats as $contrat) 
									        @foreach($contrat->reclamations as $reclamation)
									     <tr>
									     	<td class="hidden-1024">{{ $reclamation->contrat->contratecg }}</td>
									     	<td >{{ $reclamation->reference_id }}</td>
									     	<td><h5>{{ $reclamation->motif->libelle }}</h5></td>
                                                
                                             <?php
                                               $etat = "En cours";
                                               $etat_color = ""; 
											   switch ($reclamation->etat) {
											    	case 'E':
											    		$etat = 'En cours';
											    		$etat_color = "blue";
											    		break;

											    	case 'T':
											    		$etat = 'Traitée';
											    		$etat_color = "green";
											    		
											    		break;

											    	
											    	default:
											    		$etat = 'Refusée';
											    		$etat_color = "orange";
											    		
											    		break;
											    } 

											 ?>


									     	<td ><span class="label label-{{ $etat_color }}">{{ $etat }}</span></td>
									     	<td class="hidden-1024">{{ date('d/m/Y H:i', strtotime($reclamation->updated_at)) }}</td>
									     	<td class='hidden-480'>
									     		<a href="#modal-1" onclick="details({{ $reclamation->id }})" role="button" class="btn idreclam" data-toggle="modal" id="{{ $reclamation->id }}" rel="tooltip" title="Voir"><i class="icon-search"></i></a>
									     	</td>
									     </tr>
									       @endforeach
									     @endforeach
									</tbody>
									</table>


								</div>
							</div>
						</div>


				</div>
				<div class="tab-pane" id="t3">
					

					<div class="span12">
							<div class="box box-bordered">
								<div class="box-title">
									<h3>
										<i class="icon-envelope"></i>
										Liste des messages
									</h3>
									<div class="actions">
										<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
										<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
									</div>
								</div>
								<div class="box-content" style="display: block;">

								    <table class="table table-hover table-nomargin table-bordered usertable">
									<thead>
										
										<tr>
											<th class="hidden-1024"># Contrat</th>
											<th ># Objet</th>
											<th class="">Message</th>
											<th class="">Genre</th>
											<th class="hidden-1024">date</th>
											<th class="hidden-1024">Responsable</th>
										</tr>
									</thead>
									<tbody>
									     @foreach($contrats as $contrat) 
									        @foreach($contrat->messages as $message)
									     <tr>
									     	<td class="hidden-1024">{{ $message->contrat->contratecg }}</td>
									     	<td ><h5>{{ $message->objet }}</h5></td>
									     	<td>{{ substr($message->objet, 0, 100) }}...</td>
                                                
                                             <?php 
											   if($message->genre == 1) {
                                                    $genre = "Sortant";
                                                    $genre_color = "magenta";
											   }else{
                                                    $genre = "Entrant";
                                                    $genre_color = "purple";
											   }
											?>

									     	<td ><span class="label label-{{ $genre_color}}">{{ $genre }}</span></td>
									     	<td class="hidden-1024">{{ date('d/m/Y H:s', strtotime($message->updated_at)) }}</td>
									     	<td class='hidden-1024'>
									     		{{ $message->destinataire }}
									     	</td>
									     </tr>
									       @endforeach
									     @endforeach
									</tbody>
									</table>


								</div>
							</div>
						</div>


				</div>
				<div class="tab-pane" id="t4">
                 

                 <div class="span12">
							<div class="box box-bordered">
								<div class="box-title">
									<h3>
										<i class="glyphicon-conversation"></i>
										Conversations
									</h3>
									<div class="actions">
										<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
										<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
									</div>
								</div>
								<div class="box-content" style="display: block;">

								   <table class="table table-hover table-nomargin table-bordered usertable">
									<thead>
										
										<tr>
											<th>Texte</th>
											<th class="hidden-1024">Date</th>
											<th class="">Genre</th>
											<th class="visible-tablet"></th>
											<th class="visible-tablet"></th>
											<th class="visible-tablet"></th>
										</tr>
									</thead>
									<tbody>
									     @foreach($conversations as $conversation) 
									     <tr>
									     	
									     	
									     	<td>{{ $conversation->message }}</td>
                                               <td class="hidden-1024">{{ date('d/m/Y H:s', strtotime($conversation->updated_at)) }}</td> 
                                             <?php 
											   if($contrats[0]->user_id == $conversation->admin_id) {
                                                    $genre = "Sortant";
                                                    $genre_color = "magenta";
											   }else{
                                                    $genre = "Entrant";
                                                    $genre_color = "purple";
											   }
											?>

									     	<td ><span class="label label-{{ $genre_color}}">{{ $genre }}</span></td>
									     	<td class="visible-tablet"></td>
									     	<td class="visible-tablet"></td>
									     	<td class="visible-tablet"></td>
									     </tr>
									     @endforeach
									</tbody>
									</table>


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

@stop