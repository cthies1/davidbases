<?php
    try {
        $fNull = true;
        $lNull = true;
        $sNull = true;
        
        if(null != ($_POST['f_name']) and ctype_alpha($_POST['f_name'])){
            $fNull = false;
        } 
        
        if(null != ($_POST['l_name']) and ctype_alpha($_POST['l_name'])){
            $lNull = false;
        } 
        preg_match("/^[0-9]{3}-[0-9]{2}-[0-9]{4}$/", $_POST['ssn'], $matches);
        if (count($matches) > 0) {
            $sNull = false;
        }
        // if(preg_match("/^[0-9]{3}-[0-9]{2}-[0-9]{4}$/", $_POST['ssn'])){
        //     $sNull = false;
        // }
            
        
        
        //preg_match("/^[0-9]{3}-[0-9]{2}-[0-9]{4}$/", $_POST['ssn'], $matches);
        //if(count($matches) > 0){
        //    $sNull = false;
        //}
        /*
        if($fNull) {

        }
        if($lNull) {

        }
        if($sNull) {

        }
        */
        if($fNull or $lNull or $sNull) {
            echo "something went wrong!";
            header("Location: inputForm.html?error=0");
        }
        else {
        
            //open the sqlite database file
            $db = new PDO('sqlite:./myDB/airport.db');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //insert the passenger (UNSAFE!)
            //order matters (look at your schema)
            $stmt =$db->prepare("INSERT INTO passengers VALUES
                (:f_name, :m_name, :l_name, :ssn);");
            $stmt->bindValue(':f_name',$_POST['f_name']);
            $stmt->bindValue(':m_name',$_POST['m_name']);
            $stmt->bindValue(':l_name',$_POST['l_name']);
            $stmt->bindValue(':ssn',$_POST['ssn']);
            $result = $stmt->execute();
            //$db->exec($stmt);
        }
        //disconnect from database
        $db = null;
    }
    catch(PDOException $e)
    {
    die('Exception : '.$e->getMessage());
    }
    //redirect user to another page
    header("Location: showPassengers.php");
?>