<?php 

	/**
	* 
	*/
	class html
	{
		static public function h($level,$data)
		{
			echo '<h'.$level.'>'.$data.'</h'.$level.'>';
		}
	}
?>