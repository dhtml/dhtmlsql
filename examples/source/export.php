<?php 
require "../../config.default.php";

$db->export('*','sample.sql');

echo "Export database completed";
?>