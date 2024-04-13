<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <?php
            try{
                $dbname = 'u_220083681_db';
                $dbhost = 'localhost';
                $username = 'u-220083681';
                $password = '90cHDt2BbpIy5pr';

                $db = new PDO("mysql:dbname=$dbname;host=$dbhost","$username","$password");
            } catch(PDOException $ex){
                echo "failed";
            }
        ?>
    </body>
</html>