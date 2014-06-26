<h1>Fizetési mód</h1>
<?php
	if ($_SESSION['user']->getUserID()) {
		$_SESSION['user']->listPaymentMethods();
	}
?>