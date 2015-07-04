<!--PAGINA RELATIVA ALLA MEMORIZZAZIONE DEI DAI DELL ORARIO NEL DATABASE -->
<?php
include "../../config.php";
$aule = array();
$numbl = $_POST['numbl'];
$cslot = $_POST['cslot'];
$dslot = $_POST['dslot']; 
//effettuo la connessione al database
$connessione = mysql_connect($nomehost,$nomeuser,$psw);
//mi collego
mysql_select_db("$db_name",$connessione);  
//inserisco i dati all interno del database
$query4 = "UPDATE ImpOrario SET maxb = "."'".$numbl."'".",  max_slots_per_day ="."'".$cslot."'".", slots_per_day ="."'".$dslot."'"."WHERE id = 0";
echo $query4;
$ris4 = mysql_query($query4) or die (mysql_error());
$query = "SELECT * FROM Corsi";
$query2 = "SELECT Nome FROM Aule";
$ris = mysql_query($query) or die (mysql_error());
$ris2 = mysql_query($query2) or die (mysql_error());
$ris3 = mysql_query($query2) or die (mysql_error());
$nraule = mysql_num_rows($ris2);
$ris4 = mysql_query($query2);
while ($riga4 = mysql_fetch_row($ris4)){
	array_push($aule,$riga4[0]); 
}
//inizializzo la tabella disponibilità aule aggiungendo le aule 
while($riga2 = mysql_fetch_assoc($ris)){
	$query4 = "INSERT INTO DisponibilitaAule(IdCorso) VALUES("."'".$riga2['IdCorso']."'".")";
	mysql_query($query4); //or die (mysql_error());
	for ($i = 0; $i < $nraule; $i++) {
			$index = $riga2['IdCorso']."_".$aule[$i];
			$prova = $_POST["$index"];
			if($prova == "on"){
				$querty = "UPDATE DisponibilitaAule SET ".$aule[$i]."=1 WHERE IdCorso = "."'".$riga2['IdCorso']."'";
				mysql_query($querty) ;
			}
			else{
				$querty = "UPDATE DisponibilitaAule SET ".$aule[$i]."=0 WHERE IdCorso = "."'".$riga2['IdCorso']."'";
				mysql_query($querty) ;
			}
	}	
}
header("location: ../segreteriahome.php");
?>