<?php
    try {
        $fNull = false;
        $lNull = false;
        $sNull = false;
        
        if(null != ($_POST['f_name']) and ctype_alpha($_POST['f_name'])){
            $fNull = true;
        } 
        
        if(null != ($_POST['l_name']) and ctype_alpha($_POST['l_name'])){
            $lNull = true;
        } 
        
        //if(null != ($_POST['ssn']) and preg_match("/[0-9]{3}+-+[0-9]{2}+-+[0-9]{4}/", $_POST['ssn']) == 1){
        if((null != ($_POST['ssn'])) and (preg_match('/^[0-9]{3}-[0-9]{2}-[0-9]{4}$/', $_POST['ssn']) == 1)){
            $sNull = true;
        }
        /*
        if($fNull) {

        }
        if($lNull) {

        }
        if($sNull) {

        }
        */
        if(!$fNull or !$lNull or !$sNull) {
            header("Location: inputForm.html");
        }
        
        
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