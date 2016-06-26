<?php

namespace frontend\views\search;
?>
<?php
		// retrieve data in a loop
		echo "<ul>";
		foreach($xml->Items->Item as $item){
			echo "<li><a href =".$item->DetailPageURL.">".$item->ItemAttributes->Title."</a></li>";
		}
		echo "</ul>";
?>