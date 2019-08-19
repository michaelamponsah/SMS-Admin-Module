<?php 
    // ESTABLISH CONNECTION
    include_once "dbh.inc.php";
if(!isset($_POST['submit']) || !isset($_POST['update']))
{
    header("Location: ../admin_admissions_2.php");
}
    else{
    if(isset($_POST['submit']))
    {
    // SANITIZE USER INPUTS
    $firstName = mysqli_real_escape_string($conn, $_POST["firstName"]);
    $lastName = mysqli_real_escape_string($conn, $_POST["lastName"]);
    $otherNames = mysqli_real_escape_string($conn, $_POST["otherNames"]);
    $nationality = mysqli_real_escape_string($conn, $_POST["nationality"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $hseAddress = mysqli_real_escape_string($conn, $_POST["hseAddress"]);
    $hometown = mysqli_real_escape_string($conn, $_POST["hometown"]);
    $class = mysqli_real_escape_string($conn, $_POST["class"]);
    $dob = $_POST["dob"];
    $email  = $_POST["email"];
    $profile;
    $pwd = "password";
    $parentID = "hh";
    // $studentIdNumber = 1;

    // ERROR HANDLERS

    // Check if char inputs are valid
    if(!preg_match("/^[a-zA-Z]*$/", $firstName)){
        header("Location: ../admin_admissions_2.php?submit=firstname");
        exit();
    } elseif(!preg_match("/^[a-zA-Z]*$/", $lastName)){
        header("Location: ../admin_admissions_2.php?submit=lastname");
        exit();
    } elseif(!preg_match("/^[a-zA-Z]*$/", $otherNames)){
        header("Location: ../admin_admissions_2.php?othernames");
        exit();
    }else{
        if($nationality == "Choose"){
            // Check if nationality and gender are valid
            header("Location: ../admin_admissions_2.php?submit=nationality");
            exit();
        } elseif($gender == "Choose"){
            header("Location: ../admin_admissions_2.php?submit=gender");
            exit();
        } elseif($class == "Choose"){
            header("Location: ../admin_admissions_2.php?submit=class");
            exit();
        } else{
            
            //  CODE TO UPLOAD PROFILE
            $file = $_FILES["profile"];
            $fileName = $_FILES["profile"]["name"];
            $fileTmpName = $_FILES["profile"]["tmp_name"];
            $fileSize = $_FILES["profile"]["size"];
            $fileError = $_FILES["profile"]["error"];
            $fileType = $_FILES["profile"]["type"];

            // Get file extension
            $fileExt = explode(".", $fileName);
            $fileActualExt = strtolower(end($fileExt));

            // Allowed photos
            $allowed = array('jpg', 'jpeg', 'png');

        // Check if file extension is allowed
        if(!in_array($fileActualExt, $allowed)){
            header("Location: ../admin_admissions_2.php?submit=profile");
            exit();
        } else{

            // Check for file error
            if($fileError === 1){
                header("Location: ../admin_admissions_2.php?submit=error");
                exit();
            } elseif($fileSize > 2000000){
                header("Location: ../admin_admissions_2.php?submit=size");
                exit();
            } else{
                //Assign a new name to the file and add extension to filename
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = "../uploads/students/". $fileNameNew;
                    
                // Function to move file from temp location to file destibation
                move_uploaded_file($fileTmpName, $fileDestination);


             /* 
              GENERATING STUDENT ID  
                ID FORMAT: ST/Y001 WHERE Y IS THE YEAR eg. ST/19001, ST/19002
             */ 
             $year  = date("y");
             $sql =  "SELECT * FROM `students` WHERE `gen_id` LIKE '%$year%'";
             $result = mysqli_query($conn,$sql);
             $resultCheck = mysqli_num_rows($result); // Get the number of rows with the requested search pattern
             $stdCount = $resultCheck + 1;
            
             function idGenerator($counter){
              $year  = date("y");
              $stdId = "ST/".$year;
            
              // Check if $counter is falls within range
              if($counter < 10){
                  $stdId .= "00" . strval($counter);
              } elseif($counter >= 10 && $counter < 100){
                  $stdId .= "0" . strval($counter);
              } elseif($counter > 100){
                  $stdId .= strval($counter);
              }
            
              return $stdId;
              //echo $stdId;
            }
            // Function call statement
            $studentIdNumber = idGenerator($stdCount);
            

            // Insert data into database 
            $sql = "INSERT INTO `students`(`gen_id`,`first_name`, `last_name`, `other_names`, `nationality`, `gender`, `dob`, `hse_address`, `home_town`, `class`, `profile_photo`, `parent_id`) VALUES ('$studentIdNumber','$firstName','$lastName','$otherNames','$nationality','$gender','$dob','$hseAddress','$hometown','$class' ,'$fileNameNew', '$parentID')";
            mysqli_query($conn, $sql);

                // SELECT MOST RECENT STUDENT ID
            $sql = "SELECT MAX(student_id) FROM students";
            $result =  mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result); 
            $student_id = $row[0]; 
                
            
                // SELECT USER TYPE
                // Fetch Data
            $type = 'Student';
            $sql = "SELECT `type_id` FROM user_type WHERE `user_type`='".$type."'";

            // Get Result
            $result = mysqli_query($conn, $sql);

            // Get Array of users
            $row = mysqli_fetch_array($result);

            // Select user type position 3
            $role = $row[0];   

            // Hashing the  password
            $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);


            $sql = "INSERT INTO `users`(`user_name`, `user_pwd`, `user_type`, `user_fk_id`) VALUES ('$email', '$hashedPwd', '$role', '$student_id');";
            mysqli_query($conn, $sql);
            header("Location: ../admin.php?submit=success-'$studentIdNumber'");
            exit();
                
        }

    }
 }
}
    }
    elseif(isset($_POST['update']))
            {
        // SANITIZE USER INPUTS
        $firstName = mysqli_real_escape_string($conn, $_POST["firstName"]);
        $lastName = mysqli_real_escape_string($conn, $_POST["lastName"]);
        $otherNames = mysqli_real_escape_string($conn, $_POST["otherNames"]);
        $nationality = mysqli_real_escape_string($conn, $_POST["nationality"]);
        $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
        $hseAddress = mysqli_real_escape_string($conn, $_POST["hseAddress"]);
        $hometown = mysqli_real_escape_string($conn, $_POST["hometown"]);
        $class = mysqli_real_escape_string($conn, $_POST["class"]);
        $dob = $_POST["dob"];
        $email  = $_POST["email"];
        $profile;
        $pwd = "password";
        $parentID;

// ERROR HANDLERS

// Check if char inputs are valid
if(!preg_match("/^[a-zA-Z]*$/", $firstName)){
    header("Location: ../admin_admissions_2.php?submit=firstname");
    exit();
} elseif(!preg_match("/^[a-zA-Z]*$/", $lastName)){
    header("Location: ../admin_admissions_2.php?submit=lastname");
    exit();
} elseif(!preg_match("/^[a-zA-Z]*$/", $otherNames)){
    header("Location: ../admin_admissions_2.php?othernames");
    exit();
}else{
    if($nationality == "Choose"){
        // Check if nationality and gender are valid
        header("Location: ../admin_admissions_2.php?submit=nationality");
        exit();
    } elseif($gender == "Choose"){
        header("Location: ../admin_admissions_2.php?submit=gender");
        exit();
    } elseif($class == "Choose"){
        header("Location: ../admin_admissions_2.php?submit=class");
        exit();
    } else{
        
        //  CODE TO UPLOAD PROFILE
        $file = $_FILES["profile"];
        $fileName = $_FILES["profile"]["name"];
        $fileTmpName = $_FILES["profile"]["tmp_name"];
        $fileSize = $_FILES["profile"]["size"];
        $fileError = $_FILES["profile"]["error"];
        $fileType = $_FILES["profile"]["type"];

        // Get file extension
        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));

        // Allowed photos
        $allowed = array('jpg', 'jpeg', 'png');

     // Check if file extension is allowed
     if(!in_array($fileActualExt, $allowed)){
        header("Location: ../admin_admissions_2.php?submit=profile");
        exit();
    } else{

        // Check for file error
        if($fileError === 1){
            header("Location: ../admin_admissions_2.php?submit=error");
            exit();
        } elseif($fileSize > 2000000){
            header("Location: ../admin_admissions_2.php?submit=size");
            exit();
        } else{
            //Assign a new name to the file and add extension to filename
            $fileNameNew = uniqid('', true).".".$fileActualExt;
            $fileDestination = "../uploads/students/". $fileNameNew;
                 
            // Function to move file from temp location to file destibation
            move_uploaded_file($fileTmpName, $fileDestination);


             /* 
              GENERATING STUDENT ID  
                ID FORMAT: ST/Y001 WHERE Y IS THE YEAR eg. ST/19001, ST/19002
             */ 
             $year  = date("y");
             $sql =  "SELECT * FROM `students` WHERE `gen_id` LIKE '%$year%'";
             $result = mysqli_query($conn,$sql);
             $resultCheck = mysqli_num_rows($result); // Get the number of rows with the requested search pattern
             $stdCount = $resultCheck + 1;
            
             function idGenerator($counter){
              $year  = date("y");
              $stdId = "ST/".$year;
            
              // Check if $counter is falls within range
              if($counter < 10){
                  $stdId .= "00" . strval($counter);
              } elseif($counter >= 10 && $counter < 100){
                  $stdId .= "0" . strval($counter);
              } elseif($counter > 100){
                  $stdId .= strval($counter);
              }
            
              return $stdId;
              //echo $stdId;
            }
            // Function call statement
            $studentIdNumber = idGenerator($stdCount);
            

            // Insert data into database 
            $sql = "UPDATE `students` SET `first_name`= '$firstName', `last_name`='$lastName', `other_names`='$otherNames', `nationality`='$nationality', `gender`='$gender', `dob`='$dob', `hse_address`='$hseAddress',
            
            `home_town`='$hometown', `class`='$class', `profile_photo`='$fileNameNew', `parent_id`='$parentID' WHERE student_id = '".$_POST['student_id']."'";

            mysqli_query($conn, $sql);

            mysqli_query($conn, $sql);
            header("Location: ../admin.php?update=success-'$studentIdNumber'");
            exit();
                
        }

    }
 }
}
    }
}
    
