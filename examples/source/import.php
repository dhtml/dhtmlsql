<?php 
require "../../config.default.php";

$result=$db->import("sample.sql");

if($result) {
echo "Database import was completed";	
} else {
echo "Unable to import database";	
}
?>