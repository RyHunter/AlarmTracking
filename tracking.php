<?php
        ini_set('display_errors', 'On');

        $mysqli = new mysqli("alarm-tracking.turnkeymonitoring.com", "alarmtra_usr", "iW7Bw2pTnV6Vu8Cg", "alarmtra_track");

        if($mysqli->connect_errno){
                echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;}
?>

<!DOCTYPE html>
<html>
<head>
<title>Alarm Tracking</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<?php
        $a_name = $_POST['alarm'];
        $t_name = $_POST['name'];
        $notes = $_POST['notes'];

        date_default_timezone_set('America/New_York');
        $time= date('m/d/Y h:i:s a', time());


        //Select id of the alarm
        //Bind it to a vatiable
        //Rince and repeat with
        //Tech name and notes

        $stmt =  $mysqli->stmt_init();

        if($stmt->prepare("SELECT a_id FROM ALARM WHERE a_name=(?)")){
                $stmt->bind_param("s", $a_name);
                $stmt->execute();
                $stmt->bind_result($a_id);
                $stmt->fetch();
                $stmt->close();
        }

        else
                echo "SELECT a_id FROM ALARM failed";

        $stmt = $mysqli->stmt_init();

        if($stmt->prepare("SELECT id FROM TECH WHERE name=(?)")){
                $stmt->bind_param("s", $t_name);
                $stmt->execute();
                $stmt->bind_result($t_id);
                $stmt->fetch();
                $stmt->close();

        }
        else
                echo "SELECT id FROM TECH failed";


        //Add results to TECH_ALARM table

        $stmt = $mysqli->stmt_init();
 if($stmt->prepare("INSERT INTO `TECH_ALARM`(`alarm_id`, `tech_id`, `notes`) VALUES (?,?,?)")){
                $stmt->bind_param("iis", $a_id, $t_id, $notes);
                $stmt->execute();
                $stmt->close();
        }

        else
                echo "INSERT INTO failed";


        echo "<form action='update_time.php' method='POST'><div align='center'><h2>New alarm response documented<br><br></h2>";

        echo $time;

        echo "<br><br><br><br><input type='hidden' name='tech_id' value=$t_id></input><input type='submit' name = 'submit' value='Click here when finished'/>";

        $mysqli->close();

        ?>

        </form>
        <br><br>

        </div>

</body>
</html>
