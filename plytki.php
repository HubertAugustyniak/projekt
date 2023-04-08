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
		<h1>Kładzenie płytek/paneli na podłodze</h1>
		<form action="plytki.php" method="POST">
			<label for="age">Podaj powierzchnie podlogi w metrach kwadratowych:</label>
			<input type="number" id="age" step="0.1" name="podloga" min="0" max="120"><br><br>

			<label for="height">Podaj powierzchnię plytki/panela w metrach kwadratowych:</label>
			<input type="number" id="height" step="0.01" name="powierzchnia_materialu" min="0" max="300"><br><br>

			<label for="weight">Podaj cene za sztuke:</label>
			<input type="number" id="weight" step="0.1" name="cena" min="0" max="500"><br><br>

			<label for="type">Wybierz rodzaj materialu:</label>
<select id="type" name="typ">
  <option value="Płytki">Płytki</option>
  <option value="Panele">Panele</option>
  
</select><br><br>

			<input type="submit" value="Oblicz">
		</form>
</p>
		<form action="decyzja.php" method="POST">
		<button type="submit" name="plytki" value="dede">Cofnij do menu</button>
</form>
		</p>
	
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
			if(isset($_POST['podloga']) && isset($_POST['powierzchnia_materialu']) && isset($_POST['cena']) && $_POST['podloga'] != "" && $_POST['powierzchnia_materialu'] != "" && $_POST['cena'] != "") {
				
				$podloga = $_POST['podloga'];
				$powierzchnia_materialu = $_POST['powierzchnia_materialu'];
				$cena = $_POST['cena'];
				$typ = $_POST['typ']; // rodzaj farby wybrany z listy


				$ile_sztuk = round($podloga/$powierzchnia_materialu);
				$oblicz_koszt = $ile_sztuk*$cena;
				echo<<<END
				
				END;
				

				
				//$sql = "INSERT INTO `instalacja` (`id_instalacji`, `user`, `pow_podlogi`, `rodzaj_materialu`,`ile_sztuk`, `suma`) 
				//VALUES ('', '$_SESSION[user]', '$podloga', '$typ','$ile_sztuk', '$oblicz_koszt')";
				$sql = "INSERT INTO instalacja (uzytkownik_id, user, pow_podlogi,rodzaj_materialu, ile_sztuk, suma)
				SELECT id, '$_SESSION[user]', '$podloga','$typ', '$ile_sztuk', '$ile_sztuk'*'$cena'
			   FROM uzytkownicy WHERE user = '$_SESSION[user]'";

$resultat_powyzszego = $conn->query($sql);

$pytanie = "SELECT * FROM instalacja WHERE user='$_SESSION[user]'";
$result = $conn->query($pytanie);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "Instalacja nr: " . $row["id_instalacji"]."<br>". " - Użytkownik: " . $row['user']."<br>"." - Potrzebujesz: " . $row['ile_sztuk']." sztuk materialu"."<br>". " - Powierzchnia podlogi: " . $row["pow_podlogi"]."m<sup>2</sup>"."<br>"." litrów"."<br>"."- Rodzaj materialu: " . $row["rodzaj_materialu"]."<br>"."- Koszt instalacji: " . $row["suma"]." zł". "<br>";
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