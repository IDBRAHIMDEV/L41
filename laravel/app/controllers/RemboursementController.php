<?php

class RemboursementController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function index()
	{   
		$contrats       = Contrat::select('id','contratecg')->get();
		$remboursements = Remboursement::all();
		return View::make('remboursement.index', array('contrats' => $contrats, 'remboursements' => $remboursements));
	}



	protected function nouveau() {
		
		$rules = array(  
			             'contrat'   => 'required', 
			             'login'     => 'required', 
			             'password'  => 'required', 
                        
			          );

		$messages = array(
			              'contrat:required'  => 'Merci de séléctionner un contrat', 
			              'login:required'    => 'Champ Login est requis !!!',
			              'password:required' => 'Champ mot de passe est requis !!!',
			             );
           
		$v = Validator::make(Input::all(), $rules, $messages);
		if($v->passes()) {


			  $checkContrat = Remboursement::where('contrat_id', Input::get('contrat'))->get()->count();
			
			  if($checkContrat > 0) {

			  	  return Redirect::to('remboursement')->with('flash_errors', 'Les données de ce remboursement exist déjà !!!');
			  }
           
           $remboursement = new Remboursement();
           $remboursement->login      = Input::get('login');
           $remboursement->contrat_id = Input::get('contrat');
           $remboursement->password   = Input::get('password');
           $remboursement->save();

           return Redirect::to('remboursement')->with('flash_success', ' les données d\'accès au remboursement du contrat N° '.Input::get('contrat').' sont ajoutées avec Succès ');
    	}
    	else
    	{
           return Redirect::to('remboursement')->withInput()->withErrors($v);
    	}
    } 




    protected function update() {
		
		$rules = array(  
			             'remb'      => 'required', 
			             'login'     => 'required', 
			             'password'  => 'required', 
                        
			          );

		$messages = array(
			              'remb:required'     => 'Merci de séléctionner un remboursement', 
			              'login:required'    => 'Champ Login est requis !!!',
			              'password:required' => 'Champ mot de passe est requis !!!',
			             );
           
		$v = Validator::make(Input::all(), $rules, $messages);
		if($v->passes()) {

           $remboursement = Remboursement::find(Input::get('remb'));
           $remboursement->login      = Input::get('login');
           $remboursement->password   = Input::get('password');
           $remboursement->save();

           return Redirect::to('remboursement')->with('flash_success', ' les données d\'accès au remboursement du contrat N° '.$remboursement->contrat->contratecg.' sont modifiées avec Succès ');
    	}
    	else
    	{
           return Redirect::to('remboursement')->withInput()->withErrors($v);
    	}
    } 



    public function accesRemboursement() {

    	 $contrats = Auth::User()->contrats;
    	 return View::make('remboursement.remboursement', array('contrats' => $contrats));
    }


}