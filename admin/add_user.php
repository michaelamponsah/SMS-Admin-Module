<?php require_once "includes/header.php"; ?>
<?php require_once "sidebar.php"; ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Register User</h1>
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

        <h2 style="text-align:center;">User Credentials</h2>
        <hr>
        <!-- FORM TO COLLECT USER DETTAILS-->


          <form action="./includes/addUser.inc.php" method="POST">
          <div class="container custom-container">


          <div class="row">
               <div class="col">
                <div class="form-group">
                </div>
              </div>
              <div class="col">
                  <!--DISPLAY OF ERROR MESSAGES-->
                <?php 
                // Get full url
                 $fullurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                 // Check if string exists
                 if(strpos($fullurl, "add_user=wrongpasswords") == true){
                  echo "<p style='color: #ff0000; font-weight: bold;'> Passwords do not match </p>";
                 } elseif(strpos($fullurl, "add_user=invalid")){
                  echo "<p style='color: #ff0000; font-weight: bold;'> Username must contain characters only </p>";
                 } elseif(strpos($fullurl, "add_user=usertaken")){
                  echo "<p style='color: #ff0000; font-weight: bold;'> Username exists </p>";
                 } elseif(strpos($fullurl, "add_user=success")){
                   echo "<p style='color: green; font-weight: bold;'> User added successfully</p>";
                 }
                ?>
              </div>
               <div class="col">
                <div class="form-group">
                </div>
              </div>
            </div> <!--End of row-->

            <div class="row">
               <div class="col">
                <div class="form-group">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="userName">Username: </label>
                  <input type="text" class="form-control" id="adminUserName" name="userName" required>
                  <div id="msg" style="color: red;"></div>
                </div>
              </div>
               <div class="col">
                <div class="form-group">
                </div>
              </div>
            </div> <!--End of row-->

            <div class="row">
               <div class="col">
                <div class="form-group">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="password">Password: </label>
                  <input type="password" class="form-control" id="pwd" name="pwd" required>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                </div>
              </div>
            </div> <!--End of row-->
            <div class="row">
               <div class="col">
                <div class="form-group">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="password">Confirm Password: </label>
                  <input type="password" class="form-control" id="conf-pwd" name="confirmPwd" required>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                </div>
              </div>
            </div> <!--End of row-->

            <div class="row">
               <div class="col">
                <div class="form-group">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="userType">User type: </label>
                      <select class="custom-select" name="userType" id="userType" required>
                        
                        <?php 
                        // Query Database
                        $sql = "SELECT * FROM `user_type` WHERE `user_type` = 'Admin'";

                        // Get Result
                        $result = mysqli_query($conn, $sql);

                        // Get Data
                        $user_type = mysqli_fetch_all($result, MYSQLI_ASSOC);

                        // Free Result
                        mysqli_free_result($user_type);
                      ?>
                      <!-- POPULATE DATA INTO OPTIONS-->
                      <option value="">Choose</option>
                      <?php foreach($user_type as $user) : ?>
                          <option value="<?php echo $user['type_id']; ?>"><?php echo $user['user_type']; ?></option>
                      <?php endforeach;?>
                    </select>
                    

                </div>
              </div>
               <div class="col">
                <div class="form-group">
                </div>
              </div>
            </div> <!--End of row-->

            <div class="row">
               <div class="col">
                <div class="form-group">
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="otherNames"> </label>
                   <button type="submit" name="submit" class="btn btn-primary container" style="margin: 0 auto;"> Create</button>
                </div>
              </div>
               <div class="col">
                <div class="form-group">
                </div>
              </div>
            </div> <!--End of row-->
          </div>
          </form>
        
       <canvas class="my-4 w-100" id="myChart" width="900" height="50"></canvas>
       
    </main>

<?php require_once "./includes/footer.php"; ?>