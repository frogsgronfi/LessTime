<!--PAGINA RELATIVA ALLA CREAZIONE DELLA TABELLA PER L'ORARIO PROFESSORE -->
<link href="../stile.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../libraries/wSelect-master/wSelect.js"></script>
<?php
include "../config.php";
$data = $_GET['name'];//qui ho l'id del corso
$connessione = mysql_connect($nomehost,$nomeuser,$psw);
mysql_select_db("$db_name",$connessione);    
$query13 = "SELECT * FROM Corsi WHERE IdCorso = "."'".$data."'";
$ris13 = mysql_query($query13); //or die (mysql_error());
$riga13 = mysql_fetch_assoc($ris13);
$professore = $riga13['Professore'];
$crediti = $riga13['Crediti'];
$annocorso = $riga13['AnnoCorso'];
$query = "SHOW TABLES LIKE "."'".$professore."'";
$ris = mysql_query($query) or die (mysql_error());
$riga = mysql_fetch_row($ris);
$query11 = "SELECT slots_per_day FROM ImpOrario";
$ris11 = mysql_query($query11) or die (mysql_error());
$riga11 = mysql_fetch_row($ris11);
//la tabella esiste gia nel database quindi bisogna caricarla
if($riga['0'] != NULL){
	$result = creatabella($data,$crediti,$annocorso);
	$giorni = array("LUN","MAR","MER","GIO","VEN");
		$query3 = "SELECT LUN,MAR,MER,GIO,VEN FROM "."`".$professore."`";
		$ris3 = mysql_query($query3) or die (mysql_error());
		for ($z = 0; $z < $riga11['0']; $z++) {
			$riga3 = mysql_fetch_row($ris3);
			for ($i = 0; $i < 5; $i++) {
				$index = $giorni[$i].$z;
				if($riga3[$i] == 1){
					$result = $result."<script language=\"JavaScript\">\n"; 
					$result = $result."var x = document.getElementsByName("."'".$index."'".");x[0].style.backgroundColor='LimeGreen';x[0].selectedIndex ='1' "; 
					$result = $result."</script>";
				}
				if($riga3[$i] == 0.5){
					$result = $result."<script language=\"JavaScript\">\n"; 
					$result = $result."var x = document.getElementsByName("."'".$index."'".");x[0].style.backgroundColor='#FEF002';x[0].selectedIndex ='3'"; 
					$result = $result."</script>";
				}
				if($riga3[$i] == 0.75){ 
					$result = $result."<script language=\"JavaScript\">\n"; 
					$result = $result."var x = document.getElementsByName("."'".$index."'".");x[0].style.backgroundColor='#00FFE5';x[0].selectedIndex ='2'"; 
					$result = $result."</script>";
				}
				if($riga3[$i] == 0){
					$result = $result."<script language=\"JavaScript\">\n"; 
					$result = $result."var x = document.getElementsByName("."'".$index."'".");x[0].style.backgroundColor='red';x[0].selectedIndex ='0'"; 
					$result = $result."</script>";
				}
				if($riga3[$i] == 0.25){
					$result = $result."<script language=\"JavaScript\">\n"; 
					$result = $result."var x = document.getElementsByName("."'".$index."'".");x[0].style.backgroundColor='#FD9602';x[0].selectedIndex ='4'"; 
					$result = $result."</script>";
				}
			}
		}
		echo $result;
	}
else{
	//la tabella non esiste bisogna farla ex novo
	echo creatabella($data,$crediti,$annocorso);
}
//Funzione che crea la tabella per il professore
function creatabella($idcorso,$crediti,$annocorso){
	$query = "SELECT * FROM ImpOrario";
	$ris = mysql_query($query) or die (mysql_error());
	$riga = mysql_fetch_assoc($ris);
	$maxb = $riga['maxb'];
	$maxslotsday = $riga['max_slots_per_day'];
	$slotsday = $riga['slots_per_day'];
	$query3 = "SELECT OreSett FROM Corsi WHERE IdCorso="."'".$idcorso."'";
	$ris3 = mysql_query($query3) or die (mysql_error());
	$riga3 = mysql_fetch_assoc($ris3);
	$query4 = "SELECT Blocchi FROM Corsi WHERE IdCorso="."'".$idcorso."'";
	$ris4 = mysql_query($query4) or die (mysql_error());
	$riga4 = mysql_fetch_assoc($ris4);
	$blocchi = str_replace("-", "",$riga4['Blocchi']);
	if ($riga3['OreSett'] == 0){
		$oresett = "";
	}
	else
		$oresett = $riga3['OreSett'];
	$tabella = "<h3>Impostazioni Corso</h3>";
	$tabella = $tabella."<form><table><tr><td><input type = 'text' style='border : 0px none; font-size:20px; margin-top:-7px; ' readonly= 'readonly' id ='idcorso' name='idcorso' value=".$idcorso."></td></tr><tr><td>Ore Settimanali</td><td><input type = 'text' name='oresett' id='oresett' size='2' style='margin-left:-94px' maxlength = '2' value=".$oresett."></td><td><div id='oresetts' class='error' hidden style='margin-left : 14px;'>Devi inserire le ore settimanali</div></td></tr></table>";
	$tabella = $tabella."<table><tr><td>Suddivisione in Sessioni</td>";
	for($i=0;$i<$maxb;$i++){
		$z = $i+1;
		$tabella = $tabella."<td><input type = 'text' name=block".$z." id=block".$z." value=".$blocchi[$i]." maxlength ='1' size='1'></td>";
	}
	$tabella = $tabella."<td><div id='block' class='error' hidden>errore</div></td></tr></table><h3>PreferenzeOrario</h3><div id='orariotab'><table id='taborarioprof'><tr><td class='Ptable'>Ore</td>";
	$giorni = array("LUN","MAR","MER","GIO","VEN");
	for($i=0;$i<count($giorni);$i++){
	$tabella = $tabella."<td class = 'Ptable' name=".$giorni[$i]." onmouseover= 'colonnaover(\"".$giorni[$i]."\")' onmouseout = 'colonnaout(\"".$giorni[$i]."\")'>".$giorni[$i]."<select id=".$giorni[$i]." onchange='colselectall(\"".$giorni[$i]."\")'><option data-icon='/img/red.png' value='0' onclick='colselectall(\"".$giorni[$i]."\")'></option><option option data-icon='/img/green.png' onclick='colselectall(\"".$giorni[$i]."\")' value='1'></option><option option data-icon='/img/cyan.png' onclick='colselectall(\"".$giorni[$i]."\")' value='0.75'></option><option option data-icon='/img/yellow.png' onclick='colselectall(\"".$giorni[$i]."\")' value=0.5></option><option option data-icon='/img/orange.png' onclick='colselectall(\"".$giorni[$i]."\")' value='0.25'></option></select></td>";
	}
	$ore = array("8:30-9:30","9:30-10:30","10:30-11:30","11:30-12:30","12:30-13:30","13:30-14:30","14:30-15:30","15:30-16:30","16:30-17:30","17:30-18:30","18:30-19:30","19:30-20:30");
	for($i=0;$i<$slotsday;$i++){
		$tabella = $tabella."</tr><tr><td id=".$i." class = 'Ptable' onmouseover='rigaover(\"".$i."\")' onmouseout='rigaout(\"".$i."\")'>".$ore[$i]."<select id=idsel".$i." onchange='selectallrow(\"".$i."\")'><option value='0' data-icon='/img/red.png' ></option><option value='1' data-icon='/img/green.png' ></option><option value='0.75' data-icon='/img/cyan.png' ></option><option value=0.5 data-icon='/img/yellow.png'></option><option value='0.25' data-icon='/img/orange.png'></option></select></td>";
		for($j=0;$j<5;$j++){
			$tabella = $tabella."<td class='Ptable' id=".$i." name=".$giorni[$j]."><select class =".$i." name=".$giorni[$j].$i." id=".$giorni[$j].$i."><option value='0' data-icon='/img/red.png' onclick='scolorselect(\"".$giorni[$j].$i."\")'></option><option value='1' data-icon='/img/green.png' onclick='scolorselect(\"".$giorni[$j].$i."\")'></option><option value='0.75'data-icon='/img/cyan.png' onclick='scolorselect(\"".$giorni[$j].$i."\")'></option><option value=0.5 data-icon='/img/yellow.png' onclick='scolorselect(\"".$giorni[$j].$i."\")'></option><option value='0.25' data-icon='/img/orange.png' onclick='scolorselect(\"".$giorni[$j].$i."\")'></option></select></td>";
		}
		$tabella = $tabella."</tr>";
	}
	$tabella = $tabella."</table></div><input type='button' id='botprof' value='Salva' onclick='invia()'></form>";
	return $tabella;
}
?>
<script type="text/javascript">
$('select').wSelect();
</script>