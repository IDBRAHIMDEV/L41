@extends('layouts.master')

@section('content')

<style>
	.label {
		padding-top: 5px;
		display: block;
		text-align: center;

	}

	.file {
		padding-bottom: 6px;
	}
</style>

<br>
   <br>
   <br>
  <div class="container nav-hidden" id="content">
	
		<div id="main">
			<div class="container-fluid">
                  

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

				@if (Session::has('flash_errors'))
			<br>
			<div class="row-fluid">
				<div class="span12">
					<div class="alert alert-danger" align="center">
						<button data-dismiss="alert" class="close" type="button">×</button>
						<strong> {{ Session::get('flash_errors') }} </strong>
					</div>
				</div>
			</div>
			@endif


				<div class="page-header">
					<div class="pull-left">
						<h1>Nouvelle demande</h1>
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
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#">Nouveau</a>
							
						</li>
						
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i></a>
					</div>
				</div><br>

               {{ Form::open(array('url' => 'demande', 'class' => 'form-horizontal form-striped', 'files' => true, 'data-validate'=>'parsley')) }}

              <div class="row-fluid">

					<div class="span8">
						<div class="box box-bordered box-color">
							<div class="box-title">
								<h3><i class="icon-th-list"></i> Demande</h3>
							</div>
							<div class="box-content nopadding">
								
									<div class="control-group">
										<label class="control-label" for="contrat">Contrat</label>
										<div class="controls">
											<select name="contrat" id="contrat" class="input-xlarge" data-required="true">
												 <?php $contratId = ''; ?>
												<?php if(isset($contrat_id)) { ?>
												   <?php $contratId = $contrat_id; ?>
												<?php } ?>

												@foreach($contrats as $contrat)
												  <option <?php echo ($contratId == $contrat->id) ? 'selected' : ''; ?> value="{{ $contrat->id }}">{{ $contrat->produit->label }} - {{ $contrat->contratecg }}</option>
												@endforeach
												
											</select>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="nature">Nature</label>
										<div class="controls">
											<select name="nature" id="nature" class="input-xlarge" data-required="true">
											<option value=""></option>
											 @foreach($natures as $nature)
												<option value="{{ $nature->id }}">{{ $nature->libelle }}</option>
											 @endforeach	
											</select>
										</div>
									</div>

									<div class="control-group">
										<label class="control-label" for="motif">Motif</label>
										<div class="controls">
											<select name="motif" id="motif" class="input-xlarge" data-required="true">
											    <option value=""></option>
												 @foreach($motifs as $motif)
													<option value="{{ $motif->id }}">{{ $motif->libelle }}</option>
												 @endforeach	
											</select>
										</div>
									</div>
									
									<div class="control-group">
										<label class="control-label" for="description">Description</label>
										<div class="controls">
											{{ Form::textarea("description", null, array('id'=>'description', 'rows'=>5, 'data-required'=>'true')); }}
										</div>
									</div>
									<div class="form-actions">
										<button class="btn btn-primary" type="submit">Enregistrer</button>
										<a href="{{ URL::to('demande') }}" class="btn" type="button">Annuler</a>
									</div>
								
							</div>
						</div>
					</div>

                    <div class="span4">
                    	
                    	<div class="box box-bordered box-color">
							<div class="box-title">
								<h3><i class="glyphicon-folder_open"></i> Documents</h3>
							</div>
							<div id="documents" class="box-content nopadding ">
								

							</div>
						</div>

                    </div>
                       
				</div>
              {{ Form::close() }}




 <script>
    $(document).ready(function(){
         $("#documents").html('');

         $('#nature').change(function(){
              id = $(this).val();
              
              $.ajax({
				url: "motif/"+id,
				context: document.body
				}).done(function(data) {
				   
				   $("#motif").html('');
                    $("#motif").append("<option value=''></option>");
                    $.each(data, function(i, item) {
					   $("#motif").append("<option value='"+item.id+"'>"+item.libelle+"");
					});
				});
         });


         $('#motif').change(function(){
              id = $(this).val();
              
              $.ajax({
				url: "doc/"+id,
				context: document.body
				}).done(function(data) {
				   

				   $("#documents").html('');

                    $.each(data, function(i, item) {
					   $("#documents").append("<span class='label'> <h5>"+item.label+"</h5></span><input type='file' data-required='true' class='input-xlarge file' name='file["+item.id+"]' id='file["+item.id+"]'>");
					   
					});
				});
         });

    });
 </script>




@stop