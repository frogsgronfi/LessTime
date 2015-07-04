<!-- PAGINA DEDICATA ALLA GESTIONE DELL ORARIO DA PARTE DEL PROFESSORE -->
<html>
<head> 
 <link href="../stile.css" rel="stylesheet" type="text/css">
 <script type="text/javascript" src="../libraries/jquery-2.1.4.min.js"></script>
</head>
 <div class ='header'>
	<h1>GESTIONE DELL' ORARIO</h1>
    <h3>Impostazioni Professore</h3>
</div>
<?php
include "../config.php";
session_start();
$username = $_SESSION['username'];
//query per vedere se al professore sono stati assegnti corsi
$query = "SELECT NomeCorso,Status,IdCorso FROM Corsi WHERE Professore="."'".$username."'";
$ris = mysql_query($query) ;//or die (mysql_error());
$riga = mysql_fetch_array($ris);
//se non gli sono stati assegnati corsi visualizzo la scritta non ti sono stati assegnati corsi
if($riga == NULL){
  	echo "<div class='profmenudiv' id='profmenudiv'>";
	echo "<table>";
	echo "<tr><td><a href = '../login.php'>Logout</a></td></tr>";
	echo "</table></div>";
	echo "<div id = 'nocoursesprofdiv' class='nocoursesprofdiv' name='nocoursesprofdiv'><h3>non ti sono stati assegnati corsi in questo semestre</h3></div> ";
}
else{
//Se sono stati visualizzati li mostro come link da cui l'utente puo accedere al corso desiderato
	$ris2 = mysql_query($query); //or die (mysql_error());
	//div che contiene i corsi che sono stati assegnati al professore con il relativo stato
	echo "<div class='profmenudiv' id='profmenudiv'>";
	echo "<table>";
	while ($riga = mysql_fetch_array($ris2) ){
		$idcorso = $riga['IdCorso'];
		$status = $riga['Status'];
		if($status == 0)
			echo "<tr><td ><a name=".$idcorso." href = javascript:link(\"".$idcorso."\");>".$riga['NomeCorso']."</a></td><td><img src='../img/rossosemaforo.png' id='semaforo".$idcorso."' height='22' width='22'></td></tr>"; 
		if($status == 1)
			echo "<tr><td ><a name=".$idcorso." href = javascript:link(\"".$idcorso."\");>".$riga['NomeCorso']."</a></td><td><img src='../img/verdesemaforo.png' height='22' width='22'></td></tr>"; 
	}
	//bottone per il log out
	echo "<tr><td><a href = '../login.php'>Logout</a></td></tr>";
	echo "</table>";
	echo "</div>";
	//div principale della pagina
	echo "<div id = 'maincontentsdiv2' class='maincontentsdiv2' name='maincontensdiv2'></div> ";
	//div contenente la form per i vincoli mandatory
	echo "<div id = 'mandatory' class='mandatory' name='mandatory'></div> ";
	//div contenete la legenda per la tabella di inserimento orario
	echo "<div id = 'legend' class='legend' name='legend' hidden>
	<table>
	<tr><td class='legendtd' style='background-color:LimeGreen;'></td><td>assolutamente si(1)</td></tr>
	<tr><td class='legendtd' style='background-color:#00FFE5;'></td><td>probabilmente si(0,75)</td></tr>
	<tr><td class='legendtd' style='background-color:#FEF002;'></td><td>indifferente(0.5)</td></tr>
	<tr><td class='legendtd' style='background-color:#FD9602';></td><td>probabilmente no(0.25)</td></tr>
	<tr><td class='legendtd' style='background-color:red;'></td><td>assolutamente no(0)</td></tr>
	</table>
	</div> ";
}

$query = "SELECT NomeCorso,Status,IdCorso FROM Corsi WHERE Professore="."'".$username."'";
$ris = mysql_query($query) ;
$riga = mysql_fetch_array($ris);
//quando premo il pulsante invia dati sotto la tabella imp orario invioi dati a questa stessa pagina che ne fa l'elaborazione
if($_POST){
	$oresett = $_POST['oresett'];
	$block = "";
	$query = "SELECT * FROM ImpOrario";
	$ris = mysql_query($query) or die (mysql_error());
	$riga = mysql_fetch_assoc($ris);
	$maxb = $riga['maxb'];
	for($i=1;$i<=$maxb;$i++){
		$index = "block".$i;
		if($_POST[$index] != 0){
			$block = $block.$_POST[$index]."-";
		}
		else
			$block = $block."0"."-";
	}
	$idcorso = $_POST['idcorso'];
	$query6 = "UPDATE Corsi SET OreSett=".$oresett." WHERE IdCorso = "."'".$idcorso."'";
	$ris6 = mysql_query($query6) ;
	$query7 = "UPDATE Corsi SET Blocchi="."'".$block."'"." WHERE IdCorso = "."'".$idcorso."'";
	$ris7 = mysql_query($query7) ;
	$query14 = "SELECT Professore FROM Corsi WHERE IdCorso = "."'".$idcorso."'";
	$ris14 = mysql_query($query14); 
	$riga14 = mysql_fetch_assoc($ris14);
	$query = "SHOW TABLES LIKE "."'".$riga14['Professore']."'";
	$ris = mysql_query($query) ;
	$riga = mysql_fetch_row($ris);
	if($riga['0'] != NULL){
	//la tabella esiste gia nel database quindi bisogna caricarla
		memorizza();
	}
	//altrimenti devo creare la tabella relativa al corso scelto
	else{
		$query3 = "SELECT Professore FROM Corsi WHERE IdCorso = "."'".$idcorso."'";
		$ris3 = mysql_query($query3); //or die (mysql_error());
		$riga3 = mysql_fetch_assoc($ris3);
		$query2 = "CREATE TABLE "."`".$riga3['Professore']."`"."(ORE INT(2), LUN FLOAT, MAR FLOAT, MER FLOAT, GIO FLOAT, VEN FLOAT);";
		$ris2 = mysql_query($query2); //or die (mysql_error());
		//$riga2 = mysql_fetch_row($ris2);
		$query5 = "SELECT slots_per_day FROM ImpOrario";
		$ris5 = mysql_query($query5); //or die (mysql_error());
		$riga5 = mysql_fetch_assoc($ris5);
		for($z=0;$z<$riga5['slots_per_day'];$z++) {
			$query4 = "INSERT INTO  "."`".$riga3['Professore']."`"." VALUES (".$z.",'0','0','0','0','0')";
			$ris4 = mysql_query($query4) ;//or die (mysql_error());
			$riga4 = mysql_fetch_row($ris4);
		}
		memorizza();
	}
}
//funzione per memorizzare le scelte dell utente relative all orario in cui è disponibile
function memorizza(){
	$idcorso = $_POST['idcorso'];
	$query7 = "SELECT Professore FROM Corsi WHERE IdCorso = "."'".$idcorso."'";
	$ris7 = mysql_query($query7); //or die (mysql_error());
	$riga7 = mysql_fetch_assoc($ris7);
	$query5 = "SELECT slots_per_day FROM ImpOrario";
	$ris5 = mysql_query($query5); //or die (mysql_error());
	$riga5 = mysql_fetch_assoc($ris5);
	$giorni = array("LUN","MAR","MER","GIO","VEN");
		for($i=0;$i<$riga5['slots_per_day'];$i++) {
			for($j=0;$j<5;$j++){
				$index = $giorni[$j].$i;
				$value = $_POST["$index"];
				$querty = "UPDATE "."`".$riga7['Professore']."`"." SET ".$giorni[$j]."=".$value." WHERE ORE = "."'".$i."'";
				mysql_query($querty);
			}
		}
	$query8 = "SELECT Status FROM Corsi WHERE WHERE IdCorso = "."'".$IdCorso."'";
	$ris8 = mysql_query($query8);
	$riga8 = mysql_fetch_assoc($ris8);
	if($riga8['Status'] == 0){
		$query9  = "UPDATE Corsi SET Status=1 WHERE IdCorso = "."'".$idcorso."'";
		$ris9 = mysql_query($query9);
		$riga9 = mysql_fetch_assoc($ris9);
	}
}
?>
<script type="text/javascript">

javascript:pages();
//mandatory() funzione per inviare i dati mandatory 
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
        alert("devi inserire per ogni blocco un giorno diverso");
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
//funzione che collega i tag <a> alle pagine relative al corso desiderato
function link(nome) {
    $.ajax({
    url : "professoreorario.php",
    data : "name="+nome,
    success : function (data) {
      //la selezionata bianco
      $('a[name^="'+nome+'"]').css('backgroundColor', 'LimeGreen');
      //agli altri bianco
      $('a[name!="'+nome+'"]').css('backgroundColor', '#FFFFFF');
        $("div.maincontentsdiv2").html(data);
        $("div.legend").show();
        //$("div.mandatory").load("professoremandatory.php",{name:nome});
        mandatory(1);
        document.cookie="idcorso="+nome+"; path=/professore";
        //$("div.mandatory").load("professoremandatory.php");
    },
    error : function (richiesta,stato,errori) {
        alert("E' evvenuto un errore. Il stato della chiamata: "+stato);
    }
});
}
 //funzioni per cambiare colore quando con il muose passo sulle righe e le colonne della tabella
function colonnaover(prova) {
    $('td[name^="'+prova+'"]').css('backgroundColor', '#dedede');
 }
 function colonnaout(prova) {
    $('td[name$="'+prova+'"]').css('backgroundColor', '#efefef');
 }
  function rigaover(prova) {
    $('td[id$="'+prova+'"]').css('backgroundColor', '#dedede');
 }
 function rigaout(prova) {
    $('td[id$="'+prova+'"]').css('backgroundColor', '#efefef');
 } 
 //funzione per selezionare tutte righe della tabella
 function selectallrow(data){
        var classe ="."+data; 
        var idsel = "#"+"idsel"+data;
           if($(idsel).val()== 0){
            $('td[id="'+data+'"] > div > div + div').css("background-image","url(/img/red.png)");
             $(classe).val(0);
           }
           if($(idsel).val()== 1){
             $('td[id="'+data+'"] > div > div + div').css("background-image","url(/img/green.png)");
             $(classe).val(1);
           } 
           if($(idsel).val()== 0.5){
             $('td[id="'+data+'"] > div > div + div').css("background-image","url(/img/yellow.png)");
             $(classe).val(0.5);
           } 
           if($(idsel).val()== 0.75){
             $('td[id="'+data+'"] > div > div + div').css("background-image","url(/img/cyan.png)");
             $(classe).val(0.75);
           } 
           if($(idsel).val()== 0.25){
             $('td[id="'+data+'"] > div > div + div').css("background-image","url(/img/orange.png)");
             $(classe).val(0.25);
           }  
 }
  //funzione per selezionare tutte le colonne della tabella
 function colselectall(prova) {
    //prendo la select con id giorno che gli passo 
    var x = $('select[id^="'+prova+'"]');
    var idsel = "#"+prova;
    if($(idsel).val()== 0){
      $(x).val(0);
      $('td[name^="'+prova+'"] > div > div + div').css("background-image","url(/img/red.png)");
    }
    if($(idsel).val()== 1){
      $(x).val(1);
       $('td[name^="'+prova+'"] > div > div + div').css("background-image","url(/img/green.png)");
    } 
    if($(idsel).val()== 0.5){
      $(x).val(0.5);
       $('td[name^="'+prova+'"] > div > div + div').css("background-image","url(/img/yellow.png)");
               } 
    if($(idsel).val()== 0.75){
      $(x).val(0.75);
       $('td[name^="'+prova+'"] > div > div + div').css("background-image","url(/img/cyan.png)");
               } 
    if($(idsel).val()== 0.25){
      $(x).val(0.25);
       $('td[name^="'+prova+'"] > div > div + div').css("background-image","url(/img/orange.png)");
        }  
     }
//funzione visualizzare i colori
 function scolorselect(data){
    var idsel = "#"+data;
    if($(idsel).val()== 0){
    $(idsel).css('background-color','red');
  }
  if($(idsel).val()== 1){
    $(idsel).css('background-color','LimeGreen');
  } 
  if($(idsel).val()== 0.5){
    $(idsel).css('background-color','#FEF002');
  } 
  if($(idsel).val()== 0.75){;
    $(idsel).css('background-color','#00FFE5');
  } 
  if($(idsel).val()== 0.25){
    $(idsel).css('background-color','#FD9602');
    }  
 }
//funzione per controllare i dati inseriti all interno della tabella orario professore
function invia(){
    var giorni = new Array("LUN","MAR","MER","GIO","VEN");
    var blocchi = new Array();
    var error = 0;
    var errororesett = false;
    var errorblock = false;
    var stop = false;
    var oresett = $("#oresett").val();
    $("#oresetts").hide();
    $("#block").hide();
    $("#oresett").css({'border': '1px solid #000000'});
    $("input[name^='block']").css({'border': '1px solid #000000'});
    var x = $("input[name^='block']");
    var sum = 0;
    if ($("#oresett").val().length < 1 || $("#oresett").val() <= 0){
        error = error + 1;
        $("#oresett").css({'border': '1px solid #FF3333'});
        $("#oresetts").show();
        errororesett = true;
    }
    for(var i =1; i<=x.length;i++){
      if($("#block"+i).val() != 0){
        blocchi.push(parseInt($("#block"+i).val()));
      }
        sum = sum + parseInt($("#block"+i).val());
    }
    if (sum != $("#oresett").val()){
        error = error + 1;
        $("input[name^='block']").css({'border': '1px solid #FF3333'});
        $("#block").show();
        errorblock = true;
    }
    if(isNaN(oresett)){
            error = error + 1;
            $("#oresett").css({'border': '1px solid #FF3333'});
            $("#oresetts").html("Devi inserire un numero");
            $("#oresetts").show();
            errorblock = true;
    }
    var count = 0;
    for(var w=0;w<giorni.length;w++){
      y = $("select[name^='"+giorni[w]+"']");
      for(var z =0; z<y.length;z++){
        if($('#'+giorni[w]+z).val() > 0){
            count++ ;
        }
      }
    }
    if(count == 0){
      alert("hai inserito 0 preferenze");
    }
    if(count < 20 && count > 0){
      alert("devi inserire almeno 20 preferenze per memorizzare la tabella");
      error = error + 1;
    }
    if (error == 0) {
        //Per inviare i dati a professorehome.php che li memorizza all interno del database
        var data = $("form").serialize();
        $.ajax({
          type: "POST",
          url: "professorehome.php",
          data : data,
          dataType: "html",
          success: function(msg)
          {
           var semaforo = "#semaforo" + $("#idcorso").val();
           $(semaforo).attr("src","/img/verdesemaforo.png");
           var nome = $("#idcorso").val();
           //$("div.mandatory").load("professoremandatory.php",{name:nome});
           mandatory(1);
           alert("inserimento avvenuto con successo");
          },
          error: function()
          {
          alert("Chiamata fallita, si prega di riprovare...");
          }
       });
    }
}
 //funzioni per la gestione dei cookies 
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}
//pages funzione per caricare una pagina a seconda del cookie
function pages(){
  var x = getCookie('idcorso');
  var lista = document.getElementsByTagName("a");
  if(x == 0){
    var idcorso = lista.item(0).getAttribute("name");
    document.cookie="idcorso="+idcorso+"; path=/professore";
    link(idcorso);
}
  else{
    link(x);
  }
}
</script>
</html>