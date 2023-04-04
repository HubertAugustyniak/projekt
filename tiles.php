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
			<a class="navbar-brand" href="index.html">Home</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
				aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fas fa-bars"></i>
			</button>

			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav ms-auto">
					<a class="nav-link active" aria-current="page" href="index.html">Materiały budowlane</a>
					<a class="nav-link" href="paint.php">Wnętrze</a>
					<a class="nav-link" href="installation.php">Instalacja</a>
					<a class="nav-link" href="#">Kontakt</a>
				</div>
			</div>
		</div>
	</nav>

	<div class="content">
		<p>
		<h2>Kładzenie płytek/paneli na podłodze</h2>
		<form action="installation.php" method="POST">
			<label for="age">Podaj powierzchnie podłogi w metrach kwadratowych:</label>
			<input type="number" id="age" name="podloga" min="0" max="120" step="0.1"><br><br>

			<label for="height">Podaj powierzchnię plytki/panela w metrach kwadratowych:</label>
			<input type="number" id="height" name="powierzchnia_materialu" min="0" max="300" step="0.01"><br><br>

			<label for="weight">Podaj cene za sztuke:</label>
			<input type="number" id="weight" name="cena" min="0" max="500" step="0.1"><br><br>

			<input type="submit" value="Oblicz">
		</form>
		</p>

		<?php
			
			ini_set('display_errors', 0);
			if(isset($_POST['podloga']) && isset($_POST['powierzchnia_materialu']) && isset($_POST['cena']) && $_POST['podloga'] != "" && $_POST['powierzchnia_materialu'] != "" && $_POST['cena'] != "") {
				
				$podloga = $_POST['podloga'];
				$powierzchnia_materialu = $_POST['powierzchnia_materialu'];
				$cena = $_POST['cena'];
		
				$ile_sztuk = round($podloga/$powierzchnia_materialu);
				$oblicz_koszt = $ile_sztuk*$cena;
				echo<<<END
				Potrzebujesz $ile_sztuk sztuk;
				<br>
				Koszt wynosi: $oblicz_koszt zł;
				END;
			}
		
			?>

	</div>

	<div style="height: 100vh;"></div>
	<div class="footer">Stopka </div>




</body>

</html>