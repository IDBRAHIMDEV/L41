@extends('layouts.master')

@section('content')
<!-- PLUpload -->
	<script src="js/plugins/plupload/plupload.full.js"></script>
	<script src="js/plugins/plupload/jquery.plupload.queue.js"></script>
	<!-- Custom file upload -->
	<script src="js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
	<script src="js/plugins/mockjax/jquery.mockjax.js"></script>

    <br>
   <br>
   <br>
  <div class="container nav-hidden" id="content">
	
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					
				
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="{{ URL::to('home') }}">Acceuil</a>
							<i class="icon-angle-right"></i>
						</li>

						<li>
							<a href="#">Profile</a>
							
						</li>
						
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i></a>
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
				
               
               <div class="row-fluid">
				<div class="span10 offset1">
					<div class="box box-color box-bordered">
						<div class="box-title">
							<h3>
								<i class="icon-user"></i>
								Utilisateur
							</h3>
						</div>
						<div class="box-content nopadding">
							
							<div class="tab-content padding tab-content-inline tab-content-bottom">
								<div class="tab-pane active" id="profile">
									{{ Form::open(array('url' => 'profile/update', 'class' => 'form-horizontal', 'files' => true, 'data-validate'=>'parsley')) }}
										<div class="row-fluid">
											<div class="span2">
												<div class="fileupload fileupload-new" data-provides="fileupload">
													<div class="fileupload-new thumbnail" style="max-width: 200px; max-height: 150px;">{{ HTML::image($user->image) }}</div>
													<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
													<div>
														<span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name='imagefile' /></span>
														<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
													</div>
												</div>
											</div>
											<div class="span10">
												<div class="control-group">
													<label for="nom" class="control-label right">Nom complet:</label>
													<div class="controls">
														<input type="text" name="nom" id="nom" class='input-xlarge' value="{{ $user->prenom }} {{ $user->nom }}">
													</div>
												</div>
												
												
												<div class="control-group">
													<label for="email" class="control-label right">Email:</label>
													<div class="controls">
														<input type="text" name="email" class='input-xlarge' value="{{ $user->emailpro }}">
														
													</div>
												</div>
												<div class="control-group">
													<label for="password" class="control-label right">Password:</label>
													<div class="controls">
														<input type="password" name="password" id="password" class='input-xlarge' value="">
														
													</div>
												</div>

												<div class="form-actions">
													<input type="submit" class='btn btn-primary' value="Enregistrer">
													<a href="{{ URL::to('home') }}" class='btn'>Annuler</a>
												</div>
											</div>
										</div>
									</form>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
                 
             
		</div>
	</div>


@stop