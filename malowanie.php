<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
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
					
					<a class="nav-link" href="#">Kontakt</a>
				</div>
			</div>
		</div>
	</nav>

	<div class="content">
		<p>
		<h1>Malowanie ścian</h1>
		<form action="malowanie.php" method="POST">
			<label for="age">Podaj powierzchnie pokoju w metrach kwadratowych:</label>
			<input type="number" id="age" step="0.1" name="pokoj" min="0" max="120"><br><br>

			<label for="height">Podaj ilość farby na metr kwadratowy:</label>
			<input type="number" id="height" step="0.01" name="farba" min="0" max="300"><br><br>

			<label for="weight">Podaj cene za litr farby:</label>
			<input type="number" id="weight" step="0.1" name="cena" min="0" max="500"><br><br>

			<label for="type">Wybierz rodzaj farby:</label>
<select id="type" name="typ">
  <option value="akrylowa">Akrylowa</option>
  <option value="lateksowa">Lateksowa</option>
  <option value="olejna">Olejna</option>
</select><br><br>

<label for="color">Wybierz kolor farby:</label>
<select id="color" name="kolor">
  <option value="bialy">Biały</option>
  <option value="zielony">Zielony</option>
  <option value="niebieski">Niebieski</option>
  <option value="szary">Szary</option>
</select><br><br>

			<input type="submit" value="Oblicz">
		</form>
		</p>
		<form action="decyzja.php" method="POST">
		<button type="submit" name="instalacja" value="tiling">Cofnij do menu</button>
</form>
		<?php

	$_SESSION['user'];
	echo '<a href="logout.php">Wyloguj się!</a>';
	
	
	
?>

<?php

			require_once "connect.php";

	$conn = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($conn->connect_errno!=0)
	{
		echo "Error: ".$conn->connect_errno;
	}
	else
	{
			ini_set('display_errors', 0);
			if(isset($_POST['pokoj']) && isset($_POST['farba']) && isset($_POST['cena']) && $_POST['pokoj'] != "" && $_POST['farba'] != "" && $_POST['cena'] != "") {
				
				$pokoj = $_POST['pokoj'];
				$farba = $_POST['farba'];
				$cena = $_POST['cena'];
				$typ = $_POST['typ']; // rodzaj farby wybrany z listy
$kolor = $_POST['kolor']; // kolor farby wybrany z listy

				$ile_litrow = $pokoj*$farba;
				$oblicz_koszt = $pokoj*$farba*$cena;
				echo<<<END
				
				<br><br><br>
				END;

				
				//$sql = "INSERT INTO `malowanie` ('uzytkownik_id`,'id_malowania`, `user`, `pow_pokoju`, `ile_litrow_farby`, `rodzaj_farby`, `kolor_farby`, `cena_za_litr`, `suma`) 
				//VALUES ('', '$_SESSION[user]', '$pokoj', '$ile_litrow', '$typ', '$kolor', '$cena', '$oblicz_koszt')";
				$sql = "INSERT INTO malowanie (uzytkownik_id, user, pow_pokoju,ile_litrow_farby, rodzaj_farby, kolor_farby, cena_za_litr, suma)
   				 SELECT id, '$_SESSION[user]', '$pokoj','$ile_litrow', '$typ', '$kolor', '$cena', '$pokoj'*'$farba'*'$cena'
       			FROM uzytkownicy WHERE user = '$_SESSION[user]'";
	   
$resultat_powyzszego = $conn->query($sql);

$pytanie = "SELECT * FROM malowanie WHERE user='$_SESSION[user]'";
$result = $conn->query($pytanie);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "Malowanie nr: " . $row["id_malowania"]."<br>". " - Użytkownik: " . $row['user']."<br>". " - Powierzchnia pokoju: " . $row["pow_pokoju"]."m<sup>2</sup>"."<br>"."- Potrzebna losc farby: " . $row["ile_litrow_farby"]." litrów"."<br>"."- Rodzaj farby: " . $row["rodzaj_farby"]."<br>"."- Kolor: " . $row["kolor_farby"]."<br>"."- Cena za litr: " . $row["cena_za_litr"]." zł". "<br>"."- Koszt malowania: " . $row["suma"]." zł". "<br>";
  }
} else {
  echo "0 results";
}
				
				

    }
    $conn->close();
}

		?>

			

	</div>

	<div style="height: 100vh;"></div>
	<div class="footer">Stopka </div>


</body>
</html>