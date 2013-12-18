@extends('layouts.admin')

@section('content')
  <br>
  <br>
  <br>
  <br>

<?php $plaquette = "http://www.euromutuelle.com/ASSURSANTE/"; ?>
<div class="container nav-hidden" id="content">
		<div id="main">
			<div class="container-fluid">
			<div class="breadcrumbs">
					<ul>
						<li>
							<a href="{{ URL::to('home') }}">Acceuil</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#">Contrat </a>
							
						</li>
						
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i></a>
					</div>
				</div>


	 <?php $produit = ''; ?>
	@foreach($contrats as $contrat)
       @if($contrat->produit->label == 'Auto')
         <?php $produit = 'glyphicon-car'; ?>
       @else
         <?php $produit = 'icon-stethoscope'; ?>
       @endif
			  <br>

               <div class="row-fluid">
               	   <div class="span12" >

               	       <legend>contrat n° {{ $contrat->contratecg }}</legend>
						<ul class="tiles tiles tiles-center nomargin" >

						     <li class="long">
								<img rel="tooltip" data-original-title="Compagnie" src="{{ URL::asset('img/cegema.jpg') }}" alt="">
							</li>

							<li></li>
                           @if($contrat->offert > 0)
							<li class="magenta">
								<a href="#" rel="tooltip" data-original-title="Mois offert"><span><i class="icon-star-empty"></i></span><span class="name"  >1 MOIS Offert</span></a>
							</li>
						   @endif

							  
							
							<li class="blue">
								<a href="#" rel="tooltip" data-original-title="Date effet"><span><i class="icon-calendar"></i></span><span class="name">{{ date('d/m/Y', strtotime($contrat->dateeffet)) }}</span></a>
							</li>

							<li class=" lightred">
								<a href="#" rel="tooltip" data-original-title="Date echéance"><span><i class="icon-calendar"></i></span><span class="name">{{ date('d/m/Y', strtotime($contrat->dateecheance)) }}</span></a>
							</li>

							<li class="  teal">
								<a href="#" rel="tooltip" data-original-title="Gamme & formule"><span><i class="icon-bookmark-empty"></i></span><span class="name">{{ $contrat->gamme->libelle }} - {{ $contrat->formule }}</span></a>
							</li>

							<li class="  lime">
								<a href="#" rel="tooltip" data-original-title="Prime anuelle"><span ><i class="icon-money"></i></span><span class="name">{{ number_format($contrat->prime, 2, ',', ' ') }} &euro; </span></a>
							</li>

							
						</ul>
					</div>
               </div>
				

				
                 <hr>

                <div class="row-fluid">
					<div class=" span12" align="left">
					    <a href="" class="btn btn-success" rel="tooltip" data-original-title="{{ $contrat->produit->description }}"><i class="{{ $produit }}"></i> {{ $contrat->produit->label }}</a>
						<a href="{{ $plaquette }}EditionsCompagnie/IMPRIME{{ $contrat->gamme->code }}.php?NumCode={{ $contrat->user->numclient }}&Key={{ $contrat->user->passkey }}&NumDev={{ $contrat->contratecg }}&Formule={{ $contrat->formule }}" class="btn btn-primary" rel="tooltip" data-original-title="Détails" target="_blank"><i class="glyphicon-search"></i></a>
						<a href="" class="btn btn-primary" rel="tooltip" data-original-title="Remboursement"><i class="glyphicon-euro"></i></a>
						<a href="{{ URL::to('home') }}" class="btn btn-primary" rel="tooltip" data-original-title="Retour"><i class="glyphicon-share"></i></a>
					</div>
				</div>

				<div class="row-fluid">
					
					
					<div class="span6">
						<div class="box box-bordered box-color">
								<div class="box-title">
									<h3>
										<i class="icon-stethoscope"></i>
										Assuré
									</h3>
									
								</div>
								<div class="box-content">
									<div class="tab-content">
										<div class="row-fluid">

											<div class="span2">
											  @if($contrat->user->sexe == 'M')
											   <img src="{{ URL::asset('img/male.png') }}" alt="">
											  @else
                                               <img src="{{ URL::asset('img/female.png') }}" alt="">
                                              @endif 
											</div>
											<div class="span10">
												  <dl class="dl-horizontal">
												    <dt>PRENOM </dt>
											        <dd>{{ $contrat->user->prenom }}</dd>
											        <dt>NOM </dt>
											        <dd>{{ $contrat->user->nom }}</dd>
											        <dt>REGIME</dt>
											        <dd>{{ $contrat->user->regime }}</dd>
											        <dt>NAISSANCE</dt>
											        <dd>{{ date("d/m/Y",strtotime($contrat->user->datenaissance)) }}</dd>

											      </dl>

											</div>
										</div>
									</div>
								</div>
							</div>
					</div>	

					<div class="span6">
					@if($contrat->conjoint)
						<div class="box box-bordered box-color">
								<div class="box-title">
									<h3>
										<i class="icon-stethoscope"></i>
										Conjoint
									</h3>
									
								</div>
								<div class="box-content">
									<div class="tab-content">
										<div class="row-fluid">

											<div class="span2"> 
                                              @if($contrat->conjoint->sexe == 'F')
											   <img src="{{ URL::asset('img/female.png') }}" alt="">
											  @else
                                               <img src="{{ URL::asset('img/male.png') }}" alt="">
                                              @endif

											</div>
											<div class="span10">
												<dl class="dl-horizontal">
												    <dt>PRENOM </dt>
											        <dd>{{ $contrat->conjoint->prenom }}</dd>
											        <dt>NOM </dt>
											        <dd>{{ $contrat->conjoint->nom }}</dd>
											        <dt>REGIME</dt>
											        <dd>{{ $contrat->conjoint->regime }}</dd>
											        <dt>NAISSANCE</dt>
											        <dd>{{date("d/m/Y",strtotime($contrat->conjoint->datenaissance))}}</dd>

											        
											      </dl>
											</div>
										</div>
									</div>
								</div>
							</div>

						@endif
					</div>

				</div>

               @if($contrat->enfants->count() > 0)
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-bordered box-color">
							<div class="box-title">
								<h3>
									<i class="icon-stethoscope"></i>
									Enfant(s)
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin">
									<thead>
										<tr>
											<th>Nom & Pénom</th>
											<th>Genre</th>
											<th class="hidden-350">NAISSANCE</th>
											
										</tr>
									</thead>
									<tbody>

									  @foreach($contrat->enfants as $enfant)
										<tr>
											<td>{{ $enfant->prenom }} {{ $enfant->nom }}</td>
											<td>
												 @if($enfant->sexe == 'F')
											        <img src="{{ URL::asset('img/female.png') }}" alt="" width="36" height="36">
											     @else
                                                    <img src="{{ URL::asset('img/male.png') }}" alt="" width="36" height="36">
                                                 @endif
											</td>
											<td class="hidden-350">{{date("d/m/Y",strtotime($enfant->datenaissance))}}</td>
											
										</tr>
									  @endforeach
										
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
               @endif

               <br>


	@endforeach
</div>

    </div>
  </div>
	

@stop