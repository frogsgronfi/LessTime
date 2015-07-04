<?php
//funzione per inserire un aula all interno del database
if($_POST){
include "../../config.php";
//effettuo la connessione al database
$connessione = mysql_connect($nomehost,$nomeuser,$psw);
//mi collego
mysql_select_db("$db_name",$connessione);  
$query = "SELECT * FROM Aule";
  $Nome = $_POST['Nome'];
  $Ubicazione = $_POST['Ubicazione'];
  $Capienza = $_POST['Capienza'];
  $query = "INSERT into Aule VALUES ('$Nome','$Ubicazione','$Capienza')";
  $ris = mysql_query($query) or die (mysql_error());
  //inserisco l'aula anche in DisponibilitàAule
  $query3 = "ALTER TABLE DisponibilitaAule ADD ".$Nome." INT(3)";
  $ris = mysql_query($query3) or die(mysql_error());
}
?>