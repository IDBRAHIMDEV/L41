<?php

class ContratController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function index()
	{
		$contrats = Contrat::where('user_id', Auth::User()->id)->get();
		
		return View::make('contrat.index', array(
              'contrats' => $contrats
		));
	}


	protected function userContrat($id)
	{
		$contrats = Contrat::where('id', $id)->get();

		return View::make('contrat.userContrat', array(
              'contrats' => $contrats
		));
	}

}