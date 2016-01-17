<?php 
require "../../config.default.php";

/*
When there is no username matching support or email matching support@africoders.com the first array will
get inserted just like insert3.php without the ignore parameter.
However, if the entry exists, the second array will be used to replace it. In short, this will give you something like this:
insert into mails(username,email) values('support','support@africoders.com') on duplicate key update username='admin',email='tony@africoders.com';
*/
$db->insert(
	'mails',
	array(
		'username' => 'support',
		'email' => 'support@africoders.com',
	),
	array(
		'username' => 'tony',
		'email' => 'tony@africoders.com',
	)

);

echo "Entry made successfully";
?>