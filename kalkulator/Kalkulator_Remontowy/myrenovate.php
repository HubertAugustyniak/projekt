<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "Musisz się zalogować";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");

  }
  include('renoScript.php'); 
?>
<!DOCTYPE HTML>
<html lang="pl">

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kalkulator remontowy</title>

	<meta name="description" content="Kalkulator remontowy, który umożliwia użytkownikowi obliczenie kosztów prac" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<link rel="stylesheet" href="./css/style.css">
</head>

<body data-bs-spy="scroll" data-bs-target="#navbar" data-bs-offset="82">

	<nav class="navbar navbar-expand-lg position-fixed top-0 w-100 py-3">
		<div class="container wrapper">
			<a class="navbar-brand" href="HomeLogin.php">Home</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
				aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fas fa-bars"></i>
			</button>

			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav ms-auto">

					<a class="nav-link" href="HomeLogin.php">Strona główna</a>
					<a class="nav-link" href="renovate.php">Nowy remont</a>
					<a class="nav-link" href="logout.php">Wyloguj się</a>
					<a class="nav-link" href="#">Kontakt</a>
				</div>
			</div>
		</div>
	</nav>


	
	
	

			<?php
require_once "connect.php";

$db = @new mysqli($host, $db_user, $db_password, $db_name);

if ($db->connect_errno != 0) {
  echo "Error: ".$db->connect_errno;
} else {
  ini_set('display_errors', 0);
 
  if(isset($_POST['delete_record_inst']) && $_POST['delete_record_inst'] != "") {
	$id_instalation = $_POST['delete_record_inst'];

	$sql = "DELETE FROM instalation WHERE id_instalation = $id_instalation AND user = '$_SESSION[username]'";
	$result = $db->query($sql);

	if($result) {
		header("Location: myrenovate.php");
	
	} 
}

if(isset($_POST['delete_record_paint']) && $_POST['delete_record_paint'] != "") {
	$id_paint= $_POST['delete_record_paint'];

	$sql = "DELETE FROM paint WHERE id_paint = $id_paint AND user = '$_SESSION[username]'";
	$result = $db->query($sql);

	if($result) {
		header("Location: myrenovate.php");
	
	} 
}

  $pytanie_remonty = "SELECT * FROM room WHERE user='$_SESSION[username]'";
  $result_remonty = $db->query($pytanie_remonty);
  if ($result_remonty->num_rows > 0) {
    while ($row_remonty = $result_remonty->fetch_assoc()) {
      $room_id = $row_remonty["room_id"];
      ?>
	  <div class="mainRenovate">
		<div class="decoration d1"></div>
		<div class="decoration d2"></div>
		<div class="decoration d3"></div>

             
         <div class="wrapper">
		<div class="allReno">
			<div class="allReno__text">
				<span class="renovateName"><?php echo $row_remonty["renoName"] ?> 
				<span class="renovateDate"><?php echo $row_remonty["dateReno"] ?></span> </span>
				
			</div>
      <div class="allReno__show">
      
 
 <?php
	  $total_paint_cost = 0;
	  $total_instalation_cost = 0;
      $question_paint = "SELECT * FROM paint WHERE room_id='$room_id'";
      $result_paint = $db->query($question_paint);
      if ($result_paint->num_rows > 0) {
             ?>

        <div class="typeReno"><?php echo "Malowanie"; ?></div>

            <?php
        while ($row_paint = $result_paint->fetch_assoc()) {
          $total_paint_cost += $row_paint["addition"];
		  ?>
		  <div>Potrzebujesz <?php echo $row_paint["liters"] ?> litrów farby rodzaju
		   <?php echo $row_paint["type_paint"] ?> w kolorze <?php echo $row_paint["color_paint"] ?></div>
		   <div>Koszt malowania: <?php echo $row_paint["addition"] ?> zł</div>
           

		
 <form class ="delete-form" method="POST" action="">
                    <input type="hidden" name="delete_record_paint" value="<?php echo $row_paint['id_paint']; ?>">
                    <input class="delete-form_record" type="submit" value="Usuń">
                </form>
			<?php
        }
          ?>
		  <div class="fullPartCost">Łączny koszt malowania: <?php echo $total_paint_cost ?> zł</div>

		<?php
      }

      $question_instalation = "SELECT * FROM instalation WHERE room_id='$room_id'";
      $result_instalation = $db->query($question_instalation);

      if ($result_instalation->num_rows > 0) {
		?>
       <div class="typeReno"><?php echo "Instalacja"; ?></div>
		<?php
        while($row_instalation = $result_instalation->fetch_assoc()) {
            $instalation_cost = $row_instalation['addition'];
            $total_instalation_cost += $instalation_cost;

            ?>
             <div>Potrzebujesz <?php echo $row_instalation['pcs'] ?> sztuk materiału rodzaju
		   <?php echo $row_instalation['material_type'] ?> </div>
		   <div>Koszt instalacji: <?php echo $instalation_cost ?> zł</div>
          
			
 <form class ="delete-form" method="POST" action="">
                    <input type="hidden" name="delete_record_inst" value="<?php echo $row_instalation['id_instalation']; ?>">
                    <input class="delete-form_record" type="submit" value="Usuń">
                </form>
			<?php
        }
		?>
		<div class="fullPartCost">Łączny koszt instalacji: <?php echo $total_instalation_cost ?> zł</div>
		<?php
    } else {
		echo "";
    }
	?>
	<div class="fullCost">Łączny koszt: <?php echo $total_instalation_cost + $total_paint_cost ?> zł</div>
	
	<form class ="allReno-btn" method="POST">
	<input type="hidden" name="delete_room" value="<?php echo $room_id; ?>">
  <button class="result-all__btn" type="submit">Usuń remont</button>
	</form>
	<form class ="allReno-btn"method="POST">
	<input type="hidden" name="edit_room" value="<?php echo $room_id; ?>">
  <button class="result-all__btn" type="submit">dodaj więcej</button>
	</form> 
</div>
</div>
</div>
</div>
	<?php
    if (isset($_POST['delete_room'])) {
        $room_id = $_POST['delete_room'];

        $delete_paint = "DELETE FROM paint WHERE room_id='$room_id'";
        $delete_instalation = "DELETE FROM instalation WHERE room_id='$room_id'";
        $db->query($delete_paint);
        $db->query($delete_instalation);
    
        $delete_room = "DELETE FROM room WHERE room_id='$room_id' AND user='$_SESSION[username]'";
        $db->query($delete_room);
    
        header("Location: myrenovate.php");
    }
	if (isset($_POST['edit_room'])) {
		$room_id = $_POST['edit_room'];
		$db->query("UPDATE room SET isActive=0 WHERE user='{$_SESSION['username']}'");
		$db->query("UPDATE room SET isActive=1 WHERE room_id=$room_id AND user='{$_SESSION['username']}'");
		header("Location: calculate.php");
	  } 
    } } } ?>


<?php  if (isset($_SESSION['username'])) : ?>
	<?php endif ?>
	







	<div class="footer">
		<p class="footer-text">Autorzy: Hubert Augustyniak, Natalia Kosiacka</p>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
		</script>

	<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
	<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script src="./js/aosscript.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script src="./js/slicksettings.js"></script>
	<script src="/js/script.js"></script>
</body>

</html>