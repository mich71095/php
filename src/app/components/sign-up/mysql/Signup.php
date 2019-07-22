<?php 
    require_once "C:/wamp64/www/php/src/app/services/signup.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Signup </title>
    </head>
    <body>
        <?php 
            echo "Welcome to sign up page";
        ?>
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <p>
                <input type="text" name="username" placeholder="username" value="<?php echo $form['username']['value'] ?>"/> 
                <?php echo $form['username']['error']; ?>
            </p>
            <p>
                <input type="password" name="password" placeholder="password" /> 
                <?php echo $form['password']['error']; ?>
            </p>
            <p>
                <input type="password" name="confirm_password" placeholder="confirm password" /> 
            </p>
            <p>
                <input type="submit" value="Signup"> 
            </p>
        </form>

    </body>
</html>