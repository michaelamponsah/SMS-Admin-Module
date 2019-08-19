<?php 
    // CODE TO ASSIGN CLASS | SUBJECTS TO TEACHERS
    $class = $_POST["selectClass"];
    $teacher = $_POST["selectTeacher"];
    $subject = $_POST["selectSubject"];

    // Form validations
    if(!isset($_POST["submit"])){
        header("Location: ../admin_assign_class_subject.php?submit=error");
        exit();
    } else{
        // ESTABLISH CONNECTION
        include_once "dbh.inc.php";
        
        // Check for empty fields
        if(empty($class)){
            header("Location: ../admin_assign_class_subject.php?submit=choose-at-least-a-class");
            exit();
        } elseif(empty($subject)){
            header("Location: ../admin_assign_class_subject.php?submit=choose-at-least-a-suject");
            exit();
        } else{
            // Check if there is a similar record in database
            $sql = "SELECT * FROM `assign_class_subject` WHERE `teacher_id` = '".$teacher."' AND `class_id` = '".$class."' AND `subject_id` = '".$subject."'";
            $result = mysqli_query($conn, $sql);
           $resultCheck = mysqli_num_rows($result);

            if($resultCheck > 0){
                header("Location: ../admin_assign_class_subject.php?submit=entry-taken");
                exit();
            } else{
                // Insert data into database
              $sql = "  INSERT INTO `assign_class_subject`(`teacher_id`, `class_id`, `subject_id`) VALUES ('$teacher', '$class', '$subject');";
              mysqli_query($conn, $sql);
              header("Location: Location: ../admin_assign_class_subject.php?submit=success");
              exit();
            }
        }
    }