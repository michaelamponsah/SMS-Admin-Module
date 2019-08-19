<?php require_once "./includes/header.php"; ?>

<?php 
            if(!isset($_GET["cid"])){
               echo "<h1 style='padding: 20rem; text-align: center;'> Oops something went wrong!</h1>";
                exit();
            } else{
               
                // Get the ID of the class
                $classList = $_GET["cid"];
                
                $sql = "SELECT `class_name` FROM `classes` WHERE `class_id`= $classList";
                $result = mysqli_query($conn, $sql);
                $class = mysqli_fetch_array($result);

                $sql = "SELECT `student_id`, `first_name`, `last_name`, `other_names`, `gen_id` FROM `students` WHERE `class` = $classList ";
                $result  = mysqli_query($conn, $sql);
                $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
            }
            
?>       

<?php require_once "sidebar.php"; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Students</h1>
        <h3><?php echo $class[0]; ?></h3>
        <div>
         <nav class="navbar navbar-light bg-light">
            <form class="form-inline">
              <input class="form-control mr-sm-3" type="search" placeholder="Search student" aria-label="Search" required>
              <button class="btn btn-outline-primary my-3 my-sm-0" type="submit">Search</button>
            </form>
          </nav>

        </div>
      </div>
        <!-- TABLE DISPLAY OF ALL CLASSES IN THE SCHOOL-->

        <!--Checks if the user is logged in-->
        <?php
          if(isset($_SESSION['usr_id'])){
            echo "You are logged in <br>";
          }
        ?>
       
          <!-- TABLE DISPLAY OF STUDENTS IN A CLASS -->

          <!-- Table Head -->
          <table class="table table-hover table-sm custom-container">
              <thead class="thead-dark">
                  <tr>
                    <th scope="col">S/N</th>
                    <th scope="col"> NAMES</th>
                    <th scope="col">IDs</th>
                  </tr>
              </thead>

            <?php 
            $i=0;
            foreach($students as $student) :
            $i++;
            ?>
                <tbody>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><a href="view_single_student.php?stid=<?php echo $student["student_id"]; ?>"><?php echo $student["first_name"] ." ". $student["last_name"] ." ". $student["other_names"]; ?></a></td>
                        <td><a href="view_single_student.php?stid=<?php echo $student["student_id"]; ?>"><?php echo $student["gen_id"]; ?></a></td>
                    </tr>
                </tbody>  
        <?php endforeach; ?>
                         
            </table> <!-- End of Table -->

              
           
       
        <canvas class="my-4 w-100" id="myChart" width="900" height="300"></canvas> 
    </main>
  </div>
</div>


<?php include_once "./includes/footer.php"; ?>
