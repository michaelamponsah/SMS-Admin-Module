<?php require_once "./includes/header.php"; ?>
<?php require_once "sidebar.php"; ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Parents</h1>
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

        <table class="table table-striped custom-container">
          <thead>
            <tr>
              <th scope="col">S/N</th>
              <th scope="col">NAME OF PARENTS</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">1</th>
              <td><a href="#">Mark Ottoo</a></td>
            </tr>
           
          </tbody>
        </table>

       
        <canvas class="my-4 w-100" id="myChart" width="900" height="300"></canvas>
    </main>
  </div>
</div>
   <?php require_once "./includes/footer.php"; ?>