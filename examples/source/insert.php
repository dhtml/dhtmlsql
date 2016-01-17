<?php 
require "../../config.default.php";

//regular insertion
$db->insert(
	'users',
	array(
		'first' => 'Stanley',
		'last' => 'J.',
	),true
);

echo "Stanley was inserted successfully into the users table with an insertion ID of ". $db->insert_id();
?>