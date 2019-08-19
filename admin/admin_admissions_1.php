<?php require_once "./includes/header.php"; ?>
<?php require_once "sidebar.php"; ?>

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
      <!--Checks if the user is logged in-->
      <?php
          if(isset($_SESSION['usr_id'])){
            echo "You are logged in";
          }
      ?>
        <h2>Parent Details</h2>
        <hr> 
      
<div class="shadow-wrapper">

 <form  action="./includes/addParentInfo.inc.php" method="POST">
        <div class="container custom-container">
            <h5>Personal Information</h5>
            <div class="row">

              <div class="col">
                <div class="class="form-group>
                  <label for="firstName">First name: </label><span class="text-danger">*</span>
                  <?php 
                        // ERROR MESSAGES

                        // Get full url
                        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        // Check if string exists
                        if(strpos($fullurl, "submit=firstname")==true){
                          echo "<small style='color: #ff0000; font-weight: bold;'>Check first name</small>";  
                        }
                       
                    ?>
                  <input type="text" class="form-control" id="studentFirstName" name="firstName" required>
                  <div class="msg" style="color: red;"></div>
                </div>
              </div>

              <div class="col">
                <div class="class="form-group>
                  <label for="lastName">Last name: </label><span class="text-danger">*</span>
                  <?php 
                        // ERROR MESSAGES

                        // Get full url
                        $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                        // Check if string exists
                        if(strpos($fullurl, "submit=lastname")==true){
                          echo "<small style='color: #ff0000; font-weight: bold;'>Check first name</small>";  
                        }
                       
                    ?>
                  <input type="text" class="form-control" id="lastName" name="lastName" required>
                </div>
              </div>  
              <div class="col">
                <div class="class="form-group>
                  <label for="lastName">Other names: </label>
                  <input type="text" class="form-control" id="otherNames" name="otherNames">
                </div>
              </div>    

            </div> <!--End of row-->
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="nationality">Nationality </label><span class="text-danger">*</span>
                  <select class="custom-select" name="nationality" required>

                    <?php 
                      // Query Database
                      $sql = "SELECT * FROM nationality";

                      // Get Result
                      $result = mysqli_query($conn, $sql);

                      // Get Data
                      $nationality = mysqli_fetch_all($result, MYSQLI_ASSOC);

                      // Free Result
                      mysqli_free_result($nationality);
                    ?>
                     <!-- SPIT DATA INTO OPTIONS-->
                     <option value="">Choose</option>
                    <?php foreach($nationality as $nationality) : ?>
                      <option value="<?php echo $nationality['nationality_id']; ?>"><?php echo $nationality['nationality']; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <div class="col">
                <div class="form-group">
                  <label for="gender">Gender: </label><span class="text-danger">*</span>
                  <select class="custom-select" name="gender" required>

                    <?php
                      // Get Data From db
                      $sql = "SELECT * FROM gender";

                      // Query Result
                      $result = mysqli_query($conn, $sql);

                      // Get result
                      $gender = mysqli_fetch_all($result, MYSQLI_ASSOC);

                      // Free Data
                      mysqli_free_result($gender);
                     ?>

                    <!-- POPULATE DATA INTO OPTIONS-->
                    <option value="">Choose</option>
                    <?php foreach($gender as $gender) : ?>
                        <option value="<?php echo $gender['gender_id']; ?>"><?php echo $gender['gender']?></option>
                    <?php endforeach; ?>

                  </select>
                </div>
              </div>

              <div class="col">
                
              </div>

            </div> <!-- End of row-->
<hr>
          <h5>Contact Information</h5>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="mob">Mobile  number: </label><span class="text-danger">*</span>
                  <input type="number" class="form-control" id="mob" name="mob" required>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="tel">Telephone number: </label>
                  <input type="number" class="form-control" id="tel" name="tel">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="email">Email address: </label>
                  <input type="email" class="form-control" id="email" name="email">
                </div>  
              </div>
            </div> <!-- End of row-->
<hr>
          <h5>Others</h5>  
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="occupation">Occupation: </label>
                  <input type="text" class="form-control" name="occupation">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="email">House address: </label><span class="text-danger">*</span>
                  <input type="text" class="form-control" id="hseAdd" name="hseAdd" required>
                </div class="form-group">
              </div>
              <div class="col">
              </div>
            </div> <!--End of row-->
<hr>
            <div class="row">
              <div class="col">
              </div>
              <div class="col">
                <button type="submit" name="submit" class="btn btn-primary float-right">Submit</button>
              </div>
            </div> <!--End of row-->
      </div><!-- End of container-->
</form> <!--End of form-->
</div>  <!--End of shadow-wrapper-->
       <canvas class="my-4 w-100" id="myChart" width="900" height="50"></canvas>
    </main>
  </div>
</div>
<?php require_once "./includes/footer.php"; ?>