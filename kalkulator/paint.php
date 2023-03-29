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
					<a class="nav-link active" aria-current="page" href="index.php">Kalkulator</a>
					<a class="nav-link" href="paint.php">Wnętrze</a>
					<a class="nav-link" href="installation.php">Instalacja</a>
					<a class="nav-link" href="#">Kontakt</a>
				</div>
			</div>
		</div>
	</nav>

	<div class="content">
		<p>
		<h1>Malowanie ścian</h1>
		<form action="paint.php" method="POST">
			<label for="age">Podaj powierzchnie pokoju w metrach kwadratowych:</label>
			<input type="number" id="age" step="0.1" name="pokoj" min="0" max="120"><br><br>

			<label for="height">Podaj ilość farby na metr kwadratowy:</label>
			<input type="number" id="height" step="0.01" name="farba" min="0" max="300"><br><br>

			<label for="weight">Podaj cene za litr farby:</label>
			<input type="number" id="weight" step="0.1" name="cena" min="0" max="500"><br><br>

			<input type="submit" value="Oblicz">
		</form>
		</p>
		<?php
			$host = 'localhost'; // adres serwera bazodanowego
			$username = 'root'; // nazwa użytkownika bazy danych
			$password = ''; // hasło użytkownika bazy danych
			$dbname = 'remont'; // nazwa bazy danych
			
			// połączenie z bazą danych
			$conn = new mysqli($host, $username, $password, $dbname);
			
			// sprawdzenie, czy połączenie zostało poprawnie wykonane
			if ($conn->connect_error) {
				die("Nie udało się połączyć z bazą danych: " . $conn->connect_error);
			  }
			  echo "Połączenie z bazą danych zostało nawiązane.";
			  


			ini_set('display_errors', 0);
			if(isset($_POST['pokoj']) && isset($_POST['farba']) && isset($_POST['cena']) && $_POST['pokoj'] != "" && $_POST['farba'] != "" && $_POST['cena'] != "") {
				
				$pokoj = $_POST['pokoj'];
				$farba = $_POST['farba'];
				$cena = $_POST['cena'];
		
				$ile_litrow = $pokoj*$farba;
				$oblicz_koszt = $pokoj*$farba*$cena;
				echo<<<END
				Potrzebujesz $ile_litrow litrów farby;
				<br>
				Koszt malowania ścian wynosi: $oblicz_koszt zł;
				END;
			}	

			?>


	</div>

	<div style="height: 100vh;"></div>
	<div class="footer">Stopka </div>




</body>

</html>