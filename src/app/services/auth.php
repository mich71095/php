<?php

function isAuth()
{
	session_start(); 

	// if (isset($_COOKIE['username']) && isset($_SESSION['username']) && ($_COOKIE['username']==$_SESSION['username']))
	if (isset($_SESSION['loggedin']) && isset($_SESSION['expire_in']) && isset($_SESSION['username'])
		&& $_SESSION['loggedin'] && $_SESSION['expire_in'] > time() )
		return True;
	if (isset($_SESSION['loggedin']) && isset($_SESSION['expire_in']) && isset($_SESSION['username'])
		&& $_SESSION['loggedin'] && $_SESSION['expire_in'] < time() && isset($_COOKIE['username']) )

				if ($_COOKIE['username'] == $_SESSION['username']) {
					print_r( "
						<script type=\"text/javascript\">
							console.log('cookie == session: ".$_SESSION."---".$_COOKIE."');
						</script>
					");	
					return True;
				} else {
					print_r( "
						<script type=\"text/javascript\">
							console.log('cookie != session: ');
						</script>
					");	
					return False;	
				}
				
	return False;
}

function logout()
{
	session_start(); 
	session_unset();
	session_destroy();
	return True;
}