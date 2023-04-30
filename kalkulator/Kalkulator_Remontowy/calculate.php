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
					<a class="nav-link" href="account.php">Moje konto</a>
					<a class="nav-link" href="renovate.php">Nowy remont</a>
					<a class="nav-link" href="logout.php">Wyloguj się</a>
				</div>
			</div>
		</div>
	</nav>


	<div class="mainService">
		<div class="decoration d1"></div>
		<div class="decoration d2"></div>
		<div class="decoration d3"></div>



		<div class="service">

			<div class="service__text">
				<h2>Wybierz usługę</h2>
			</div>


			<ul class="service__choose">
				<li class="service__choose-form">
					<a href="calculate.php?calc=1" class="button-form">Malowanie</a>
				</li>

				<li class="service__choose-form">
					<a href="calculate.php?calc=2" class="button-form">Instalacja</a>
				</li>
			</ul>
			<div class="underline">
			</div>
		</div>

		<div class="open-calc">
			<?php
			 include("paint.php"); include("instalation.php");
			 
             $calc = $_GET['calc'];
			 switch ($calc) {
				case 1: 
				  ?>
			<div class="paint">
				<p>
				<h3>Malowanie ścian</h3>
				<form action="calculate.php" method="POST">
					<label for="age">Podaj powierzchnie pokoju w metrach kwadratowych:</label>
					<input type="number" id="age" step="0.1" name="room" min="0" max="120">

					<label for="height">Podaj ilość farby na metr kwadratowy:</label>
					<input type="number" id="height" step="0.01" name="painter" min="0" max="300">

					<label for="weight">Podaj cene za litr farby:</label>
					<input type="number" id="weight" step="0.1" name="price" min="0" max="500">

					<label for="type">Wybierz rodzaj farby:</label>
					<select id="type" name="type">
						<option value="akrylowa">Akrylowa</option>
						<option value="lateksowa">Lateksowa</option>
						<option value="olejna">Olejna</option>
					</select>

					<label for="color">Wybierz kolor farby:</label>
					<select id="color" name="color">
						<option value="bialy">Biały</option>
						<option value="zielony">Zielony</option>
						<option value="niebieski">Niebieski</option>
						<option value="szary">Szary</option>
					</select>

					<input type="submit" value="Oblicz i zapisz">
				</form>
				</p>
				<form action="renovate.php" method="POST">
					<button type="submit" name="paint" value="tiling">Zacznij nowy remont</button>
				</form>
			</div>


			<?php	  
				break;
				case 2:
			?>
			<div class="Instalation">
				<p>
				<h3>Instalacja</h3>
				<form action="calculate.php" method="POST">
					<label for="age">Podaj powierzchnie podlogi w metrach kwadratowych:</label>
					<input type="number" id="age" step="0.1" name="floor" min="0" max="120">

					<label for="height">Podaj powierzchnię materiału w metrach kwadratowych:</label>
					<input type="number" id="height" step="0.01" name="surf_material" min="0" max="300">

					<label for="weight">Podaj cene za sztuke:</label>
					<input type="number" id="weight" step="0.1" name="price" min="0" max="500">

					<label for="type">Wybierz rodzaj materialu:</label>
					<select id="type" name="type">
						<option value="Płytki">Płytki</option>
						<option value="Panele">Panele</option>
						<option value="Terakota">Terakota</option>
					</select>

					<input type="submit" value="Oblicz i zapisz">
				</form>
				</p>
				<form action="renovate.php" method="POST">
					<button type="submit" name="tiles" value="dede">Zacznij nowy remont</button>
				</form>
				</p>
			</div>
			<?php
				break;
				default: 
			?>
			<div class="default-calculate">
				<p class="default-calculate__text">Ile wyniesie cię remont?</p>
			</div>
			<?php	
				}
			?>
		</div>
		<?php  if (isset($_SESSION['username'])) : ?>
		<?php endif ?>



	</div>







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