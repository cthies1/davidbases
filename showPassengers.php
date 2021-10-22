<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8" />
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" /> -->
        <title>Show Passengers Table</title>
        <meta name="description" content="This is a table of passengers." />
        <meta name="author" content="Chloe, Bee, Anna, Diggy" />
        <link rel="stylesheet" href="./assets/css/styles.css" />
    </head>
    <body>

        <?php
         //path to the SQLite database file
        $db_file = './myDB/airport.db';

        try {
            //open connection to the airport database file
            $db = new PDO('sqlite:' . $db_file);

            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //return all passengers, and store the result set
            $query_str = "select * from passengers;";
            $result_set = $db->query($query_str);

            echo "<table style='border:1px solid black; border-collapse: collapse;'>";
            echo "<tr style='border:1px solid black; border-collapse: collapse;'>";
                echo "<th>SSN</th><th>First Name</th><th>Middle Name</th><th>Last Name</th>";
            echo "</tr>";
            foreach($result_set as $tuple) {
                echo "<tr style='border:1px solid black; border-collapse: collapse;'>";
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
        
    </body>
</html>
        