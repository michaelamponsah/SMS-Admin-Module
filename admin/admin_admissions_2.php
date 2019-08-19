
<?php require_once "./includes/header.php"; ?>
<?php require_once "sidebar.php"; ?>


      <?php if(!isset($_GET["stid"])){  ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Admissions</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>
         <h2>Student Details</h2>
         <hr>

     <!--Checks if the user is logged in-->
      <?php
          if(isset($_SESSION['usr_id'])){
            echo "You are logged in";
          }
      ?>

<div class="shadow-wrapper">
<form action="./includes/students.inc.php" method="POST" enctype="multipart/form-data" class="form-shadow">
        <div class="container custom-container">
            <h5>Personal Information</h5>
            <div class="row">

              <div class="col">
                <div class="class="form-group>
                  <label for="firstName">First name: </label>


                  <?php 
                        // ERROR MESSAGES

                        // Get full url
                        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        // Check if string exists
                        if(strpos($fullurl, "submit=firstname")==true){
                          echo "<small style='color: #ff0000; font-weight: bold;'>Check first name</small>";  
                        }
                       
                    ?>


                  <input type="text" class="form-control" id="firstName" name="firstName" required>
                </div>
              </div>

              <div class="col">
                <div class="class="form-group>
                  <label for="lastName">Last name: </label>

                  <?php 
                        // ERROR MESSAGES

                        // Get full url
                        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        // Check if string exists
                        if(strpos($fullurl, "submit=lastname")==true){
                          echo "<small style='color: #ff0000; font-weight: bold;'>Check last name</small>";  
                        }
                       
                   ?>

                  <input type="text" class="form-control" id="lastName" name="lastName" required>
                </div>
              </div>  
              <div class="col">
                <div class="class="form-group>
                  <label for="lastName">Other names: </label>


                  <?php 
                    // Get full url 
                    $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    // Check if string exists
                    if(strpos($fullurl, "submit=lastname")==true){
                      echo "<small style='color: #ff0000; font-weight: bold;'>Check other names</small>";  
                    }

                  ?>


                  <input type="text" class="form-control" id="otherNames" name="otherNames">
                </div>
              </div>    

            </div> <!--End of row-->
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="nationality">Nationality </label>
                  <select class="custom-select" name="nationality" required>
                    <option selected>Choose</option>
            
                    <?php 
                      // Query Database
                      $sql = "SELECT * FROM nationality";

                      // Get Result
                      $result = mysqli_query($conn, $sql);

                      // Get Data
                      $nationality = mysqli_fetch_all($result, MYSQLI_ASSOC);

                      // Free Result
                      //mysqli_free_result($nationality);

                    ?>
                    
                     <!-- POPULATE OPTIONS WITH DATA FROM DATABASE-->
                     <?php foreach($nationality as $nationality) : ?>
                        <option value="<?php echo $nationality['nationality_id']; ?>"><?php echo $nationality['nationality']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label for="gender">Gender: </label>
                  <select class="custom-select" name="gender" required>

                  <?php 
                      // Query Database
                      $sql = "SELECT * FROM gender";

                      // Get Result
                      $result = mysqli_query($conn, $sql);

                      // Get Data
                      $gender = mysqli_fetch_all($result, MYSQLI_ASSOC);

                      // Free Result
                      mysqli_free_result($gender);

                    ?>
                    
                    <option value="">Choose</option>
                      <!-- POPULATE OPTIONS WITH DATA FROM DATABASE-->
                      <?php foreach($gender as $gender) : ?>
                        <option value="<?php echo $gender['gender_id']; ?>"><?php echo $gender['gender']; ?></option>
                    <?php endforeach; ?>

                  </select>
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label for="dob">Date of birth: </label>
                <!--  <input type="date" class="form-control" placheholder="Choose date"> -->
                  <input placeholder="Enter Date" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" name="dob" required>
                </div>
              </div>

            </div> <!-- End of row-->
<hr>
          <h5>Contact Information</h5>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="email">Home address: </label>
                  <input type="text" class="form-control" id="hseAddress" name="hseAddress" required>
                </div>  
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="hometown">Hometown: </label>
                  <input type="text" name="hometown" class="form-control" name="hometown" required>
                </div>
              </div>
              <div class="col">
                  <div class="form-group">
                    
                  </div>  
              </div>
            </div> <!-- End of row-->
<hr>
          <h5>Others</h5>  
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="occupation">Enter Parent ID: </label>
                  <input type="text" class="form-control" name="parentID" required>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                   <label for="photoUpload">Upload photo</label>
                   <div class="input-group mb-3">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="profile" required>
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                      </div>
                    </div>
                </div>
              </div>
              <div class="col">
                  <div class="form-group">
                    <label for="class">Assign Class: </label>
                      <select class="form-control custom-select" name="class" required>
                    
                        <?php 
                          // Get Data from db
                      $sql = "SELECT * FROM classes";

                          // Query DB
                      $result = mysqli_query($conn, $sql);

                          // Get Data
                      $classes = mysqli_fetch_all($result, MYSQLI_ASSOC);

                          // Free Data
                      mysqli_free_result($classes);    
                        ?>

                        <!--POPULATE DATA INTO OPTIONS-->

                      <option value="">Choose</option>
                      <?php foreach($classes as $class) : ?>
                        <option value="<?php echo $class['class_id']; ?>"><?php echo $class['class_name']; ?></option>
                      <?php endforeach;?>

                      </select>
                  </div>
              </div>
            </div> <!--End of row-->
<hr>
            <div class="row">
              <div class="col">
                <button class="btn btn-primary"><a href="admin_admissions_1.php" class="badge-primary">Go Back</a></button>
              </div>
              <div class="col">
                <button type="submit" class="btn btn-primary float-right" name="submit">Submit</button>
              </div>
            </div> <!--End of row-->
      </div><!-- End of container-->
</form>
</div>
        <canvas class="my-4 w-100" id="myChart" width="900" height="0"></canvas> 
    </main>
  </div>
    
</div>
<?php require_once "./includes/footer.php"; ?>





      <?php   } else{  ?>


        <?php 


              // FETCH ALL DATA FROM THE DATABASE WITH THE CORRESPONDING ID
              $student = $_GET["stid"];
              $sql = "SELECT * FROM `students` WHERE `student_id`= $student";
              $result = mysqli_query($conn, $sql);
              $student_data = mysqli_fetch_array($result);

              // Fetch Nationality
              $std_nat = $student_data["nationality"];
              $sql = "SELECT * FROM `nationality` WHERE `nationality_id` = $std_nat";
              $result = mysqli_query($conn, $sql);
              $nat = mysqli_fetch_array($result);

              // Fetch Classes
              $std_class = $student_data["class"];
              $sql = "SELECT * FROM `classes` WHERE `class_id` = $std_class";
              $result = mysqli_query($conn, $sql);
              $class = mysqli_fetch_array($result);

             // Fetch Gender
            $std_gender  = $student_data["gender"];
            $sql = "SELECT * FROM `gender` WHERE `gender_id` = $std_gender";
            $result = mysqli_query($conn, $sql);
            $gen = mysqli_fetch_array($result);
              
          ?>
 <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>
         <h2>Edit Student Details</h2>
         <hr>

     <!--Checks if the user is logged in-->
      <?php
          if(isset($_SESSION['usr_id'])){
            echo "You are logged in";
          }
      ?>

        <div class="shadow-wrapper">
<form action="./includes/students.inc.php" method="POST" enctype="multipart/form-data" class="form-shadow">
        <div class="container custom-container">
            <h5>Personal Information</h5>
            <div class="row">

              <div class="col">
                <div class="class="form-group>
                  <label for="firstName">First name: </label>


                  <?php 
                        // ERROR MESSAGES

                        // Get full url
                        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        // Check if string exists
                        if(strpos($fullurl, "submit=firstname")==true){
                          echo "<small style='color: #ff0000; font-weight: bold;'>Check first name</small>";  
                        }
                       
                    ?>


                  <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $student_data["first_name"]; ?>" required>
                </div>
              </div>

              <div class="col">
                <div class="class="form-group>
                  <label for="lastName">Last name: </label>

                  <?php 
                        // ERROR MESSAGES

                        // Get full url
                        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        // Check if string exists
                        if(strpos($fullurl, "submit=lastname")==true){
                          echo "<small style='color: #ff0000; font-weight: bold;'>Check last name</small>";  
                        }
                       
                   ?>

                  <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $student_data["last_name"]; ?>" required>
                </div>
              </div>  
              <div class="col">
                <div class="class="form-group>
                  <label for="lastName">Other names: </label>


                  <?php 
                    // Get full url 
                    $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    // Check if string exists
                    if(strpos($fullurl, "submit=lastname")==true){
                      echo "<small style='color: #ff0000; font-weight: bold;'>Check other names</small>";  
                    }

                  ?>


                  <input type="text" class="form-control" id="otherNames" value="<?php echo $student_data["other_names"]; ?>" name="otherNames">
                </div>
              </div>    

            </div> <!--End of row-->
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="nationality">Nationality </label>
                  <select class="custom-select" name="nationality" required>
                    <option selected value="<?php echo $student_data["nationality"]; ?>"><?php echo $nat["nationality"]; ?></option>
            
                    <?php 
                      // Query Database
                      $sql = "SELECT * FROM nationality";

                      // Get Result
                      $result = mysqli_query($conn, $sql);

                      // Get Data
                      $nationality = mysqli_fetch_all($result, MYSQLI_ASSOC);

                      // Free Result
                      //mysqli_free_result($nationality);

                    ?>
                    
                     <!-- POPULATE OPTIONS WITH DATA FROM DATABASE-->
                     <?php foreach($nationality as $nationality) : ?>
                        <option value="<?php echo $nationality['nationality_id']; ?>"><?php echo $nationality['nationality']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label for="gender">Gender: </label>
                  <select class="custom-select" name="gender" required>

                  <?php 
                      // Query Database
                      $sql = "SELECT * FROM gender";

                      // Get Result
                      $result = mysqli_query($conn, $sql);

                      // Get Data
                      $gender = mysqli_fetch_all($result, MYSQLI_ASSOC);

                      // Free Result
                      mysqli_free_result($gender);

                    ?>
                    
                    <option value="<?php echo $student_data["gender"]; ?>"><?php echo $gen["gender"]; ?></option>
                      <!-- POPULATE OPTIONS WITH DATA FROM DATABASE-->
                      <?php foreach($gender as $gender) : ?>
                        <option value="<?php echo $gender['gender_id']; ?>"><?php echo $gender['gender']; ?></option>
                    <?php endforeach; ?>

                  </select>
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label for="dob">Date of birth: </label>
                <!--  <input type="date" class="form-control" placheholder="Choose date"> -->
                  <input placeholder="Enter Date" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" name="dob" value="<?php echo $student_data["dob"]; ?>" required>
                </div>
              </div>

            </div> <!-- End of row-->
<hr>
          <h5>Contact Information</h5>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="email">Home address: </label>
                  <input type="text" class="form-control" id="hseAddress" name="hseAddress" value="<?php echo $student_data["hse_address"]; ?>" required>
                </div>  
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="hometown">Hometown: </label>
                  <input type="text" name="hometown" class="form-control" name="hometown" value="<?php echo $student_data["home_town"]; ?>" required>
                </div>
              </div>
              <div class="col">
                  <div class="form-group">
                   
                  </div>  
              </div>
            </div> <!-- End of row-->
<hr>
          <h5>Others</h5>  
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="occupation">Enter Parent ID: </label>
                  <input type="text" class="form-control" name="parentID" value="<?php echo $student_data["parent_id"]; ?>" required>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                   <label for="photoUpload">Upload photo</label>
                   <div class="input-group mb-3">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="profile" value="<?php echo $student_data["profile_photo"]; ?>" required>
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                      </div>
                    </div>
                </div>
              </div>
              <div class="col">
                  <div class="form-group">
                    <label for="class">Assign Class: </label>
                      <select class="form-control custom-select" name="class" required>
                    
                        <?php 
                          // Get Data from db
                      $sql = "SELECT * FROM classes";

                          // Query DB
                      $result = mysqli_query($conn, $sql);

                          // Get Data
                      $classes = mysqli_fetch_all($result, MYSQLI_ASSOC);

                          // Free Data
                      mysqli_free_result($classes);    
                        ?>

                        <!--POPULATE DATA INTO OPTIONS-->

                      <option value="<?php echo $student_data["class"]; ?>"><?php echo $class["class_name"]; ?></option>
                      <?php foreach($classes as $class) : ?>
                        <option value="<?php echo $class['class_id']; ?>"><?php echo $class['class_name']; ?></option>
                      <?php endforeach;?>

                      </select>
                  </div>
              </div>
            </div> <!--End of row-->
<hr>

<input type="hidden" name="student_id" value="<?php echo $_GET["stid"]; ?>" />
            <div class="row">
              <div class="col">
              </div>
              <div class="col">
               
            
 <button type="submit" class="btn btn-primary float-right" name="update">Submit</button>
                  
                
               
              
              </div>
            </div> <!--End of row-->
      </div><!-- End of container-->
</form>
</div>
        <canvas class="my-4 w-100" id="myChart" width="900" height="0"></canvas> 
    </main>
  </div>
    
</div>
<?php require_once "./includes/footer.php"; ?>  
        
     <?php } ?>


