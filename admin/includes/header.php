<?php include_once "dbh.inc.php"; ?>

<?php 
  session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Michael Amponsah">
    <title>SSMS</title>   

<link rel="stylesheet" type="text/css" href="./statics/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="./statics/custom_css/style.css">
<link rel="stylesheet" href="./assets/all.css">
<link rel="stylesheet" href="./statics/custom_css/app.cs">
<!-- <script type="text/javascript" src="./js/custom-script.js"></script> -->

  </head>
  <body>
<nav class="navbar navbar-dark fixed-top bg-info flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#"> <i class="fas fa-school"></i>  School Name</a>
  <h5 style="color: #fff;">Welcome, Admin</h5>
  <?php 
    // DISPLAY A LOGOUT BUTTON IF THE USER IS ACTUALLY LOGGED IN
    if(isset($_SESSION['usr_id'])){
    ?>
  <div class="form-group">
      <button class="btn" type="cancel" style="color: #fefefe;" onclick="window.location='../includes/logout.inc.php?logout=success';return false;"><i class="fas fa-sign-out-alt" style="font-size: 1.3rem;"></i> Logout</button>
  </div>
                  <!--<a href="../includes/logout.inc.php?logout" > LOGOUTT</a>-->
  <?php } ?>
  
</nav>