<?php require_once "includes/header.php"; ?>
<?php require_once "sidebar.php"; ?> 

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <button type="button" class="btn btn-sm btn-outline-secondary " id="classTeacher">
          Make class teachers
          </button>

          <button type="button" class="btn btn-sm btn-outline-secondary " id="subjectTeacher" style="display:none;">
          Assign subjects to teacher
          </button>

        </div>
      </div>

      <!--Checks if the user is logged in-->
      <?php
          if(isset($_SESSION['usr_id'])){
            echo "You are logged in";
          }
      ?>
      

    <div  id="displaySubjectForm">
<div class="shadow-wrapper">
<h2 style="text-align:center;">Assign subjects to teacher</h2>
        <hr>
<!-- FORM TO COLLECT DETTAILS-->
<form action="./includes/assignClassSubject.inc.php" method="POST">
<div class="container custom-container">
            <div class="row">
            <div class="col"></div>
            <div class="col">
            <div class="form-group">
                <label for="" class="label-style">Select Teacher: </label>
                <select class="custom-select" name="selectTeacher" id="selectTeacher" required>
                    
                <?php 
            // Query Database
            $sql = "SELECT * FROM `employ_staff` WHERE `employee_status` = 1";

            // Get Result
            $result = mysqli_query($conn, $sql);

            // Get Data
            $teachers = mysqli_fetch_all($result, MYSQLI_ASSOC);

            // Free Result
            //mysqli_free_result($teachers);
            ?>
            <!-- SPIT DATA INTO OPTIONS-->
            <option value="">Choose</option>
            <?php foreach($teachers as $teacher) : ?>
            <option value="<?php echo $teacher['staff_id']; ?>"><?php echo $teacher['first_name']." ". $teacher['last_name']." ".$teacher['other_names']; ?></option>
            <?php endforeach; ?>
                </select>
            </div>
            </div>
            <div class="col"></div>
        </div>  <!-- End of row-->    


        <div class="row">
            <div class="col"></div>
            <div class="col">
            <div class="form-group">
                <label for="">Select Class | Classes:</label>
                <select name="selectClass" id="" class="custom-select" required>
                    <option value="">Choose</option>

                    <?php
            // CLASSES ARE POPULATED AND DISPLAYED HERE

                    // Get Data from db
                $sql = "SELECT * FROM classes";

                // Query DB
            $result = mysqli_query($conn, $sql);

                // Get Data
            $classes = mysqli_fetch_all($result, MYSQLI_ASSOC);

                // Free Data
            //  mysqli_free_result($classes);    
            
            ?>

                <!-- POPULATE DATA INTO SELECTS-->
            <?php foreach($classes as $class) : ?>
                <div class="form-check">
                    <option  value="<?php echo $class['class_id']; ?>" ><?php echo $class['class_name']; ?></option>
                </div>
            <?php endforeach; ?>
            
                </select>
            </div>
            </div>
            <div class="col"></div>
        </div> <!-- End of row-->    


        <div class="row">
            <div class="col"></div>
            <div class="col">
            <div class="form-group">
            <label for=""class="label-style">Select subject: </label>
                <select name="selectSubject" id="" class="custom-select" required>
                    <option value="">Choose</option>
                    <?php
                    // SUBJECTS ARE POPULATED AND DISPLAYED HERE

                            // Get Data from db
                        $sql = "SELECT * FROM subjects";

                        // Query DB
                    $result = mysqli_query($conn, $sql);

                        // Get Data
                    $subjects = mysqli_fetch_all($result, MYSQLI_ASSOC);

                        // Free Data
                //  mysqli_free_result($subjects);    
                    
                    ?>
            <!-- POPULATE DATA INTO SELECT-->
                    <?php foreach($subjects as $subject) : ?>
                        <div class="form-check">
                            <option value="<?php echo $subject['subject_id']; ?>" ><?php echo $subject['subject_name']; ?> </option>
                        </div>
                    <?php endforeach; ?>

                </select>
            </div>                    
            </div>
            <div class="col"></div>
        </div> <!-- End of row-->   
        <div class="row">
            <div class="col"></div>
            <div class="col">
                    <button class="btn btn-primary" style="width: 100%;" name="submit" type="submit" id="assignClass">Submit</button>
            </div>
            <div class="col"></div>
        </div> <!-- End of row-->
        </div>       
</form>
    </div> <!-- End of shadow-wrapper-->  
</div>






          <!-- SECTION TO ASSIGN / MAKE CLASS TEACHERS-->
<div  id="makeClassTeacher" style="display:none;">
    <div class="shadow-wrapper"> 
          <h2 style="text-align: center;">Assign class to teachers</h2>
          <hr> <br>
        <form action="./includes/makeClassTeacher.inc.php" method="POST">
          <div class="row">
              <div class="col"></div>
              <div class="col">
              <div class="form-group">
                    <label for="">Select Teacher</label>
                    <select class="custom-select" name="employeeName" required> 
                    <option value="">Choose</option>               
                     <!--SELECT ALL TEACHING STAFF DETAILS AND POPULATE THEM INTO OPTIONS -->
                     <?php 
                            // Fetch Data
                            $sql = "SELECT * FROM `employ_staff` WHERE `employee_status` = 1";
                            // Query Data
                            $result = mysqli_query($conn, $sql);
                            // Fetch Data
                            $teachingStaff = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            // Free Result
                            mysqli_free_result($result);
                            ?>

                        <?php foreach($teachingStaff as $teacher) : ?>
                            <option value="<?php echo $teacher['staff_id']; ?>"> <?php echo $teacher['last_name'] . " ". $teacher['first_name'] . " ". $teacher['other_names'];   ?></option>
                        <?php endforeach; ?>
                    </select>
                       
                    </div>   
              </div>
              <div class="col"></div>
          </div>

          <div class="row">
              <div class="col"></div>
              <div class="col">
              <div class="form-group">
                    <label for="">Select Class:</label>
                    <select  class="custom-select" name="className" required>
                        <option value="">Choose</option>

                        <?php
                // CLASSES ARE POPULATED AND DISPLAYED HERE

                        // Get Data from db
                $sql = "SELECT * FROM classes";

                    // Query DB
                $result = mysqli_query($conn, $sql);

                    // Get Data
                $classes = mysqli_fetch_all($result, MYSQLI_ASSOC);

                    // Free Data
                //  mysqli_free_result($classes);    
                
                ?>

                    <!-- POPULATE DATA INTO SELECTS-->
                <?php foreach($classes as $class) : ?>
                    
                        <option  value="<?php echo $class['class_id']; ?>" ><?php echo $class['class_name']; ?></option>
                    
                <?php endforeach; ?>
                
                    </select>
                </div>
              </div>
              <div class="col"></div>
          </div>

          <div class="row">
              <div class="col"></div>
              <div class="col">
                 <button class="btn btn-primary" style="width: 100%;" name="submit">Submit</button>
              </div>
              <div class="col"></div>
          </div>

        </form>
    </div>  <!-- End of shadow wrapper--> 
</div>
    </main>

<?php require_once "./includes/footer.php"; ?>