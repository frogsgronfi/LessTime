<!--PAGINA RELATIVA AI VINCOLI MANDATORY LATO SEGRETERIA -->
<html>
<head> 
 <link href="../stile.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/libraries/jquery-2.1.4.min.js"/></script> 
</head>
<?php
include "../config.php";
if($_GET){
  //quanndo elimino un vincolo
  if($_GET['mod'] == "delete"){
    $query = "DELETE FROM Mandatory WHERE IdCorso="."\"".$_GET['idcorso']."\" AND Giorno="."\"".$_GET['giorno']."\"";
    $ris = mysql_query($query) or die (mysql_error());
  }
  //quando aggiungoun vincolo
  else if($_GET['mod'] == "adddelete"){
    if($_GET['status'] == 0)
      $query = "UPDATE Mandatory SET Selected='1' WHERE IdCorso="."\"".$_GET['idcorso']."\" AND Giorno="."\"".$_GET['giorno']."\"";
    else
       $query = "UPDATE Mandatory SET Selected='0' WHERE IdCorso="."\"".$_GET['idcorso']."\" AND Giorno="."\"".$_GET['giorno']."\"";
    $ris = mysql_query($query) or die (mysql_error());
  }
}
//Visualizzazione dei vincoli mandatory
$query = "SELECT * FROM Mandatory";
$ris = mysql_query($query) or die (mysql_error());
if(mysql_num_rows($ris) > 0){
  echo "<h3>Obbligatori</h3>";
  echo "<div id='smandatory'>";
  echo "<table>";
  echo "<th></th><th>Id</th><th>Aula</th><th>Gio</th><th>Slot</th>";
  while($riga = mysql_fetch_assoc($ris)){
    if($riga['Selected']==0)
      echo "<tr><td><input type = 'checkbox' onclick='adddelete(\"".$riga['IdCorso']."\",\"".$riga['Giorno']."\",0)'></td><td>".$riga['IdCorso']."</td><td>".$riga['Aule']."</td><td>".$riga['Giorno']."</td><td>".$riga['blocco']."</td><td>".$riga['InitSlot']."</td><td><input type = 'image' src='/img/trash.png' height='22' width='22' onclick='elimina(\"".$riga['IdCorso']."\",\"".$riga['Giorno']."\")'></td></tr>";
    else
      echo "<tr><td><input type = 'checkbox' checked onclick='adddelete(\"".$riga['IdCorso']."\",\"".$riga['Giorno']."\",1)'></td><td>".$riga['IdCorso']."</td><td>".$riga['Aule']."</td><td>".$riga['Giorno']."</td><td>".$riga['blocco']."</td><td>".$riga['InitSlot']."</td><td><input type = 'image' src='/img/trash.png' height='22' width='22' onclick='elimina(\"".$riga['IdCorso']."\",\"".$riga['Giorno']."\")'></td></tr>";
  }
  echo "</table></div>";
}
else{
  echo "<h3>Obbligatori</h3>";
  echo "<h3>Nono sono stati inseriti obbligatori</h3>";
}
?>

<script type="text/javascript">
//funzione che elimina i vincoli mandatory
 function elimina(idcorso,giorno) {
  $.ajax({
    url : "mandatoryseg.php",
    data : "mod=delete&idcorso="+idcorso+"&giorno="+giorno,
    success : function (data) {
        alert("cancellazione avvenuta con successo");
        $('#infodiv').load("orarioview.php");
         $('#insertdiv').load("mandatoryseg.php");
    },
    error : function (richiesta,stato,errori) {
        alert("E' evvenuto un errore. Il stato della chiamata: "+stato);
    }
});
 }
 //funzione che regola le checkbox
 function adddelete(idcorso,giorno,status) {
  $.ajax({
    url : "mandatoryseg.php",
    data : "mod=adddelete&idcorso="+idcorso+"&giorno="+giorno+"&status="+status,
    success : function (data) {
        $('#infodiv').load("orarioview.php");
         $('#insertdiv').load("mandatoryseg.php");
    },
    error : function (richiesta,stato,errori) {
        alert("E' evvenuto un errore. Il stato della chiamata: "+stato);
    }
});
 }
</script>
</html>