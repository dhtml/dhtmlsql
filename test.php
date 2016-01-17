<?php 
require "config.default.php";

echo $db->host_info;

$db->query("show tables");
echo $db->host_info;
var_dump($db->fetch_assoc_all());

?>