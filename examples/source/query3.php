<?php 
require "../../config.default.php";

$db->query("select * from country limit 0,4");
$rows=$db->fetch_assoc_all();
foreach($rows as $row) {
var_dump($row);	
}
?>