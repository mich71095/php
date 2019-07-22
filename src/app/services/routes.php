<?php

	require_once "C:/wamp64/www/php/src/app/services/http.php";
	require_once "C:/wamp64/www/php/src/app/services/auth.php";

	const HOME = '/';
	const SIGNUP = '/signup';
	const LOGIN = '/login';
	const LOGOUT = '/logout';
	const _404 = '/404'; 
	
	switch ( strval($_SERVER['PHP_SELF']) ) {
		case HOME:
			if(!isAuth())
				redirect(LOGIN);
			else
				echo "MAIN";
			// session_start();
			// echo $_COOKIE['username'];
			// echo $_SESSION['username'];
			break;

		case SIGNUP:
			if(isAuth())
				require_once "C:/wamp64/www/php/src/app/components/sign-up/mysql/Signup.php";
			redirect(LOGIN);
			break;

		case LOGIN:
			if(isAuth())
				redirect('/');
			require_once "C:/wamp64/www/php/src/app/components/sign-in/mysql/Signin.php";
			break;

		case LOGOUT:
			if(logout())
				redirect(LOGIN);
			break;

		case _404:
			require_once "C:/wamp64/www/php/src/app/components/404/404.php";
			break;

		default:
			redirect(_404);
			break;
	}

