<?php
	session_start();

	echo session_id().'<br>';

	//Biztonsági védelem - Session azonosító újra generálása
	session_regenerate_id();

	echo session_id().'<br>';	

	echo '<PRE>';
	print_r($_SESSION);
	echo '</PRE>';

	//Osztályok automatikus betöltése
	//Paraméterként az osztály neve
	function classLoader($className)
	{
		include 'class/'.$className.'.class.php';
	}

	//Saját osztály betöltő függvény regisztrálása az __autoload helyett
	spl_autoload_register('classLoader');
	
	//Új felhasználó létrehozása ha még nem létezik
	if (!$_SESSION['user']) {
		new user();
	}

	//(Felhasználó) Objektum tulajdonságának elérése
	//echo $user->userEmail;
	//(Felhasználó) Objektum metódusának elérése
	//echo $user->getUserID();
	//echo $user->userName;

	echo 'Azonosító: '.$_SESSION['user']->getUserID();

	//Rákattintott e felhasználó a bejelentkezés gombra
	if (isset($_POST['login'])) {

	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Második alkalom</title>
	<meta charset="utf8">
</head>
<body>

<form method="POST">
	<label>Email</label>
	<input type="email" name="email">
	<button name="login">Elküldés</button>
</form>

</body>
</html>