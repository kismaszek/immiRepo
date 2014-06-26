<h1>Kosár tartalma</h1>
<?php
	if ($_SESSION['cart']['obj']) {
		$_SESSION['cart']['obj']->listCart();
	}
?>