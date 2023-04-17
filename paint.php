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
					<a class="nav-link" href="renovate.php">Remont</a>
				</div>
			</div>
		</div>
	</nav>

	<div class="content">
		<p>
		<h1>Malowanie ścian</h1>
		<form action="paint.php" method="POST">
			<label for="age">Podaj powierzchnie pokoju w metrach kwadratowych:</label>
			<input type="number" id="age" step="0.1" name="room" min="0" max="120"><br><br>

			<label for="height">Podaj ilość farby na metr kwadratowy:</label>
			<input type="number" id="height" step="0.01" name="painter" min="0" max="300"><br><br>

			<label for="weight">Podaj cene za litr farby:</label>
			<input type="number" id="weight" step="0.1" name="price" min="0" max="500"><br><br>

			<label for="type">Wybierz rodzaj farby:</label>
<select id="type" name="type">
  <option value="akrylowa">Akrylowa</option>
  <option value="lateksowa">Lateksowa</option>
  <option value="olejna">Olejna</option>
</select><br><br>

<label for="color">Wybierz kolor farby:</label>
<select id="color" name="color">
  <option value="bialy">Biały</option>
  <option value="zielony">Zielony</option>
  <option value="niebieski">Niebieski</option>
  <option value="szary">Szary</option>
</select><br><br>

			<input type="submit" value="Oblicz">
		</form>
		</p>
		<form action="calculate.php" method="POST">
		<button type="submit" name="instalation" value="tiling">Cofnij do menu</button>
</form>
	
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
				
				<br><br><br>
				END;

				
				//$sql = "INSERT INTO `malowanie` ('uzytkownik_id`,'id_malowania`, `user`, `pow_pokoju`, `ile_litrow_farby`, `rodzaj_farby`, `kolor_farby`, `cena_za_litr`, `suma`) 
				//VALUES ('', '$_SESSION[user]', '$pokoj', '$ile_litrow', '$typ', '$kolor', '$cena', '$oblicz_koszt')";
				$sql = "INSERT INTO paint (user_id, user, surf_room, liters, type_paint, color_paint,price_for_liter, addition)
   				 SELECT user_id, '$_SESSION[username]', '$room','$how_liters', '$type', '$color', '$price', '$calc_price'
       			FROM users WHERE username = '$_SESSION[username]'";
	   
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

			

	</div>

	<div class="footer">
		<p class="footer-text">Autorzy: Hubert Augustyniak, Natalia Kosiacka</p>
	</div


</body>
</html>