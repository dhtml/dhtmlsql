<?php 
require "../../config.default.php";

$db->query("select * from country limit 0,4");
while($row=$db->fetch_assoc()) {
var_dump($row);	
}
?>