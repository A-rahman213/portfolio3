<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <?php
            try{
                session_start();
                session_unset();
                session_destroy();

                echo "Log out successful! Redirecting to main page...";

                sleep(3);
                header("Location: main.php");
            } catch(e){
                echo "Logout Unsuccessful! Try again";
            }
        ?>
    </body>
</html>