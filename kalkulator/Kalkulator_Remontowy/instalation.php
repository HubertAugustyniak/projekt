<?php

require('connect.php');

			$db = @new mysqli($host, $db_user, $db_password, $db_name);
	if ($db->connect_errno!=0)
	{
		echo "Error: ".$db->connect_errno;
	}
	else
	{
		if(isset($_POST['delete_inst']) && $_POST['delete_inst'] != "") {
			$id_instalation = $_POST['delete_inst'];
	
			$sql = "DELETE FROM instalation WHERE id_instalation = $id_instalation AND user = '$_SESSION[username]'";
			$result = $db->query($sql);
	
			if($result) {
			?>	<div class="delete-success">  <?php echo "Usunięto pomyślnie"; ?> </div> 
			<?php
			} else {
				echo "Wystąpił błąd podczas usuwania rekordu";
			}
		}

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

$question = "SELECT * FROM instalation WHERE user='$_SESSION[username]' ORDER BY id_instalation DESC LIMIT 1";
$result = $db->query($question);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
	?>
    <div class="instalation-result">
	<div class="instalation-result__text" >
  <p class="box_inst"><span class="box_bold">Powierzchnia podłogi:</span>  <span class="box_info"> <?php echo $row["surf_floor"] ?> m<sup>2</sup></span></p>
  <p class="box_inst"><span class="box_bold">Potrzebna ilość materiału:</span>  <span class="box_info"><?php echo $row["pcs"] ?> sztuk</span></p>
  <p class="box_inst"><span class="box_bold">Rodzaj materiału:</span>  <span class="box_info"><?php echo $row["material_type"] ?> </span></p>
  <p class="box_inst"><span class="box_bold">Koszt instalacji:</span>  <span class="box_info"><?php echo $row["addition"] ?> zł</span></p>
  </div>
	
	<form class ="instalation-result__form" method="POST" action="">
                    <input type="hidden" name="delete_inst" value="<?php echo $row['id_instalation']; ?>">
                    <input class="result-inst__btn" type="submit" value="Usuń">
                </form>
  <button class = "next-inst__btn"><a  href="calculate.php?calc=2" >Kontynuuj</a> </button> 
     </div>
	<?php
  }
} else {
	echo "0 results";
}

}
    $db->close();
}

		?> 