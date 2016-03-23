<?php 
require "../../config.default.php";


$db->pquery_all('select * from country');

while($row=$db->fetch_assoc()) {
	var_dump($row);	
}
?>
