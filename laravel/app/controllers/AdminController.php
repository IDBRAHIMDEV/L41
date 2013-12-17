<?php

class AdminController extends BaseController {

	

	public function index()
	{
		$contrat = DB::table('contrats')->count();
		$demande = DB::table('reclamations')->count();
		$message = DB::table('messages')->count();

        return View::make('admin.index', array('nbcontrat' => $contrat, 'nbdemande' => $demande, 'nbmessage' => $message));
	}


	public function stat() {
		$contrat = DB::table('contrats')->whereBetween('contrats.created_at', array(Input::get('datedebut').' 00:00:00', Input::get('datefin').' 23:59:59'))->count();
		$demande = DB::table('reclamations')->whereBetween('reclamations.created_at', array(Input::get('datedebut').' 00:00:00', Input::get('datefin').' 23:59:59'))->count();
		$message = DB::table('messages')->whereBetween('messages.created_at', array(Input::get('datedebut').' 00:00:00', Input::get('datefin').' 23:59:59'))->count();

		return json_encode(array('contrat'=>$contrat, 'demande'=>$demande, 'message'=>$message));
	}

	

	public function pie()
	{
		$pie = DB::table('reclamations')
		            ->select(DB::raw('count(*) as count, etat'))
		            ->whereBetween('reclamations.updated_at', array(Input::get('datedebut').' 00:00:00', Input::get('datefin').' 23:59:59'))
                    ->orderBy('etat', 'desc')
                    ->groupBy('etat')
                    ->get();

        return $pie;
	}



	public function line_sort()
	{ 
		
		$line_sort  = DB::table('reclamations')
		            ->join('motifs', 'reclamations.motif_id', '=', 'motifs.id')
                    ->join('natures', 'motifs.nature_id', '=', 'natures.id')
		            ->select(DB::raw('count(*) as count, natures.libelle'))
		            ->whereBetween('reclamations.updated_at', array(Input::get('datedebut').' 00:00:00', Input::get('datefin').' 23:59:59'))
                    ->orderBy('count', 'desc')
                    ->groupBy('natures.libelle')
                    ->get();

        return $line_sort;
	}


	public function line_duree()
	{
		$line_sort  = DB::table('reclamations')
		            ->join('motifs', 'reclamations.motif_id', '=', 'motifs.id')
                    ->join('natures', 'motifs.nature_id', '=', 'natures.id')
		            ->select(DB::raw('round(avg((TO_DAYS(reclamations.updated_at)*24) - (TO_DAYS(reclamations.created_at)*24))) as AVG, natures.libelle'))
		            ->whereBetween('reclamations.updated_at', array(Input::get('datedebut').' 00:00:00', Input::get('datefin').' 23:59:59'))
		            ->where('etat', 'T')
                    ->orderBy('AVG', 'desc')
                    ->groupBy('natures.libelle')
                    ->get();

        return $line_sort;
	}


	public function demandes() {

		$demandes = Reclamation::orderBy('updated_at', 'DESC')->take(100)->get();
		$motifs   = DB::connection('assurnetsante')->table('gr_motif_reclamation')->where('groupemotif', 1)->orderBy('motif', 'asc')->get();
		return View::make('admin.demandes', array('demandes'=>$demandes, 'motifs' => $motifs));
	}


	public function fermeture() {

		$input = Input::all();

		$rules = array(  
			             'motif'         => 'required', 
			             'idreclamation' => 'required', 
			          );

		$messages = array(
			    'motif.required'  => "Merci de séléctionner un motif de fermeture !",
			);
           
		$v = Validator::make($input, $rules, $messages);
		
		if($v->passes()) {

			$part = explode('-', Input::get('motif'));
			$idMotif      = $part[0];
			$libelleMotif = $part[1];

    DB::connection('assurnetsante')->table('gr_reclamation')
                                            ->where('DC_IdReclam', Input::get('idreclamation'))
                                            ->update(
                                              array(
                                              	  'GR_MotifFermer' => $idMotif, 'GR_Etat' => 'F',
                                              	  'GR_SITUATION' => 'FE', 'GR_DateFermuture' => date('Y-m-d'),
                                                  'GR_HeureFermuture' => date('H:i:s'), 'GR_CommentFermer' => Input::get('commentaire')
                                              	  )
                                            );


	DB::connection('assurnetsante')->table('gr_trace_reclamation')->insert(
		   
		   array('Action'=>'FE', 'Date_Action'=>date('Y-m-d'),
		         'Heure_Action'=>date('H:i:s'), 
		   	     'Action_Consernne'=>'SAV', 
		   	     'Responsable_Action'=>'SAV', 
		   	     'idReclam'=>Input::get('idreclamation')
		   	     )
		);



    DB::table('reclamations')->where('reference_id', Input::get('idreclamation'))
                             ->update(array('commentaire' => $libelleMotif,
                                            'lu' => 3, 'etat' => 'R',
                                            'updated_at' => date('Y-m-d H:i:s')
                              ));

    $action = new Action();
    $action->libelle = $libelleMotif;
    $action->reclamation_id = Input::get('idreclamation');
    $action->gestionnaire = 'SAV';
    $action->save();

    return Redirect::to('demandes')->with('flash_success', "	La fermeture de la demande # ".Input::get('idreclamation')." a été fait avec Succès... ");
}
else{

	return Redirect::to('demandes')->withInput()->withErrors($v);
}
}


public function message() {

	$input = Input::all();

		$rules = array(  
			             'idcontrat'  => 'required', 
			             'objet'      => 'required',
			             'message'    => 'required',
			          );

		$messages = array(
			    'objet.required'  => "Objet est requis !",
			    'message.required'  => "Message est requis !",
			);
           
		$v = Validator::make($input, $rules, $messages);
		   
		   $vue = "";
		   if(Input::has('mode')) {
                 $vue = "messages";
            }else{
            	$vue = "demandes";
            }

		if($v->passes()) {

			$message = new Message();
			$message->message = Input::get('message');
			$message->objet = Input::get('objet');
			$message->destinataire = Auth::User()->prenom.' '.Auth::User()->nom;
			$message->genre = 2;
			$message->contrat_id = Input::get('idcontrat');
			$message->save();

            

			 return Redirect::to($vue)->with('flash_success', "	Le message a été envoyé ");


        }else {
        	return Redirect::to($vue)->withInput()->withErrors($v);
        }

}


public function messages() {

		$messages = Message::orderBy('created_at', 'DESC')->take(100)->get();
		return View::make('admin.messages', array('messages' => $messages));
	}




public function parametrage() {
     
     $natures = Nature::where('active', 1)->orderBy('libelle', 'asc')->get();
     $compagnies = Compagnie::where('active', 1)->orderBy('libelle', 'asc')->get();
     $gammes = Gamme::orderBy('libelle', 'asc')->get();
     $motifs = Motif::orderBy('libelle', 'asc')->get();
     $docs   = Doc::orderBy('label', 'asc')->get();
     $param = Parametrage::where('active', 1)->orderBy('type', 'DESC')->get();
	 return View::make('admin.parametrage', array('parametrages'=>$param, 
	 	                                          'gammes'=>$gammes, 
	 	                                          'motifs' => $motifs, 
	 	                                          'docs' => $docs,
	 	                                          'compagnies'=> $compagnies,
	 	                                          'natures' => $natures
	 	                                          ));
}



public function compagnieNouveau() {
    
    $rules = array(  
			             'code'    => 'required|unique:compagnies,code', 
			             'libelle' => 'required',
			             'siteCompagnie' => 'required',
			             'logo'    => 'required|image|mimes:jpeg,png'
			          );

		$messages = array(

			    'code.required'     => "Code compagnie est requis !",
			    'libelle.required'  => "Libellé est requise !",
			    'siteCompagnie.required' => 'Url de site requis !',
			    'logo.required'     => "Logo compagnie est requis !"
			);
           
		$v = Validator::make(Input::all(), $rules, $messages);
		
		if($v->passes()) {
             
             DB::connection('assurnetsante')->table('groupe_cie')
				                               ->insert(array('NumGrpCie' => Input::get('code'),
				                               	     'NomGrpCie' => Input::get('libelle'),
				                               	     'NomCie'    => Input::get('libelle')
				                               	));

			
			$path = "uploads/".Input::get('code'); 
			
			$compagnie          = new Compagnie();
			$compagnie->code    = Input::get('code');
			$compagnie->site    = Input::get('siteCompagnie');
			$compagnie->libelle = Input::get('libelle');
			$compagnie->chemin  = $path.'/'.Input::file('logo')->getClientOriginalName();
            $compagnie->save();
             
             
             Input::file('logo')->move($path, Input::file('logo')->getClientOriginalName());
             return Redirect::to('parametrage')->with('flash_success', '	La compagnie à été bien enregistrée ');

		} 
		else {
			return Redirect::to('parametrage')->withErrors($v);
		}

}


public function compagnieUpdate() {
    
    $rules = array(  
			            
			             'libelle' => 'required',
			             'logo'    => 'image|mimes:jpeg,png'
			          );

		$messages = array(

			    'libelle.required'  => "Libellé est requise !",
			    'logo.image'     => "Logo compagnie est une image !"
			);
           
		$v = Validator::make(Input::all(), $rules, $messages);
		
		if($v->passes()) {

			$compagnie          = Compagnie::find(Input::get('compagnieId'));
			$compagnie->libelle = Input::get('libelle');
            $compagnie->site    = Input::get('siteCompagnie');
             if (Input::hasFile('logo')){
             	$path = "uploads/".$compagnie->code; 
             	$compagnie->chemin  = $path.'/'.Input::file('logo')->getClientOriginalName();
               Input::file('logo')->move($path, Input::file('logo')->getClientOriginalName());
             }

             $compagnie->save();

             DB::connection('assurnetsante')->table('groupe_cie')
                                               ->where('NumGrpCie', $compagnie->code)
				                               ->update(array(
				                               	     'NomGrpCie' => Input::get('libelle'),
				                               	     'NomCie'    => Input::get('libelle')
				                               	));

			 
			
             return Redirect::to('parametrage')->with('flash_success', ' La compagnie à été bien modifiée ');

		} 
		else {
			return Redirect::to('parametrage')->withErrors($v);
		}

}



public function gammeNouveau() {
    
    $rules = array(      
    	                 'compagnie' => 'required',
			             'code'      => 'required|unique:gammes,code', 
			             'libelle'   => 'required',
			             
			          );

		$messages = array(
                
                'compagnie.required' => "Merci de choisir une compagnie",
			    'code.required'      => "Code gamme est requis !",
			    'libelle.required'   => "Libellé est requise !",
			    
			);
           
		$v = Validator::make(Input::all(), $rules, $messages);
		
		if($v->passes()) {
			
			$gamme = new Gamme();
			$gamme->code = Input::get('code');
			$gamme->libelle = Input::get('libelle');
			$gamme->compagnie_id = Input::get('compagnie');
            $gamme->save();


            DB::connection('assurnetsante')->table('gamme')
				                               ->insert(array('CODEGAMME' => Input::get('code'),
				                               	     'LIBELLEGAMME' => Input::get('libelle'),
				                               	   
				                               	));


		    $compagnie = Compagnie::find($gamme->compagnie_id);

            DB::connection('assurnetsante')->table('compagnie')
				                               ->insert(array('NUMCIE' => Input::get('code'),
				                               	     'NOMCIE'   => Input::get('libelle'),
				                               	     'SIGCIE'   => $compagnie->code,
				                               	     'GroupCie' => $compagnie->code,
				                               	     'NOMBREMOISACCOMPTE' => 0,
				                               	));
            

             return Redirect::to('parametrage')->with('flash_success', '	La gamme à été bien enregistrée ');

		} 
		else {
			return Redirect::to('parametrage')->withErrors($v);
		}

}




public function gammeUpdate() {
    
        $rules = array('libelle'   => 'required');
		$messages = array('libelle.required'   => "Libellé est requise !");
           
		$v = Validator::make(Input::all(), $rules, $messages);
		
		if($v->passes()) {
			
			$gamme = Gamme::find(Input::get('gammeId'));
			$gamme->libelle = Input::get('libelle');
            $gamme->save();

            DB::connection('assurnetsante')->table('gamme')
                                               ->where('CODEGAMME', $gamme->code)
				                               ->update(array('LIBELLEGAMME' => Input::get('libelle')));

		    DB::connection('assurnetsante')->table('compagnie')
                                               ->where('NUMCIE', $gamme->code)
				                               ->update(array('NOMCIE' => Input::get('libelle')));


             return Redirect::to('parametrage')->with('flash_success', '	La gamme à été bien modifiée ');

		} 
		else {
			return Redirect::to('parametrage')->withErrors($v);
		}

}




public function natureNouveau() {

         $rules = array(      
    	                 'code'      => 'required|unique:natures,code',
			             'libelle'   => 'required',
			             
			          );

		$messages = array(
			    'code.required'      => "Code nature est requis !",
			    'libelle.required'   => "Libellé est requise !",
			    'code.unique'        => "Nature existe déjà dans le système !"
			    
			);
           
		$v = Validator::make(Input::all(), $rules, $messages);
		
		if($v->passes()) {
			
			$nature = new Nature();
			$nature->code = Input::get('code');
			$nature->libelle = Input::get('libelle');

            $nature->save();
            
            DB::connection('assurnetsante')->table('gr_groupe_categorie')
				                               ->insert(array(
				                               	     'codecatReclam' => Input::get('code'),
				                               	     'libcatReclam' => Input::get('libelle'),
				                               	));


             return Redirect::to('parametrage')->with('flash_success', '	La nature à été bien enregistrée ');

		} 
		else {
			return Redirect::to('parametrage')->withErrors($v);
		}

}





public function motifNouveau() {

         $rules = array(      
    	                 'nature'    => 'required',
			             'libelle'   => 'required|unique:motifs,libelle',
			             
			          );

		$messages = array(
			    'nature.required'    => "nature est requise !",
			    'libelle.required'   => "Libellé est requise !",
			    
			);
           
		$v = Validator::make(Input::all(), $rules, $messages);
		
		if($v->passes()) {

		  $nature = Nature::find(Input::get('nature'));
		  $id = DB::connection('assurnetsante')->table('gr_categorie_reclamation')
				                               ->insertGetId(array(
				                               	     'CodeCatReclam' => $nature->code,
				                               	     'SouCat' => Input::get('libelle'),
				                               	));

			
			$motif = new Motif();
			$motif->nature_id = Input::get('nature');
			$motif->libelle   = Input::get('libelle');
            $motif->code      = $id;
            $motif->save();

             DB::table('docsmotifs')
	               ->insert(array('motif_id' => $motif->id, 'doc_id' => 14));

             return Redirect::to('parametrage')->with('flash_success', '	Le motif à été bien enregistré ');

		} 
		else {
			return Redirect::to('parametrage')->withErrors($v);
		}

}



public function motifUpdate() {

         $rules = array(      
    	                 'nature'    => 'required',
			             'libelle'   => 'required',
			          );

		$messages = array(
			    'nature.required'    => "nature est requise !",
			    'libelle.required'   => "Libellé est requise !",
			);
           
		$v = Validator::make(Input::all(), $rules, $messages);
		
		if($v->passes()) {

			$motif = Motif::find(Input::get('motifId'));
			$motif->libelle   = Input::get('libelle');
            $motif->nature_id = Input::get('nature');
            $motif->save();

             DB::connection('assurnetsante')->table('gr_categorie_reclamation')
                                               ->where('CodeSouCat', $motif->code)
				                               ->update(array('SouCat' => Input::get('libelle')));

             return Redirect::to('parametrage')->with('flash_success', ' Le motif à été bien modifié ');

		} 
		else {
			return Redirect::to('parametrage')->withErrors($v);
		}

}



public function documentNouveau() {

         $rules = array(      
			             'libelle'   => 'required|unique:docs,label',
			          );

		$messages = array(
			    'libelle.required'   => "Libellé est requise !",
			);
           
		$v = Validator::make(Input::all(), $rules, $messages);
		
		if($v->passes()) {
			
			$doc = new Doc();
			$doc->label = Input::get('libelle');
            $doc->description = Input::get('description');
            $doc->save();

             return Redirect::to('parametrage')->with('flash_success', '	Le document à été bien enregistré ');

		} 
		else {
			return Redirect::to('parametrage')->withErrors($v);
		}

}



public function documentUpdate() {

         $rules = array('libelle' => 'required');
		 $messages = array('libelle.required' => "Libellé est requise !");
           
		$v = Validator::make(Input::all(), $rules, $messages);
		
		if($v->passes()) {
			
			$doc = Doc::find(Input::get('documentId'));
			$doc->label = Input::get('libelle');
            $doc->description = Input::get('description');
            $doc->save();

             return Redirect::to('parametrage')->with('flash_success', '	Le document à été bien modifié ');

		} 
		else {
			return Redirect::to('parametrage')->withErrors($v);
		}

}



public function motifDocument($id) {
	
	$docs   = Doc::orderBy('label', 'asc')->get();
	$motif = Motif::find($id);
	return View::make('admin.motifDocument', array('motif' => $motif, 'docs' => $docs));
}



public function motifDocAffecte() {
    
    if(Input::get('valeur')) {
	   
	    DB::table('docsmotifs')
	               ->insert(array('motif_id' => Input::get('motif'), 'doc_id' => Input::get('doc')));
    }
    else{

       if(Input::get('doc') != 14){
       	DB::table('docsmotifs')
	               ->where('motif_id', Input::get('motif'))
	               ->where('doc_id', Input::get('doc'))
	               ->delete();
       }
    	

    }
}


public function gammePower() {

	 $gamme = Gamme::find(Input::get('id'));
	 $gammeEtat = ($gamme->active == 1) ? 0 : 1;
     $gammeEtatAssur = ($gamme->active == 1) ? 'N' : 'O';
	 $gamme->active = $gammeEtat;
	 $gamme->save();
      

       DB::connection('assurnetsante')->table('gamme')
                                         ->where('CODEGAMME', $gamme->code)
                                         ->update(array('Active' => $gammeEtatAssur));



     $etat = '';
	 if($gammeEtat) {
	 	$etat = 'img/on.png';
	 }
	 else{
	 	$etat = 'img/off.png';
	 }
	 return $etat;
}



public function update() {

	if(Input::get('valeur') != '') {

		 $param = Parametrage::find(Input::get('idParam'));
		 $param->etat = Input::get('valeur');
		 $param->save();

		 return 'glyphicon-circle_ok';
	}
	return 'glyphicon-circle_remove';
}




  public function userContrats($id) {
  	 
  	 $contrats = Contrat::where('user_id', $id)->orderBy('updated_at', 'desc')->get();
  	 $chats    = Chat::where('user_id', $id)->orWhere('admin_id', $id)->orderBy('updated_at', 'desc')->get();
  	 return View::make('admin.userContrats', array('contrats' => $contrats, 'conversations' => $chats));
  } 


}
