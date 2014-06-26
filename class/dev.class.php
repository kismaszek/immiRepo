<?php 
	class dev
	{
		
		function __construct()
		{
			$this->showInfo();
		}

		public function showInfo()
		{
			echo'<div id="dev">
		    <div id="dev-header">
		        <h1>Fejlesztés panel</h1>
		    </div>
		    <div id="dev-content">';
		    $this->showInfoBox('Kosár',$_SESSION['cart']);
		    $this->showInfoBox('User',$_SESSION['user']);
		    $this->showInfoBox('Session',$_SESSION);
		    $GLOBALS['page']->getPageInfo();
		    $this->showInfoBox('Post',$_POST);
		    echo '</div></div>';
		}

		public function showInfoBox($label,$data)
		{
			echo '<div class="dev-box">';
		    echo '<h2>'.$label.'</h2>';
			echo '<PRE>';
		    print_r($data);
		    echo '</PRE>';
		    echo '</div>';
		}
	}
?>