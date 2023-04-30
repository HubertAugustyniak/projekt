
<?php

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
                $dateReno = date("Y-m-d");
				echo<<<END
				
				END;

				
				//$sql = "INSERT INTO `malowanie` ('uzytkownik_id`,'id_malowania`, `user`, `pow_pokoju`, `ile_litrow_farby`, `rodzaj_farby`, `kolor_farby`, `cena_za_litr`, `suma`) 
				//VALUES ('', '$_SESSION[user]', '$pokoj', '$ile_litrow', '$typ', '$kolor', '$cena', '$oblicz_koszt')";
				$sql = "INSERT INTO room (user_id, user, renoName, dateReno)
   				 SELECT user_id, '$_SESSION[username]', '$reno','$dateReno' FROM users WHERE username = '$_SESSION[username]'";
	   
$result_inst = $db->query($sql);

$question = "SELECT * FROM room WHERE user='$_SESSION[username]'";
$result = $db->query($question);

				
				

    }
    $db->close();
}

		?>

		