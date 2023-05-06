
<?php
        $errors = array();
			require_once "connect.php";
			
			$db = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($db->connect_errno!=0)
	{
		echo "Error: ".$db->connect_errno;
	}
	else
	{
			ini_set('display_errors', 0);
			if(isset($_POST['submit_desc']) != "") {
				
				$reno = $_POST['reno'];
				if(empty($reno)) { array_push($errors, "Pole nie może być puste"); }
		else {
                $dateReno = date("Y-m-d");
				
			$sql = "SELECT * FROM room WHERE renoName='$reno' AND user='$_SESSION[username]'";
            $result = $db->query($sql);

            if(mysqli_num_rows($result) > 0) {
				array_push($errors, "Remont o takiej nazwie istnieje");
			  }
				else {

				$sql3 = "SELECT * FROM room WHERE isActive = 1 AND user_id = (SELECT user_id FROM users WHERE username = '$_SESSION[username]')";
                $result_active = $db->query($sql3);
               if(mysqli_num_rows($result_active) > 0) {
				array_push($errors, "Najpierw zakończ swój poprzedni remont");
			  }
			  else {
				//$sql = "INSERT INTO `malowanie` ('uzytkownik_id`,'id_malowania`, `user`, `pow_pokoju`, `ile_litrow_farby`, `rodzaj_farby`, `kolor_farby`, `cena_za_litr`, `suma`) 
				//VALUES ('', '$_SESSION[user]', '$pokoj', '$ile_litrow', '$typ', '$kolor', '$cena', '$oblicz_koszt')";
				$sql2 = "INSERT INTO room (user_id, user, renoName, dateReno, isActive)
   				 SELECT user_id, '$_SESSION[username]', '$reno','$dateReno', 1 FROM users WHERE username = '$_SESSION[username]'";
	   
$result_inst = $db->query($sql2);
header("Location: calculate.php");
//$question = "SELECT * FROM room WHERE user='$_SESSION[username]'";
//$result = $db->query($question);
			  }

				}			
				
	}
    }
	if(isset($_POST['endReno']) != "") {
		$sql = "UPDATE room SET isActive = 0 WHERE user_id = (SELECT user_id FROM users WHERE username = '$_SESSION[username]') AND isActive = 1";
		$result = $db->query($sql);
		header("Location: renovate.php");
		
	}
    $db->close();
}

		?>

		