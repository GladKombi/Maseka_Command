<?php
try {
session_start();	
$connexion=new PDO('mysql:dbname=maseka_command; host=localhost', 'root', '');
} catch (Exception $e) {
	echo $e;
	
}

?>