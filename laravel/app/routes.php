<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{         
	return View::make('users.login');
});

Route::get('login', function()
{         
	return View::make('users.login');
});


Route::post('login', 'UserController@login');
Route::get('logout', 'UserController@logout');
Route::get('compte', 'UserController@compte');
Route::get('active', 'UserController@activeCompte');


 Route::get('chat/close', 'ChatController@close');

Route::group(array('before'=>'auth'), function(){
        Route::resource('chat', 'ChatsController');
		Route::post('chat/nouveau', 'ChatsController@nouveau');
		Route::post('demande/details', 'DemandeController@details');
        Route::get('demande/actions', 'DemandeController@actions');
        Route::get('theme', 'HomeController@theme');

        Route::get('profile', 'UserController@profile');
        Route::post('profile/update', 'UserController@update');
});


Route::group(array('before'=>'auth|admin'), function(){
    
	Route::get('admin', 'AdminController@index');
	Route::get('pie', 'AdminController@pie');
	Route::get('line_sort', 'AdminController@line_sort');
	Route::get('line_duree', 'AdminController@line_duree');
	Route::get('stat', 'AdminController@stat');
	Route::get('demandes', 'AdminController@demandes');
	Route::post('demandes/fermeture', 'AdminController@fermeture');
	Route::post('demandes/message', 'AdminController@message');
	Route::get('messages', 'AdminController@messages');
	Route::get('parametrage', 'AdminController@parametrage');
	Route::post('parametrage/update', 'AdminController@update');
    Route::get('users', 'UserController@index');
    Route::post('users/create', 'UserController@create');
    Route::get('users/etat/{id}/{etat}', 'UserController@etat');
    Route::get('users/profile/{id}', 'UserController@profiler');
    Route::post('users/profile/update', 'UserController@profileUpdate');

    Route::get('user/details/{id}', 'AdminController@userContrats');
    Route::get('user/details/contrat/{id}', 'ContratController@userContrat');

    Route::post('compagnie/nouveau', 'AdminController@compagnieNouveau');
    Route::post('compagnie/update', 'AdminController@compagnieUpdate');

    Route::post('gamme/nouveau', 'AdminController@gammeNouveau');
    Route::post('gamme/update', 'AdminController@gammeUpdate');

    Route::post('nature/nouveau', 'AdminController@natureNouveau');
    Route::post('nature/update', 'AdminController@natureUpdate');

    Route::post('motif/nouveau', 'AdminController@motifNouveau');
    Route::post('motif/update', 'AdminController@motifUpdate');

    Route::post('document/nouveau', 'AdminController@documentNouveau');
    Route::post('document/update', 'AdminController@documentUpdate');

    Route::get('motif/doc/{id}', 'AdminController@motifDocument');
    Route::post('motif/doc/affecte', 'AdminController@motifDocAffecte');

    Route::post('gamme/power', 'AdminController@gammePower');
});



Route::group(array('before'=>'auth|client'), function(){
	    Route::get('demande/rejet', 'DemandeController@rejet');
        Route::post('demande/search', 'DemandeController@search');
        Route::get('contrat', 'ContratController@index');
    	Route::get('home', 'HomeController@index');
    	Route::get('reclamation', 'HomeController@reclamation');
    	Route::get('message', 'HomeController@message');
		Route::resource('demande', 'DemandeController');
		Route::resource('motifs', 'MotifsController');
		Route::resource('mail', 'MailController');
		
		Route::get('demande/new/{id}', 'DemandeController@nouveau');
		Route::get('demande/motif/{id}', 'DemandeController@ajaxMotifs');
		Route::get('demande/doc/{id}', 'DemandeController@ajaxMotifDocs');
		Route::get('demande/{idrec}/motif/{id}', 'DemandeController@ajaxMotifs2');
		Route::get('demande/{idrec}/doc/{id}', 'DemandeController@ajaxMotifDocs2');
		Route::resource('natures', 'NaturesController');
        Route::get('notification', 'NotificationController@notification');
        Route::get('notificationVue', 'NotificationController@notificationVue');
        Route::get('acces', 'RemboursementController@accesRemboursement');

       
});


Route::group(array('before'=>'auth|expert'), function(){
        
        Route::get('expert', 'ChatsController@expert');
        Route::get('remboursement', 'RemboursementController@index');
        Route::post('remboursement/nouveau', 'RemboursementController@nouveau');
        Route::post('remboursement/update', 'RemboursementController@update');
		
});






