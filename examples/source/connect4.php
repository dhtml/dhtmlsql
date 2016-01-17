<?php 
$mysqli = @new mysqli('localhost','admin','pass','dbtest');

require "../../dhtmlsql.php";


$db=DHTMLSQL::get()->connect($mysqli);

if(!$db->connected()) {
exit("Unable to connect to database");
}

//Sets MySQL character set and collation
$db->set_charset('utf8','utf8_general_ci');

echo "Database connection was successful<br/><br/>";
?>