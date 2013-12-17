<?php

class MailController extends BaseController {

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
		$messages = Message::where('type_message_id', 1)->whereIn('contrat_id', $this->contrats)->orderBy('updated_at', 'DESC')->get();
        
        return View::make('mails.index', array('contrats' => $contratSAV, 'messages' => $messages));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function chat()
	{
        return View::make('mails.chat');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

		$input = Input::all();
		
		$rules = array(  
			'contrat'   => 'required|Integer', 
			'objet'     => 'required', 
			'message'   => 'required',
			);

		$messages = array(
			    'contrat.required'  => "Merci de séléctionner un numéro de contrat !",
                'objet.required'    => "Champ objet est requis !",
                'message.required'  => "Champ message est requis !",
			);
           
		$v = Validator::make($input, $rules, $messages);
		
		if($v->passes()) {
             
            $contratSAV = Contrat::find(Input::get('contrat')); 
			$destinataire = DB::connection('assurnetsante')
			                                    ->table('utilisateur')
			                                    ->select('NomUser', 'PrenomUser', 'EmailUser')
			                                    ->where('UseUti', $contratSAV->conseiller)->get();
            
            $message = new Message();
            $message->contrat_id        = Input::get('contrat');
            $message->objet             = Input::get('objet');
            $message->message           = Input::get('message');
            $message->destinataire      = $destinataire[0]->PrenomUser.' '.strtoupper($destinataire[0]->NomUser);
            $message->destinataire_mail = $destinataire[0]->EmailUser;

            $message->save();

            return Redirect::to('mail')->with('flash_success', ' Votre message a été envoyé. ');
		}
		else
		{
			return Redirect::to('mail')->withErrors($v);
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        return View::make('motifs.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('motifs.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}