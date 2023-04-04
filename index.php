<?php

	session_start();
	
	if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
	{
		header('Location: decyzja.php');
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
			<a class="navbar-brand" href="#">Home</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
				aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fas fa-bars"></i>
			</button>

			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav ms-auto">
					<a class="nav-link active" aria-current="page" href="#calculate">Kalkulator</a>
					<a class="nav-link" href="login.php">Logowanie</a>
					<a class="nav-link" href="register.php">Rejestracja</a>
					<a class="nav-link" href="#">Kontakt</a>
				</div>
			</div>
		</div>
	</nav>

	<header>
		<div class="hero-image">
			<div class="hero-image__text">
				<h1>Kalkulator Remontowy</h1>
				<p>Oblicz wydatki na remont swojego mieszkania</p>
			</div>
			<div class="hero-image__bg"></div>
		</div>
	</header>

	<div class="calculate" id="calculate">
		<div class="wrapper">
			<p>Kalkulator</p>
			<div class="boxes_calc">
				<a href="paint.php" class="box_calc plytki">
					<div class="text-box">
						<p>Płytki</p>
					</div>
				</a>
				<a href="paint.php" class="box_calc panele">
					<div class="text-box">
						<p>Panele</p>
					</div>
				</a>
				<a href="paint.php" class="box_calc farba">
					<div class="text-box">
						<p>Farby</p>
					</div>
				</a>
			</div>
		</div>
	</div>

	<div style="height: 100vh;"></div>
	<div class="footer">Stopka </div>




</body>

</html>