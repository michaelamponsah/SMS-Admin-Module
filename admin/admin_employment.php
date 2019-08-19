<?php require_once "./includes/header.php"; ?>
<?php require_once "sidebar.php"; ?>



<?php if(!isset($_GET["empid"])){ ?>

  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Employments</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>

        <h2>Employee Details</h2>
      <!--Checks if the user is logged in-->
        <?php
          if(isset($_SESSION['usr_id'])){
            echo "You are logged in";
          }
         ?>
        <hr> 
  <div class="shadow-wrapper">
          <form action="./includes/employment.inc.php" method="POST" enctype="multipart/form-data">
              <div class="container custom-container">
                  <h5>Personal Information</h5>
                  <div class="row">

                    <div class="col">
                      <div class="class="form-group>
                        <label for="firstName">First name: <span class="text-danger">*</span></label>
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
                        <label for="lastName">Last name: <span class="text-danger">*</span></label>
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
                            //++++++++ ERROR MESSAGES

                            // Get full url
                            $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            // Check if string exists
                            if(strpos($fullurl, "submit=othernames")==true){
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
                        <label for="nationality">Nationality: <span class="text-danger">*</span> </label>
                        <?php 
                            // ERROR MESSAGES

                            // Get full url
                            $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            // Check if string exists
                            if(strpos($fullurl, "submit=nationality")==true){
                              echo "<small style='color: #ff0000; font-weight: bold;'>Select nationality</small>";
                            }
                        ?>
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
                        <label for="gender">Gender: <span class="text-danger">*</span></label>
                        <?php 
                            // ERROR MESSAGES

                            // Get full url
                            $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            // Check if string exists
                            if(strpos($fullurl, "submit=gender")==true){
                              echo "<small style='color: #ff0000; font-weight: bold;'>Select gender</small>";
                            }
                        ?>
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
                        <label for="mob">Mobile  number: <span class="text-danger">*</span></label>
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
                        <label for="email">Email address: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" required>
                      </div>  
                    </div>
                  </div> <!-- End of row-->
      <hr>
                <h5>Bank Details</h5>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label for="bankName">Bank name: <span class="text-danger">*</span></label>
                        <?php 
                            // ERROR MESSAGES

                            // Get full url
                            $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            // Check if string exists
                            if(strpos($fullurl, "submit=bankname")==true){
                              echo "<small style='color: #ff0000; font-weight: bold;'>Select bank name</small>";
                            }
                        ?>
                        <select class="custom-select" name="bankName" required>
                          <?php 
                            // Query Database
                            $sql = "SELECT * FROM banks";

                            // Get Result
                            $result = mysqli_query($conn, $sql);

                            // Get Data
                            $banks = mysqli_fetch_all($result, MYSQLI_ASSOC);

                            // Free Result
                            mysqli_free_result($banks);
                          ?>

                          <!-- SPIT DATA INTO OPTIONS-->
                          <option value="">Choose</option>
                          <?php foreach($banks as $bank) : ?>
                            <option value="<?php echo $bank['bank_id']; ?>"><?php echo $bank['bank_name']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>


                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="accName">Acount name: <span class="text-danger">*</span></label>
                        <?php 
                            // ERROR MESSAGES

                            // Get full url
                            $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            // Check if string exists
                            if(strpos($fullurl, "submit=accountname")==true){
                              echo "<small style='color: #ff0000; font-weight: bold;'>Check account name</small>";
                            }
                        ?>
                        <input type="text" name="accountName" class="form-control" required>
                      </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                      <label for="accNumber">Account number: <span class="text-danger">*</span></label>
                      <input type="number" name="accountNumber" class="form-control" required>
                    </div>
                    </div>  
                  </div> <!-- End of row-->
      <hr>
                <h5>Others</h5>  
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label for="academicQual">Academic qualification: <span class="text-danger">*</span></label>
                        <?php 
                            // ERROR MESSAGES

                            // Get full url
                            $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            // Check if string exists
                            if(strpos($fullurl, "submit=acdquali")==true){
                              echo "<small style='color: #ff0000; font-weight: bold;'>Select academic qualification</small>";
                            }
                        ?>
                        <select class="custom-select" name="acdQual" required>
                          <?php 
                            // Query the Database
                            $sql = "SELECT * FROM academic_qualification";

                            // Fetch Result
                            $result = mysqli_query($conn, $sql);

                            // Get Data
                            $acdQual = mysqli_fetch_all($result, MYSQLI_ASSOC);

                            // Free Result
                            mysqli_free_result($result);
                          ?>
                          <option value="">Choose</option>

                          <!-- SPIT DATA INTO OPTIONS-->
                          <?php foreach($acdQual as $qual) : ?>
                            <option value="<?php echo $qual['acd_qual_id']; ?>"><?php echo $qual['qualification']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="email">House address: <span class="text-danger">*</span></label>
                        <?php 
                            // ERROR MESSAGES

                            // Get full url
                            $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            // Check if string exists
                            if(strpos($fullurl, "submit=hseaddress")==true){
                              echo "<small style='color: #ff0000; font-weight: bold;'>Check house address</small>";
                            }
                        ?>
                        <input type="text" class="form-control" id="hseAdd" name="hseAddress" required>
                      </div class="form-group">
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="maritalStatus">Marital status: <span class="text-danger">*</span></label>
                        <?php 
                            // ERROR MESSAGES

                            // Get full url
                            $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            // Check if string exists
                            if(strpos($fullurl, "submit=maritalstatus")==true){
                              echo "<small style='color: #ff0000; font-weight: bold;'>Check marital status</small>";
                            }
                        ?>
                        
                        <select class="custom-select" name="maritalStatus" required>
                          <?php 
                                // Create Query
                                $sql = "SELECT * FROM marital_status";

                                // Get Result
                                $result = mysqli_query($conn, $sql);

                                // Fetch Data
                                $marStatus = mysqli_fetch_all($result, MYSQLI_ASSOC);

                                // Free Result
                                mysqli_free_result($result);
                            ?>
                          <option value=""> Choose </option>
                          <?php foreach($marStatus as $status) : ?>
                            <option value="<?php echo $status['marital_status_id']; ?>"><?php echo $status['status']; ?></option>
                          <?php endforeach; ?>
                        
                        </select>
                      </div> 
                    </div>
                  </div> <!--End of row-->
      <hr>
                  <div class="row">
                    <div class="col">
                      <div class="input-group mb-3">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="profile">
                            <label class="custom-file-label" for="inputGroupFile01">Choose photo </label><span class="text-danger">*</span>
                          </div>
                        </div>
                      </div>
                    <div class="col">
                       <label for="">Select Staff Type: <span class="text-danger">*</span></label>
                       <select name="staffType" id="" class="custom-select" required>

                          <?php 
                            // Fetch Data
                            $sql = "SELECT * FROM `employee_type`";
                            // Query Data
                            $result = mysqli_query($conn, $sql); 
                            // Fetch Data 
                            $emp_type = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            // Free Result
                            mysqli_free_result($result);
                          ?>
                            <option value="">Choose</option>

                            <!-- SELECT STAFF TYPE-->
                            <?php foreach($emp_type as $emp) : ?>
                            <option value="<?php echo $emp['employee_type_id']; ?>"> <?php  echo $emp['type']; ?> </option>
                            <?php endforeach; ?>

                       </select>
                    </div>  
                    <div class="col">
                      <button type="submit" class="btn btn-primary float-right" name="submit">Submit</button>
                    </div>
                  </div> <!--End of row-->
            </div><!-- End of container-->
      </form>
    </div>   <!-- End of shadow wrapper-->        

       <canvas class="my-4 w-100" id="myChart" width="900" height="50"></canvas> 
    </main>
                      
  </div>
</div>
<?php require_once "./includes/footer.php"; ?>

<?php } else{ ?>


    <?php 
      // Fetch all data from the database corresponding to the ID
      $employee = $_GET["empid"];
      $sql = "SELECT * FROM `employ_staff`";
      $result = mysqli_query($conn, $sql);
      $emp_data = mysqli_fetch_array($result);

     // Fetch Nationality
     $emp_nat = $emp_data["nationality_id"];
     $sql = "SELECT * FROM `nationality` WHERE `nationality_id` = $emp_nat";
     $result = mysqli_query($conn, $sql);
     $nat = mysqli_fetch_array($result);

      // Fetch Gender
      $emp_gender  = $emp_data["gender_id"];
      $sql = "SELECT * FROM `gender` WHERE `gender_id` = $emp_gender";
      $result = mysqli_query($conn, $sql);
      $gen = mysqli_fetch_array($result);

      // Fetch Bank
      $emp_bank  = $emp_data["bank_id"];
      $sql = "SELECT * FROM `banks` WHERE `bank_id` = $emp_bank";
      $result = mysqli_query($conn, $sql);
      $bank = mysqli_fetch_array($result);

       // Fetch Academic Qualification
       $emp_acd_qual  = $emp_data["acd_qual_id"];
       $sql = "SELECT * FROM `academic_qualification` WHERE `acd_qual_id` = $emp_acd_qual";
       $result = mysqli_query($conn, $sql);
       $qual = mysqli_fetch_array($result);

        // Fetch Marital Status
        $emp_marital_status  = $emp_data["marital_status_id"];
        $sql = "SELECT * FROM `marital_status` WHERE `marital_status_id` =  $emp_marital_status";
        $result = mysqli_query($conn, $sql);
        $mar_status = mysqli_fetch_array($result);

         // Fetch Employee Status
         $emp_type = $emp_data["employee_status"];
         $sql = "SELECT * FROM `employee_type` WHERE `employee_type_id` =  $emp_type";
         $result = mysqli_query($conn, $sql);
         $employee_type = mysqli_fetch_array($result);

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

        <h2>Edit Employee Details</h2>
      <!--Checks if the user is logged in-->
        <?php
          if(isset($_SESSION['usr_id'])){
            echo "You are logged in";
          }
         ?>
        <hr> 
  <div class="shadow-wrapper">
          <form action="./includes/employment.inc.php" method="POST" enctype="multipart/form-data">
              <div class="container custom-container">
                  <h5>Personal Information</h5>
                  <div class="row">

                    <div class="col">
                      <div class="class="form-group>
                        <label for="firstName">First name: <span class="text-danger">*</span></label>
                        <?php 
                              // ERROR MESSAGES

                              // Get full url
                              $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                              // Check if string exists
                              if(strpos($fullurl, "submit=firstname")==true){
                                echo "<small style='color: #ff0000; font-weight: bold;'>Check first name</small>";  
                              }
                            
                          ?>

                        <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $emp_data["first_name"]; ?>" required>
                      </div>
                    </div>

                    <div class="col">
                      <div class="class="form-group>
                        <label for="lastName">Last name: <span class="text-danger">*</span></label>
                        <?php 
                            // ERROR MESSAGES

                            // Get full url
                            $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            // Check if string exists
                            if(strpos($fullurl, "submit=lastname")==true){
                              echo "<small style='color: #ff0000; font-weight: bold;'>Check last name</small>";
                            }
                        ?>

                        <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $emp_data["last_name"]; ?>" required>
                      </div>
                    </div>  
                    <div class="col">
                      <div class="class="form-group>
                        <label for="lastName">Other names: </label>
                        <?php 
                            //++++++++ ERROR MESSAGES

                            // Get full url
                            $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            // Check if string exists
                            if(strpos($fullurl, "submit=othernames")==true){
                              echo "<small style='color: #ff0000; font-weight: bold;'>Check other names</small>";
                            }
                        ?>
                        <input type="text" class="form-control" id="otherNames" name="otherNames" value="<?php echo $emp_data["other_names"]; ?>">
                      </div>
                    </div>    

                  </div> <!--End of row-->
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label for="nationality">Nationality: <span class="text-danger">*</span> </label>
                        <?php 
                            // ERROR MESSAGES

                            // Get full url
                            $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            // Check if string exists
                            if(strpos($fullurl, "submit=nationality")==true){
                              echo "<small style='color: #ff0000; font-weight: bold;'>Select nationality</small>";
                            }
                        ?>
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
                          <option value="<?php echo $emp_data["nationality_id"]?>"><?php echo $nat["nationality"]?></option>
                          <?php foreach($nationality as $nationality) : ?>
                            <option value="<?php echo $nationality['nationality_id']; ?>"><?php echo $nationality['nationality']; ?></option>
                          <?php endforeach; ?>


                        </select>
                      </div>
                    </div>

                    <div class="col">
                      <div class="form-group">
                        <label for="gender">Gender: <span class="text-danger">*</span></label>
                        <?php 
                            // ERROR MESSAGES

                            // Get full url
                            $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            // Check if string exists
                            if(strpos($fullurl, "submit=gender")==true){
                              echo "<small style='color: #ff0000; font-weight: bold;'>Select gender</small>";
                            }
                        ?>
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
                          
                          <option value="<?php echo $emp_data["gender_id"] ?>"><?php echo $gen["gender"] ?></option>
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
                  <input placeholder="Enter Date" class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" id="date" name="dob" value="<?php echo $emp_data["dob"]; ?>" required>
                </div>
              </div>

                  </div> <!-- End of row-->
      <hr>
                <h5>Contact Information</h5>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label for="mob">Mobile  number: <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="mob" name="mob" value="<?php echo $emp_data["mob"]?>" required>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="tel">Telephone number: </label>
                        <input type="number" class="form-control" id="tel" name="tel" value="<?php echo $emp_data["tel"]?>">
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="email">Email address: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="email" name="email" value="<?php echo $emp_data["email"]?>" required>
                      </div>  
                    </div>
                  </div> <!-- End of row-->
      <hr>
                <h5>Bank Details</h5>
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label for="bankName">Bank name: <span class="text-danger">*</span></label>
                        <?php 
                            // ERROR MESSAGES

                            // Get full url
                            $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            // Check if string exists
                            if(strpos($fullurl, "submit=bankname")==true){
                              echo "<small style='color: #ff0000; font-weight: bold;'>Select bank name</small>";
                            }
                        ?>
                        <select class="custom-select" name="bankName" required>
                          <?php 
                            // Query Database
                            $sql = "SELECT * FROM banks";

                            // Get Result
                            $result = mysqli_query($conn, $sql);

                            // Get Data
                            $banks = mysqli_fetch_all($result, MYSQLI_ASSOC);

                            // Free Result
                            mysqli_free_result($banks);
                          ?>

                          <!-- SPIT DATA INTO OPTIONS-->
                          <option value="<?php echo $emp_data["bank_id"]; ?>"><?php echo $bank["bank_name"]; ?></option>
                          <?php foreach($banks as $bank) : ?>
                            <option value="<?php echo $bank['bank_id']; ?>"><?php echo $bank['bank_name']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>


                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="accName">Acount name: <span class="text-danger">*</span></label>
                        <?php 
                            // ERROR MESSAGES

                            // Get full url
                            $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            // Check if string exists
                            if(strpos($fullurl, "submit=accountname")==true){
                              echo "<small style='color: #ff0000; font-weight: bold;'>Check account name</small>";
                            }
                        ?>
                        <input type="text" name="accountName" class="form-control" value="<?php echo $emp_data["account_name"]?>" required>
                      </div>
                    </div>
                    <div class="col">
                    <div class="form-group">
                      <label for="accNumber">Account number: <span class="text-danger">*</span></label>
                      <input type="number" name="accountNumber" class="form-control" value="<?php echo $emp_data["account_number"]?>" required>
                    </div>
                    </div>  
                  </div> <!-- End of row-->
      <hr>
                <h5>Others</h5>  
                  <div class="row">
                    <div class="col">
                      <div class="form-group">
                        <label for="academicQual">Academic qualification: <span class="text-danger">*</span></label>
                        <?php 
                            // ERROR MESSAGES

                            // Get full url
                            $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            // Check if string exists
                            if(strpos($fullurl, "submit=acdquali")==true){
                              echo "<small style='color: #ff0000; font-weight: bold;'>Select academic qualification</small>";
                            }
                        ?>
                        <select class="custom-select" name="acdQual" required>
                          <?php 
                            // Query the Database
                            $sql = "SELECT * FROM academic_qualification";

                            // Fetch Result
                            $result = mysqli_query($conn, $sql);

                            // Get Data
                            $acdQual = mysqli_fetch_all($result, MYSQLI_ASSOC);

                            // Free Result
                            mysqli_free_result($result);
                          ?>
                          <option value="<?php echo $emp_data["acd_qual_id"]; ?>"><?php echo $qual["qualification"]; ?></option>

                          <!-- SPIT DATA INTO OPTIONS-->
                          <?php foreach($acdQual as $qual) : ?>
                            <option value="<?php echo $qual['acd_qual_id']; ?>"><?php echo $qual['qualification']; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="email">House address: <span class="text-danger">*</span></label>
                        <?php 
                            // ERROR MESSAGES

                            // Get full url
                            $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            // Check if string exists
                            if(strpos($fullurl, "submit=hseaddress")==true){
                              echo "<small style='color: #ff0000; font-weight: bold;'>Check house address</small>";
                            }
                        ?>
                        <input type="text" class="form-control" id="hseAdd" name="hseAddress" value="<?php echo $emp_data["hse_address"]?>" required>
                      </div class="form-group">
                    </div>
                    <div class="col">
                      <div class="form-group">
                        <label for="maritalStatus">Marital status: <span class="text-danger">*</span></label>
                        <?php 
                            // ERROR MESSAGES

                            // Get full url
                            $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            // Check if string exists
                            if(strpos($fullurl, "submit=maritalstatus")==true){
                              echo "<small style='color: #ff0000; font-weight: bold;'>Check marital status</small>";
                            }
                        ?>
                        
                        <select class="custom-select" name="maritalStatus" required>
                          <?php 
                                // Create Query
                                $sql = "SELECT * FROM marital_status";

                                // Get Result
                                $result = mysqli_query($conn, $sql);

                                // Fetch Data
                                $marStatus = mysqli_fetch_all($result, MYSQLI_ASSOC);

                                // Free Result
                                mysqli_free_result($result);
                            ?>
                          <option value="<?php echo $emp_data["marital_status_id"]; ?>"> <?php echo $mar_status["status"]; ?> </option>
                          <?php foreach($marStatus as $status) : ?>
                            <option value="<?php echo $status['marital_status_id']; ?>"><?php echo $status['status']; ?></option>
                          <?php endforeach; ?>
                        
                        </select>
                      </div> 
                    </div>
                  </div> <!--End of row-->
      <hr>
                  <div class="row">
                    <div class="col">
                      <div class="input-group mb-3">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="inputGroupFile01" name="profile">
                            <label class="custom-file-label" for="inputGroupFile01">Choose photo </label><span class="text-danger">*</span>
                          </div>
                        </div>
                      </div>
                    <div class="col">
                       <label for="">Select Staff Type: <span class="text-danger">*</span></label>
                       <select name="staffType" id="" class="custom-select" required>

                          <?php 
                            // Fetch Data
                            $sql = "SELECT * FROM `employee_type`";
                            // Query Data
                            $result = mysqli_query($conn, $sql); 
                            // Fetch Data 
                            $emp_type = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            // Free Result
                            mysqli_free_result($result);
                          ?>
                            <option value="<?php echo $emp_data["employee_status"]; ?> "> <?php echo $employee_type["type"]?> </option>

                            <!-- SELECT STAFF TYPE-->
                            <?php foreach($emp_type as $emp) : ?>
                            <option value="<?php echo $emp['employee_type_id']; ?>"> <?php  echo $emp['type']; ?> </option>
                            <?php endforeach; ?>

                       </select>
                    </div>  
                    <div class="col">
                      <button type="submit" class="btn btn-primary float-right" name="update">Submit</button>
                    </div>
                  </div> <!--End of row-->
            </div><!-- End of container-->
      </form>
    </div>   <!-- End of shadow wrapper-->        

       <canvas class="my-4 w-100" id="myChart" width="900" height="50"></canvas> 
    </main>
                      
  </div>
</div>
<?php require_once "./includes/footer.php"; ?>
      

<?php } ?>