<?php

class DemandeController extends BaseController {

	public $contrats;
	public $Incontrats;

	public function __construct(){

		$contrats = array(0);
		$Incontrats = 0;

		foreach(Auth::User()->contrats as $contrat){
			$this->contrats[] = $contrat->id;
		}

		$this->Incontrats = implode(',', $this->contrats);

	}


	public function index()
	{   
		$demandes = Reclamation::whereIn('contrat_id', $this->contrats)->orderBy('updated_at', 'DESC')->get();
		$motifs   = Motif::orderBy('libelle', 'ASC')->get();
        return View::make('demandes.index', array('demandes'=>$demandes, 'motifs'=>$motifs));
	}

	public function rejet()
	{   
		$demandes = Reclamation::whereIn('contrat_id', $this->contrats)->where('etat', 'R')->orderBy('updated_at', 'DESC')->get();
		$motifs   = Motif::orderBy('libelle', 'ASC')->get();
        return View::make('demandes.index', array('demandes'=>$demandes, 'motifs'=>$motifs));
	}


	public function search()
	{
		$Input = Input::all();
		$motif = Input::get('motif');
		$etat  = Input::get('etat');
        $start = Input::get('start');
        $end   = Input::get('end');

		$condition = "";
		if(!empty($etat)) {
			$condition .= "and etat = '$etat' ";
		}

		if(!empty($motif)) {
            $condition .= "and motif_id = $motif ";
		}

		if(!empty($start)) {
			$condition .= "and reclamations.updated_at between '$start 00:00:00' and '$end 23:59:59' ";
		}

		if(Auth::User()->type == 'CLI'){
			$condition .= "and reclamations.contrat_id in ($this->Incontrats) ";
		}
       
		$demandes = DB::select("select reclamations.*, motifs.libelle 
			                    from reclamations, motifs where motifs.id = reclamations.motif_id 
			                    $condition 
			                    order by reclamations.updated_at desc");

         $table = "";
         foreach($demandes as $demande) {
         	
         	if($demande->etat == 'E') {
         		 $etatdemande = "En cours";
                 $progress    = 'primary'; 
                 $pourcentage = 30; 

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

			}else {
				 $etatdemande = "Refusé";
				 $progress = 'danger';
				 $pourcentage = 100; 
			}
		    
		    $edit = '';
		    if($demande->etat == 'E') {
               $edit = "<a href='".URL::to('demande/'.$demande->id.'/edit')."' class='btn btn-primary' rel='tooltip' data-original-title='Editer'><i class='icon-edit'></i></a>";
		    }								   
         	$table .=  "<tr><td><i class='icon-angle-right'></i> $demande->reference_id </td>  <td><i class='icon-angle-right'></i> $demande->libelle </td><td> $demande->updated_at </td><td class='hidden-350'>$etatdemande</td><td class='hidden-1024'><div class='progress progress-striped progress-$progress active'><div class='bar img-rounded ' style='width: $pourcentage%;'><span align='center'>$pourcentage%</span></div></div></td><td class='hidden-480 textalign' > $edit <a id='$demande->id' href='#modal-1' role='button' class='btn btn-primary idreclam' data-toggle='modal' rel='tooltip' data-original-title='Pièce jointe'><i class='icon-search'></i></a> <a id='$demande->reference_id' href='#modal-2' role='button' class='btn btn-primary idreclamA' data-toggle='modal' rel='tooltip' data-original-title='Actions'><i class='icon-tags'></i></a></td></tr>";
           
         }

        return $table;
	}

    

    public function details() {

    	 $idReclamation = Input::get('idreclam');

    	 	$documents = DB::select("select documents.*, reclamations.*, docs.label from documents, reclamations, docs where documents.doc_id = docs.id and documents.reclamation_id = reclamations.id and reclamations.id = $idReclamation order by docs.label desc");
            $support = "";
            $content = "";
            foreach ($documents as $document) {
                    $extension = substr($document->path, strlen($document->path) - 3, strlen($document->path) - 1);
                    
                    switch ($extension) {
                    	case 'pdf':
                    		{
                    			$support = HTML::image('img/pdf.png'); 
                    			break;
                    		}

                    	case 'doc':
                    	    {
                    	    	$support = HTML::image('img/word.png'); 
                    			break;
                    	    }

                    	case 'ocx':
                    	    {
                    	    	$support = HTML::image('img/word.png');
                    			break;
                    	    }	
                    	
                    	default:
                    		    $support = HTML::image('img/vide.png'); 
                    			break;
                    }  

                      $link    = HTML::link($document->path, $document->label, array('target' => '_blank'), false );
                      $dowload = HTML::link($document->path, "Télécharger", array('target' => '_blank'), false );
            	 $content .= "<tr><td> $support </td><td> $link </td> <td align='center'> $dowload</td></tr>"; 
            }

            return $content;
    }




    public function actions() {

    	 $idReclamation = Input::get('idreclam');

    	 	$actions = Action::where('reclamation_id', $idReclamation)->orderBy('updated_at', 'desc')->get();
            

            $content = "";
            foreach ($actions as $action) {
                     
            	 $content .= "<tr><td> $action->libelle </td><td>  </td> <td align='center'> ".date('d/m/Y H:i', strtotime($action->updated_at))." </td></tr>"; 
            }

            return $content;
    }




	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$value = isset($_COOKIE['nbDemande']) ? $_COOKIE['nbDemande'] : 0; 
        $param = Parametrage::find(1);
		
		if($param->etat <= $value) {
           return Redirect::to('demande')->with('flash_error', 'Vous avez atteint le nombre maximum d\'envoi de demandes');
        }



		$contrats = Auth::User()->contrats;
		$motifs   = Motif::where('active', '=', 1)->orderBy('nature_id', 'ASC')->get();
		$natures  = Nature::where('active', '=', 1)->orderBy('code', 'ASC')->get();
        
        return View::make('demandes.new', array('natures'=>$natures, 'motifs'=>$motifs, 'contrats'=>$contrats));
	}


	public function nouveau($id)
	{

		$contrats = Auth::User()->contrats;
		$motifs   = Motif::where('active', '=', 1)->orderBy('nature_id', 'ASC')->get();
		$natures  = Nature::where('active', '=', 1)->orderBy('code', 'ASC')->get();
        
        return View::make('demandes.new', array('natures'=>$natures, 'motifs'=>$motifs, 'contrats'=>$contrats, 'contrat_id'=>$id));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{   
      
		if (isset($_COOKIE['nbDemande'])) {
          $value = $_COOKIE['nbDemande'];
          $value++;
		}else {
          $value = 0;
		}

		setcookie("nbDemande", $value, time()+(3600*12));  /* expire dans 12 heure */
        
        $param = Parametrage::find(1);
		
        if($param->etat <= $value) {
           return Redirect::to('demande')->with('flash_error', 'Vous avez atteint le nombre maximum d\'envoi de demandes');
        }

		$path = '';
		$input = Input::all();

		$rules = array(  
			             'contrat'     => 'required', 
			             'nature'      => 'required', 
                         'motif'       => 'required',
                         'description' => 'required',
                         'file'        => 'required'
			          );
           
		$v = Validator::make($input, $rules);
		if($v->passes()) {
          
          
            $files = Input::file('file');
			foreach($files as $id=>$file) {
                       
				if(!is_null($file)) {

					if($file->getClientOriginalExtension() == 'pdf' or $file->getClientOriginalExtension() == 'doc' or $file->getClientOriginalExtension() == 'docx') {
                       
						if($file->getSize() == 0){

							return Redirect::to('demande/create')->with('flash_errors', "la taille du fichier ne doit pas dépassée 2 MO !!!");
						}
						
					}
					else{
						return Redirect::to('demande/create')->with('flash_errors', "le type de fichier ".$file->getClientOriginalExtension()." est non autorisé !!!");
					}
				}
			}


			$reclamation = new Reclamation();
			$reclamation->contrat_id  = Input::get('contrat');
			$reclamation->motif_id    = Input::get('motif'); 
			$reclamation->description = Input::get('description');
			$reclamation->lu = '0';
			$reclamation->etat = 'E';

			$reclamation->save();
            
				   foreach($files as $id=>$file) {
				    	
				    	if(!is_null($file)) {
                           
			            	          	$path = "uploads/".$reclamation->contrat_id.'/'.$reclamation->id.'/'; 
				                        $document = new Document();
				                        $document->path = "uploads/".$reclamation->contrat_id.'/'.$reclamation->id.'/'.$file->getClientOriginalName();
				                        $document->doc_id = $id;
				                        $document->reclamation_id = $reclamation->id;
				                        $document->save();

				                        $file->move($path, $file->getClientOriginalName());
			            }
			        }
				

				     $agence     = '060';
				     $contratSAV = Contrat::find(Input::get('contrat'));
				     $motifSAV   = Motif::find(Input::get('motif'));
                     $apporteur  = substr($contratSAV->contratecg, 0, 2);
				    

				     switch ($apporteur) {
				      	case '90':
				      		$agence = "090";
				      		break;

				      	case '80':
				      		$agence = "080";
				      		break;

				      	case '70':
				      		$agence = "070";
				      		break;

				      	case '61':
				      		$agence = "061";
				      		break;

				      	case '60':
				      		$agence = "060";
				      		break;

				      	case '50':
				      		$agence = "050";
				      		break;
				      	
				      	default:
				      		$agence = "020";
				      		break;
				      } 
                     
				     $numrecl   = Compteursante::where('AGECPT', $agence)->get();
  
				       DB::connection('assurnetsante')->table('gr_reclamation')->insert(
				       	 
				       	  array('DC_IdReclam' => $numrecl[0]->NumReclam,
				       	        'DC_DateInsertion'  => date('Y-m-d H:i:s'),
				       	        'DC_HeureInsertion' => date('Y-m-d H:i:s'),
				       	        'GR_CodeSouCat'     => $motifSAV->code,
				       	        'GR_NumContrat'     => $contratSAV->contratecg,
				       	        'GR_NumApp'         => 5000
				       	        )
				       );

				       DB::connection('assurnetsante')->table('gr_trace_reclamation')->insert(

                           array(
                           	      'Action'             => 'CR',
                           	      'Date_Action'        => date('Y-m-d'),
                           	      'Heure_Action'       => date('H:i:s'),
                           	      'Responsable_Action' => 'Errais',
                           	      'Action_Consernne'   => 'Errais',
                           	      'TypeAction'         => 'M',
                           	      'idReclam'           => $numrecl[0]->NumReclam
                           	    )

				       	);
                       
                       $reclamation->reference_id = $numrecl[0]->NumReclam;
				       $reclamation->save();
                      
				       DB::connection('assurnetsante')->table('compteur')
				                                             ->where('AGECPT', $agence)
				                                             ->update(
				                                             	       array('NumReclam' => $numrecl[0]->NumReclam + 1)
				                                             	     );

       

                   return Redirect::to('demande')->with('flash_success', '	Votre demande est en cours de traitement ... ');
			

		}else{

            return Redirect::to('demande/create')->withInput()->withErrors($v);
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
        return View::make('demandes.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$contrats = Auth::User()->contrats;
        $motifs  = Motif::where('active', '=', 1)->orderBy('nature_id', 'ASC')->get();
		$natures = Nature::where('active', '=', 1)->orderBy('code', 'ASC')->get();

        $reclamation = Reclamation::find($id);
        $motif = Motif::find($reclamation->motif_id);

       return View::make('demandes.edit', array('natures'     => $natures, 
       	                                        'motifs'      => $motifs, 
       	                                        'reclamation' => $reclamation,
       	                                        'nature_id'   => $motif->nature_id,
       	                                        'contrats'    => $contrats
       	                                        )
       );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		

		$path = '';
	
		$rules = array(  
			             'contrat'     => 'required', 
			             'nature'      => 'required', 
                         'motif'       => 'required',
                         'description' => 'required',
                         'file'        => 'required'
			          );
           
		$v = Validator::make(Input::all(), $rules);
		
		if($v->passes()) {

               $files = Input::file('file');
				foreach($files as $id=>$file) {
	                       
					if(!is_null($file)) {

						if($file->getClientOriginalExtension() == 'pdf' or $file->getClientOriginalExtension() == 'doc' or $file->getClientOriginalExtension() == 'docx') {
	                       
							if($file->getSize() == 0){

								return Redirect::to('demande')->with('flash_error', "la taille du fichier ne doit pas dépassée 2 MO !!!");
							}
							
						}
						else{
							return Redirect::to('demande')->with('flash_error', "le type de fichier ".$file->getClientOriginalExtension()." est non autorisé !!!");
						}
					}
				}

			
			$reclamation = Reclamation::find(Input::get('idreclamation'));
			$reclamation->contrat_id  = Input::get('contrat');
			$reclamation->motif_id    = Input::get('motif'); 
			$reclamation->description = Input::get('description');
			$reclamation->updated_at  = date('Y-m-d H:i:s');
			$reclamation->lu = '0';
			$reclamation->etat = 'E';

			$reclamation->save();
             Document::where('reclamation_id', '=', $reclamation->id)->delete();
            	
            	    $files = Input::file('file');

            	    
				  foreach($files as $id=>$file) {
				    	
				    	if(!is_null($file)) {

				    		$path = "uploads/".$reclamation->contrat_id.'/'.$reclamation->id.'/'; 
	                        $document = new Document();
	                        $document->path = "uploads/".$reclamation->contrat_id.'/'.$reclamation->id.'/'.$file->getClientOriginalName();
	                        $document->doc_id = $id;
	                        $document->reclamation_id = $reclamation->id;
	                        $document->save();

			                $file->move($path, $file->getClientOriginalName());
				    	}

				    	
				    }

				     $contratSAV = Contrat::find(Input::get('contrat'));
				     $motifSAV   = Motif::find(Input::get('motif'));
                     $apporteur  = substr($contratSAV->contratecg, 0, 2);
				    
  
				    DB::connection('assurnetsante')->table('gr_reclamation')
				                                      ->where('DC_IdReclam', $reclamation->reference_id)
				                                      ->update(
				                                           array(
											       	        'DC_DateInsertion'  => date('Y-m-d H:i:s'),
											       	        'DC_HeureInsertion' => date('Y-m-d H:i:s'),
											       	        'GR_CodeSouCat'     => $motifSAV->code,
											       	        'GR_NumContrat'     => $contratSAV->contratecg,
											       	        )
				                                        );

                    

                   return Redirect::to('demande')->with('flash_success', '	Votre demande à été bien modifiée ... ');
			

		}else{

            return Redirect::to('demande/create')->withInput()->withErrors($v);
		}


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


	public function ajaxMotifs($id) {
        return Motif::where('nature_id','=', $id)->where('active', '=', '1')->get();
	}


	public function ajaxMotifDocs($id) {
        $motifs = Motif::find($id);
        return $motifs->docs;
	} 


	public function ajaxMotifs2($idrec = null, $id) {
        return Motif::where('nature_id','=', $id)->where('active', '=', '1')->get();
	}


	public function ajaxMotifDocs2($idrec = null, $id) {
        $motifs = Motif::find($id);
        return $motifs->docs;
	} 

}
