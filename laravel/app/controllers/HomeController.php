<?php

class HomeController extends BaseController {

	 public $contrats;

	public function __construct(){

		$this->contrats = array();

		foreach(Auth::User()->contrats as $contrat){
			$this->contrats[] = $contrat->id;
		}

	}

	

	public function index()
	{

		$contratSAV = Auth::User()->contrats;
		$messages = Message::where('type_message_id', 1)->where('genre', 2)->whereIn('contrat_id', $this->contrats)->orderBy('updated_at', 'DESC')->get();
		$demandes = Reclamation::whereIn('contrat_id', $this->contrats)->orderBy('updated_at', 'DESC')->get();

        $message_count = $messages->count();
        $demande_count = $demandes->count();
        $crejet        = Reclamation::whereIn('contrat_id', $this->contrats)->where('etat', 'R')->orderBy('updated_at', 'DESC')->get()->count();

		return View::make('acceuil.home', array('messages'=>$messages->take(5),
		                                        'demandes' => $demandes->take(5),
		                                        'cmessage' => $message_count,
		                                        'cdemande' => $demande_count,
		                                        'crejet'   => $crejet 
		                                       ));
	}



	public function reclamation() {

		$contratSAV = Auth::User()->contrats;
		$demandes = Reclamation::whereIn('contrat_id', $this->contrats)->orderBy('updated_at', 'DESC')->get();
        
        $content = "";
        $compteur = 1;
		foreach($demandes as $demande) {
             if($compteur <= 5){
           
               $motif = $demande->motif;
              $updated_at = date('d/m/y H:i', strtotime($demande->updated_at));

              if($demande->etat == 'E') {
         		 $etatdemande = "En cours";
                 $progress    = 'primary'; 
                 $pourcentage = 30; 
                 $label       = 'info';

                 if($demande->lu == 1) {
                 	$pourcentage = 50;
                 } 

                 if($demande->lu == 2) {
                 	$pourcentage = 70;
                 }                                        
         	}
			elseif ($demande->etat == 'T'){
				 $etatdemande = "Traité";
				 $progress = 'success'; 
				 $pourcentage = 100;
				 $label       = 'success';

			}else {
				 $etatdemande = "Refusé";
				 $progress = 'danger';
				 $pourcentage = 100; 
				 $label       = 'warning';
			}
            
            $commentaire = "";
			if(!empty($demande->commentaire)) {
				$commentaire = "<p><i class='glyphicon-comments'></i> $demande->commentaire</p>";
			}

			 $content .= 
			 "<tr>
			 			 <td class='well'>
			 			 <div><b>$motif->libelle</b> </div>
			 			 <p>
			 			 <div class='progress progress-$progress progress-striped active '>
			 			 <div class='bar img-rounded' style='width: $pourcentage%;'>$pourcentage %</div>
			 			 </div>
			 			 </p>
			 			 	
								$commentaire			
			 			 
			 			 </td>
			 			 <td><blockquote><span class='label label-$label'>$etatdemande</span> <br>N° $demande->reference_id <br> $updated_at  </blockquote></td>
			 
			 			 </tr>
			 			 
			 			 <tr>";
                                   
		}else {
			break;
		} 
          $compteur++;   
      }
      $url = URL::to('demande');
      $content .= "<tr><td colspan='2'><div class='pull-right'><a href='$url' class='btn '>Suite...</a></div></td> </tr>";
		return $content;
	}




	public function message() {
      
        $contratSAV = Auth::User()->contrats;
		$messages = Message::where('type_message_id', 1)->where('genre', 2)->whereIn('contrat_id', $this->contrats)->orderBy('updated_at', 'DESC')->get();
     
      $content = "";
      $compteur = 1;
      foreach($messages as $message) {
       
       if($compteur <= 5) {
       	$date  = date('d/m/Y', strtotime($message->updated_at)); 
        $heure = date('H:i', strtotime($message->updated_at));

	       $content .= "
	      <tr>
		      <td>
			      <h5 class='media-heading'> $message->objet <small class='pull-right'>&nbsp; le $date à $heure </small></h5>
			      <p class='well'>
			        $message->message<br>
                    <span class='pull-right'> <small><b>$message->destinataire</b></small> </span>
			      </p>
			      <div class='media-actions pull-right'>
			      <input type='hidden' id='$message->contrat_idm' value='$message->contrat_id'>
			      <a id='$message->contrat_id' class='btn btn-small response' data-toggle='modal' role='button' href='#modal-1'><i class='icon-reply'></i> Répondre</a>
			      </div>
		      </td>
	      </tr>";
	      }
	      else{
             break;
	      }

	      $compteur++;
       }
       

        return $content;
	}



	public function theme() {

	    DB::table('users')
			->where('id', Auth::User()->id)
			->update(array('theme' => Input::get('theme')));
	}
   
}