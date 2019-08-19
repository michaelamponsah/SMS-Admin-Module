<?php require_once "./includes/header.php"; ?>

<?php 
    if(!isset($_GET["empid"])){
        echo "<h1 style='padding: 20rem; text-align: center;'> Oops something went wrong!</h1>";
        header("Location: admin_teachers.php");
        exit();
    } else{
        $employee = $_GET["empid"];

        $sql = "SELECT * FROM `employ_staff` WHERE `staff_id` = $employee";
        $result  = mysqli_query($conn, $sql);
        $emp = mysqli_fetch_array($result);

        // Fetch nationalityy
        $nationality  = $emp["nationality_id"];
        $sql = "SELECT * FROM `nationality` WHERE `nationality_id` = $nationality";
        $result = mysqli_query($conn, $sql);
        $nat = mysqli_fetch_array($result);

        // Fetch  gender
        $gender  = $emp["gender_id"];
        $sql = "SELECT * FROM `gender` WHERE `gender_id` = $gender";
        $result = mysqli_query($conn, $sql);
        $gen = mysqli_fetch_array($result);

        // Fetch Bank
        $bank  = $emp["bank_id"];
        $sql = "SELECT * FROM `banks` WHERE `bank_id` = $bank";
        $result = mysqli_query($conn, $sql);
        $emp_bank = mysqli_fetch_array($result);

        // Fetch Marital Status
        $marital_stat  = $emp["marital_status_id"];
        $sql = "SELECT * FROM `marital_status` WHERE `marital_status_id` = $marital_stat";
        $result = mysqli_query($conn, $sql);
        $marital_stat = mysqli_fetch_array($result);

        // Fetch Employee Type
        $emp_type  = $emp["employee_status"];
        $sql = "SELECT * FROM `employee_type` WHERE `employee_type_id` = $emp_type";
        $result = mysqli_query($conn, $sql);
        $emp_type = mysqli_fetch_array($result); 
        
        // Fetch Academic Qualification
        $emp_acd_qual = $emp["acd_qual_id"];
        $sql = "SELECT * FROM `academic_qualification` WHERE `acd_qual_id` = $emp_acd_qual";
        $result = mysqli_query($conn, $sql);
        $academic_qual = mysqli_fetch_array($result); 

    }
?>        

<?php require_once "sidebar.php"; ?>


<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h3>VIEW EMPLOYEE DETAILS</h3>
        <div>
         <nav class="navbar navbar-light bg-light">
             
            <form class="form-inline">
              <input class="form-control mr-sm-3" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-primary my-3 my-sm-0" type="submit">Search</button>
            </form>
          </nav>

        </div>
      </div>
        <!-- TABLE DISPLAY OF ALL CLASSES IN THE SCHOOL-->

          <div class="container custom-container small-box">
              
              <img src="./uploads/staff/<?php echo $emp["profile_photo"];?>" height="150px" width="120px" style="text-align: center;" alt="">
              <div class="edit-box">
                <h4>Actions</h4>
                <button class="btn btn-success" onclick="window.location='admin_employment.php?empid=<?php echo $emp['staff_id']; ?>'; return false;">Edit</button>
                <button class="btn btn-info">Print</button>
              </div>

            <div class="card">  
                    <div class="card-title info-title">
                    <h4 >Personal Details</h4>
                    </div>   
                       <div class="row card-body">
                            <div class="col">
                                <label class="info-label" for="">Full Name: </label>
                                    <p><?php echo $emp["first_name"] ." ".$emp["last_name"] . " ". $emp["other_names"] ; ?></p> 
                            </div>
                            <div class="col">
                                <label class="info-label" for="">Nationality: </label>
                                    <p><?php echo $nat["nationality"]; ?></p> 
                            </div>
                            <div class="col">
                                <label class="info-label" for="">Gender: </label>
                                    <p><?php echo $gen["gender"]; ?></p> 
                            </div>            
                        </div>
                        <div class="row card-body">
                            <div class="col">
                                <label class="info-label" for="">Date Of Birth: </label>
                                    <p><?php echo $emp["dob"]; ?></p> 
                        </div>
                            <div class="col"></div>
                            <div class="col"></div>
                       </div>
                    
            </div>


          <div class="card">
              <div class="card-title info-title" >
                 <h4 class="card-title">Contact Information</h4>
              </div>
        
          <div class="row card-body">
                <div class="col">
                    <label class="info-label" for="">House Address: </label>
                    <p><?php echo $emp["hse_address"]; ?></p> 
                </div>
                <div class="col">
                    <label class="info-label" for="">Email: </label>
                    <p><?php echo $emp["email"]; ?></p> 
                </div>
                <div class="col">
                   <label class="info-label" for="">Mob 1: </label>
                    <p><?php echo $emp["mob"]; ?></p> 
                </div>
                <div class="col">
                   <label class="info-label" for="">Mob 2: </label>
                    <p><?php echo $emp["tel"]; ?></p> 
                </div>
          </div>
        </div>

        <div class="card">
            <div class="card-title info-title">
                <h4 class="card-title">Bank Details</h4>
            </div>  
          <div class="row card-body">
              <div class="col">
                <label class="info-label" for="">Bank Name: </label>
                    <p><?php echo $emp_bank["bank_name"]; ?></p>
              </div>
              <div class="col">
                 <label class="info-label" for="">Account Name: </label>
                    <p><?php echo $emp["account_name"]; ?></p>
              </div>
              <div class="col">
                <label class="info-label" for="">Account Number: </label>
                    <p><?php echo $emp["account_number"]; ?></p>
              </div>
          </div>

        </div>

        <div class="card">
            <div class="card-title info-title">
                <h4 class="card-title">Others</h4>
            </div>  
          <div class="row card-body">
              <div class="col">
                <label class="info-label" for="">Marital Status: </label>
                    <p><?php echo $marital_stat["status"]; ?></p>
              </div>
              <div class="col">
                 <label class="info-label" for="">Employee Type: </label>
                    <p><?php echo $emp_type["type"]; ?></p>
              </div>
              <div class="col">
              <label class="info-label" for="">Academic Qualification: </label>
                    <p><?php echo $academic_qual["qualification"]; ?></p>
              </div>
          </div>

        </div>

        <button class="btn btn-info" style="float: right; margin-top: 5px;" onclick="window.location='admin.php'; return false;">  Exit  </button>

        <canvas class="my-4 w-100" id="myChart" width="900" height="0"></canvas> 
    </main>
  </div>
</div>
</div>

<?php include_once "./includes/footer.php"; ?>