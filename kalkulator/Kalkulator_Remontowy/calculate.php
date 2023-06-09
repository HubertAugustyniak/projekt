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

  require_once "connect.php";
  
  $db = @new mysqli($host, $db_user, $db_password, $db_name);
  if ($db->connect_errno!=0)
  {
      echo "Error: ".$db->connect_errno;
  }
  else
  {
      $sql = "SELECT renoName FROM room WHERE isActive=1 AND user='$_SESSION[username]'";
      $result = $db->query($sql);

      if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $renoName = $row['renoName'];

      }
      else {
        $renoName = "Brak aktywnego remontu";
      }

      $db->close();
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
			<a class="navbar-brand" href="HomeLogin.php">Home</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
				aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fas fa-bars"></i>
			</button>

			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav ms-auto">

					<a class="nav-link" href="HomeLogin.php">Strona główna</a>
					<a class="nav-link" href="myrenovate.php">Moje remonty</a>
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


		<div class="wrapper">
		<div class="service">

			<div class="service__text">
				<h2><?php echo  $renoName ?></h2>
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
			 
             $calc = $_GET['calc'];
			 switch ($calc) {
				case 1: 
				  ?>
			<div class="open-calc__box">
				
				<h3>Malowanie</h3>
				<form class="form_calc" action="calculate.php" method="POST">
					<label class="label-calc" for="age">Podaj powierzchnie pokoju w metrach kwadratowych:</label>
					<input class="input-calc" type="number" id="age" step="0.1" name="room" min="0" max="120">

					<label class="label-calc" for="height">Podaj ilość farby na metr kwadratowy:</label>
					<input class="input-calc" type="number" id="height" step="0.01" name="painter" min="0" max="300">

					<label class="label-calc" for="weight">Podaj cene za litr farby:</label>
					<input class="input-calc" type="number" id="weight" step="0.1" name="price" min="0" max="500">

					<label class="label-calc" for="type">Wybierz rodzaj farby:</label>
					<select class="select-calc" id="type" name="type">
						<option class="option-calc" value="akrylowa">Akrylowa</option>
						<option class="option-calc" value="lateksowa">Lateksowa</option>
						<option class="option-calc" value="olejna">Olejna</option>
					</select>

					<label class="label-calc" for="color">Wybierz kolor farby:</label>
					<select class="select-calc" id="color" name="color">
						<option class="option-calc" value="bialy">Biały</option>
						<option class="option-calc" value="zielony" >Zielony</option>
						<option class="option-calc" value="niebieski">Niebieski</option>
						<option class="option-calc" value="szary">Szary</option>
					</select>

					<input class="submit-calc" type="submit" value="Oblicz i zapisz">
				</form>
				
			
			</div>


			<?php	  
				break;
				case 2:
			?>
			<div class="open-calc__box">
				<h3>Instalacja</h3>
				<form class="form_calc" action="calculate.php" method="POST">
					<label class="label-calc" for="age">Podaj powierzchnie podlogi w metrach kwadratowych:</label>
					<input class="input-calc" type="number" id="age" step="0.1" name="floor" min="0" max="120">

					<label class="label-calc" for="height">Podaj powierzchnię materiału w metrach kwadratowych:</label>
					<input class="input-calc" type="number" id="height" step="0.01" name="surf_material" min="0" max="300">

					<label class="label-calc" for="weight">Podaj cene za sztuke:</label>
					<input class="input-calc" type="number" id="weight" step="0.1" name="price" min="0" max="500">

					<label class="label-calc" for="type">Wybierz rodzaj materialu:</label>
					<select class="select-calc" id="type" name="type">
						<option value="Płytki">Płytki</option>
						<option value="Panele">Panele</option>
						<option value="Terakota">Terakota</option>
					</select>

					<input class="submit-calc" type="submit" value="Oblicz i zapisz">
				</form>
				
				
			</div>
			<?php
				break;
				default: 
			?> 
			<div class="default-calculate">
				<p class="default-calculate__text">Ile wyniesie cię remont?</p>
			</div>
			<?php	
			  break;
				}
				include("paint.php"); include("instalation.php");
			?>
		<form class="form_calc-btn" action="calculate.php" method="POST">
				<button class="submit-calc-btn" type="submit" name="endReno" value="tiling">Zakończ remont</button>
			</form>
		</div>
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