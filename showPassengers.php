<?php
/*
    $db_file = './myDB/airport.db';
    try {
        //open connection to the airport database file
        $db = new PDO('sqlite:' . $db_file);      // <------ Line 13
        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }
    */
?>


<!DOCTYPE html>
<html>
    <head>
        <title> PASSENGERS </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-sacle=1.0">
    </head>
    <body>

        <?php
         //path to the SQLite database file
        $db_file = './myDB/airport.db';

        try {
            //open connection to the airport database file
            $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //return all passengers, and store the result set
            $query_str = "select * from passengers;";  // <----- Line 19
            $result_set = $db->query($query_str);

            //loop through each tuple in result set and print out the data
            //ssn will be shown in blue (see below)
       
            //foreach($result_set as $tuple) {          // <------ Line 24
             //   echo "<font color='blue'>$tuple[ssn]</font> $tuple[f_name] $tuple[m_name] $tuple[l_name]<br/>\n";
            //}
            echo "<table>";
            echo "<tr>";
                echo "<th>SSN</th><th>First Name</th><th>Middle Name</th><th>Last Name</th>";
            echo "</tr>";
            foreach($result_set as $tuple) {          // <------ Line 24
                echo "<tr>";
                echo "<td>$tuple[ssn]</td>";
                echo "<td>$tuple[f_name]</td>";
                echo "<td>$tuple[m_name]</td>";
                echo "<td> $tuple[l_name]</td>";
                $updatelink = "inputForm.php?ssn=".$tuple['ssn']."&f_name=".$tuple['f_name']."&m_name=".$tuple['m_name']."&l_name=".$tuple['l_name']."&update=".$tuple['ssn'];
                echo "<td><a href=$updatelink>Update</a></td>";
                echo "</tr>"; 
             } 
             echo "</table>";  

            //disconnect from db
            $db = null;
        }
        catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }
        ?>

        <!-- <table>
            <tr>
                <th>SSN</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Last Name</th>
            </tr>
            
            <tr>
             foreach($result_set as $tuple) {          // <------ Line 24
                echo "<font color='blue'>$tuple[ssn]</font> $tuple[f_name] $tuple[m_name] $tuple[l_name]<br/>\n";
                echo "<td>$tuple[ssn]</td>"
                echo "<td>$tuple[f_name]</td>"
                echo "<td>$tuple[m_name]</td>"
                echo "<td> $tuple[l_name]</td>"
                echo "<td><a href="">Update</a></td>"
             }    
            </tr>
            
        </table> -->
        
    </body>
</html>
        