<?php 
require "../../config.default.php";

//checks for table existence and creates the table if it does not exist
if(!$db->table_exists("clients")) {
			$sql="CREATE TABLE IF NOT EXISTS `clients` (
			`vid` varchar(255) NOT NULL,
			`name` varchar(128) NOT NULL,
			`value` longtext NOT NULL,
			`scope` varchar(255) NOT NULL
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;
			";
			$db->query($sql);
			$db->query("ALTER TABLE `clients`
			ADD UNIQUE KEY `vid` (`vid`);");
           echo "clients table created <br/>";
} else {
         echo "clients table already exists <br/>";	
}

?>