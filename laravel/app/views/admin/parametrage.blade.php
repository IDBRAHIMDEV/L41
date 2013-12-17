@extends('layouts.admin')


@section('content')



{{ HTML::style('css/bootstrap-switch.css') }}

<!-- dataTables -->
	{{ HTML::script('js/plugins/datatable/jquery.dataTables.min.js') }}
	{{ HTML::script('js/plugins/datatable/TableTools.min.js') }}
	{{ HTML::script('js/plugins/datatable/ColReorderWithResize.js') }}
	{{ HTML::script('js/plugins/datatable/ColVis.min.js') }}
	{{ HTML::script('js/plugins/datatable/jquery.dataTables.columnFilter.js') }}
	{{ HTML::script('js/plugins/datatable/jquery.dataTables.grouping.js') }}
    {{ HTML::script('js/param.js') }}



<style>
	.thaction{
		font-size: 20px;
		text-align: center !important;
	}

	td.etat {
		text-align: center;
	}
</style>


<br><br><br>



<div id="modal-1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   	<div class="modal-header">
   		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
   		<h3 id="myModalLabel">Compagnie</h3>
   	</div>
   	<div class="modal-body" id="">
   		

   		<div class="box">
   			<div class="box-title">
   				<h3>
   					
   				</h3>
   			</div>
   			<div class="box-content nopadding">
   				   
   				   <form action="compagnie/nouveau" method="POST" id="compagnieForm" class='form-horizontal form-bordered' enctype="multipart/form-data">
				   <input type="hidden" name="compagnieId" id="compagnieId">
					
					<div class="control-group" id="codeCompagnie">
						<label for="code" class="control-label">Code compagnie</label>
						<div class="controls">
							<input type="text" name="code" id="code">
						</div>
					</div>
					<div class="control-group">
						<label for="libelleCompagnie" class="control-label">Libelle compagnie</label>
						<div class="controls">
							<input type="text" name="libelle" id="libelleCompagnie">
						</div>
					</div>
					<div class="control-group">
						<label for="siteCompagnie" class="control-label">Url de site</label>
						<div class="controls">
							<input type="text" name="siteCompagnie" id="siteCompagnie">
						</div>
					</div>
					<div class="control-group">
						<label for="logo" class="control-label">Logo compagnie</label>
						<div class="controls">
							<input type="file" name="logo" id="logo">
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
   	<div class="modal-footer">
   		<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Fermer</button>
   	</div>
   </div>




   <div id="modal-2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   	<div class="modal-header">
   		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
   		<h3 id="myModalLabel">Gamme</h3>
   	</div>
   	<div class="modal-body" id="">
   		

   		<div class="box">
   			<div class="box-title">
   				
   			</div>
   			<div class="box-content nopadding">
   				  <form action="gamme/nouveau" id="gammeForm" method="POST" class='form-horizontal form-bordered'>
				  	<input type="hidden" name="gammeId" id="gammeId" value="">
					<div class="control-group">
						<label for="compagnie" class="control-label">Compagnie</label>
						<div class="controls">
							<select name="compagnie" id="compagnie">
								@foreach($compagnies as $compagnie)
								   <option value="{{ $compagnie->id }}">{{ $compagnie->libelle }}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="control-group">
						<label for="code" class="control-label">Code gamme</label>
						<div class="controls">
							<input type="text" name="code" id="codeGamme">
						</div>
					</div>
					<div class="control-group">
						<label for="libelle" class="control-label">Libelle gamme</label>
						<div class="controls">
							<input type="text"  name="libelle" id="libelleGamme">
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
   	<div class="modal-footer">
   		<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Fermer</button>
   	</div>
   </div>




<div id="modal-3" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   	<div class="modal-header">
   		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
   		<h3 id="myModalLabel">Nature</h3>
   	</div>
   	<div class="modal-body" id="">
   		

   		<div class="box">
   			<div class="box-title">
   				
   			</div>
   			<div class="box-content nopadding">
   				  <form action="nature/nouveau" method="POST" class='form-horizontal form-bordered'>
				  
					
					<div class="control-group">
						<label for="code" class="control-label">Code nature</label>
						<div class="controls">
							<input type="text" name="code" id="code">
						</div>
					</div>
					<div class="control-group">
						<label for="libelle" class="control-label">Libelle nature</label>
						<div class="controls">
							<input type="text" name="libelle" id="libelle">
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
   	<div class="modal-footer">
   		<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Fermer</button>
   	</div>
   </div>




<div id="modal-4" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   	<div class="modal-header">
   		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
   		<h3 id="myModalLabel">Motif</h3>
   	</div>
   	<div class="modal-body" id="">
   		

   		<div class="box">
   			<div class="box-title">
   				
   			</div>
   			<div class="box-content nopadding">
   				  <form action="motif/nouveau" id="motifForm" method="POST" class='form-horizontal form-bordered'>
				 <input type="hidden" name="motifId" id="motifId" value="">
					<div class="control-group">
						<label for="nature" class="control-label">Nature</label>
						<div class="controls">
							<select name="nature" id="nature">
							   @foreach($natures as $nature)
								<option value="{{ $nature->id }}">{{ $nature->libelle }}</option>
							   @endforeach
							</select>
						</div>
					</div>
					<div class="control-group">
						<label for="libelle" class="control-label">Libelle motif</label>
						<div class="controls">
							<input type="text" name="libelle" id="libelleMotif">
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
   	<div class="modal-footer">
   		<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Fermer</button>
   	</div>
   </div>




<div id="modal-5" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   	<div class="modal-header">
   		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
   		<h3 id="myModalLabel">Document</h3>
   	</div>
   	<div class="modal-body" id="">
   		

   		<div class="box">
   			<div class="box-title">
   				
   			</div>
   			<div class="box-content nopadding">
   				  <form action="document/nouveau" method="POST" id="documentForm" class='form-horizontal form-bordered'>
				  <input type="hidden" name="documentId" id="documentId" value="">
					<div class="control-group">
						<label for="libelle" class="control-label">libelle document</label>
						<div class="controls">
							<input type="text" name="libelle" id="libelleDocument">
						</div>
					</div>
					<div class="control-group">
						<label for="description" class="control-label">Description document</label>
						<div class="controls">
							<textarea name="description" id="descriptionDocument" cols="40" rows="5"></textarea>
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
   	<div class="modal-footer">
   		<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Fermer</button>
   	</div>
   </div>





<div class="container">
	

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
	<div class="span12 ">
		<div class="box ">
			<div class="box-title">
				
				<ul class="tabs">
					<li class="active">
						<a href="#t1" data-toggle="tab"><i class="glyphicon-cogwheel"></i> Réglage</a>
					</li>
					<li>
						<a href="#t2" data-toggle="tab"><i class="icon-bookmark-empty"></i> Gamme</a>
					</li>
					<li>
						<a href="#t3" data-toggle="tab"><i class="glyphicon-fire"></i> Motif</a>
					</li>
					<li>
						<a href="#t4" data-toggle="tab"><i class="glyphicon-notes"></i> Document</a>
					</li>
				</ul>
			</div>
			<div class="box-content nopadding">
			  <div class="tab-content">
			   <div class="tab-pane active" id="t1">

			    <div class="row-fluid">
			  	   
			  	   	<div class="span12">
			  	   		
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="glyphicon-cogwheels"></i>
									Réglages
								</h3>
							</div>
							<div class="box-content nopadding">
								

							<form action="#" method="POST" class='form-horizontal form-striped'>
					@foreach($parametrages as $parametrage)
					<div class="control-group">
						<label for="textfield" class="control-label"><i class="glyphicon-circle_arrow_right" id="{{ $parametrage->id }}-i"></i> {{ $parametrage->libelle }}</label>
						<div class="controls">
						  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						   @if($parametrage->type == 'B')
							<div class="label-toggle-switch make-switch" id="{{ $parametrage->id }}" data-on="primary" data-off="danger">
							  <?php
							      $etat = "";
							      if($parametrage->etat){
							      	$etat = "checked";
							      } 

							   ?>
						        <input type="checkbox" {{ $etat }} />
						    </div>
						    @else
						    
						    <input type="text" name="textfield" id="{{ $parametrage->id }}" value="{{ $parametrage->etat }}" class="spinner input-mini">
						    @endif


						</div>
					</div>
				    @endforeach
					
				</form>


							</div>
						</div>
					
			  	   	</div>
			  	   </div>
				
			  </div> 
			  <div class="tab-pane" id="t2">
			  	
			  	   <div class="row-fluid">
			  	   
			  	   	<div class="span12">
			  	   		
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="icon-bookmark-empty"></i>
									GAMMES 
								</h3>
								<div class="pull-right"><h3><a href="#modal-1" role="button" data-toggle="modal" rel="tooltip" title="Nouvelle Compagnie"><i class="glyphicon-circle_plus"></i></a> <a href="#modal-2" role="button" data-toggle="modal" rel="tooltip" title="Nouvelle Gamme"><i class="icon-plus"></i></a></h3></div>
							</div>
							<div class="box-content nopadding">
								

							<table class="table table-hover table-nomargin table-bordered " data-nosort="0">
									<thead>
										<tr class='thefilter'>
											<th></th>
											<th>Compagnie</th>
											<th class="hidden-1024">code</th>
											<th >Gamme</th>
											<th class='hidden-1024'>Date</th>
											<th class='hidden-480'></th>
											
										</tr>
									</thead>
									<tbody>
									   @foreach($gammes as $gamme)
										<tr>
										    <input type="hidden" id="{{ $gamme->id }}-cie" value="{{ $gamme->compagnie_id }}">
										    <input type="hidden" id="{{ $gamme->compagnie->id }}-site" value="{{ $gamme->compagnie->site }}">
											<td class="etat">
												@if($gamme->active == '1')
												{{ HTML::image('img/on.png', '', array('id' => $gamme->id.'-i', 'class' => 'power')) }}
												@else
												{{ HTML::image('img/off.png', '', array('id' => $gamme->id.'-i', 'class' => 'power')) }}
												@endif
											</td>
											<td><a class="compagnie" href="#" id="{{ $gamme->compagnie->id }}-compagnie">{{ $gamme->compagnie->libelle }}</a></td>
											<td class="hidden-1024" id="{{ $gamme->id }}-code">{{ $gamme->code }}</td>
											<td id="{{ $gamme->id }}-libelle">{{ $gamme->libelle }}</td>
											<td class='hidden-1024 etat'>{{ date('d/m/Y H:i', strtotime($gamme->updated_at)) }}</td>
											<td class='hidden-480 etat'> <a href="#" id="{{ $gamme->id }}" class="btn btn-primary gamme"  rel="tooltip" title="Editer">  <i class="icon-edit"></i> </a> <button type="button" id="{{ $gamme->id }}" class="btn btn-primary etatPower" rel="tooltip" title="Etat"> <i class="icon-off"></i> </button></td>

										</tr>
									@endforeach
									</tbody>
								</table>
								


							</div>
						</div>
					
			  	   	</div>
			  	   </div>
			  </div>
			  <div class="tab-pane" id="t3">
			  	  
			  	   <div class="row-fluid">
			  	   
			  	   	<div class="span12">
			  	   		
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="glyphicon-fire"></i>
									MOTIFS 
								</h3>
								<div class="pull-right"><h3><a href="#modal-3" role="button" data-toggle="modal" rel="tooltip" title="Nouvelle Nature"><i class="glyphicon-circle_plus"></i></a> <a href="#modal-4" role="button" data-toggle="modal" rel="tooltip" title="Nouveau Motif"><i class="icon-plus"></i></a></h3></div>
							</div>
							<div class="box-content nopadding">
								

							<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort" data-nosort="0">
									<thead>
										<tr class='thefilter'>
											<th class="visible-tablet"></th>
											<th>Nature</th>
											
											<th >Motif</th>
											<th class='hidden-1024'>Date</th>
											<th class='hidden-480'></th>
											
										</tr>
									</thead>
									<tbody>
									   @foreach($motifs as $motif)
									    
										<tr>
										 <input type="hidden" id="{{ $motif->id }}-nature" value="{{ $motif->nature_id }}">
											<td class="visible-tablet"></td>
											<td>{{ $motif->nature->libelle }}</td>
											
											<td id="{{ $motif->id }}-libelle">{{ $motif->libelle }}</td>
											<td class='hidden-1024 etat'>{{ date('d/m/Y H:i', strtotime($motif->updated_at)) }}</td>
											<td class='hidden-480 etat'> <a href="motif/doc/{{ $motif->id }}" class="btn btn-primary"  rel="tooltip" title="Documents"> <i class="icon-external-link"></i> </a> <a href="#" id="{{ $motif->id }}" class="btn btn-primary motif"  rel="tooltip" title="Editer"> <i class="icon-edit"></i> </a></td>

										</tr>
									@endforeach
									</tbody>
								</table>
								


							</div>
						</div>
					
			  	   	</div>
			  	   </div>

			  </div>
			   <div class="tab-pane" id="t4">
			  	  
			  	  <div class="row-fluid">
			  	   
			  	   	<div class="span12">
			  	   		
						<div class="box">
							<div class="box-title">
								<h3>
									<i class="glyphicon-notes"></i>
									DOCUMENTS 
								</h3>
								<div class="pull-right"><h3><a href="#modal-5" role="button" data-toggle="modal" rel="tooltip" title="Nouveau Document"><i class="icon-plus"></i></a></h3></div>
							</div>
							<div class="box-content nopadding">
								

							<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort" data-nosort="0">
									<thead>
										<tr class='thefilter'>
											<th class="visible-tablet"></th>
											<th>Libelle</th>
											
											<th >Description</th>
											<th class='hidden-1024'>Date</th>
											<th class='hidden-480'></th>
											
										</tr>
									</thead>
									<tbody>
									   @foreach($docs as $doc)
										<tr>

											<td class="visible-tablet"></td>
											<td id="{{ $doc->id }}-libelleDoc">{{ $doc->label }}</td>
											
											<td  id="{{ $doc->id }}-descriptionDoc">{{ $doc->description }}</td>
											<td class='hidden-1024 etat'>{{ date('d/m/Y H:i', strtotime($doc->updated_at)) }}</td>
											<td class='hidden-480 etat'><a href="#" id="{{ $doc->id }}" class="btn btn-primary doc"  rel="tooltip" title="Editer"> <i class="icon-edit"></i> </a></td>

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
</div>



{{ HTML::script('js/bootstrap-switch.min.js') }}

@stop