<?php 
/*
This is a basic database connection script using DHTMLSQL
*/
require "dhtmlsql.php";

// Connection data (server_address, database, name, poassword)
$db=DHTMLSQL::get()->connect('localhost','admin','pass','dbtest');

//confirm database connection
if(!$db->connected()) {
exit("Unable to connect to database. Reason: ".$db->connect_error());
}

//Sets MySQL character set and collation
$db->set_charset('utf8','utf8_general_ci');
?>