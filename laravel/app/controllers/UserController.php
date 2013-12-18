<?php

class UserController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		$clients = User::where('type', 'CLI')->orderBy('etat', 'asc')->orderBy('compteur', 'asc')->get();
		$users = User::where('type', '<>', 'CLI')->orderBy('type', 'asc')->get();
		return View::make('users.index', array('clients' => $clients, 'users' => $users));
	}

	public function parametrage()
	{
		return View::make('users.parametrage');
	}

	

	public function profile()
	{   
		$user = User::find(Auth::User()->id);
		
		switch (Auth::User()->type) {
			case 'ADMIN':
				$layout = 'users.profilea';
				break;

		    case 'EXPRT':
				$layout = 'users.profilex';
				break;

			
			default:
				$layout = 'users.profile';
				break;
		}
         
		return View::make($layout, array('user' => $user));
	}



	public function profiler($id)
	{   
		$user = User::find($id);
		
		return View::make('users.profiler', array('user' => $user));
	}




	public function logout()
	{   
		if(Auth::check()){
			
			    $User = User::find(Auth::User()->id);
				$User->online = 0;
				$User->save();

		    
		}
		Auth::logout();
		return Redirect::to('/');
	}



	public function login() {
        
		
		$input = Input::all();
		$rules = array('username'=>'required', 'password'=>'required');
           
		$v = Validator::make($input, $rules);
            
		if($v->fails()){
            
           return Redirect::to('/')->withInput()->with('flash_error', 'Merci de mettre un login et mot de passe correct');
		} 
		else{

			$credentials = array('username' => $input['username'], 'password' => $input['password'], 'etat' => 1);
			
			if(Auth::attempt($credentials)){
				
				if(Auth::User()->type == "CLI"){
					$param = Parametrage::find(5);
			        if($param->etat == 0) {
			           return Redirect::to('/')->with('flash_error', 'Le système est en maintenance');
			        }
				}
					
				$User = User::find(Auth::User()->id);
				$User->online = 1;
				$User->connexion = date('Y-m-d H:i:s');
				$User->compteur += 1;
				$User->save();

				return Redirect::to('home');
			}else{
				
				return Redirect::to('/')->with('flash_error', '	Login ou mot de passe incorrect');
			}
		}
	}


	public function update() {
		

        $rules = array(
        	             'imagefile' => 'mimes:jpeg,jpg,png',
        	             'email'     => 'required|email',
        	            
        	          );

        $v = Validator::make(Input::all(), $rules);
		
		if($v->passes()) {
			
			$path = "uploads/profile/".Auth::User()->id.'/'; 

            $user = User::find(Auth::User()->id);
            $user->emailpro = Input::get('email');
           
           if (Input::hasFile('imagefile')){
            	$user->image    = $path.Input::file('imagefile')->getClientOriginalName();
            	Input::file('imagefile')->move($path, Input::file('imagefile')->getClientOriginalName());
            }
            
            if(Input::get('password')){
            	$user->password = Hash::make(Input::get('password'));
            }
            
            $user->save();
           
            
            return Redirect::to('profile')->with('flash_success', 'Votre profile à été bien modifié ');
		}
		else{
			return Redirect::to('profile')->withInput()->withErrors($v);
		}

	}



	public function profileUpdate() {
		
        $rules = array(
        	             'imagefile' => 'mimes:jpeg,jpg,png',
        	             'email'     => 'required|email',
        	             
        	          );

        $id = Input::get('userId');

        $v = Validator::make(Input::all(), $rules);
		
		if($v->passes()) {
			
			$path = "uploads/profile/".$id.'/'; 

            $user = User::find($id);
            $user->emailpro = Input::get('email');
           
           if (Input::hasFile('imagefile')){
            	$user->image    = $path.Input::file('imagefile')->getClientOriginalName();
            	Input::file('imagefile')->move($path, Input::file('imagefile')->getClientOriginalName());
            }
            
            if(Input::get('password')){
            	$user->password = Hash::make(Input::get('password'));
            }

            if(Input::get('profile')){
            	$user->type = Input::get('profile');
            }
            
            $user->save();
           
            
            return Redirect::to('users')->with('flash_success', 'le profile de '.$user->prenom.' '.$user->nom.' à été bien modifié ');
		}
		else{
			return Redirect::to('users/profile/'.$id)->withInput()->withErrors($v);
		}

	}




	public function create() {
           
           $rules = array(  
           	                'nom'      => 'required',
           	                'prenom'   => 'required',
           	                'login'    => 'required',
           	                'password' => 'required',
           	                'email'    => 'required|email',
           	                
           	             );

           $v = Validator::make(Input::all(), $rules);
           
           if($v->passes()) {
               
               $user = new User();
               $user->nom      = Input::get('nom');
               $user->prenom   = Input::get('prenom');
               $user->emailpro = Input::get('email');
               $user->username = Input::get('login');
               $user->password = Hash::make(Input::get('password'));
               $user->type     = Input::get('profile'); 
               $user->save();

               return Redirect::to('users')->with('flash_success', 'Le utilisateur '.Input::get('prenom').' '.Input::get('nom').' à été ajouté avec Succès');
           }
           
           	  return Redirect::to('users')->withErrors($v);
          
	}






	public function etat($id, $etat) {
		$user = User::find($id);
		$user->etat = ($etat == 0) ? 1 : 0;

		   if (Hash::needsRehash($user->password)) {
			    $user->password = Hash::make($user->password);
			}

		$user->save();

		return Redirect::to('users')->with('flash_success', 'Le compte de '.$user->prenom.' '.$user->nom.' à été changé');
	}


	public function compte() {

		$username = "david";
		$password = Hash::make('123');

		$user = new User();
		$user->username = $username;
		$user->password = $password;
		$user->save();
	}


	public function activeCompte() {

	    $users = User::where('etat', 0)->get();

        foreach($users as $user) {
           
           User::where('id', $user->id)->update(array('etat' => 1, 'password' => Hash::make($user->password)));
        }

		
	}

}