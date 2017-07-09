<?php
        ini_set('display_errors', 'On');

        $mysqli = new mysqli("alarm-tracking.turnkeymonitoring.com", "alarmtra_usr", "iW7Bw2pTnV6Vu8Cg", "alarmtra_track");

        if($mysqli->connect_errno){
                echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
        }

?>


<!DOCTYPE html>
<head>
        <title>Add New Alarm</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
        <div align="center">
                <br><form action="alarm_tracking.php" method="POST">
                <h2>Add New Alarm</h2><br>
                <br><br><label>Alarm</label><br><br>
                        <select name="alarm"><br>
                        <option disabled selected value>Select alarm</option>
                        <?php
                                if(!($stmt = $mysqli->prepare("SELECT COUNT(*) AS `Rows`,  `a_name` FROM `ALARM` GROUP BY `a_name` ORDER BY `a_name`"))){
                                        echo "Prepare failed" . $mysqli->connect_errno . " " . $mysqli->connect_error;}
                                if(!($stmt->execute())){
                                        echo "Execute failed" . $mysqli->connect_errno . " " . $mysqli->connect_error;}
                                if(!($stmt->bind_result( $a_id, $a_name))){
                                        echo "Bind failed" . $mysqli->connect_errno . " " . $mysqli->connect_error;}
                                while ($stmt->fetch()){
                                        echo "<option value='". $a_name . "'>" . $a_name . "</option>";}
                                $stmt->close();
                        ?>
                        </select>

                <br><br><label>Name</label><br><br>
                        <select name="name"><br>
                        <option disabled selected value>Select tech</option>
                        <?php
                                if(!($stmt = $mysqli->prepare("SELECT COUNT(*) AS `Rows`, `name` FROM `TECH` GROUP BY `name` ORDER BY `name`"))){
                                        echo "Prepare failed" . $mysqli->connect_errno . " " . $mysqli->connect_error;}
                                if(!($stmt->execute())){
                                        echo "Execute failed" . $mysqli->connect_errno . " " . $mysqli->connect_error;}
                                if(!($stmt->bind_result($id, $name))){
                                        echo "Bind failed" . $mysqli->connect_errno . " " . $mysqli->connect_error;}
                                while ($stmt->fetch()){
                                        echo "<option value='". $name . "'>" . $name . "</option>";}
                                $stmt->close();
                        ?>
                        </select>
                <br><br><label>Notes</label><br><br>
                        <textarea placeholder="Please copy and paste alarm name from NOC" name="notes" cols="25" rows="5"></textarea>
                        <br><br>
                                <input type="submit" name = "submit" value="Submit"/>
                        <br><br>
        </form>

</body>
</html>
