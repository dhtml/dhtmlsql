<?php 
require "../../config.default.php";

$rows=$db->query("select * from country limit 0,4")->fetch_assoc_all();
foreach($rows as $row) {
var_dump($row);	
}
?>