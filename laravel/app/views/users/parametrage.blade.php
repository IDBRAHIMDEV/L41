@extends('layouts.master')

@section('content')


   
    <br>
   <br>
   <br>
  <div class="container nav-hidden" id="content">
	
		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Profile</h1>
					</div>
					<div class="pull-center">
						        <ul class="tiles tiles-center nomargin">

									
									<li class="lightred">
										<span class="label label-info">284</span>
										<a href="#"><span><i class=" glyphicon-envelope"></i></span><span class="name">Mail</span></a>
									</li>
									<li class="orange">
										<span class="label label-inverse">15</span>
										<a href="#"><span><i class="glyphicon-conversation"></i></span><span class="name">Chat</span></a>
									</li>
									<li class="blue">
										<span class="label label-important">444</span>
										<a href="#"><span><i class="glyphicon-circle_question_mark"></i></span><span class="name">Demande</span></a>
									</li>
									<li class="satgreen">
										<span class="label label-inverse">5</span>
										<a href="#"><span><i class=" glyphicon-bullhorn"></i></span><span class="name">Réclamation</span></a>
									</li>
									
									<li class="magenta">
										<span class="label label-inverse">15</span>
										<a href="#"><span><i class="glyphicon-euro"></i></span><span class="name">Remboursement</span></a>
									</li>
									<li class="lightgrey">
										<span class="label label-info">17</span>
										<a href="#"><span><i class="glyphicon-circle_exclamation_mark"></i></span><span class="name">Rejets</span></a>
									</li>
								</ul>
						
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="more-login.html">Acceuil</a>
							<i class="icon-angle-right"></i>
						</li>

						<li>
							<a href="more-login.html">Utilisateur</a>
							<i class="icon-angle-right"></i>
						</li>

						<li>
							<a href="more-login.html">Paramètrage</a>
							
						</li>
						
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i></a>
					</div>
				</div>

                

                  <div class="row-fluid">
				<div class="span12">
					<div class="box box-color box-bordered">
						<div class="box-title">
							<h3>
								<i class="icon-user"></i>
								Profile utilisateur
							</h3>
						</div>
						<div class="box-content nopadding">
							<ul class="tabs tabs-inline tabs-top">
								<li class="active">
									<a href="#profile" data-toggle="tab"><i class="icon-user"></i> Profile</a>
								</li>
								<li>
									<a href="#notifications" data-toggle="tab"><i class="icon-bullhorn"></i> Notifications</a>
								</li>
								
							</ul>
							<div class="tab-content padding tab-content-inline tab-content-bottom">
								<div class="tab-pane active" id="profile">
									<form action="#" class="form-horizontal">
										<div class="row-fluid">
											<div class="span2">
												<div class="fileupload fileupload-new" data-provides="fileupload">
													<div class="fileupload-new thumbnail" style="max-width: 225px; max-height: 170px;"><img src="img/demo/user-1.jpg"></div>
													<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
													<div>
														<span class="btn btn-file"><span class="fileupload-new">Votre image</span><span class="fileupload-exists">Change</span><input type="file" name="imagefile"></span>
														<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
													</div>
												</div>
											</div>

											  
                                            <div class="span10">
											<div class="box">
												
												<div class="box-content" style="border:none">
													<form action="#" method="POST" class="form-horizontal form-bordered">
														<div class="control-group">
															<label for="textfield" class="control-label">Nom complet</label>
															<div class="controls">
																<input type="text" name="textfield" id="textfield" placeholder="Nom & Prénom" class="input-xlarge span7">
															</div>
														</div>
														<div class="control-group">
															<label for="password" class="control-label">Mot de passe</label>
															<div class="controls">
																<input type="password" name="password" id="password" placeholder="Mot de passe" class="input-xlarge span7">
															</div>
														</div>
														
															<div class="control-group">
															<label for="password" class="control-label">Ville</label>
															<div class="controls">
															<select name="s2" id="s2" class='select2-me input-xlarge span7'>
															    <option value="01">Votre une ville</option>
																<option value="01">Paris</option>
																<option value="02">Toulouse</option>
																<option value="03">Nimes</option>
																<option value="04">Lion</option>
																<option value="05">Nantes</option>
																<option value="06">Monpelier</option>
																
															</select>
															</div>
														</div>
														<div class="control-group">
															<label for="password" class="control-label">Email 1</label>
															<div class="controls">
																<input type="text" name="mail1" id="mail1" placeholder="Adresse mail 1 *" class="input-xlarge span7">
															</div>
														</div>
														<div class="control-group">
															<label for="password" class="control-label">Email 2</label>
															<div class="controls">
																<input type="text" name="mail2" id="mail2" placeholder="Adresse mail 2" class="input-xlarge span7">
															</div>
														</div>

														<div class="form-actions">
															<button type="submit" class="btn btn-danger"><i class=" icon-pencil"></i> Modifier</button>
															<button type="button" class="btn"><i class="icon-reply"></i> Annuler</button>
														</div>
													</form>
												</div>
											</div>
										</div>

												
											
										</div>
									</form>
								</div>
								<div class="tab-pane" id="notifications">
									<form action="#" class="form-horizontal">
										<div class="control-group">
											<label for="asdf" class="control-label">notifications</label>
											<div class="controls">
												<label class="checkbox"><input type="checkbox" name="asdf"> Envoyer un email de sécurité</label>
												<label class="checkbox"><input type="checkbox" name="asdf"> Envoyer un email système</label>
												<label class="checkbox"><input type="checkbox" name="asdf"> Envoyer un email de suivi</label>
												<label class="checkbox"><input type="checkbox" name="asdf"> Minim veli</label>
											</div>
										</div>
										<div class="control-group">
											<label for="asdf" class="control-label">Email pour les notifications</label>
											<div class="controls">
												<select name="email" id="email">
													<option value="1">asdf@blasdas.com</option>
													<option value="2">johnDoe@asdasf.de</option>
													<option value="3">janeDoe@janejanejane.net</option>
												</select>
											</div>
										</div>
										<div class="form-actions">
											<input type="submit" class="btn btn-primary" value="Enregistrer">
											<input type="reset" class="btn" value="Annuler">
										</div>
									</form>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>




               <hr>
             
		</div>
	</div>



@stop