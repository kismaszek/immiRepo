<?php
	/**
	* 
	*/
	class html
	{
		
		public static function div($data,$id='',$class='')
		{
			if ($class) {
				$class =' class="'.$class.'"';
			}
			
			if ($id) {
				$id =' id="'.$id.'"';
			}

			echo '<div'.$id.$class.'>'.$data.'</div>';
		}

	

		public static function table($data,$thead='')
		{
			echo '<table border="0" cellpadding="0" cellspacing="0">';
			
			if (is_array($thead)) {			
				echo '<thead><tr>';
					foreach ($thead as $key => $th) {
						echo '<th>'.$th.'</th>';
					}
				echo '</tr></thead>';
			}
			
			if(is_array($data)){
				echo '<tbody>';
				foreach ($data as $key => $tableRow) {
					echo '<tr>';
					foreach ($tableRow as $key => $tableData) {
						echo '<td>'.$tableData.'</td>';
					}
					echo '</tr>';
				}
				echo '</tbody>';
			}
			echo '</table>';
		}
	}
?>