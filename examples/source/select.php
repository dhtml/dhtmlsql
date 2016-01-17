<?php 
require "../../config.default.php";

$result=$db->query('select FirstName,LastName from Employees'); 
while($row=$result->fetch_assoc()) {
	var_dump($row);	
}
?>