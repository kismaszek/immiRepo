<h1>Számlázási cím</h1>
<?php
	if ($_SESSION['user']->getUserID()) {
		$_SESSION['user']->listAddress("billing");
	}
?>