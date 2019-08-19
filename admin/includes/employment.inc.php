<?php 



    if(!isset($_POST["submit"]) || !isset($_POST["update"])){
        header("Location: ../admin_employment.php?submit=error");
        exit();
    } else{
        if(isset($_POST["submit"])){
 // ESTABLISH A CONNECTION
 require_once "./dbh.inc.php";

 // SANITIZE USER INPUTS
// SANITIZE USER INPUTS
$firstName = mysqli_real_escape_string($conn, $_POST["firstName"]);
$lastName = mysqli_real_escape_string($conn, $_POST["lastName"]);
$otherNames = mysqli_real_escape_string($conn, $_POST["otherNames"]);
$email = mysqli_real_escape_string($conn, $_POST["email"]);
$accountName = mysqli_real_escape_string($conn, $_POST["accountName"]);
$hseAddress = mysqli_real_escape_string($conn, $_POST["hseAddress"]);
$accountNumber = mysqli_real_escape_string($conn, $_POST["accountNumber"]);

$bankName = $_POST["bankName"];
$acdQual = $_POST["acdQual"];
$maritalStatus = $_POST["maritalStatus"];
$nationality = $_POST["nationality"];
$gender = $_POST["gender"];
$mob = $_POST["mob"];
$tel = $_POST["tel"];
$staffType = $_POST["staffType"];
$pwd = "password";

// FORM VALIDATIONS
 // Check for input chars
 if(!preg_match("/^[a-zA-Z]*$/", $firstName)){
     header("Location: ../admin_employment.php?submit=firstname");
     exit();
 } elseif(!preg_match("/^[a-zA-Z]*$/", $lastName)){
     header("Location: ../admin_employment.php?submit=lastname");
     exit();
 } elseif(!preg_match("/^[a-zA-Z]*$/", $otherNames)){
     header("Location: ../admin_employment.php?submit=othernames");
     exit();
 }  elseif(!preg_match("/^[a-zA-Z-]+\s[a-zA-Z]*$/", $accountName)){
     header("Location: ../admin_employment.php?submit=accountname");
     exit();
 }  elseif(!preg_match("/^[a-zA-Z0-9- ]*$/", $hseAddress)){
     header("Location: ../admin_employment.php?submit=hseaddress");
     exit();
 }   else{
     // Validate email
     if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
         header("Location: ../admin_employment.php?submit=email");
         exit();
     }else{
         
         //  FILE INSERTION
        $file =  $_FILES["profile"];
        $fileName = $_FILES["profile"]["name"];
        $fileTmpName = $_FILES["profile"]["tmp_name"];
        $fileSize = $_FILES["profile"]["size"];
        $fileError = $_FILES["profile"]["error"];
        $fileType = $_FILES["profile"]["type"];

        // Get file extension
        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));
        // Allowed extensions
        $allowedExt = array('jpg', 'jpeg', 'png');

        // Check if extension exist
        if(!in_array($fileActualExt, $allowedExt)){
         header("Location: ../admin_employment.php?=profile");
         exit();
        } else{
            // Check for file errorS
            if($fileError === 1){
             header("Location: ../admin_employment.php?=error");
             exit();
            } elseif($fileSize > 2000000){
             header("Location: ../admin_employment.php?=size");
             exit();
            } else{
                // Assign new name to the file
                $fileNewName = uniqid('', true).".".$fileActualExt;
                $fileDestination = "../uploads/staff/". $fileNewName;

                // Function to move file from temp location to file destination
              move_uploaded_file($fileTmpName, $fileDestination);



               /* 
     GENERATING STAFF ID  
     ID FORMAT: EM/Y001 WHERE Y IS THE YEAR eg. EM/19001, EM/19002
     */ 
     $year  = date("y");
     $sql =  "SELECT * FROM `employ_staff` WHERE `gen_id` LIKE '%$year%'";
     $result = mysqli_query($conn,$sql);
     $resultCheck = mysqli_num_rows($result); // Get the number of rows with the requested search pattern
     $empCount = $resultCheck + 1;
     
     function idGenerator($counter){
         $year  = date("y");
         $empId = "EM/".$year;
     
         // Check if $counter is falls within range
         if($counter < 10){
             $empId .= "00" . strval($counter);
         } elseif($counter >= 10 && $counter < 100){
             $empId .= "0" . strval($counter);
         } elseif($counter > 100){
             $empId .= strval($counter);
         }
     
         return $empId;
     }

     // Function call statement
     $employeeIdNumber = idGenerator($parentCount);

                     //  INSERT DATA INTO DATABASE
         $sql = "INSERT INTO `employ_staff`(`gen_id`, `first_name`, `last_name`, `other_names`, `nationality_id`, `gender_id`, `mob`, `tel`, `email`, `bank_id`, `account_name`, `account_number`, `acd_qual_id`, `hse_address`, `marital_status_id`, `profile_photo`, `employee_status`) VALUES ('$employeeIdNumber', '$firstName', '$lastName', '$otherNames', '$nationality', '$gender', '$mob', '$tel', '$email', '$bankName', '$accountName', '$accountNumber', '$acdQual', '$hseAddress', '$maritalStatus', '$fileNewName', '$staffType');";
         mysqli_query($conn, $sql);

         
             // SELECT MOST RECENT STAFF ID
             $sql = "SELECT MAX(staff_id) FROM employ_staff";
             $result =  mysqli_query($conn, $sql);
             $row = mysqli_fetch_array($result); 
             $staff_id = $row[0]; 
             
                 // SELECT USER TYPE
                 // Fetch Data
             $type = 'Teacher';
             $sql = "SELECT `type_id` FROM user_type WHERE `user_type`='".$type."'";

             // Get Result
             $result = mysqli_query($conn, $sql);

             // Get Array of users
             $row = mysqli_fetch_array($result);

             // Select user type position 3
             $role = $row[0];   

             // Hashing the  password
             $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);


             $sql = "INSERT INTO `users`(`user_name`, `user_pwd`, `user_type`, `user_fk_id`) VALUES ('$email', '$hashedPwd', '$role', '$staff_id');";
             mysqli_query($conn, $sql);

         header("Location: ../admin.php?submit=success");
         exit();   

            }
        }
        
     }

  }
        }
        elseif(isset($_POST["update"])){
             // ESTABLISH A CONNECTION
 require_once "./dbh.inc.php";

 // SANITIZE USER INPUTS
// SANITIZE USER INPUTS
$firstName = mysqli_real_escape_string($conn, $_POST["firstName"]);
$lastName = mysqli_real_escape_string($conn, $_POST["lastName"]);
$otherNames = mysqli_real_escape_string($conn, $_POST["otherNames"]);
$email = mysqli_real_escape_string($conn, $_POST["email"]);
$accountName = mysqli_real_escape_string($conn, $_POST["accountName"]);
$hseAddress = mysqli_real_escape_string($conn, $_POST["hseAddress"]);
$accountNumber = mysqli_real_escape_string($conn, $_POST["accountNumber"]);

$bankName = $_POST["bankName"];
$acdQual = $_POST["acdQual"];
$maritalStatus = $_POST["maritalStatus"];
$nationality = $_POST["nationality"];
$gender = $_POST["gender"];
$mob = $_POST["mob"];
$tel = $_POST["tel"];
$staffType = $_POST["staffType"];
$pwd = "password";

// FORM VALIDATIONS
 // Check for input chars
 if(!preg_match("/^[a-zA-Z]*$/", $firstName)){
     header("Location: ../admin_employment.php?submit=firstname");
     exit();
 } elseif(!preg_match("/^[a-zA-Z]*$/", $lastName)){
     header("Location: ../admin_employment.php?submit=lastname");
     exit();
 } elseif(!preg_match("/^[a-zA-Z]*$/", $otherNames)){
     header("Location: ../admin_employment.php?submit=othernames");
     exit();
 }  elseif(!preg_match("/^[a-zA-Z-]+\s[a-zA-Z]*$/", $accountName)){
     header("Location: ../admin_employment.php?submit=accountname");
     exit();
 }  elseif(!preg_match("/^[a-zA-Z0-9- ]*$/", $hseAddress)){
     header("Location: ../admin_employment.php?submit=hseaddress");
     exit();
 }   else{
     // Validate email
     if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
         header("Location: ../admin_employment.php?submit=email");
         exit();
     }else{
         
         //  FILE INSERTION
        $file =  $_FILES["profile"];
        $fileName = $_FILES["profile"]["name"];
        $fileTmpName = $_FILES["profile"]["tmp_name"];
        $fileSize = $_FILES["profile"]["size"];
        $fileError = $_FILES["profile"]["error"];
        $fileType = $_FILES["profile"]["type"];

        // Get file extension
        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));
        // Allowed extensions
        $allowedExt = array('jpg', 'jpeg', 'png');

        // Check if extension exist
        if(!in_array($fileActualExt, $allowedExt)){
         header("Location: ../admin_employment.php?=profile");
         exit();
        } else{
            // Check for file errorS
            if($fileError === 1){
             header("Location: ../admin_employment.php?=error");
             exit();
            } elseif($fileSize > 2000000){
             header("Location: ../admin_employment.php?=size");
             exit();
            } else{
                // Assign new name to the file
                $fileNewName = uniqid('', true).".".$fileActualExt;
                $fileDestination = "../uploads/staff/". $fileNewName;

                // Function to move file from temp location to file destination
              move_uploaded_file($fileTmpName, $fileDestination);



               /* 
     GENERATING STAFF ID  
     ID FORMAT: EM/Y001 WHERE Y IS THE YEAR eg. EM/19001, EM/19002
     */ 
     $year  = date("y");
     $sql =  "SELECT * FROM `employ_staff` WHERE `gen_id` LIKE '%$year%'";
     $result = mysqli_query($conn,$sql);
     $resultCheck = mysqli_num_rows($result); // Get the number of rows with the requested search pattern
     $empCount = $resultCheck + 1;
     
     function idGenerator($counter){
         $year  = date("y");
         $empId = "EM/".$year;
     
         // Check if $counter is falls within range
         if($counter < 10){
             $empId .= "00" . strval($counter);
         } elseif($counter >= 10 && $counter < 100){
             $empId .= "0" . strval($counter);
         } elseif($counter > 100){
             $empId .= strval($counter);
         }
     
         return $empId;
     }

     // Function call statement
     $employeeIdNumber = idGenerator($parentCount);

                     //  INSERT DATA INTO DATABASE
         $sql = "UPDATE `employ_staff` SET `first_name`='$firstName', `last_name`='$lastName', `other_names`='$otherNames', `nationality_id`='$nationality', 
         
         `gender_id`='$gender', `mob`='$mob', `tel`='$tel', `email`='$email', `bank_id`='$bankName', `account_name`='$accountName', `account_number`='$accountNumber', 
         
         `acd_qual_id`='$acdQual', `hse_address`='$hseAddress', `marital_status_id`='$maritalStatus', `profile_photo`='$fileNewName', `employee_status`='$staffType' WHERE staff_id = '".$_POST["staff_id"]."' ";
         
         mysqli_query($conn, $sql);

         header("Location: ../admin.php?submit=success");
         exit();   

            }
        }
        
     }

  }

        }
       
    }