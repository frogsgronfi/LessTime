<?php
//file contenente la configurazione per l'accesso al database
	$nomehost = "localhost"; 
	$nomeuser = "root";
	$psw = "vincenzotesi";
	$db_name = "Tesi";
	$connessione = mysql_connect($nomehost,$nomeuser,$psw);
	mysql_select_db("$db_name",$connessione);
?>