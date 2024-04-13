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
                   <?php
                    session_start();
                    if(!isset($_SESSION["email"])){
                        echo"
                            <li>
                                <a class=nav-link href="."'login.php'".">Login</a>
                            </li>
                        ";
                    }
                    ?>
                   <li>
                       <a class="nav-link" href="addproject.php">Add Projects</a>
                   </li>
                   <li>
                       <a class="nav-link" href="updateProject.php">Update Projects</a>
                   </li>
                   <?php
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

        <?php
            include("connectdb.php");
            if(!isset($_SESSION["uid"])){
                header("Location: login.php");
            } else{
                $qstr = "SELECT * FROM projects WHERE contact = ".'"'.$_SESSION["email"].'"';

                $rows = $db->query($qstr)->fetchAll();
            }
        ?>

        <label>Select a Project</label>
        <select name="projects" id="projects">
            <?php
                foreach($rows as $row){
                    echo"
                        <option value=".'"'.$row["title"].'"'.">".$row["title"]."</option>
                    ";
                }
            ?>
        </select>
        <form method="post" action="updateProject.php">
        <label>Title:</label><input type="text" name="title"/><br/>
            <label>Start Date:</label><input type="date" name="startDate" value=<?php $row["start_date"]?>/>
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
            if(isset($_POST["submit"])){
                if(isset($_POST["title"])){
                    try{
                        $title = $db->quote($_POST["title"]);
                        $statement = "UPDATE projects SET title = ".$title."WHERE title = ".'"'.$row["title"].'"';
                        $result = $db->prepare($statement)->execute();
                        echo "Title updated!";
                    } catch(e){
                        echo "Error! Check inputs and try again";
                    }
                } elseif(isset($_POST["startDate"])){
                    try{
                        $startDate = $_POST["startDate"];
                        $statement = "UPDATE projects SET start_date = ".$startDate."WHERE start_date = ".'"'.$row["start_date"].'"';
                        $result = $db->prepare($statement)->execute();
                        echo "Start Date updated!";
                    } catch(e){
                        echo "Error! Check inputs and try again";
                    }
                } elseif(isset($_POST["endDate"])){
                    try{
                        $endDate = $_POST["endDate"];
                        $statement = "UPDATE projects SET end_date = ".$endDate."WHERE end_date = ".'"'.$row["end_date"].'"';
                        $result = $db->prepare($statement)->execute();
                        echo "End Date updated!";
                    } catch(e){
                        echo "Error! Check inputs and try again";
                    }
                } elseif(isset($_POST["description"])){
                    try{
                        $description = $db->quote($_POST["description"]);
                        $statement = "UPDATE projects SET description = ".$description."WHERE end_date = ".'"'.$row["description"].'"';
                        $result = $db->prepare($statement)->execute();
                        echo "Description updated!";
                    } catch (e){
                        echo "Error! Check inputs and try again";
                    }
                } elseif(isset($_POST["description"])){
                    try{
                        $description = $db->quote($_POST["phase"]);
                        $statement = "UPDATE projects SET phase = ".$description."WHERE phase = ".'"'.$row["phase"].'"';
                        $result = $db->prepare($statement)->execute();
                        echo "Description updated!";
                    } catch (e){
                        echo "Error! Check inputs and try again";
                    }
                }
            }
        ?>
    </body>
</html>