<?php
	
	//Osztályok beemelése
	function classLoader($className)
	{
		include('class/'.$className.'.class.php');
	}

	//Osztály betöltő függvény meghatározása
	spl_autoload_register('classLoader');
	
	//Munkamenet elindítása
	session_start();

	//DB Config
	define('DB_DSN','mysql:dbname=wp;host=localhost;charset=utf8');
	define('DB_USER','root');
	define('DB_PASS','admin');


	$GLOBALS['pdo'] = new myPDO(DB_DSN, DB_USER, DB_PASS);
	
	//Session törlése
	if (isset($_POST['session_destroy'])) {
		session_destroy();
		session_unset();
	}
	
	//Felhasználó létrehozása
	if (!$_SESSION['user']) {
		new user();
	}

	//Bejelentkezés figyelése
	if (isset($_POST['login'])) {
		$_SESSION['user']->userLogin();
	}

	//$pdo->query("SELECT * FROM menu");
	//$result = $pdo->fetchAll(PDO::FETCH_OBJ);
	//print_r($pdo->getResult());


	//echo get_class($pdo);

	//DBCONFIG -> CONNECT -> PREPARE -> BIND -> EXECUTE -> FETCH
	
	//Csatlakozás a MySQL szerverhez
	/*
	try{
		$pdo = new myPDO(DB_DSN, DB_USER, DB_PASS);
	}catch (PDOException $e) {
	    echo 'Connection failed: ' . $e->getMessage();
	}
	*/

	//Tulajdonságok beállítása
	//$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ); 
	//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//Lekérdezés előkészítése
	//$userEmail = 'info@immi.hu';
	//$userName = 'immi';


	//Mysql támadás (MySQL injection elleni védelem)
	//$sql = "SELECT * FROM user WHERE userEmail=? AND userName=?";
	//$sql = "SELECT * FROM user WHERE userEmail=:userEmail AND userName=:userName";

	//PDOSTATEMENT osztály 
	//$stmt = $pdo->prepare($sql);

	//Paraméterek Bind-olása '  ' PlaceHolderek-hez
	//$stmt->bindValue(1,$userEmail,PDO::PARAM_STR);
	//$stmt->bindValue(2,$userName,PDO::PARAM_STR);

	//Paraméterek Bind-olása 'Named' PlaceHolderek-hez
	//$stmt->bindValue(':userEmail',$userEmail,PDO::PARAM_STR);
	//$stmt->bindValue(':userName',$userName,PDO::PARAM_STR);

	//Lekérdezést futtatom, ha hiba van elkapom
	/*
	try {
		$stmt->execute();	
	} catch (PDOException $e) {
		echo $e->getMessage();
	}
	*/
	//Adatok formázott lekérése (Összeset egyszerre)
	//$records = $stmt->fetchAll(PDO::FETCH_NUM);
	//$records = $stmt->fetchAll(PDO::FETCH_OBJ);
	//$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

	//Adatlekérdezés soronként
	/*
	while ($record = $stmt->fetch(PDO::FETCH_OBJ)) {
		echo $record->userEmail;
	}
	*/
	
	echo '<pre>';
	print_r($records);
	echo '</pre>';

	html::table($records);

	$page = new page();

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/page.css">
</head>
<body>

<?php
	
	html::div('adat','azon','oszt');

	//Táblázat adatok
	$data = array(array('1','Photoshop'),
				  array('2','Illustrator'),
				  array('3','inDesign'));
	
	//Táblázat fejléc
	$thead = array('Azonosító','Tanfolyam');
	
	html::table($data,$thead);
?>

<nav>
	<ul>
		<li><a href="">Menüpont</a></li>
	</ul>
</nav>

<div id="content">
	<div id="content-left"></div>
	<div id="content-main">
<?php 
	echo session_id();
?>

	</div>
	<div id="content-right">
		<form method="POST" action="">
			<label>E-mail</label>
			<input type="text" name="email">
			<label>Jelszó</label>
			<input type="password" name="pw">
			<button name="login">Bejelentkezés</button>
		</form>
		<form method="post">
			<button name="session_destroy">Session törlése</button>
		</form>
	</div>
</div>

<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
</body>
</html>