<?php 
require "../../config.default.php";


//running this query the first time will work - but subsequently there will be errors of duplicate key
$db->insert(
	'mails',
	array(
		'username' => 'support',
		'email' => 'support@africoders.com',
	),true
);

echo "Entry made successfully";
?>