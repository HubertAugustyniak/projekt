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
			<a class="navbar-brand" href="index.php">Home</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
				aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fas fa-bars"></i>
			</button>

			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav ms-auto">
					<a class="nav-link" href="index.php">Strona główna</a>
					<a class="nav-link" href="register.php">Rejestracja</a>
					<a class="nav-link" href="#">Kontakt</a>
				</div>
			</div>
		</div>
	</nav>

	<header>
		<div class="hero-image">
			<div class="hero-image__login">
				<h1>Logowanie</h1>
				<p>
				<form action="login.php" method="post">

					<br /> 
					<input type="text" name="login" placeholder="E-mail lub nazwa" required /> <br /> <br /> 
					<input type="password" name="password" placeholder="Hasło" required /> <br /><br />
					<input class="login-btn" type="submit" value="Zaloguj się" />

				</form>
				</p>
			</div>
			<div class="hero-image__bg"></div>
		</div>
	</header>



	</div>
	<div class="footer">Stopka </div>
	<?php
	if(isset($_SESSION['blad']))	echo $_SESSION['blad'];
?>

</body>

</html>