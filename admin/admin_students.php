<?php require_once "./includes/header.php"; ?>
<?php require_once "sidebar.php"; ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Students</h1>
        <div>
         <nav class="navbar navbar-light bg-light">
            <form class="form-inline">
              <input class="form-control mr-sm-3" type="search" placeholder="Search student" aria-label="Search">
              <button class="btn btn-outline-primary my-3 my-sm-0" type="submit">Search</button>
            </form>
          </nav>

        </div>
      </div>
        <!-- TABLE DISPLAY OF ALL CLASSES IN THE SCHOOL-->

        <!--Checks if the user is logged in-->
        <?php
          if(isset($_SESSION['usr_id'])){
            echo "You are logged in";
          }
        ?>

        
       
          <!-- TABLE DISPLAY OF CLASSES AND CLASS TEACHER -->


  <!-- ********************************************************************************************************************************** -->
          <!-- Table Head -->
          <div class="shadow-wrapper">
          <table class="table table-hover table-sm custom-container table-cursor">
              <thead class="thead-dark">
                  <tr>
                    <th scope="col">S/N</th>
                    <th scope="col">Class</th>
                    <th scope="col">Class Teacher</th>
                    <th scope="col">No. of students</th>
                  </tr>
              </thead>
          <?php 
            $sql = "SELECT `class_id`, `class_name` FROM `classes`";
            $result = mysqli_query($conn, $sql);
            $classes = mysqli_fetch_all($result, MYSQLI_ASSOC);
         
            //$sql = "SELECT first_name, last_name, other_names FROM `employ_staff` JOIN `class_teacher` ON employ_staff.staff_id = class_teacher.teacher_id";
            //$result = mysqli_query($conn, $sql);
            //$teachers = mysqli_fetch_all($result, MYSQLI_ASSOC);
          ?>

            <?php 
            $i = 0;
            foreach($classes as $class) : 
            $i++;
            ?>

            <?php
                $sql1 = "SELECT count(`student_id`) as cnt FROM `students` WHERE `class` = '".$class['class_id']."'"; 
                $result1 = mysqli_query($conn, $sql1);
                $data = mysqli_fetch_all($result1,  MYSQLI_ASSOC);

                $sql2 = "SELECT `teacher_id` FROM `class_teacher` WHERE `class_id` = '". $class['class_id'] ."' LIMIT 1";
                $result_teacher_ID = mysqli_query($conn, $sql2);
                $teacher = mysqli_fetch_all($result_teacher_ID);
                $teacher_ID_received =0;
                foreach($teacher as $record_ID){
                  $teacher_ID_received = $record_ID[0];
                }

                if($teacher_ID_received > 0){
                  $sql3 = "SELECT TRIM(CONCAT(`last_name`, ' ', `first_name`, ' ', `other_names`)) AS `fullname` FROM `employ_staff` WHERE `staff_id` = '". $teacher_ID_received ."' LIMIT 1"; 
                  $result_teacher_name = mysqli_query($conn, $sql3);
                  $teacher_name = mysqli_fetch_all($result_teacher_name);

                  foreach($teacher_name as $teacher_record_name){
                    $teacher_name_received = $teacher_record_name[0];
                  }
                }else{
                  $teacher_name_received ="N/A";
                }
                
             ?>
          
              <!-- Table Body-->         
                  <tbody>
                    <tr>
                      <th scope=""><?php echo $i; ?></th>
                      <td><a href="view_students.php?cid='<?php echo $class["class_id"]; ?>'"><?php echo $class['class_name']; ?></a></td>
                      <td><a href="view_single_employee.php?empid=<?php echo $teacher_ID_received; ?>"><?php echo $teacher_name_received ?></a></td>
                      
                      <?php foreach($data as $datum) : ?>
                        <td><span class="badge badge-secondary"><?php echo $datum['cnt']; ?></span></td>
                      <?php endforeach; ?>
                    </tr>
                  </tbody>
              <?php endforeach; ?> 
            </table> <!-- End of Table -->
             <div>
              
           

  <!-- ********************************************************************************************************************************** -->
       
  <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="300"></canvas>  -->
    </main>
  </div>
</div>

<?php require_once "./includes/footer.php"; ?>