<?php 
if(!isset($_POST['add'])){
    header("Location: ../admin_add_class_subject.php");
    exit();
} else{
    // ESTABLISH A CONECTION
    include_once "dbh.inc.php";

    // SANITIZE INPUTS
    $subjectName = mysqli_real_escape_string($conn, $_POST['subjectName']);
   // $subjectName = $_POST['subjectName'];
    
    // SINCE THE 'required' ATTRIBUTE HAS BEEN ADDED TO THE INPUT FIELDS, FORM VALIDATION FOR EMPTY FIELD HAS BEEN IGNORED

    // Check if input characters are valid
    if(!preg_match("/^[a-zA-Z- ]*$/", $subjectName)){
        header("Location: ../admin_add_class_subject.php?add=invalidchar");
        exit();
    }else{
        // Check if class name already exists in the database
        $sql = "SELECT * FROM subjects WHERE subject_name = '". $subjectName ."'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0){
            header("Location: ../admin_add_class_subject.php?add='$subjectName' exists");
            exit();
        } else{
            // Insert data into the database
            $sql = "INSERT INTO subjects (subject_name) VALUES ('$subjectName')";
            mysqli_query($conn, $sql);
            header("Location: ../admin_add_class_subject.php?add=success");
            exit();
        }
    }
}