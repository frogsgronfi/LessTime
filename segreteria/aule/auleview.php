<!--PAGINA RELATIVA ALLA View PER LE AULE -->
<html>
<head> 
</head>
<body>
<?php
include "../../config.php";
session_start();
$_SESSION['status'] = 2;
//-----CONNESSIONE AL DATABASE-----
$connessione = mysql_connect($nomehost,$nomeuser,$psw);
mysql_select_db("$db_name",$connessione);  
$query = "SELECT * FROM Aule";
$ris = mysql_query($query) or die (mysql_error());
if(mysql_num_rows($ris) == 0){
    echo "<h3> Aule</h3>";
    echo "<h3> Nel database non sono presenti Aule</h3>";
}
else{
echo "<h3> Aule</h3>";
echo "<div id='tabellaule'>";
echo "<table class='tableorario' id='tableorarioaule'>";
echo "<tr><th>Nome</th><th>Ubicazione</th><th>Capienza</th></tr>";
$color = 0;
while($riga = mysql_fetch_assoc($ris)){
    if($color % 2 == 0){
        echo "<tr class='odd'><td> ".$riga['Nome']."</td><td>".$riga['Ubicazione']."</td><td>".$riga['Capienza']."</td>";
        $color = $color + 1;
    }
    else{
         echo "<tr><td> ".$riga['Nome']."</td><td>".$riga['Ubicazione']."</td><td>".$riga['Capienza']."</td>";
           $color = $color + 1;
        }
	echo "<td><input type = 'image' src='/img/trash.png' height='22' width='22' onclick='elimina(\"".$riga['Nome']."\")'></td></tr>";
} 
echo "</table></div>";
}
?>
<!--Funzione per effettuare l'eliminazione di un aula dall interfaccia e dal database -->
<script type="text/javascript">
 function elimina(nome) {
 	$.ajax({
    url : "aule/auledelete.php",
    data : "name="+nome,
    success : function (data) {
        alert("eliminazione avvenuta con successo");
        $('#infodiv').load("aule/auleview.php");
    },
    error : function (richiesta,stato,errori) {
        alert("E' evvenuto un errore. Il stato della chiamata: "+stato);
    }
});
 }
</script>
</body>
</html>