<?php 
require "../../config.default.php";

//do bulk insertion
$db->insert_bulk(
	'users',
	array('first', 'last'),
	array(
		array('Owen', 'David'),
		array('Mathew', 'Randel'),
		array('San', 'Andy'),
	)
);

echo "Entries made successfully";
?>