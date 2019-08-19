<?php
    // FUNCTION TO CREATE IDs FOR STUDENTS, TEACHERS AND PARENTS

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