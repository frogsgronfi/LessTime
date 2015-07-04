<?php
//PAGINA PER SALVARE ALL INTERNO DEL DATABASE I CORSI
include "../../config.php";
if($_POST){
$connessione = mysql_connect($nomehost,$nomeuser,$psw);
mysql_select_db("$db_name",$connessione); 
$query = "SELECT * FROM Corsi";
  $Ncorso = $_POST['Ncorso'];
  $Idcorso = $_POST['Idcorso'];
  $Prof = $_POST['Prof'];
  $Acorso = $_POST['Acorso'];
  $Crediti = $_POST['Crediti'];
  $query = "INSERT into Corsi VALUES ('$Ncorso','$Idcorso','$Prof','$Acorso','0','0-0-0-0-0-','$Crediti','0')";
  $ris = mysql_query($query) or die (mysql_error());
}
  header("location: ../segreteriahome.php");
?>