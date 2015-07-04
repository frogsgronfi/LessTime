<!--PAGINA RELATIVA ALLA GESTIONE DEI VINCOLI OBBLIGATORI LATO PROFESSORE-->
<html>
<head> 
 <link href="../stile.css" rel="stylesheet" type="text/css">
</head>
<?php
include "../config.php";
if($_POST){
  //se voglio cancellare i mandatory
  if($_POST['mod'] == "delete"){
    $query = "DELETE FROM Mandatory WHERE IdCorso="."\"".$_POST['idcorso']."\"";
    $ris = mysql_query($query) or die (mysql_error());
  }
  else{
    $idcorso = $_POST['name'];//qui ho l'id del corso
    $query5 = "SELECT * FROM ImpOrario";
    $ris5 = mysql_query($query5) or die (mysql_error());
    $riga5 = mysql_fetch_assoc($ris5);
    $maxb = $riga5['maxb'];
    $nrslots = $riga5['slots_per_day'];
    if($_POST['mode'] == 0){
    if( isset($_POST['aule1']) ){
      //elimino i vecchi mandatory per inserire i nuovi
      $query = "DELETE FROM Mandatory WHERE IdCorso="."\"".$idcorso."\"";
      $ris = mysql_query($query) or die (mysql_error());
    }
      for ($i=1;$i<=$maxb;$i++){
        $aule = "aule".$i;
        if($_POST[$aule] != NULL){
            $giorni = "giorni".$i;
            $blocco = "blocco".$i;
            $ore = "ore".$i;
            //inserisco all'interno della tabella mandatory
            $query5 = "INSERT INTO Mandatory VALUES('".$idcorso."','".$_POST[$aule]."','".$_POST[$giorni]."',".$_POST[$blocco].",".$_POST[$ore].",'0');";
            $ris5 = mysql_query($query5) or die (mysql_error());
        }
      }
    }
    //Visualizzo la tabella mandatory
    $query = "SELECT * FROM Mandatory WHERE idCorso ="."'".$idcorso."'";
    $ris = mysql_query($query) or die (mysql_error());
    if(mysql_num_rows($ris) != 0){
      $return = "<div id='rmandatory'>";
      $return = $return."<h3>Obbligatori</h3><table><th>Corso</th><th>Aula</th><th>Giorno</th><th>Slot</th><th>Orainizio</th>";
    while ($riga = mysql_fetch_assoc($ris)){
      $return = $return."<tr><td>".$riga['IdCorso']."</td><td>".$riga['Aule']."</td><td>".$riga['Giorno']."</td><td>".$riga['Blocco']."</td><td>".$riga['InitSlot']."</td></tr>";
    }
     $return = $return."</table></div>";
    }
    else{
       $return = $return."<h3 id='pres'>Obbligatori</h3>";
    }
}
}
//$return contiene l'html che verrà inviato alla funzione ajax
$return=$return."<div class='mandatorydiv' id='mandatorydiv'><form><input type='text' name='name' value=".$idcorso." hidden><table><th>Sessione</th><th>Aula</th><th>Giorno</th><th>Ora</th>";
  $query4 = "SELECT Blocchi FROM Corsi WHERE IdCorso="."'".$idcorso."'";
  $ris4 = mysql_query($query4) or die (mysql_error());
  $riga4 = mysql_fetch_assoc($ris4);
  $blocchi = str_replace("-", "",$riga4['Blocchi']);
  for($i=0;$i<$maxb;$i++){
  	if($blocchi[$i] != 0){
  		$z = $i+1;
        $return = $return."<tr><td><input type='text' name='blocco".$z."' value=".$z." size = '1' readonly></td><td><select name='aule".$z."' id='aule' class='aule'>";
      $query = "SELECT Nome FROM Aule";
      $ris = mysql_query($query) ;//or die (mysql_error());
      while($riga = mysql_fetch_assoc($ris)){
        $query = "SELECT ".$riga['Nome']." FROM DisponibilitaAule WHERE IdCorso="."'".$idcorso."'";
        $ris2 = mysql_query($query);
        $riga2 = mysql_fetch_row($ris2);
        if($riga2[0] == 1){
          $return = $return."<option value=".$riga['Nome'].">".$riga['Nome']."</option>";
        }
      }
      $return = $return."</select></td><td><select name='giorni".$z."' id='giorni' class='giorni".$z."'><option value='LUN'>LUN</option><option value='MAR'>MAR</option><option value='MER'>MER</option><option value='GIO'>GIO</option><option value='VEN'>VEN</option></select></td><td><select name='ore".$z."' id='ore' class='ore'>";
  		for($j=1;$j<=$nrslots;$j++){
        $return = $return."<option value='$j'>".$j."</option>";
  		}
      $return = $return."</select>";
  	}
    $return = $return."</tr>";
  }
  $return = $return."</table><table><tr><td><input type='button' id='mandatorybut' value='Salva' onclick ='mandatory(0)'></td></tr><tr><td><input type='button' id='deletebut' onclick='deletemandatory()' value='Elimina'></td></tr></table></form></div>";
  echo $return;
?>
<script type="text/javascript">
//funzione per memorizzare mandatory
function mandatory(mode){
    var idcorso = $("#idcorso").val();
    var error = 0;
    if(mode == 0){
      var data = $("form").serialize();
      var idcorso = $("#idcorso").val();
      var z = $("select[name^='giorni']");
      var value = 0;
      for(var y=1;y<=z.length;y++){
        for(var i=1;i<=z.length;i++){
          if($("select[name^='giorni"+y+"']").val() == $("select[name^='giorni"+i+"']").val()){
            value++;
          }
        }
      }
      if(value != z.length ){
        alert("devi inserire per ogni sessione un giorno diverso");
        error = error + 1 ;
      }
    }
    if(error == 0){
      $.ajax({
        type: "POST",
          url: "professoremandatory.php",
          data : data+"&name="+idcorso+"&mode="+mode,
          dataType: "html",
          success: function(msg)
          {
           $('#mandatory').html(msg);

          },
          error: function(msg)
          {
          alert("Chiamata fallita, si prega di riprovare...");
          }
       });
    }
  }
//funzione per eliminare i vincoli mandatory
function deletemandatory(){
    var idcorso = $("#idcorso").val();
      $.ajax({
        type: "POST",
          url: "professoremandatory.php",
          data : "mod=delete&idcorso=" + idcorso,
          dataType: "html",
          success: function(msg)
          {
           alert("cancellazione avvenuta con successo");
           $('#rmandatory').html("<h3>Preschedule</h3>");
          },
          error: function(msg)
          {
          alert("Chiamata fallita, si prega di riprovare...");
          }
});
    }
    </script>
</html>