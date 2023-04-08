
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
					<a class="nav-link" href="zarejestruj.php">Zarejestruj się</a>
				</div>
			</div>
		</div>
	</nav>

	<div class="content">
		<center><p>
		<h1>Rejestracja</h1>
		
		<p><form action="zarejestruj.php" method="post">
	
	Login: <br /> <input type="text" name="login" /> <br />
	Hasło: <br /> <input type="password" name="haslo" /> <br />
	E-mail: <br /> <input type="text" name="email" /> <br /><br /><br />

	<input type="submit" value="Zarejestruj się" />

</form>
</p><center>
		
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
			if(isset($_POST['login']) && isset($_POST['haslo']) && isset($_POST['email']) && $_POST['login'] != "" && $_POST['haslo'] != "" && $_POST['email'] != "") {
				
				$login = $_POST['login'];
				$haslo = $_POST['haslo'];
				$email = $_POST['email'];
				
				echo<<<END
				kokoko
				<br><br><br>
				END;

				
				$sql = "INSERT INTO `uzytkownicy` ('id','user','pass','email') 
				VALUES ('','$login', '$haslo', '$email')";
				
	   
$resultat_powyzszego = $conn->query($sql);
}

    $conn->close();
			
			}

		?>

			

	</div>

	<div style="height: 100vh;"></div>
	<div class="footer">Stopka </div>


</body>
</html>