 <!DOCTYPE html>
 <html>
    <head>
      <!-- Latest compiled and minified CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
      <!--Table CSS-->
      <link href="table.css" rel="stylesheet"/>
      <!--Site CSS-->
      <link href="style.css" rel="stylesheet"/>
      <!--search function script-->
      <script src="search.js"></script>
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
      
      <div id="intro">
         <h2>Available Projects</h2>
         <p>A list of current projects at Aston University</p>
         <ul>
            <li> To add or edit projects, Log in </li>
            <li> Can't find a project? Use the search feature to look for projects by name</li>
         </ul>
      </div>

      <input type="text" id="input" onkeyup="search()" placeholder="Search"/>

      <?php
      include("connectdb.php");

      $qstr = "SELECT * FROM projects";
      $rows = $db->query($qstr)->fetchAll();

      echo "
         <table id=".'"table"'."class="."table table-hover".">
            <thead>
               <tr>
                  <th></th>
                  <th>Title</th>
                  <th>Start Date</th>
                  <th>Description</th>
               </tr>
            </thead>
      ";
         
      foreach($rows as $row){
         echo "
            <tbody>
               <tr>
                  <td><span class="."expandChild"."></span></td>
                  <td>".$row["title"]."</td>
                  <td>".$row["start_date"]."</td>
                  <td>".$row["description"]."</td>
               </tr>
         ";

         echo "
               <tr class="."child".">
                  <td></td>
                  <td>"."End Date: ".$row["end_date"]."</td>
                  <td>"."Phase: ".$row["phase"]."</td>
                  <td>"."Contact Detail: ".$row["contact"]."</td>
               </tr>
         ";
         }

         echo "
               </tbody>
            </table>
         ";

      ?>

      <script src="//code.jquery.com/jquery.js"></script>
      <!-- Latest compiled and minified JavaScript -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script><!-- <script src="js/disqus-config.js"></script> -->

      <script>
      $(function() {
         $('.expandChild').on('click', function() {
            $(this).toggleClass('selected').closest('tr').next().toggle();
         })
      });
      </script>
    </body>
 </html>