<?php 
require "../../config.default.php";

$result=$db->query("select * from country limit 0,4");
while($row=$result->fetch_assoc()) {
var_dump($row);	
}

?>