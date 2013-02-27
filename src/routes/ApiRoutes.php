<?php

Route::filter('ravelauth.api', function()
{
	if(!is_null(Request::getUser()))
	{
		
		$user = Request::getUser();

		$password = Request::getPassword();

		$credentials = array('username'=>$user, 'password'=> $password);

		$loginAttempt = Auth::attempt($credentials);


		if($loginAttempt !== true)
		{
			$header = array('message'=>trans('ravel::error.403'));
			
			App::abort('403',trans('ravel::error.403'),$header);
		}
	}
});

Route::group(array('prefix'=>_API_BASE_,'before'=>'ravelauth.api|ravelauth'),function()
{
	Route::resource('pages','PagesApiController', array('only'=>array('index','show','store','update','destroy')));

	Route::resource('posts','PostsApiController', array('only'=>array('index','show','store','update','destroy')));

	Route::resource('users','UsersApiController', array('only'=>array('index','show','store','update','destroy')));
	
});