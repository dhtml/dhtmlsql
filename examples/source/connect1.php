<?php 
require "../../dhtmlsql.php";

// Connection data (server_address, database, name, poassword)
$dbhost = 'localhost';
$dbname = 'dbtest';
$dbuser = 'admin';
$dbpass = 'pass';


$db=new DHTMLSQL();

//attempt connection to database
$db->connect($dbhost,$dbuser,$dbpass,$dbname);

//testing for connection to database
if(!$db->connected()) {
exit("Unable to connect to database");
}

//Sets MySQL character set and collation
$db->set_charset('utf8','utf8_general_ci');

echo "Database connection was successful<br/><br/>";

?>