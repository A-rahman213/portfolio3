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

        <form method="post" action="addProject.php">
            <label>Title:</label><input type="text" name="title"/><br/>
            <label>Start Date:</label><input type="date" name="startDate"/>
            <label>End Date:</label><input type="date" name="endDate"/><br/>
            <label>Description:</label><textarea name="description"></textarea><br/>
            <label>Phase:</label><input list="phase" name="phase">
            <datalist id="phase">
                <option value="design"></option>
                <option value="development"></option>
                <option value="testing"></option>
                <option value="deployment"></option>
                <option value="complete"></option>
            </datalist><br/>
            <button type="submit">Submit</button>
            <input type="hidden" name="submit" value="true"/>
        </form>

        <?php
            if(!isset($_SESSION["uid"])){
                header("Location: login.php");
            } else{
                if(isset($_POST["submit"])){
                    include("connectdb.php");

                    $title = $db->quote($_POST["title"]);
                    $startDate = $_POST["startDate"];
                    $endDate = $_POST["endDate"];
                    $description = $db->quote($_POST["description"]);
                    $phase = $_POST["phase"];
                    $uid = $_SESSION["uid"];
                    $email = $_SESSION["email"];
                    
                    if(isset($title)&&isset($startDate)&&isset($endDate)&&isset($description)&&isset($phase)){
                        $sth = $db->prepare("INSERT INTO projects (title,start_date,end_date,description,phase,contact,uid)
                            VALUES (:title,:startDate,:endDate,:description,:phase,:contact,:uid)");
                        $sth->bindParam(":title",$title,PDO::PARAM_STR,20);
                        $sth->bindParam(":startDate",$startDate,PDO::PARAM_STR,10);
                        $sth->bindParam(":endDate",$endDate,PDO::PARAM_STR,10);
                        $sth->bindParam(":description",$description,PDO::PARAM_STR,100);
                        $sth->bindParam(":phase",$phase);
                        $sth->bindParam(":contact",$email,PDO::PARAM_STR,50);
                        $sth->bindParam(":uid",$uid,PDO::PARAM_INT,3);

                        $sth->execute();

                        if($db->lastInsertId()){
                            echo "Project Added!";
                        } else{
                            echo "Error! Check details and try again!";
                        }
                    }
                }
            }   
            
        ?>
    </body>
</html>