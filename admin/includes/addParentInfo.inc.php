<?php 
if(!isset($_POST["submit"])){
    header("Location: ../admin_admissions_1.php");
} else{
    //  ESTABLISH A CONNECTION
    include_once "dbh.inc.php";

    // SANITIZE INPUTS 
    $firstName = mysqli_real_escape_string($conn, $_POST["firstName"]);
    $lastName = mysqli_real_escape_string($conn, $_POST["lastName"]);
    $otherNames = mysqli_real_escape_string($conn, $_POST["otherNames"]);
    $nationality = mysqli_real_escape_string($conn, $_POST["nationality"]);
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $mob  = mysqli_real_escape_string($conn, $_POST["mob"]);
    $tel = mysqli_real_escape_string($conn, $_POST["tel"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $occupation  = mysqli_real_escape_string($conn, $_POST["occupation"]);
    $hseAddress = mysqli_real_escape_string($conn, $_POST["hseAdd"]);
   /* $addDate = mysqli_real_escape_string($conn, $_POST["date"]);*/
    $pwd = "password";

    // FORM VALIDATIONS

    // SINCE THE HTML 'required' ATTRIBUTE IS INCLUDED IN THE INPUT FIELDS, FORM VALIDATIONS FOR EMPTY FIELDS ARE IGNORED


    // Check if input characters are valid
    if(!preg_match("/^[a-zA-Z]*$/", $firstName)){
        header("Location: ../admin_admissions_1.php?submit=firstname");
        exit();
    } elseif(!preg_match("/^[a-zA-Z]*$/", $lastName)){
        header("Location: ../admin_admissions_1.php?submit=lastname");
        exit();
    } elseif(!preg_match("/^[a-zA-Z]*$/", $otherNames)){
        header("Location: ../admin_admissions_1.php?submit=othernames");
        exit();
    } elseif(!preg_match("/^[a-zA-Z]*$/", $occupation)){
        header("Location: ../admin_admissions_1.php?submit=occupation");
        exit(); 
    } else{
        // Check if email is valid
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location: ../admin_admissions_1.php?submit=email");
            exit();
        } elseif($nationality == "Choose"){
            header("Location: ../admin_admissions_1.php?submit=nationality");
            exit();
        } elseif($gender == "Choose"){
            header("Locaion: ../admin_admiossions_1.php?submit=gender");
            exit();
        } else{



        /* 
            GENERATING PARENT ID  
            ID FORMAT: ST/Y001 WHERE Y IS THE YEAR eg. PT/19001, PT/19002
            */ 
        $year  = date("y");
        $sql =  "SELECT * FROM `parents` WHERE `gen_id` LIKE '%$year%'";
        $result = mysqli_query($conn,$sql);
        $resultCheck = mysqli_num_rows($result); // Get the number of rows with the requested search pattern
        $parentCount = $resultCheck + 1;
        
        function idGenerator($counter){
            $year  = date("y");
            $ptId = "PT/".$year;
        
            // Check if $counter is falls within range
            if($counter < 10){
                $ptId .= "00" . strval($counter);
            } elseif($counter >= 10 && $counter < 100){
                $ptId .= "0" . strval($counter);
            } elseif($counter > 100){
                $ptId .= strval($counter);
            }
        
            return $ptId;
        }

        // Function call statement
        $parentIdNumber = idGenerator($parentCount);

          // Insert data into the database
          $sql = "INSERT INTO parents (gen_id, first_name, last_name, other_names, nationality, gender, mob, tel, email, occupation, house_address) VALUES ('$parentIdNumber', '$firstName', '$lastName', '$otherNames', '$nationality', '$gender', '$mob', '$tel', '$email', '$occupation', '$hseAddress')" ;
          mysqli_query($conn, $sql);

         // SELECT MOST RECENT PARENT ID
         $sql = "SELECT MAX(parent_id) FROM parents";
         $result =  mysqli_query($conn, $sql);
         $row = mysqli_fetch_array($result); 
         $parent_id = $row[0]; 
         
             // SELECT USER TYPE
             // Fetch Data
         $type = 'Parent';
         $sql = "SELECT `type_id` FROM user_type WHERE `user_type`='".$type."'";

         // Get Result
         $result = mysqli_query($conn, $sql);

         // Get Array of users
         $row = mysqli_fetch_array($result);

         // Select user type position 3
         $role = $row[0];   

         // Hashing the  password
         $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

         $sql = "INSERT INTO `users`(`user_name`, `user_pwd`, `user_type`, `user_fk_id`) VALUES ('$email', '$hashedPwd', '$role', '$parent_id');";
         mysqli_query($conn, $sql);

          header("Location: ../admin.php?submit=success-'$parentIdNumber'");
          exit(); 
        }
    }
}