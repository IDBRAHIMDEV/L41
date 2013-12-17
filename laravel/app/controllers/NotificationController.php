<?php

class NotificationController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('notifications.index');
	}

	
	public function notificationVue() {
		$idAction = Input::get('id');

	    DB::table('actions')
			->where('id', $idAction)
			->update(array('vue' => 1));
	}



	public function notification() {
		

		$notifications = DB::table('actions')
			->join('reclamations', 'actions.reclamation_id', '=', 'reclamations.reference_id')
			->join('contrats', 'reclamations.contrat_id', '=', 'contrats.id')
			->orderBy('actions.updated_at', 'desc')
			->where('contrats.user_id', '=', Auth::User()->id);


        $Actions  = "";
        $compteur = 1;
        $notifs   = $notifications->get();

        foreach($notifs as $notification){

        	$Actions .= "<li>
							<a href='#' title='Réclamation N°: $notification->reclamation_id'>
								
								<div class='details'>
									<div class='name'>$notification->gestionnaire</div>
									<div class='message'>
									  ".date('d/m/Y H:i', strtotime($notification->updated_at))."<br>
									  $notification->libelle...
									</div>
								</div>
							</a>
						</li>";
		 
			 if($compteur >= 5){
			 	break;
			 }

			 $compteur++;
        }
		
        $Actions .= "<li>
          <a href='".URL::to('chat')."' class='more-messages'>Voir toutes les notifications <i class='icon-arrow-right'></i></a>
        </li>";

		return json_encode(array('actions' => $Actions, 'actionscount' => $notifications->count())); 
	}
}
