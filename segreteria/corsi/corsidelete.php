<?php
//funzione per eliminare un corso dal database
	include "../../config.php";
	$IdCorso = $_GET['name'];
	$query = "SELECT Professore FROM Corsi WHERE IdCorso= "."'".$IdCorso."'";
	$ris2 = mysql_query($query) ;
	$prof = mysql_fetch_row($ris2);
	//elimino il corso da corsi
	$query = "DELETE FROM Corsi WHERE IdCorso= "."'".$IdCorso."'";
	$ris2 = mysql_query($query) ;
	//elimino gli eventuali madatory
	$query5 = "DELETE FROM Mandatory WHERE IdCorso= "."'".$IdCorso."'";
	$ris2 = mysql_query($query5) ;
	//Elimino il corso da disponibilità aule
	$query3 = "DELETE FROM DisponibilitaAule WHERE IdCorso ="."'".$IdCorso."'";
	$ris3 = mysql_query($query3) ;
	//Vededo quanti corsi ha ancora quel professore
	$query4= "SELECT COUNT(*) FROM Corsi WHERE Professore="."'".$prof[0]."'";
	$ris = mysql_query($query4);
	$riga4 = mysql_fetch_row($ris);
	//Se il professore non ha piu corsi elimino la tabella a lui relativa
	if($riga4[0] == 0){
	$ris3 = mysql_query("DROP TABLE ".$prof[0]);
	}
	mysql_close($connesisone);
?>