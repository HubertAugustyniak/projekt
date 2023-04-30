
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
			if(isset($_POST['room']) && isset($_POST['painter']) && isset($_POST['price']) && $_POST['room'] != "" && $_POST['painter'] != "" && $_POST['price'] != "") {
				
				$room = $_POST['room'];
				$painter = $_POST['painter'];
				$price = $_POST['price'];
				$type = $_POST['type']; // rodzaj farby wybrany z listy
$color = $_POST['color']; // kolor farby wybrany z listy

				$how_liters = $room*$painter;
				$calc_price = $room*$painter*$price;
				echo<<<END
				
				
				END;

				
				//$sql = "INSERT INTO `malowanie` ('uzytkownik_id`,'id_malowania`, `user`, `pow_pokoju`, `ile_litrow_farby`, `rodzaj_farby`, `kolor_farby`, `cena_za_litr`, `suma`) 
				//VALUES ('', '$_SESSION[user]', '$pokoj', '$ile_litrow', '$typ', '$kolor', '$cena', '$oblicz_koszt')";
				$sql = "INSERT INTO paint (room_id, user, surf_room, liters, type_paint, color_paint,price_for_liter, addition)
   				 SELECT room_id, '$_SESSION[username]', '$room','$how_liters', '$type', '$color', '$price', '$calc_price'
       			FROM users, room WHERE username = '$_SESSION[username]'";
	   
$result_inst = $db->query($sql);

$question = "SELECT * FROM paint WHERE user='$_SESSION[username]'";
$result = $db->query($question);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "Malowanie nr: " . $row["id_paint"]."<br>". " - Użytkownik: " . $row['user']."<br>". " - Powierzchnia pokoju: " . $row["surf_room"]."m<sup>2</sup>"."<br>"."- Potrzebna losc farby: " . $row["liters"]." litrów"."<br>"."- Rodzaj farby: " . $row["type_paint"]."<br>"."- Kolor: " . $row["color_paint"]."<br>"."- Cena za litr: " . $row["price_for_liter"]." zł". "<br>"."- Koszt malowania: " . $row["addition"]." zł". "<br>";
  }
} else {
  echo "0 results";
}
				
				

    }
    $db->close();
}

		?>

		