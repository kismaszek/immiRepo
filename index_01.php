<?php
	//Munkamenet elindítása
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf8">
</head>
<body>
<?php 
	
	echo "php test";
	
	print("kiiratás print-el");

	echo '<div class="page">Ez egy html kiiratás</div>';

	//Változó deklarálása, értékadás
	$menu = 'Home';

	//Változó kiiratása
	echo $menu;

	//Összefűzés
	print('A menu változó tartalma: '.$menu.'<br>');

	/*
		Ez
		egy 
		több soros comment
	*/

	//Tömb
	$menupontok = array('Home','Services','Contact');
	echo $menupontok[0];
	
	//Asszociatív tömb (társításos tömb)
	$hallgatok = array('nev'=>'Nagy Tímea','kor'=>'22');
	echo 'Hallgató neve: '.$hallgatok['nev'];
	echo 'Hallgató életkora: '.$hallgatok['kor'];



	$szamok = array(1,2,3);

	//Tömb elemeinek kiiratása (tesztelésre)
	print_r($menupontok);

	//Tömb elemeinek kiiratása (felhasználó)
	/*
	foreach ($menupontok as $k => $menu) {
		echo '<a href="'.$menu.'.html">'.$menu.'</a>';
	}
	*/

	//Függvény deklarálása
	function menuKirako($menupontok)
	{
		foreach ($menupontok as $k => $menu) {
			echo '<a href="'.$menu.'.html">'.$menu.'</a>';
		}
	}

	//Függvény hívása
	menuKirako($menupontok);

	//Super Globals (globális változók)
	/*
		$_POST
		$_GET
		$_REQUEST
		$_SERVER
		$GLOBALS
		$_SESSION
	*/

	//print_r($_POST);

	echo '<PRE>';
	//print_r($_SERVER);
	echo '</PRE>';

	//echo 'Szerver neve'.$_SERVER['SERVER_NAME'];

	$GLOBALS['page'] = 'index';

	//Munkamenet változó

	$_SESSION['cart'] = 'alma';
	
	print_r($_SESSION);
?>

<form method="POST">
	<label>E-mail</label>
	<input type="email" name="email">
	<label>Jelszó</label>
	<input type="password" name="pw">
	<button>Login</button>
</form>

</body>
</html>