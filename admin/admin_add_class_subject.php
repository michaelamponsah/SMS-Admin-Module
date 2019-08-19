<?php require_once "./includes/header.php"; ?>
<?php require_once "sidebar.php"; ?>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add class / subject</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
         <!-- <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div> -->
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

        <h2 style="text-align:center;">Enter Details</h2>
        <hr>
        <!-- FORMS TO COLLECT CLASS / SUBJECT DETTAILS-->

         <div class="container custom-container">

             <!--FORM TO ADD CLASSES TO THE DATABASE -->
<div class="shadow-wrapper">            
            <form action="./includes/addClass.inc.php" method="POST">
            <div class="row">
            <div class="col">
                <div class="form-group">
                  <label for=""></label>
                </div>
              </div>
               <div class="col">
                <div class="form-group">
                    <label for="className">Class name: </label>
                    <input type="text" class="form-control" id="className" name="className" required autofocus>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for=""></label>
                </div>
              </div>
               <div class="col">
                <div class="form-group">
                    <label for=""></label>
                     <button type="submit" name="add" class="btn btn-primary container" style="margin: 0 auto;"> Add Class</button>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for=""></label>
                </div>
              </div>
            </div> <!--End of row-->
          </form>
</div>             



            <!--FORM TO ADD SUBJECTS TO THE DATABASE -->
<div class="shadow-wrapper">


            <form action="./includes/addSubject.inc.php" method="POST">
              <div class="row">
              <div class="col">
                  <div class="form-group">
                    <label for=""></label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                      <label for="subjectName">Subject name: </label>
                      <input type="text" class="form-control" id="subjectName" name="subjectName" required>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for=""></label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                      <label for=""></label>
                      <button type="submit" name="add" class="btn btn-primary container" style="margin: 0 auto;"> Add Subject</button>
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for=""></label>
                  </div>
                </div>
              </div> <!--End of row-->
            </form>
</div>            
         </div>
        
       <canvas class="my-4 w-100" id="myChart" width="900" height="100"></canvas>
    </main>

<?php include_once "./includes/footer.php"; ?>