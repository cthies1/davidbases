<?php
    try {
        $error = 0;
        $str = "Location: inputForm.html?error=";
        $fNull = true;
        $lNull = true;
        $sNull = true;
        
        if(null != ($_POST['f_name']) and ctype_alpha($_POST['f_name'])){
            $fNull = false;
        } else {
            $error += 100;
        }
        
        if(null != ($_POST['l_name']) and ctype_alpha($_POST['l_name'])){
            $lNull = false;
        } else {
            $error += 10;
        }

        preg_match("/^[0-9]{3}-[0-9]{2}-[0-9]{4}$/", $_POST['ssn'], $matches);
        if (count($matches) > 0) {
            $sNull = false;
        } else {
            $error += 1;
        }

        //if($fNull or $lNull or $sNull) {
        if($error > 0) {
            $str .= $error;
            header($str);
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

            //redirect user to another page
            header("Location: showPassengers.php");
        }
        //disconnect from database
        $db = null;
    }
    catch(PDOException $e)
    {
        die('Exception : '.$e->getMessage());
    }

?>