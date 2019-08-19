<?php 
 // Check if user clicks submit
 if(!isset($_POST["submit"])){
    header("Location: ../admin_assign_class_subject.php?submit=error");
    exit();
 } else{
    // ESTABLISH CONNECTION
    require_once "dbh.inc.php";

    // Get inputs
    $teacherName = $_POST["employeeName"];
    $className = $_POST["className"];
 

     // Form validations
     /* SINCE THIS SECTION CONTAINS ONLY TWO INPUT FIELDS WITH REQUIRED ATTRIBUTES, 
        FORM VALIDATIONS ARE NOT REQUIRED. MOREOVER, VALUES ARE FILTERED BEFORE BEIGN POPULATED INTO SELECT INPUT FIELDS
        
        IF VALIDAIONS ARE REQUIRED IN THE FUTURE, DO SO!.

     */ 
    $sql = "INSERT INTO `class_teacher`(`class_id`, `teacher_id`) VALUES ('$className','$teacherName');";
    mysqli_query($conn, $sql);
    header("Location: ../admin.php?submit=success'$teacherName'.'$className'");
    exit();
 }
  