<?php
    if(!isset($_POST["submit"])){
        header("Location: ../admin_admissions_2.php");
        exit();
    } else{
        // ESTABLISH A CONNECTION
            include_once "dbh.inc.php";

        // Get all info about the file
        $file = $_FILES["profile"];  
        
        $fileName = $_FILES["profile"]["name"];
        $fileTmpName = $_FILES["profile"]["tmp_name"];
        $fileSize = $_FILES["profile"]["size"];
        $fileError = $_FILES["profile"]["error"];
        $fileType = $_FILES["profile"]["type"];

        // Files allowed
        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));

        // Allowed photos
        $allowed = array("jgp", "jpeg", "png");

        // Check if file extension is allowed
        if(!in_array($fileActualExt, $allowed)){
            header("Location: ../admin_admissions_2.php?submit=profile");
            exit();
        } else{

            // Check for file error
            if($fileError === 0){
                header("Location: ../admin_admissions_2?submit=error");
                exit();
            } elseif($fileSize > 1000000){
                header("Location: ../admin_admissions_2?submit=size");
                exit();
            } else{
                //Assign a new name to the file and add extension to filename
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = "../uploads/". $fileNameNew;
                
                // Function to move file from temp location to file destibation
                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location: ../admin.php?submit=success");
          
            }
        }
    }
