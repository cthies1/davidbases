<?php
    try {
        //open the sqlite database file
        $db = new PDO('sqlite:./myDB/airport.db');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //insert the passenger (UNSAFE!)
        //order matters (look at your schema)
        $stmt = "INSERT INTO passengers VALUES
            ('$_POST[firstName]', '$_POST[lastName]', '$_POST[ssn]');";
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