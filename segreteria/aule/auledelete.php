<?php
//funzione per eliminare un aula all interno del database
	include "../../config.php";
	$data = $_GET['name'];
	$connessione = mysql_connect($nomehost,$nomeuser,$psw);
	//mi collego
	mysql_select_db("$db_name",$connessione);  
	$query = "DELETE FROM Aule WHERE Nome ="."'".$data."'";
	$query2 = "ALTER TABLE DisponibilitaAule DROP ".$data;
	$ris = mysql_query($query) ;
	$ris2 = mysql_query($query2);
?>