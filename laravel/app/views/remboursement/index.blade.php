@extends('layouts.expert')


@section('content')
<br>
<br>
<br>
<!-- dataTables -->
	{{ HTML::script('js/plugins/datatable/jquery.dataTables.min.js') }}
	{{ HTML::script('js/plugins/datatable/TableTools.min.js') }}
	{{ HTML::script('js/plugins/datatable/ColReorderWithResize.js') }}
	{{ HTML::script('js/plugins/datatable/ColVis.min.js') }}
	{{ HTML::script('js/plugins/datatable/jquery.dataTables.columnFilter.js') }}
	{{ HTML::script('js/plugins/datatable/jquery.dataTables.grouping.js') }}

<script>
	function rembId(id) {
       $('#remb-id').val(id);
       var login = $('#'+id+'-l').text();
       var password = $('#'+id+'-p').text();

       $('#login-ll').val(login);
       $('#password-pp').val(password);
	}


</script>

<div id="modal-1" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	{{ Form::open(array('url' => 'remboursement/nouveau', 'class' => 'form-horizontal form-striped', 'data-validate'=>'parsley')) }}

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Nouveau remboursement</h3>
	</div>
	<div class="modal-body">
		
		<p>
		    <div class="control-group">
				<label class="control-label" for="contrat" data-required="true" >N° Contrat</label>
				<div class="controls">
					<div class="input-xlarge">
						<select name="contrat" id="contrat" class='chosen-select'>
							<option value=""></option>
							@foreach($contrats as $contrat)
							  <option value="{{ $contrat->id }}">{{ $contrat->contratecg }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="login" data-required="true" >Login</label>
				<div class="controls">
					<input type="text" class="input-xlarge" placeholder="" id="login" name="login">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="password">Mot de passe</label>
				<div class="controls">
					<input type="text" class="input-xlarge" placeholder="" id="password" name="password">
				</div>
			</div>

		</p>


	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
		<button type="submit" class="btn btn-primary" >Ajouter</button>
	</div>

</form>
</div>




<div id="modal-2" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	{{ Form::open(array('url' => 'remboursement/update', 'class' => 'form-horizontal form-striped', 'data-validate'=>'parsley')) }}

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Editer ce remboursement</h3>
	</div>
	<div class="modal-body">
		
		<p>
		   <input type="hidden" id="remb-id" name="remb" value="">
			<div class="control-group">
				<label class="control-label" for="login-ll" data-required="true" >Login</label>
				<div class="controls">
					<input type="text" class="input-xlarge" placeholder="" id="login-ll" name="login">
				</div>
			</div>

			<div class="control-group">
				<label class="control-label" for="password-pp">Mot de passe</label>
				<div class="controls">
					<input type="text" class="input-xlarge" placeholder="" id="password-pp" name="password">
				</div>
			</div>

		</p>


	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
		<button type="submit" class="btn btn-danger" >Modifier</button>
	</div>

</form>
</div>






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
			   	<div class="span12">
							<div class="box">
								<div class="box-title">
									<h3>
										<i class="icon-reorder"></i>
										Accès aux rembousements
									</h3>
									<div class="actions">
										<a href="#modal-1" role="button"  data-toggle="modal" rel="tooltip" title="Nouveau" class="btn btn-mini"><i class="icon-plus"></i></a>
										<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
									</div>
								</div>
								<div class="box-content">

								   <table class="table table-hover table-nomargin table-bordered usertable">
									<thead>
										
										<tr>
											
											<th ></th>
											<th># Contrat</th>
											
											<th class='hidden-350'>Login</th>
											<th class='hidden-350'>Password</th>
											<th class="hidden-1024">Date</th>
											<th class="hidden-1024"></th>
											
										</tr>
									</thead>
									<tbody>
                                        
                                        @foreach($remboursements as $remboursement)
                                       
										<tr> 
										   
											<td >
											   <a href="#modal-2" onclick="rembId({{ $remboursement->id }})" role="button" class="btn editer" id="{{ $remboursement->id }}" data-toggle="modal" rel="tooltip" title="Editer"><i class="icon-edit"></i></a>							
											</td>
											<td id="{{ $remboursement->id }}-c">{{ $remboursement->contrat->contratecg }}</td>
											
											<td class='hidden-350' id="{{ $remboursement->id }}-l">{{ $remboursement->login }}</td>
											<td class='hidden-350' id="{{ $remboursement->id }}-p">{{ $remboursement->password }}</td>
											<td class="hidden-1024">{{ date('d/m/y H:i', strtotime($remboursement->updated_at)) }}</td>
											<td class="hidden-1024"></td>
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




@stop