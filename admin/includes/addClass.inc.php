<?php 
// CHECK IF THE USER ACTUALLY CLICKED THE SUBMIT BUTTON

if(!isset($_POST['add'])){
    header("Location: ../admin_add_class_subject.php");
    exit();
}else{
    // ESTABLISH A CONNECTION
    include_once "dbh.inc.php";

    // SANITIZE USER INPUTS
    $className = mysqli_real_escape_string($conn, $_POST["className"]);

     // SINCE THE 'required' ATTRIBUTE HAS BEEN ADDED TO THE INPUT FIELDS, FORM VALIDATION FOR EMPTY FIELD HAS BEEN IGNORED

     // Check if input characters are valid
    if(!preg_match("/^[a-zA-Z0-9- ]*$/", $className)){
        header("Location: ../admin_add_class_subject.php?add=invalidchar");
        exit();
    } else{
    // Check if class already exists in the database
    $sql = "SELECT * FROM classes WHERE class_name = '".$className."'";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    
    if($resultCheck > 0){
        header("Location: ../admin_add_class_subject.php?add=classexists");
        exit();
    } else{
        // Add class to the database
        $sql = "INSERT INTO classes (class_name) VALUES ('$className')";
        mysqli_query($conn, $sql);
        header("Location: ../admin_add_class_subject.php?add=success");
        exit();
    }
    }
}