<?php 
require "../../config.default.php";


$db->pquery('select * from country',5,'page');

while($row=$db->fetch_assoc()) {
	var_dump($row);	
}

if($db->num_rows>0) {
	echo $db->show_navigation();
}
?>
