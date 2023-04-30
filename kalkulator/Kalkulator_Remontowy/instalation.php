<?php

            require('connect.php');

			$db = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($db->connect_errno!=0)
	{
		echo "Error: ".$db->connect_errno;
	}
	else
	{
			ini_set('display_errors', 0);
			if(isset($_POST['floor']) && isset($_POST['surf_material']) && isset($_POST['price']) && $_POST['floor'] != "" && $_POST['surf_material'] != "" && $_POST['price'] != "") {
				
				$floor = $_POST['floor'];
				$surf_material = $_POST['surf_material'];
				$price = $_POST['price'];
				$type = $_POST['type']; // rodzaj farby wybrany z listy


				$pcs = round($floor/$surf_material);
				$calc_price = $pcs*$price;
				echo<<<END
				
				END;
				

				
				//$sql = "INSERT INTO `instalation` (`id_instalation`, `user`, `surf_floor`, `type_material`,`pcs`, `addition`) 
				//VALUES ('', '$_SESSION[user]', '$podloga', '$typ','$ile_sztuk', '$oblicz_koszt')";
				$sql = "INSERT INTO instalation (room_id, user, surf_floor, material_type, pcs, addition)
				SELECT room_id, '$_SESSION[username]', '$floor','$type', '$pcs', '$calc_price'
			   FROM users, room WHERE username = '$_SESSION[username]'";

$result_inst = $db->query($sql);

$question = "SELECT * FROM instalation WHERE user='$_SESSION[username]'";
$result = $db->query($question);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "Instalacja nr: " . $row["id_instalation"]."<br>". " - Użytkownik: " . $row['user']."<br>"." - Potrzebujesz: " . $row['pcs']." sztuk materialu"."<br>". " - Powierzchnia podlogi: " . $row["surf_floor"]."m<sup>2</sup>"."<br>"." litrów"."<br>"."- Rodzaj materialu: " . $row["material_type"]."<br>"."- Koszt instalacji: " . $row["addition"]." zł". "<br>";
  }
} else {
  echo "0 results";
}
				
				

    }
    $db->close();
}

		?>