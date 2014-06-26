<h1>Szállítási cím</h1>
<?php
	if ($_SESSION['user']->getUserID()) {
		$_SESSION['user']->listAddress("delivery");
	}
?>