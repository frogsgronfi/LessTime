<!--PAGINA CHE SI OCCUPA DELLA VIEW DI ORARIO-->
<html>
 <head>
  <link href="../../stile.css" rel="stylesheet" type="text/css">
 </head>
<body>
<div class ='firsttableorario'>
<form id="orario">
<table id='firsttable'>
<?php
include "../../config.php";
session_start();
$_SESSION['status'] = 1;
if(isset($_SESSION['comp']))
  $comp = $_SESSION['comp'];
else
  $comp = 0;
$aule = array();
$query = "SELECT * FROM ImpOrario";
$ris = mysql_query($query);
$riga2 = mysql_fetch_assoc($ris);
echo "<h3>Impostazioni orario</h3>";
echo "<tr><td>Numero massimo di blocchi</td><td><input type='text' maxlength='2' size='2' id = 'numbl' name='numbl' value="."'".$riga2['maxb']."'"."></td><td><div id='ernumbl' class='error' hidden>Inserire un numero > 0 </div></td></tr>";
echo "<tr><td>Numero massimo di slot consecutivi</td><td><input type='text' size='2' maxlength='2' id='cslot' name='cslot' value="."'".$riga2['max_slots_per_day']."'"."></td><td><div id='ercslot' class='error' hidden>Inserire un numero > 0 </div></td></tr>";
echo "<tr><td>Numero massimo di slot in un giorno</td><td><input type='text' size='2' maxlength='2' id='dslot' name='dslot' value="."'".$riga2['slots_per_day']."'"."></td><td><div id='erdslot' class='error' hidden>Inserire un numero > 0 </div></td></tr>";
echo "</table>"; 
$query2 ="SELECT COUNT(*) FROM Corsi ";
$ris = mysql_query($query2);
$countc = mysql_fetch_row($ris)[0];
$query2= "SELECT Status, COUNT(*) FROM Corsi group by Status";
$ris = mysql_query($query2);
while($riga2 = mysql_fetch_row($ris)){
	if ($riga2[0] == 1 && $riga2[1] == $countc && $comp == 0){
        echo "<script language=\"JavaScript\">\n"; 
        echo "document.getElementById('calcolaorariob').disabled=false;"; 
        echo "document.getElementById('calcolaorariom').disabled=false;"; 
        echo "</script>"; 
     }
}
$query = "SELECT * FROM Corsi";
$query2 = "SELECT * FROM Aule";
$ris = mysql_query($query) or die (mysql_error());
$ris2 = mysql_query($query2) or die (mysql_error());
$ris4 = mysql_query($query2) or die (mysql_error());
$count = mysql_num_rows($ris2);
//se c'è almeno un corso
if($countc != 0){
  echo "<h3>Corsi-Aule</h3>";
  echo "<div id='tabellacoraule'>";
	echo "<table><tr><td id='Ncorso'>Corsi</td><td id='Ncorso'></td>";
	//stampo elenco delle aule
	while($riga2 = mysql_fetch_assoc($ris2)){
		$aula = $riga2['Nome'];
		echo "<td id='Ncorso' name=".$aula." onmouseover='colonnaover(\"".$aula."\")' onmouseout='colonnaout(\"".$aula."\")'>".$aula."<input type='button' class = 'selectall' onclick='colselectall(\"".$aula."\")'></td>";
	}
	echo "</tr>";
	while($riga = mysql_fetch_assoc($ris)){
		$nomecorso = $riga['NomeCorso'];
		$IdCorso = $riga['IdCorso'];
		$status = $riga['Status'];
		echo "<tr id='Ncorso' id=".$IdCorso."><td id=".$IdCorso." onmouseover='rigaover(\"".$IdCorso."\")' onmouseout='rigaout(\"".$IdCorso."\")'>".$nomecorso."(".$IdCorso.")"."</td><td><input type='button' class= 'selectall' onclick='rowselectall(\"".$IdCorso."\")'></td>";
		$ris4 = mysql_query($query2) or die (mysql_error());
		while($riga4 = mysql_fetch_array($ris4)){
			$aula = $riga4['Nome'];
    		echo "<td name=".$aula." id=".$IdCorso."><input type = 'checkbox' class = ".$IdCorso." name=".$IdCorso."_".$aula."></td>";
		}
	if($status == 0)
			echo "<td id='tdwhite'><img src='/img/rossosemaforo.png' height='22' width='22'></td>";
	if($status == 1)
			echo "<td id='tdwhite'><img src='/img/verdesemaforo.png' height='22' width='22'></td>";
	echo "</tr>";
	}
echo "</tr></table></div></form></div>";
echo "<div class = 'calcolaorariodiv' id = 'calcolaorariodiv'>
    <input type='button' value ='Calcola Ottimo' disabled id='calcolaorariob' class='calcolaorariob' onclick='calcolaorario(1)'><input type='button' value ='Calcola SAT' disabled id='calcolaorariom' class='calcolaorariom' onclick='calcolaorario(0)'></div>";
echo "<div class = 'salvaorariodiv' id = 'salvaorariodiv'>
    <input type = 'button' value='Salva' id='bottono'></div>";

$query6 = "SELECT Nome FROM Aule";
$ris6 = mysql_query($query2);
//metto il primo elemento a zero per una questione di indici delle aule
array_push($aule,0);
while ($riga6 = mysql_fetch_row($ris6)){
	array_push($aule,$riga6[0]); 
}
//prelevo dal database i dati che sono stati gia inseriti
$query3 = "SELECT * FROM DisponibilitaAule";
$ris3 = mysql_query($query3);
while($riga3 = mysql_fetch_assoc($ris3)){
	for ($i = 1; $i <= $count; $i++) {
		$index = $riga3['IdCorso']."_".$aule[$i];
		if($riga3[$aule[$i]] == 0){
			echo "<script language=\"JavaScript\">\n"; 
			echo "var x = document.getElementsByName("."'".$index."'".");x[0].checked= false"; 
			echo "</script>"; 
		}
		else{
			echo "<script language=\"JavaScript\">\n"; 
			echo "var x = document.getElementsByName("."'".$index."'".");x[0].checked= true"; 
			echo "</script>"; 
		}
	}
}
}
else
	echo "<tr><td><input type = 'button' value='salva' id='bottono'></td></tr></table></div></form>";
?>
</body>

<script type="text/javascript">
//funzione che inivia i dati a orariodb per memorizzarli
$(document).ready(function() {
  $("#bottono").click(function(){
    var error = 0;
    $("#numbl").css({'border': '1px solid #000000'});
    $("#cslot").css({'border': '1px solid #000000'});
    $("#dslot").css({'border': '1px solid #000000'});
    $("#ernumbl").hide();
    $("#ercslot").hide();
    $("#erdslot").hide();
    
    if ( $("#numbl").val() == 0 || isNaN($("#numbl").val()) ){
        error = error + 1;
        $("#numbl").css({'border': '1px solid #cc0000'});
        $("#ernumbl").show();
    }
    if ( $("#cslot").val() == 0 || isNaN($("#cslot").val()) ){
        error = error + 1;
        $("#cslot").css({'border': '1px solid #cc0000'});
        $("#ercslot").show();
    }
    if ( $("#dslot").val() == 0 || isNaN($("#dslot").val()) ){
        error = error + 1;
        $("#dslot").css({'border': '1px solid #cc0000'});
        $("#erdslot").show();
    }
    if(error == 0){
        //Per inviare i dati a orariodb.php che ne fa la computazione
        var data = $("form").serialize();
        $.ajax({
          type: "POST",
          url: "orario/orariodb.php",
          data : data,
          dataType: "html",
          success: function(msg)
          {
           alert("Inserimento avvenuto con successo");
          },
          error: function()
          {
          alert("Chiamata fallita, si prega di riprovare...");
          }
       });
    }
    });
   });
 </script>
</html>