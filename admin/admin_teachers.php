<?php require_once "./includes/header.php"; ?>
<?php require_once "sidebar.php"; ?>


    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Teachers</h1>
        <div>
         <nav class="navbar navbar-light bg-light">
            <form class="form-inline">
              <input class="form-control mr-sm-3" type="search" placeholder="Search teacher" aria-label="Search">
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
        <table class="table table-striped table-hover table-sm custom-container">
          <thead class="thead-dark">
            <tr>
              <th scope="col">S/N</th>
              <th scope="col">NAME OF TEACHERS</th>
            </tr>
          </thead>
            <?php
              $sql = "SELECT * FROM `employ_staff`";
              $result = mysqli_query($conn, $sql);
              $teachers = mysqli_fetch_all($result, MYSQLI_ASSOC);
            ?>
          
            <?php foreach($teachers as $teacher) : ?>
              <tbody>
                <tr>
                  <th scope="row"><?php echo $teacher['staff_id']?></th>
                  <td><a href="view_single_employee.php?empid=<?php echo $teacher["staff_id"]; ?>"><?php echo $teacher['first_name']. " ". $teacher['last_name']. " ". $teacher['other_names']; ?></a></td>
                </tr>
              </tbody>
            <?php endforeach; ?>
          
        </table>

       
        <canvas class="my-4 w-100" id="myChart" width="900" height="350"></canvas> 
    </main>
  </div>
</div> <!--- End of container fluid-->

     <?php require_once "./includes/footer.php"; ?>