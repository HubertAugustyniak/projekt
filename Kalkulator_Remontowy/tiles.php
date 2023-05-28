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
			<a class="navbar-brand" href="index.php">Home</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
				aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fas fa-bars"></i>
			</button>

			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav ms-auto">
			
					<a class="nav-link" href="HomeLogin.php">Strona główna</a>
					<a class="nav-link" href="#">Moje konto</a>
					<a class="nav-link" href="logout.php">Wyloguj się</a>
					<a class="nav-link" href="#">Kontakt</a>
				</div>
			</div>
		</div>
	</nav>

	<div class="content">
		<p>
		<h1>Kładzenie płytek/paneli na podłodze</h1>
		<form action="tiles.php" method="POST">
			<label for="age">Podaj powierzchnie podlogi w metrach kwadratowych:</label>
			<input type="number" id="age" step="0.1" name="floor" min="0" max="120"><br><br>

			<label for="height">Podaj powierzchnię plytki/panela w metrach kwadratowych:</label>
			<input type="number" id="height" step="0.01" name="surf_material" min="0" max="300"><br><br>

			<label for="weight">Podaj cene za sztuke:</label>
			<input type="number" id="weight" step="0.1" name="price" min="0" max="500"><br><br>

			<label for="type">Wybierz rodzaj materialu:</label>
<select id="type" name="type">
  <option value="Płytki">Płytki</option>
  <option value="Panele">Panele</option>
  
</select><br><br>

			<input type="submit" value="Oblicz">
		</form>
</p>
		<form action="calculate.php" method="POST">
		<button type="submit" name="tiles" value="dede">Cofnij do menu</button>
</form>
		</p>

<?php

            require('connect.php');

	
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
				$sql = "INSERT INTO instalation (user_id, user, surf_floor, material_type, pcs, addition)
				SELECT user_id, '$_SESSION[username]', '$floor','$type', '$pcs', '$calc_price'
			   FROM users WHERE username = '$_SESSION[username]'";

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

			

	</div>

	
	<div class="footer">
		<p class="footer-text">Autorzy: Hubert Augustyniak, Natalia Kosiacka</p>
	</div


</body>
</html>