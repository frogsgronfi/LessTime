<!-- Pagina relativa alla visualizzazione dei corsi all interno di un div -->
<html>
<head> 
 <link href="stile.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
	include "../../config.php";
	session_start();
	$_SESSION['status'] = 3;
	$connessione = mysql_connect($nomehost,$nomeuser,$psw);
	mysql_select_db("$db_name",$connessione);  
	$query = "SELECT * FROM Corsi ORDER BY NomeCorso";
	$ris = mysql_query($query) or die (mysql_error());
	if(mysql_num_rows($ris) == 0){
			echo "<h3>Corsi</h3>";
			echo "<h3>Nel database non sono presenti corsi</h3>";
	}
	else{
	echo "<h3>Corsi</h3>";
	echo "<div id=tabellacorsi>";
	echo "<table><th>Nome Corso</th><th>IdCorso</th><th>Professore</th><th>Anno</th><th>Stato</th>";
	$c = 0;
	while($riga = mysql_fetch_assoc($ris)){
		$status = $riga['Status'];
		if($status == 0){
			if ($c % 2 == 0){
				echo "<tr class ='odd'><td> ".$riga['NomeCorso']."</td><td>".$riga['IdCorso']."</td><td>".$riga['Professore']."</td><td>".$riga['AnnoCorso']."</td><td><img src='/img/rossosemaforo.png' height='22' width='22'></td>";
				$c = $c + 1;
			}
			else{
				echo "<tr ><td> ".$riga['NomeCorso']."</td><td>".$riga['IdCorso']."</td><td>".$riga['Professore']."</td><td>".$riga['AnnoCorso']."</td><td><img src='/img/rossosemaforo.png' height='22' width='22'></td>";
				$c = $c + 1;
			}
		}
		if($status == 1){
			if ($c % 2 == 0){
				echo "<tr class ='odd'><td> ".$riga['NomeCorso']."</td><td>".$riga['IdCorso']."</td><td>".$riga['Professore']."</td><td>".$riga['AnnoCorso']."</td><td><img src='/img/verdesemaforo.png' height='22' width='22'></td>";
				$c = $c + 1;
			}
			else{
				echo "<tr ><td> ".$riga['NomeCorso']."</td><td>".$riga['IdCorso']."</td><td>".$riga['Professore']."</td><td>".$riga['AnnoCorso']."</td><td><img src='/img/verdesemaforo.png' height='22' width='22'></td>";
				$c = $c + 1;
			}
		}
		echo "<td><input type = 'image' src='/img/trash.png' height='22' width='22' onclick='elim(\"".$riga['IdCorso']."\")'></td></tr>";
	}
	}	 
?>
</table>
</div>
<!--Funzione per effettuare l'eliminazione di un corso dall interfaccia e dal database -->
<script type="text/javascript">
 function elim(nome) {
 	$.ajax({
    url : "corsi/corsidelete.php",
    data : "name="+nome,
    success : function (data) {
    	alert("eliminazione avvenuta con successo");
        $('#infodiv').load("corsi/corsiview.php");
    },
    error : function (richiesta,stato,errori) {
        alert("E' evvenuto un errore. Il stato della chiamata: "+stato);
    }
});
 }
</script>
</body>
</html>