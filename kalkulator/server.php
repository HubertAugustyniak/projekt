<?php
session_start();

$username = "";
$email    = "";
$errors = array(); 

require('connect.php');


if (isset($_POST['submit'])) {

  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "hasła się nie zgadzają");
  }

  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['username'] === $username) {
      array_push($errors, "Taki użytkownik istnieje");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Taki email istnieje");
    }
  }


  if (count($errors) == 0) {
  	$password = md5($password_1);

  	$query = "INSERT INTO users (username, email, passwordhash) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "Jesteś zalogowany";
  	header('location: renovate.php');
  }
}

if (isset($_POST['submit_2'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Wymagana jest nazwa użytkownika");
  }
  if (empty($password)) {
  	array_push($errors, "Wymagane jest hasło");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE username='$username' AND passwordhash='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "Jesteś zalogowany";
      header('location: renovate.php');
  	}else {
  		array_push($errors, "Zła nazwa użytkownika lub hasło");
  	}
  }
}

?>