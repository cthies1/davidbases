<?php
    try {
        if(null !== ('$_POST[f_name]')){
            var_dump($_POST[f_name]);
        } else { header("Location: inputForm.html"); }
        if(null !== ('$_POST[l_name]')){
            var_dump('$_POST[l_name]');
        } else { header("Location: inputForm.html"); }
        if(null !== ('$_POST[ssn]')){
            var_dump('$_POST[ssn]');
        } else { header("Location: inputForm.html"); }
        
        //open the sqlite database file
        $db = new PDO('sqlite:./myDB/airport.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //insert the passenger (UNSAFE!)
        //order matters (look at your schema)
        $stmt =$db->prepare("INSERT INTO passengers VALUES
            (:f_name, :m_name, :l_name, :ssn);");
        $stmt->bindValue(':f_name','$POST_[f_name]');
        $stmt->bindValue(':m_name','$POST_[m_name]');
        $stmt->bindValue(':l_name','$POST_[l_name]');
        $stmt->bindValue(':ssn','$POST_[ssn]');
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