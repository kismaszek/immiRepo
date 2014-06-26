<?php 
class page
{
	public $URL;
	public $TABLE;			/* Melyik táblában */
	public $PAGE_ID;
	public $PAGE_TITLE;
	public $PAGE_TYPE;		/* Tartalom honnan? Inlude, vagy mezőből */
	public $STYLESHEETS = array('page.css','dev.css');
	public $SCRIPTS = array('http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js',
							'//code.jquery.com/ui/1.10.4/jquery-ui.js',
							'js/myscript.js',
							'js/modernizr.js',
							'js/main.js');

	function __construct()
	{
		$this->setURL();
		$this->buildPage();
	}

	//Az URL beállítása
	function setURL(){
		//Feldarabolom az URL-t a per jelek mentén, és tömbbe rakom
		$URL = explode("/",$_SERVER['REQUEST_URI']);
		
		//A tömb utolsó eleme a fájl név
		$URL = $URL[count($URL)-1];
		
		//Az URL letárolása
		if(!$URL){
			$this->URL = 'index';
		}else{
			$this->URL = $URL;
		}

		$this->getURL($this->URL);
	}

	public function getURL($URL)
	{
		$pdo = myPDO::getPDO();
		$sql = "SELECT * FROM indexes WHERE URL=:URL";
		$stmt = $pdo->prepare($sql);
		$stmt->bindValue(':URL',$URL,PDO::PARAM_STR);
	
		try {
			$stmt->execute();
		} catch (PDOException $e) {
			echo 'GÁZ VAN: '.$e->getMessage();
		}

		if($index = $stmt->fetchAll()) {
			//Index táblában van, adott táblában?
			$this->TABLE = $table = $index[0]->tableName;
			$ID = $index[0]->tableID;
			$stmt = $pdo->query("SELECT * FROM $table WHERE ID='$ID'");
			if ($result = $stmt->fetchAll()){
				$this->PAGE_ID = $result[0]->ID;
				switch ($this->TABLE) {
					case 'pages':
						$this->setPage($result);
						break;
					case 'products':
						# code...
						break;
					case 'categories':
						# code...
						break;					
					default:
						# code...
						break;
				}
			}
		}else{
			echo 'nincs';
		}
	}

	public function getPageInfo()
	{
			echo '<div class="dev-box">';
		    html::h(2,'Page INFO');
		    echo '<h3>PAGE_TITLE:</h3><span>'.$this->PAGE_TITLE.'</span>';
		    echo '<h3>PAGE_TYPE:</h3><span>'.$this->PAGE_TYPE.'</span>';
		    echo '<h3>URL:</h3><span>'.$this->URL.'</span>';
		    echo '<h3>PAGE_ID:</h3><span>'.$this->PAGE_ID.'</span>';
		    echo '<h3>TABLE:</h3><span>'.$this->TABLE.'</span>';
		    echo '</div>';
	}

	public function setPage($page)
	{
		$this->PAGE_TITLE = $page[0]->page;
		$this->PAGE_TYPE = $page[0]->type;
	}

	public function buildPage()
	{
		echo '<!DOCTYPE html>
		<html class="js no-touch csstransforms csstransforms3d csstransitions svg js-ready" style="">
    	<head>
			<meta charset="UTF-8">
        	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
        	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        	<title>'.$this->PAGE_TITLE.'</title>';
        	$this->buildScripts();
        	$this->buildStyleSheets();
    	echo '</head>';
    	echo '<body cz-shortcut-listen="true">
				<div id="outer-wrap">
				<div id="inner-wrap">
    			<header id="top" role="banner">
        		<div class="block">
            	<h1 class="block-title">Webáruház</h1>
            	<a class="nav-btn" id="nav-open-btn" href="http://dbushell.github.io/Responsive-Off-Canvas-Menu/step4.html?1#nav">Book Navigation</a>
        		</div>
    			</header>';
    	$this->listNavItems("nav",1);
    	$this->stepsBar();
    	$this->buildContent();
    	echo '</div><!--/#inner-wrap--></div><!--/#outer-wrap-->';
    	echo '</body></html>';
	}

	public function showLogin()
	{
	    if (!$_SESSION['user']->getUserID()) {
	        include('includes/loginForm.php');
	    }else{
	        include('includes/userPanel.php');
	    }
	}

	public function buildContent()
	{
		echo '<div id="main" role="main"><section id="content">';
		
		//$this->listProducts();

		switch ($this->PAGE_TYPE) {
					case 'file':
						include 'includes/'.$this->URL.'.php';
						break;

					case 'menu':
						//Lekérem a táblából
						break;
					
					default:
						# code...
						break;
				}		
		echo '</section>';
		echo '<section id="side-panel">';
		$this->showLogin();
		echo '</section>';
		echo '<div class="cl"></div></div>';
	}

	public function stepsBar()
	{
		 echo '<section id="steps">
        	<ul>
            <li>
                <a href="cart">Kosár tartalma</a>
                <span>A kosár üres</span>
            </li>';
            
            
            if ($_SESSION['user']->getUserID()) {
	            if ($_SESSION['cart']['items']) {
		            echo '<li>
		                <a href="delivery-address">Szállítási cím</a>';
		                if ($_SESSION['delivery-address']) {
		                	echo '<span>Ok</span>';
		                }else{
		                	echo '<span>Kérjük adja meg</span>';
		                }
		            echo '</li>';
	            }
	            
	            if ($_SESSION['deliveryAddress']) {
		            echo '<li>
		                <a href="billing-address">Számlázási cím</a>';
		                if ($_SESSION['billing-address']) {
		                	echo '<span>Ok</span>';
		                }else{
		                	echo '<span>Kérjük adja meg</span>';
		                }
		            echo'</li>';
	            }
	            
	            if ($_SESSION['billingAddress']) {
		           	echo '<li>
		                <a href="payment-method">Fizetési mód</a>';
		               if ($_SESSION['payment-method']) {
		                	echo '<span>Ok</span>';
		                }else{
		                	echo '<span>Kérjük adja meg</span>';
		                }
		             echo'</li>';
	            }
	            
	            if ($_SESSION['paymentMethod']) {
		            echo'<li>
		                <a href="order">Megrendelés</a>
		            </li>';            	
	            }
        	}
        echo'</ul></section>';
	}

	//Menüpontok listázására
	public function listNavItems($id,$position)
	{
		$pdo = myPDO::getPDO();
		$stmt = $pdo->query("SELECT * FROM pages WHERE position = '$position'");
		if ($navItems = $stmt->fetchAll()) {
			echo '<nav id="'.$id.'" role="navigation"><ul>';
			foreach ($navItems as $key => $item) {
				echo '<li class="is-active">
				<a href="'.$item->URL.'">'.$item->page.'</a></li>';
			}
			echo '</ul>
            <a class="close-btn" id="nav-close-btn" href="http://dbushell.github.io/Responsive-Off-Canvas-Menu/step4.html?1#top">Return to Content</a>
    		</nav>';
		}
	}

	public function buildScripts(){
		foreach ($this->SCRIPTS as $key => $file) {
			echo '<script type="text/javascript" src="'.$file.'"></script>';
		}
	}

	public function buildStyleSheets()
	{
		foreach ($this->STYLESHEETS as $key => $file) {
			echo '<link rel="stylesheet" type="text/css" href="'.$file.'">';
		}
	}
}
?>