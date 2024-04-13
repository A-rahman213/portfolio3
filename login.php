<!DOCTYPE html>
<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="navbar-brand" href="main.php">AProject</a>
                    </li>
                    <li>
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <li>
                        <a class=nav-link href="login.php">Login</a>
                    </li>
                    <li>
                        <a class="nav-link" href="addproject.php">Add Projects</a>
                    </li>
                    <li>
                        <a class="nav-link" href="updateProject.php">Update Projects</a>
                    </li>
                    <?php
                        session_start();
                        if(isset($_SESSION["email"])){
                            echo"
                                <li>
                                    <a class=nav-link href="."'logout.php'".">Logout</a>
                                </li>
                            ";
                        }
                    ?>
                </ul>
            </div>
        </nav>

        <form method="post" action="login.php">
            <label>Username:</label><input type="text" name="username"/><br/>
            <label>Password:</label><input type="password" name="password"/><br/>
            <input type="hidden" name="submit"/>
            <button type="submit" value="true">Submit</button>
            <a href="register.php">Register</a>
        </form>
        
        <?php
            if(isset($_POST["username"])&&isset($_POST["password"])){
                session_start();
                include("connectdb.php");
                $username = $db->quote($_POST["username"]);
                $password = $db->quote($_POST["password"]);

                $qstr = "SELECT * FROM users WHERE username = ".'"'.$username.'"';

                $row = $db->query($qstr)->fetch();

                if(password_verify($password,$row["password"])){
                    $_SESSION["username"] = $username;
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["uid"] = $row["uid"];
                    header("Location: main.php");
                } else{
                    echo "Error! Check credentials and try again!";
                }
            }
        ?>
    </body>
</html>