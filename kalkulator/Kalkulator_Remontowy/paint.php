
<?php

			require_once "connect.php";

	$db = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($db->connect_errno!=0)
	{
		echo "Error: ".$db->connect_errno;
	}
	else
	{
		if(isset($_POST['delete_paint']) && $_POST['delete_paint'] != "") {
			$id_paint = $_POST['delete_paint'];
	
			$sql = "DELETE FROM paint WHERE id_paint = $id_paint AND user = '$_SESSION[username]'";
			$result = $db->query($sql);
	
			if($result) {
				?>	<div class="delete-success">  <?php echo "Usunięto pomyślnie"; ?> </div> 
			<?php
			} else {
				echo "Wystąpił błąd podczas usuwania rekordu";
			}
		}
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
       			FROM users, room WHERE username = '$_SESSION[username]' AND isActive=1";
	   
$result_inst = $db->query($sql);

$question = "SELECT * FROM paint WHERE user='$_SESSION[username]' ORDER BY id_paint DESC LIMIT 1";
$result = $db->query($question);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
	?>
     <div class="instalation-result">
		<div class="instalation-result__text" >
  <p class="box_inst"><span class="box_bold">Powierzchnia pokoju:</span>  <span class="box_info"> <?php echo $row["surf_room"] ?> m<sup>2</sup></span></p>
  <p class="box_inst"><span class="box_bold">Potrzebna ilość farby:</span>  <span class="box_info"><?php echo $row["liters"] ?> litrów</span></p>
  <p class="box_inst"><span class="box_bold">Rodzaj farby:</span>  <span class="box_info"><?php echo $row["type_paint"] ?> </span></p>
  <p class="box_inst"><span class="box_bold">Kolor:</span>  <span class="box_info"><?php echo $row["color_paint"] ?> </span></p>
  <p class="box_inst"><span class="box_bold">Cena za litr:</span>  <span class="box_info"><?php echo $row["price_for_liter"] ?> zł</span></p>
  <p class="box_inst"><span class="box_bold">Koszt malowania:</span>  <span class="box_info"><?php echo $row["addition"] ?> zł</span></p>
  </div>
	<form class ="instalation-result__form" method="POST" action="">
                    <input type="hidden" name="delete_paint" value="<?php echo $row['id_paint']; ?>">
                    <input class="result-inst__btn" type="submit" value="Usuń">
                </form>
				<button class = "next-inst__btn"><a href="calculate.php?calc=1" >Kontynuuj</a></button>
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

		