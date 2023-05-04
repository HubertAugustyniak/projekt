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

               $_SESSION['floor'] = $_POST['floor'];
               $_SESSION['surf_material'] = $_POST['surf_material'];
               $_SESSION['price'] = $_POST['price'];
               $_SESSION['type'] = $_POST['type'];
			  
				$pcs = round($floor/$surf_material);
				$calc_price = $pcs*$price;
				
				//$sql = "INSERT INTO `instalation` (`id_instalation`, `user`, `surf_floor`, `type_material`,`pcs`, `addition`) 
				//VALUES ('', '$_SESSION[user]', '$podloga', '$typ','$ile_sztuk', '$oblicz_koszt')";
				$sql = "INSERT INTO instalation (room_id, user, surf_floor, material_type, pcs, addition)
				SELECT room_id, '$_SESSION[username]', '$floor','$type', '$pcs', '$calc_price'
			   FROM users, room WHERE username = '$_SESSION[username]' AND isActive=1";

$result_inst = $db->query($sql);

$question = "SELECT * FROM instalation WHERE user='$_SESSION[username]'";
$result = $db->query($question);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
	?>
    <div class="instalation-result">
	<?php
    echo "Instalacja nr: " . $row["id_instalation"]."<br>". " - Użytkownik: " . $row['user']."<br>"." - Potrzebujesz: " . $row['pcs']." sztuk materialu"."<br>". " - Powierzchnia podlogi: " . $row["surf_floor"]."m<sup>2</sup>"."<br>"." litrów"."<br>"."- Rodzaj materialu: " . $row["material_type"]."<br>"."- Koszt instalacji: " . $row["addition"]." zł". "<br>";
	?>
     </div>
	 <form method="POST">
				<button  class="submit-calc" >Edytuj</button>
				<button class="submit-calc" name="deleteResult" value="<?php echo $row['id_instalation']; ?>">Usuń</button>
  </form>
		
	<?php
  }
} else {
	echo "0 results";
}
if(isset($_POST['deleteResult']))
{
		 $id_instalation = $_POST['deleteResult'];
		$delete_sql = "DELETE FROM instalation WHERE id_instalation = $id_instalation AND user='$_SESSION[username]'";
		$result_delete = $db->query($delete_sql);
		header('Location: calculate.php');
}
}
    $db->close();
}

		?> 