<?php
        ini_set('display_errors', 'On');

        $mysqli = new mysqli("alarm-tracking.turnkeymonitoring.com", "alarmtra_usr", "iW7Bw2pTnV6Vu8Cg", "alarmtra_track");

        if($mysqli->connect_errno){
                echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;}
?>
<!DOCTYPE html>
<head><link rel="stylesheet" type="text/css" href="style.css" /></head>
<body><div align='center'>
<?php

        $t_id = $_POST['tech_id'];
        $stmt = $mysqli->stmt_init();

        if($stmt->prepare("SELECT t1.id FROM `TECH_ALARM` t1 WHERE t1.date_in = (SELECT MAX(t2.date_in) FROM TECH_ALARM t2 WHERE t2.tech_id=(?))")){
                $stmt->bind_param("i", $t_id);
                $stmt->execute();
                $stmt->bind_result($table_id);
                $stmt->fetch();
                $stmt->close();
        }

        else
                echo "Table SELECT failed<br>";

                $stmt = $mysqli->stmt_init();

                if($stmt->prepare("UPDATE TECH_ALARM SET date_out=CURRENT_TIMESTAMP WHERE id=(?)")){
                        $stmt->bind_param("i", $table_id);
                        $stmt->execute();
                        $stmt->close();
                                echo "<br><br>Thank you!<br><br>";
                }

        else
                echo ("Failed to UPDATE table");

       $mysqli->close();

?>

<input type=button onClick="location.href='index.php'" value='Go Back'>

</div>
</body>
</html>
~
