<?php

class ChatsController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{   
		$param = Parametrage::find(4);
		$layout = '';
		$view   = '';
		
		if($param->etat) {
          
		   $view   = 'chats.index';
		}
		else{

		   $view   = 'chats.close';
		}

        return View::make($view);
	}


	public function expert()
	{   
		$param = Parametrage::find(4);
		$layout = '';
		$view   = '';
		
		if($param->etat) {
          
		   $view   = 'chats.show';
		}
		else{

		   $view   = 'chats.ferme';
		}

        return View::make($view);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('chats.create');
	}



	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $users_id = array(Auth::User()->id);
		if(Auth::User()->type == 'CLI'){

			$admins   = User::select('id', 'prenom', 'nom')->where('type', 'EXPRT')->where('online', 1)->get();
		}
		else {
			$admins   = User::select('id', 'prenom', 'nom')->where('type', 'CLI')->where('online', 1)->get();
		}

		$chats = Chat::where('active', 1)->whereIn('user_id', $users_id)->orWhereIn('admin_id', $users_id)->orderBy('updated_at', 'DESC')->take(15)->get();
		        
        $content = "";
        $users   = "";
		foreach($chats as $chat) {
            $user = $chat->user;
            $position = "left";
            if($user->type == 'EXPRT') {
            	$position = "right";
            }
            $content .= "<li class='element $position'>
										<div class='image'>
											<img alt='' src='$user->image'>
										</div>
										<div class='message'>
											<span class='caret'></span>
											<span class='name'>$user->prenom $user->nom</span><span class='time pull-right'>
												le ".date('d/m/y', strtotime($chat->updated_at))." à ".date('H:i:s', strtotime($chat->updated_at))."
											</span>
											<p>$chat->message </p>
											
										</div>
									</li>";
		}

		foreach($admins as $admin) {
             
             $users .= "<li id='$admin->id' class='userEx'>
			             <div class='image'>
			                <img alt='' src='$admin->image'>
			             </div>
			             <div class='username'>
			                $admin->prenom $admin->nom 
			             </div>
			             <div class='pull-right'><img src='img/active.png'></div>
                       </li>";
		}

		return json_encode(array('content'=>$content, 'users'=>$users));

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('chats.edit');
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


	public function nouveau(){
      
      if(Input::get('message')) {
      	$chat = new Chat();
		$chat->message = Input::get('message');
		$chat->user_id = Auth::User()->id;
		$chat->admin_id = Input::get('user');
		$chat->user_ip = $_SERVER["REMOTE_ADDR"];
		$chat->active  = 1;

		$chat->save();
		
		return json_encode(array('nom' => Auth::User()->prenom.' '.Auth::User()->nom, 'message' => $chat->message, 'date' => $chat->updated_at)); 

      }
      return 'erreur';
   }



}
