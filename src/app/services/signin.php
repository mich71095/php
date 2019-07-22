<?php

    namespace Signin;

    error_reporting(E_ERROR | E_PARSE);
    
    // modelForm name
    const USERNAME = 'username';
    const PASSWORD = 'password';

    const ERROR = 'error';
    const VALUE = 'value';

    const NO_USERNAME = "Username does not exist!";
    const INCORRECT_PASSWORD = "Password is incorrect! Try again.";

    // mysql
    require_once "C:/wamp64/www/php/config/mysql_config.php";
    require_once "C:/wamp64/www/php/src/app/services/db/mysql/mixins.php";
    require_once "C:/wamp64/www/php/src/app/services/db/mysql/signin.php";

    require_once "C:/wamp64/www/php/src/app/services/mixins.php";
    require_once "C:/wamp64/www/php/src/app/services/http.php";

    if ($_SERVER['REQUEST_METHOD']==GET)
    	$form = formValidation();

    // validating
    function formValidation()
    {
        if (!array_key_exists(USERNAME, $_GET) && !array_key_exists(PASSWORD, $_GET)) 
            return False;

        $username = $_GET['username'];
        $password = $_GET['password'];

        $username_error = validateUsername($username);
        $password_error = validatePassword($password);

        if (empty($username_error[USERNAME][ERROR]) && empty($password_error[PASSWORD][ERROR]))      
            if (authenticate($_GET['username'], $_GET['password']))
            {
                if (isset($_GET['remember']) && ($_GET['remember']=='on'))
                    setcookie('username', $username, time()+259200, '/'); // 3 days
               redirect('/');
            } else
                return array_merge(
                    $username_error, 
                    array(
                        PASSWORD => array(
                            ERROR => "<span>".INCORRECT_PASSWORD."</span>",
                            VALUE => cleanData($password)
                        )
                    )
                );

        return array_merge($username_error, $password_error);
    }

    function validateUsername($username)
    {
        if (empty($username))
            return array (
                USERNAME => array(
                    ERROR => "<span>".REQUIRED_ERROR."</span>",
                    VALUE => cleanData($username)
                )
            );
        else if (isNewUsername($username))
            return array (
                USERNAME => array(
                    ERROR => "<span>".NO_USERNAME."</span>",
                    VALUE => cleanData($username)
                )
            );

        return array (
                USERNAME => array(
                    ERROR => '',
                    VALUE => cleanData($username)
                )
            );
    }

    function validatePassword($password)
    {
        if (empty($password))
            return array (
                PASSWORD => array(
                    ERROR => "<span>".REQUIRED_ERROR."</span>",
                    VALUE => cleanData($password)
                )
            );

         return array (
                PASSWORD => array(
                    ERROR => '',
                    VALUE => cleanData($username)
                )
            );
    }
