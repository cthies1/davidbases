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

        <h1>Passenger Table</h1>

        <?php
        if(isset($_GET["success"])) echo "<font color='blue'>Success! </br>";

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
                echo "<th style='border:1px solid black; border-collapse: collapse;'>SSN</th>";
                echo "<th style='border:1px solid black; border-collapse: collapse;'>First Name</th>";
                echo "<th style='border:1px solid black; border-collapse: collapse;'>Middle Name</th>";
                echo "<th style='border:1px solid black; border-collapse: collapse;'>Last Name</th>";
            echo "</tr>";
            foreach($result_set as $tuple) {
                echo "<tr style='border:1px solid black; border-collapse: collapse;'>";
                echo "<td style='border:1px solid black; border-collapse: collapse;'>$tuple[ssn]</td>";
                echo "<td style='border:1px solid black; border-collapse: collapse;'>$tuple[f_name]</td>";
                echo "<td style='border:1px solid black; border-collapse: collapse;'>$tuple[m_name]</td>";
                echo "<td style='border:1px solid black; border-collapse: collapse;'> $tuple[l_name]</td>";
                $updatelink = "inputForm.php?ssn=".$tuple['ssn']."&f_name=".$tuple['f_name']."&m_name=".$tuple['m_name']."&l_name=".$tuple['l_name']."&update=".$tuple['ssn'];
                echo "<td style='border:1px solid black; border-collapse: collapse;'><a href=$updatelink>Update</a></td>";
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
        