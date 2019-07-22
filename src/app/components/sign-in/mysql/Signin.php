

<?php
    require_once "C:/wamp64/www/php/src/app/services/signin.php";
?>


<!DOCTYPE html>
<html>
    <head>
        <title> Signin </title>
    </head>
    <body>
        <?php
            echo "Welcome to Sigin page.";
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
            <p>
                <input type="text" name="username" placeholder="username" value="<?php echo $form['username']['value'] ?>" />
                <?php  echo $form['username']['error'] ?>
            </p>
            <p>
                <input type="password" name="password" placeholder="password" />
                <?php  echo $form['password']['error'] ?>
            </p>
            <p>
                <input type="checkbox" name="remember" />
            </p>
            <p>
                <input type="submit" value="Login" />
            </p>
        </form>
    </body>
</html>