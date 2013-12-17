@extends('layouts.master')

@section('content')

<style>
	.textalign {
		text-align: right !important;

	}

	.selectric p.label {
		background-color: #fff;
		font-size: 14px;
	}

	.selectric{
		width: 150px;
	}
</style>

<script type="text/javascript">
         
    function details(){
    	$('.idreclam').click(function(){
             var idReclamation = $(this).attr('id');
              
                $.ajax({
                   	type: "post",
                   	data: "idreclam="+idReclamation,
					url: "demande/details",
					context: document.body
			    }).done(function(data) {         
                   $("#details").html(data);
                });

        });

       
    }


    function actions() {
    	 $('.idreclamA').click(function(){
             var idReclamation = $(this).attr('id');

                $.ajax({
                   	type: "get",
                   	data: "idreclam="+idReclamation,
					url: "demande/actions",
					context: document.body
			    }).done(function(data) {         
                   $("#actions").html(data);
                });

        });
    }

    $(function(){
        details();
        actions();
    });
            
        $(function(){
 
            $('#etat').change(function(){
                 etat  = $(this).val();
                 range = $('#reportrange span').html();
                 motif = $('#motif').val();
                
                   $.ajax({
                   	type: "post",
                   	data: "motif="+motif+"&etat="+etat,
					url: "{{ URL::to('demande/search') }}",
					context: document.body
					}).done(function(data) {
                            
                            $("#demandes").html(data);
                             details();
                              actions();
					});
            });


            $('#motif').change(function(){
                 etat  = $('#etat').val();
                 range = $('#reportrange span').html();
                 motif = $(this).val();
                 
                 $.ajax({
                 	type: "post",
                   	data: "motif="+motif+"&etat="+etat,
					url: "{{ URL::to('demande/search') }}",
					context: document.body
					}).done(function(data) {
                            
                            $("#demandes").html(data);
                            details();
                             actions();
					});
            });
        });
        
        

      $(document).ready(function() {
                  $('#reportrange').daterangepicker(
                     {
                        startDate: moment().subtract('days', 29),
                        endDate: moment(),
                        minDate: '01/01/2013',
                        maxDate: '12/31/2014',
                        dateLimit: { days: 60 },
                        showDropdowns: true,
                        showWeekNumbers: true,
                        timePicker: false,
                        timePickerIncrement: 1,
                        timePicker12Hour: true,
                        ranges: {
                           'Ajourd\'hui': [moment(), moment()],
                           'Hier': [moment().subtract('days', 1), moment().subtract('days', 1)],
                           '7 jours avant': [moment().subtract('days', 6), moment()],
                           '30 jours avant': [moment().subtract('days', 29), moment()],
                           'ce mois': [moment().startOf('month'), moment().endOf('month')],
                           'le mois dernier': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                        },
                        opens: 'left',
                        buttonClasses: ['btn btn-default'],
                        applyClass: 'btn-small btn-primary',
                        cancelClass: 'btn-small',
                        format: 'DD/MM/YYYY',
                        separator: ' A ',
                        locale: {
                            applyLabel: 'Appliquer',
                            fromLabel: 'De',
                            toLabel: 'A',
                            customRangeLabel: 'Personnaliser',
                            daysOfWeek: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven','Sam'],
                            monthNames: ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Decembre'],
                            firstDay: 1
                        }
                     },
                     function(start, end) {
                      $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));

                             etat   = $('#etat').val();
			                 range1 = start.format('YYYY-MM-DD');
			                 range2 = end.format('YYYY-MM-DD');
			                 motif  = $('#motif').val();
			                 
			                   $.ajax({
			                   	type: "post",
			                   	data: "motif="+motif+"&etat="+etat+"&start="+range1+"&end="+range2,
								url: "{{ URL::to('demande/search') }}",
								context: document.body
								}).done(function(data) {
			                            
			                            $("#demandes").html(data);
			                            details();
			                             actions();
								});

                     }
                  );
                  //Set the initial state of the picker label
                  $('#reportrange span').html(moment().subtract('days', 29).format('DD/MM/YYYY') + ' - ' + moment().format('DD/MM/YYYY'));
               });
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



<div id="modal-2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">Actions</h3>
			</div>
			<div class="modal-body" id="">
				

				<div class="box">
							
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-striped">
									<thead>
										<tr>
											<th></th>
											<th align="left">Action</th>
											<th>Date</th>
											
										</tr>
									</thead>
									<tbody id="actions">
										
									</tbody>
								</table>
							</div>
						</div>

			</div>
			<div class="modal-footer">
				<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Fermer</button>
			</div>
		</div>




  <div class="container nav-hidden" id="content">
	
	
           @if (Session::has('flash_error'))
			<br>
			<div class="row-fluid">
				<div class="span12">
					<div class="alert alert-danger" align="center">
						<button data-dismiss="alert" class="close" type="button">×</button>
						<strong> {{ Session::get('flash_error') }} </strong>
					</div>
				</div>
			</div>
			@endif


				

			 @if (Session::has('flash_success'))
			<br>
			<div class="row-fluid">
				<div class="span12">
					<div class="alert alert-success" align="center">
						<button data-dismiss="alert" class="close" type="button">×</button>
						<strong> {{ Session::get('flash_success') }} </strong>
					</div>
				</div>
			</div>
			@endif	

	   

		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Demande</h1>
					</div>
					
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="{{ URL::to('home') }}">Acceuil</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="{{ URL::to('demande') }}">Demande</a>
							
						</li>
						
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i></a>
					</div>
				</div><br>
               

               <div class="row-fluid">

                <div class="span4">  
                   <select name="etat" id="etat" class="pull-right">
                   	<option value="">Tous</option>
                   	<option value="E">En cours</option>
                   	<option value="T">Traité</option>
                   	<option value="R">Refusé</option>
                   </select>

               </div>


				<div class="span4">
					<select name="motif" id="motif" class="pull-right">
						<option value="">Type de la demande</option>

						@foreach($motifs as $motif)
						  <option value="{{ $motif->id }}">{{ $motif->libelle }}</option>
						@endforeach
					</select>
				</div>	


				<div class="span4" >

						    <div id="reportrange" class="pull-right" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
			                  <i class="glyphicon glyphicon-calendar icon-calendar icon-large"></i>
			                  <span></span> <b class="caret"></b>
			               </div>
				</div>


               </div>

               

               <div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered" style="margin-top:10px">
							<div class="box-title" style="margin-top:10px">
								<h3>
									<i class="glyphicon-circle_question_mark"></i>
									Liste des demandes
								</h3>

								<div class="actions">
								<a href="{{ URL::to('demande/create') }}" class="btn btn-mini" rel="tooltip" data-original-title="Nouvelle demande"><i class="icon-plus"></i></a>
								<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
							</div>


							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin">
									<thead>
										<tr>
										    <th><i class="icon-align-left"></i> Référence</th>
											<th><i class="icon-align-left"></i> Libellé demande</th>
											<th><i class="icon-calendar"></i> Date</th>
											<th class="hidden-350"><i class="icon-check"></i> Etat</th>
											<th class="hidden-1024"><i class="icon-signal"></i> Progression</th>
											<th class="hidden-480"></th>
										</tr>
									</thead>
									<tbody id="demandes">

									@foreach($demandes as $demande)
										<tr>
										    <td><i class="icon-tag"></i> {{ $demande->reference_id }}</td>
											<td><i class="icon-angle-right"></i> {{ $demande->motif->libelle }}</td>
											<td>
												le {{ date("d/m/Y",strtotime($demande->updated_at)) }} à {{ date("H:i:s ",strtotime($demande->updated_at)) }}
											</td>
											<td class="hidden-350">


											        @if ($demande->etat == 'E')
													    {{'En cours'}}
													   <?php 
													      $progress    = 'primary'; 
                                                          $pourcentage = 30;
													   ?>
													     @if($demande->lu == 1)
														    <?php $pourcentage = 50; ?>
														  @endif

														  @if($demande->lu == 2)
														    <?php $pourcentage = 70; ?>
														  @endif

													@elseif ($demande->etat == 'T')
													    {{'Traité'}}
													    <?php 
													      $progress = 'success'; 
													      $pourcentage = 100;
													    ?>
													@else
													    {{'Refusé'}}
													    <?php 
													       $progress = 'danger'; 
													       $pourcentage = 100;
													    ?>
													@endif



											</td>
											<td class="hidden-1024"><div class="progress progress-striped progress-{{$progress}} active">
												  <div class="bar img-rounded " style="width: {{$pourcentage}}%;"><span align="center">{{$pourcentage}}%</span></div>

												</div>

											</td>
											<td class="hidden-480 textalign" >
											   @if($demande->etat == 'E')
												<a href="{{ URL::to('demande/'.$demande->id.'/edit') }}" class="btn btn-primary" rel="tooltip" data-original-title="Editer"><i class="icon-edit"></i></a>
											   @endif
												<a href="#modal-1" role="button" class="btn btn-primary idreclam" data-toggle="modal" id="{{ $demande->id }}" rel="tooltip" data-original-title="Pièce jointe"><i class="icon-search"></i></a>
												<a href="#modal-2" role="button" class="btn btn-primary idreclamA" data-toggle="modal" id="{{ $demande->reference_id }}" rel="tooltip" data-original-title="Acions"><i class="icon-tags"></i></a>
											</td>
										</tr>
									@endforeach	

										
									</tbody>
								</table>
								<div class="table-pagination">
									
									
									
								</div>
							</div>
						</div>
					</div>
				</div>
             
		</div></div>



@stop