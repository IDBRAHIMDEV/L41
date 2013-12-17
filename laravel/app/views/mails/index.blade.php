@extends('layouts.master')

@section('content')

<script>
	$(function(){
        $('.message').click(function(){
             var id      = $(this).attr('id');
             var objet   = $('#'+id+'o').val();
             var message = $('#'+id+'m').val();
             objet
             $('#objet').text(objet);
             $('#message_content').text(message);
        });
	});
</script>

<div id="modal-2" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="objet"></h3>
			</div>
			<div class="modal-body">
				<p id="message_content"></p>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Fermer</button>
			</div>
		</div>



<div id="modal-1" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	{{ Form::open(array('url' => 'mail', 'class' => 'form-horizontal form-striped', 'files' => true, 'data-validate'=>'parsley')) }}

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel">Nouveau message</h3>
	</div>
	<div class="modal-body">
		
		<p>

			<div class="control-group">
				<label class="control-label" for="contrat">Contrat</label>
				<div class="controls">
					<select name="contrat" id="contrat">
						@foreach($contrats as $contrat)
						<option value="{{ $contrat->id }}">{{ $contrat->produit->label }} - {{ $contrat->contratecg }}</option>
						@endforeach
					</select>
				</div>
			</div>
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




<br>
<br>
<br>
<div class="container nav-hidden" id="content">
	
	<div id="main">
		<div class="container-fluid">
			<div class="page-header">
				<div class="pull-left">
					<h1>Boite mail</h1>
				</div>
				
			</div>
			<div class="breadcrumbs">
				<ul>
					<li>
						<a href="{{ URL::to('home') }}">Acceuil</a>
						<i class="icon-angle-right"></i>
					</li>
					<li>
						<a href="#">Email</a>

					</li>

				</ul>
				<div class="close-bread">
					<a href="#"><i class="icon-remove"></i></a>
				</div>
			</div>


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
					<div class="box box-bordered box-color">
						<div class="box-title">
							<h3>
								<i class="icon-envelope"></i>
								Boite E-mail
							</h3>
						</div>
						<div class="box-content nopadding">
							<ul class="tabs tabs-inline tabs-left">
								<li class="write">
									<a data-toggle="modal" role="button" href="#modal-1">Ecrire message</a>
								</li>
								<li class="active">
									<a href="#inbox" data-toggle="tab"><i class="icon-inbox"></i> Recus </a>
								</li>
								<li>
									<a href="#sent" data-toggle="tab"><i class="icon-share-alt"></i> Envoyés</a>
								</li>

							</ul>
							<div class="tab-content tab-content-inline">
								<div class="tab-pane active" id="inbox">
									<div class="highlight-toolbar">

									</div>
									<table class="table table-striped table-nomargin table-mail">
										<thead>
											<tr>
												<th class="table-checkbox hidden-480">

												</th>

												<th >Expéditeur</th>
												<th>Objet</th>
												<th class="hidden-480">Message</th>
												<th class="table-date hidden-480">Date</th>
											</tr>
										</thead>
										<tbody>

											@foreach($messages as $message)
											@if($message->genre == 2)
											<tr data-toggle="modal" role="button" href="#modal-2" id="{{ $message->id }}" class="message">

												<td class="table-checkbox hidden-480">
													
												</td>
												<td >
													{{ $message->destinataire }}
												</td>
												<input type="hidden" id="{{ $message->id }}o" value="{{$message->objet}}">
												<td class="table-fixed-medium">
													{{ $message->objet }}
												</td>
												<input type="hidden" id="{{ $message->id }}m" value="{{$message->message}}">
												<td class="hidden-480" >
													{{ substr($message->message, 0, 70) }}
												</td>
												
												<td class="table-date hidden-480">
													{{ date('d/m/y', strtotime($message->updated_at)) }} à {{ date('H:i', strtotime($message->updated_at)) }}
												</td>
											</tr>
											@endif
											@endforeach

										</tbody>
									</table>
								</div>
								<div class="tab-pane" id="sent">

									<table class="table table-striped table-nomargin table-mail">
										<thead>
											<tr>
												<th class="table-checkbox hidden-480">

												</th>

												<th >Déstinataire</th>
												<th>Objet</th>
												<th class="hidden-480">Message</th>
												<th class="table-date hidden-480">Date</th>
											</tr>
										</thead>
										<tbody>
											@foreach($messages as $message)
											@if($message->genre == 1)
											<tr data-toggle="modal" role="button" href="#modal-2" id="{{ $message->id }}" class="message">
												<td class="table-checkbox hidden-480">

												</td>
												<td >
													{{ $message->destinataire }}
												</td>
												<td class="table-fixed-medium">
												<input type="hidden" id="{{ $message->id }}o" value="{{$message->objet}}">
													{{ $message->objet }}
												</td>
												<input type="hidden" id="{{ $message->id }}m" value="{{$message->message}}">
												<td class="hidden-480" >
													{{ substr($message->message, 0, 70) }}
												</td>

												<td class="table-date hidden-480">
													{{ date('d/m/y', strtotime($message->updated_at)) }} à {{ date('H:i', strtotime($message->updated_at)) }}
												</td>
											</tr>
											@endif	 
											@endforeach

										</tbody>
									</table>
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>




			<hr>

		</div></div>



		@stop