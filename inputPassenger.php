<?php
    try {
        //open the sqlite database file
        $db = new PDO('sqlite:./myDB/airport.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //insert the passenger (UNSAFE!)
        //order matters (look at your schema)
        $stmt = "INSERT INTO passengers VALUES
            ('$_POST[f_name]', '$_POST[m_name]', '$_POST[l_name]', '$_POST[ssn]');";
        $db->exec($stmt);
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