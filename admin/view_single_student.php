<?php require_once "./includes/header.php"; ?>

<?php 
    if(!isset($_GET["stid"])){
        echo "<h1 style='padding: 20rem; text-align: center;'> Oops something went wrong!</h1>";
        header("Location: admin_students.php");
        exit();
    } else{
        $single_student = $_GET["stid"];

        $sql = "SELECT * FROM `students` WHERE `student_id` = $single_student";
        $result  = mysqli_query($conn, $sql);
        $student = mysqli_fetch_array($result);

            // Fetch nationality
        $nationality  = $student["nationality"];
        $sql = "SELECT * FROM `nationality` WHERE `nationality_id` = $nationality";
        $result = mysqli_query($conn, $sql);
        $nat = mysqli_fetch_array($result);

        // Fetch  gender
        $gender  = $student["gender"];
        $sql = "SELECT * FROM `gender` WHERE `gender_id` = $gender";
        $result = mysqli_query($conn, $sql);
        $gen = mysqli_fetch_array($result);

    }
?>

<?php require_once "sidebar.php"; ?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h3></h3>
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

          <div class="container custom-container small-box">
              
              <img src="./uploads/students/<?php echo $student["profile_photo"];?>" height="150px" width="120px" style="text-align: center;" alt="">
              <div class="edit-box">
                <h4>Actions</h4>
                <button class="btn btn-success" onclick="window.location='admin_admissions_2.php?stid=<?php echo $student['student_id']; ?>'; return false;">Edit</button>
                <button class="btn btn-info">Print</button>
              </div>

            <div class="card">  
                    <div class="card-title info-title">
                    <h4 >Personal Details</h4>
                    </div>   
                       <div class="row card-body">
                            <div class="col">
                                <label class="info-label" for="">Full Name: </label>
                                    <p><?php echo $student["first_name"] ." ".$student["last_name"] . " ". $student["other_names"] ; ?></p> 
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
                                    <p><?php echo $student["dob"]; ?></p> 
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
                    <p><?php echo $student["hse_address"]; ?></p> 
                </div>
                <div class="col">
                    <label class="info-label" for="">Home Town: </label>
                    <p><?php echo $student["home_town"]; ?></p> 
                </div>
                <div class="col">
                   
                </div>
          </div>
        </div>

        <div class="card">
            <div class="card-title info-title">
                <h4 class="card-title">Others</h4>
            </div>  
          <div class="row card-body">
              <div class="col">
                  <label for="" class="info-label">Parent ID</label>
                  <p><?php echo $student["parent_id"]; ?></p>
              </div>
          </div>
        </div>
 
        <canvas class="my-4 w-100" id="myChart" width="900" height="50"></canvas> 
    </main>
  </div>
</div>

<?php include_once "./includes/footer.php"; ?>