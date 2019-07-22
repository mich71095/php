<?php
    
    namespace Signup;

    error_reporting(E_ERROR | E_PARSE);


    // modelForm name
    const USERNAME = 'username';
    const PASSWORD = 'password';
    const CONFIRM_PASSWORD = 'confirm_password';

    // mysql
    // require_once "C:/wamp64/www/php/config/mysql_config.php";
    // use Mysql\DB as mysql_connection;
    // const CONNECTION = mysql_connection;
    require_once "C:/wamp64/www/php/src/app/services/db/mysql/mixins.php";
    require_once "C:/wamp64/www/php/src/app/services/db/mysql/signup.php";

    require_once "C:/wamp64/www/php/src/app/services/mixins.php";
    require_once "C:/wamp64/www/php/src/app/services/http.php";
    

    

    // error messages
    $form = NULL;

    // modelForm scheme
    const MAX_SIZE = 'max_size';
    const MIN_SIZE = 'min_size';
    const REQUIRED = 'required';
    const TYPE = 'type';

    // data types
    const _STRING = 'string';
    const _NUMBER = 'number';

    
    const CONFIRM_PASSWORD_ERROR_EMPTY = "Confirm password is empty!";
    const CONFIRM_PASSWORD_ERROR_MISMATCH = "Confirm password mismatch!";
    const USERNAME_EXIST = "Username already taken.";

    const ERROR = 'error';
    const VALUE = 'value';

    const FORM_MODEL = array (
        USERNAME => array (
            MAX_SIZE => 12,
            MIN_SIZE => 8,
            REQUIRED => True
        ),
        PASSWORD => array (
            MAX_SIZE => 20,
            MIN_SIZE => 5,
            REQUIRED => True
        )
    );


    if ($_SERVER['REQUEST_METHOD']==POST)
        $form = formValidation();

    // validating
    function formValidation()
    {
        if (!array_key_exists(USERNAME, $_POST) && !array_key_exists(PASSWORD, $_POST)) 
            return False;
        
        $username = $_POST[USERNAME];
        $password = $_POST[PASSWORD];
        $confirm_password = $_POST[CONFIRM_PASSWORD];

        $username_error = validateUsername($username);
        $password_error = validatePassword($password, $confirm_password);

        if (empty($username_error[USERNAME][ERROR]) && empty($password_error[PASSWORD][ERROR]))
            if (!isNewUsername($username))
                return array (
                    USERNAME => array(
                        ERROR => "<span>".USERNAME_EXIST."</span>",
                        VALUE => cleanData($username)
                    )
                );
        
            if (saveToDB($username, $password))
                redirect('/login');

        return array_merge($username_error, $password_error);
    }




    function validateUsername($username) 
    {
        $error = checkRequired($username, FORM_MODEL[USERNAME][REQUIRED]);

        if (empty($error)) 
        {
            $max_size = checkMaxSize($username, FORM_MODEL[USERNAME][MAX_SIZE]);
            $error = (empty($max_size)) ? checkMinSize($username, FORM_MODEL[USERNAME][MIN_SIZE]) : $max_size;
        }

        return array (
            USERNAME => array(
                ERROR => $error,
                VALUE => cleanData($username)
            )
        );
    }

    function validatePassword($password, $confirm_password)
    {
        $error = checkRequired($password, FORM_MODEL[PASSWORD][REQUIRED]);

        if (empty($error)) 
        {
            $max_size = checkMaxSize($password, FORM_MODEL[PASSWORD][MAX_SIZE]);
            $error = (empty($max_size)) ? checkMinSize($password, FORM_MODEL[PASSWORD][MIN_SIZE]) : $max_size;
        }

        return array (
            PASSWORD => array(
                ERROR => (empty($error)) ? checkConfirmPassword($password, $confirm_password) : $error,
                VALUE => cleanData($password)
            )
        );
    }

    function checkConfirmPassword($password, $confirm_password)
    {
        if (empty($confirm_password))
            return "<span>".CONFIRM_PASSWORD_ERROR_EMPTY."</span>";
        else 
            return (cleanData($password)==cleanData($confirm_password)) ? '' : "<span>".CONFIRM_PASSWORD_ERROR_MISMATCH."</span>";
    }

    
