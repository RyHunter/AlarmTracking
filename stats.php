<?php
        ini_set('display_errors', 'On');

        $mysqli = new mysqli("alarm-tracking.turnkeymonitoring.com", "alarmtra_usr", "iW7Bw2pTnV6Vu8Cg", "alarmtra_track");

        if($mysqli->connect_errno){
                echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }

?>


<head>
<title>Alarm Details</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<style type="text/css">

table.stats{
        padding: 10px;
        border: 1px solid black;
        border-collapse: collapse;
        color: white;
        text-align: center;
        font-family: "Times New Roman", Georgia, serif;
        font-size: 14px;
        line-height: 18px;
}

table.stats th{
        padding: 13px;
        border: 1px solid black;

}

table.stats td{
        padding: 13px;
        border: 1px solid black;
}

table.stats tr:nth-child(even){
        background-color: #303030;
}

</style>
</head>


<body>


<br>
<br>
<input  type=button onClick="location.href='index.php'" value='HOME'>
<br>
<br>

<div>

<?php
        $stmt = $mysqli->stmt_init();
if($stmt->prepare("SELECT `name`, `a_name`, `date_in`, `date_out`, `notes` FROM `TECH` INNER JOIN `TECH_ALARM` on `TECH`.`id` = `TECH_ALARM`.`tech_id` INNER JOIN `ALARM` ON `TECH_ALARM`.`alarm_id` = `ALARM`.`a_id` ORDER BY `TECH_ALARM`.`date_in` DESC LIMIT 0, 100")){
                $stmt->execute();
                $stmt->bind_result($name, $alarm_name, $date_in, $date_out, $notes);

                echo "<table class='stats'><tr><th>NAME</th><th>ALARM</th><th>START</th><th>END</th><th>DURATION</th><th>NOTES</th></tr>";
                
                while ($stmt->fetch()){
                        $time = ((abs(strtotime($date_out)-strtotime($date_in)))/60);
                        $time=round($time, 3);
                        echo "<tr><td>" . $name . "</td><td> " . $alarm_name . "</td><td> " . $date_in . "</td><td> " . $date_out . "</td><td>" . $time . " min</td><td>" . $notes . "</td></tr><br>";
                }

                $stmt->close();
        }

        else
                echo "SELECT failed";
?>

</table>
</div>
</body>
</html>
