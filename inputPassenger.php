<?php
    try {
        $error = 0;
        //$update = false;
        
        if(null == ($_POST['f_name']) or !ctype_alpha($_POST['f_name'])){//fname
            $error += 100;
        }
        
        if(null == ($_POST['l_name']) or !ctype_alpha($_POST['l_name'])){//lname
            $error += 20;
        }

        preg_match("/^[0-9]{3}-[0-9]{2}-[0-9]{4}$/", $_POST['ssn'], $matches);//ssn
        if (count($matches) <= 0) {
            $error += 3;
        }

        if($error > 0) {
            $str = "Location: inputForm.php?error=".$error;
            header($str);
        }
        else {
    
            //open the sqlite database file
            $db = new PDO('sqlite:./myDB/airport.db');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //insert the passenger (UNSAFE!)
            //order matters (look at your schema)
            if (isset($_POST['update'])) {
                $quer = $db->prepare("delete from passengers where ssn = :s");
                $quer->bindValue(':s',$_POST['ssn']);
                $result = $quer->execute();
            }
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