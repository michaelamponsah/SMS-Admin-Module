<?php require_once "./includes/header.php"; ?>
<?php require_once "sidebar.php"; ?>

     <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
     
   <div class="shadow-wrapper"> 
 <!--Checks if the user is logged in-->
 <?php
          if(isset($_SESSION['usr_id'])){
            echo "You are logged in";
          }
  ?>
   


      <h2 style="text-align: center;">Quick Links</h2>
        <div class="row">
          <div style="color: #fff; font-weight: bold;" class="boxes col one"> <img src="./statics/images/teacher.png" alt=""><p>Teachers</p></div>
          <div style="color: #fff; font-weight: bold;" class="boxes col two" ><img src="./statics/images/student.png" alt=""><p>Students</p></div>
          <div style="color: #fff; font-weight: bold;" class="boxes col three" ><img src="./statics/images/parents.jpg" alt=""><p>Parents</p></div>
          <div style="color: #fff; font-weight: bold;" class="boxes col four" ><img src="./statics/images/finance.png" alt="" ><p>Accounts</p></div>
           
        </div>
      <canvas class="my-4 w-100" id="myChart" width="900" height="300"></canvas>
          </main>

        </div>
      </div>

</div>  <!--End of shadow-wrapper-->
 <?php include_once "./includes/footer.php"; ?>