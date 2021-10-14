<?php
    try {
        if(null == ($_POST['f_name'])){
            header("Location: inputForm.html");
        } else if(null == ($_POST['l_name'])){
            header("Location: inputForm.html");
        } else if(null == ($_POST['ssn'])){
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