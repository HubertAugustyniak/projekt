<?php include('server.php') ?>
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
			</button>

			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav ms-auto">
					<a class="nav-link" href="index.php">Strona główna</a>
					<a class="nav-link" href="login.php">Logowanie</a>
				</div>
			</div>
		</div>
	</nav>

	<header class="header">
		<div class="hero-image">
			<div class="hero-image__login">
				<h2>Rejestracja</h2>
				<p>
				<form class="form" method="POST" action="register.php">
					<?php include('errors.php'); ?>
					<input type="text" class="login-input" name="username" placeholder="Nazwa użytkownika" required>
					<input type="email" class="login-input" name="email" placeholder="E-mail" required>
					<input type="password" class="login-input" name="password_1" placeholder="Hasło" required>
					<input type="password" class="login-input" name="password_2" placeholder="Powtórz hasło"
						required>
					<input class="login-btn" type="submit" name="submit" value="Zarejestruj się">
				</form>
				</p>
			</div>
			<div class="hero-image__bg"></div>
		</div>
	</header>


	</div>
	<div class="footer">
		<p class="footer-text">Autorzy: Hubert Augustyniak, Natalia Kosiacka</p>
	</div

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