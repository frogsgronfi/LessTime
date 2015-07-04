<!--HOME PAGE DELLA SEGRETERIA -->
<html>
 <head>
  <link href="../stile.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/libraries/jquery-2.1.4.min.js"/></script> 
 </head>
 <div class ='header'>
	<h1>GESTIONE DELL' ORARIO</h1>
    <h3>segreteria</h3>
</div>
<body>
<div class = 'segreteriadiv'>
        <h3>Menu</h3>
        <table id="homepanelsegreteria">
        	<tr id='aorario'><td ><a href='javascript:orario()'> Orario </a></td></tr><tr id='aaule'><td><a href = 'javascript:aule()'> Aule </a></td></tr><tr id='acorsi'><td><a href='javascript:corsi()'> Corsi </a></td></tr><tr><td><a href='../login.php'> LogOut </a></td></tr>
        	</tr>
        </table>
</div>
<div class = 'maincontentsdiv' id = 'maincontentsdiv'> 
<div class = 'infodiv' id = 'infodiv'>
</div>
<div class = 'insertdiv' id = 'insertdiv'>
</div>
</div>
<?php
include "../config.php";
session_start();
if ( !isset($_SESSION['status'])){
    $_SESSION['status'] = 1;
    echo "<script language=\"JavaScript\">\n";  
    echo "</script>";
}
//sono in aule
if ($_SESSION['status'] == 2){
    echo "<script language=\"JavaScript\">\n";  
    echo "$("."'"."#aorario"."'".").css('background-color','white');";
    echo "$("."'"."#aaule"."'".").css('background-color','LimeGreen');";
    echo "$("."'"."#acorsi"."'".").css('background-color','white');";
    echo "$("."'"."#infodiv"."'".").load(\"aule/auleview.php\");";  
    echo "$("."'"."#insertdiv"."'".").load(\"aule/auleinsert.php\");";  
    echo "</script>";
}
//sono in corsi
if ($_SESSION['status'] == 3){
    echo "<script language=\"JavaScript\">\n"; 
    echo "$("."'"."#aorario"."'".").css('background-color','white');";
    echo "$("."'"."#aaule"."'".").css('background-color','white');";
    echo "$("."'"."#acorsi"."'".").css('background-color','LimeGreen');"; 
    echo "$("."'"."#infodiv"."'".").load(\"corsi/corsiview.php\");";  
    echo "$("."'"."#insertdiv"."'".").load(\"corsi/corsiinsert.php\");";  
    echo "</script>";
}
//sono in orario
if ($_SESSION['status'] == 1){
    echo "<script language=\"JavaScript\">\n"; 
    echo "$("."'"."#aorario"."'".").css('background-color','LimeGreen');";
    echo "$("."'"."#aaule"."'".").css('background-color','white');";
    echo "$("."'"."#acorsi"."'".").css('background-color','white');";
    echo "$("."'"."#infodiv"."'".").load(\"orario/orarioview.php\");"; 
     echo "$("."'"."#insertdiv"."'".").load(\"mandatoryseg.php\");"; 
    echo "</script>"; 
}
?>
</body>
<!--Funzioni per l'aggiornamento dell div centrale della pagina -->
<script type="text/javascript">
//funzione che visualizza le informazioni relative all orario
 function orario() {
 	$.ajax({
    url : "orario/orarioview.php",
    success : function () {
        $('#infodiv').empty();
        $('#insertdiv').empty();
        $('#aorario').css('background-color','LimeGreen');
        $('#aaule').css('background-color','white');
        $('#acorsi').css('background-color','white');
    	$('#infodiv').load("orario/orarioview.php");
        $('#insertdiv').load("mandatoryseg.php");
    },
    error : function (richiesta,stato,errori) {
        alert("E' evvenuto un errore. Il stato della chiamata: "+stato);
    }
});
 }
 //funzione che visualizza le informazioni relative alle aule
 function aule() {
 	$.ajax({
    url : "orario/orarioview.php",
    success : function () {
        $('#infodiv').empty();
        $('#insertdiv').empty();
        $('#aorario').css('background-color','white');
        $('#aaule').css('background-color','LimeGreen');
        $('#acorsi').css('background-color','white'); 
    	$('#infodiv').load("aule/auleview.php");
        $('#insertdiv').load("aule/auleinsert.php");
    },
    error : function (richiesta,stato,errori) {
        alert("E' evvenuto un errore. Il stato della chiamata: "+stato);
    }
});
 }
 //funzione che visualizza le informazioni relative ai corsi
 function corsi() {
 	$.ajax({
    url : "orario/orarioview.php",
    success : function () {
        $('#infodiv').empty();
        $('#insertdiv').empty();
        $('#aorario').css('background-color','white');
        $('#aaule').css('background-color','white');
        $('#acorsi').css('background-color','LimeGreen');
    	$('#infodiv').load("corsi/corsiview.php");
        $('#insertdiv').load("corsi/corsiinsert.php");
    },
    error : function (richiesta,stato,errori) {
        alert("E' evvenuto un errore. Il stato della chiamata: "+stato);
    }
});
 }
 //funzione per selezionare tutte le righe
 function rowselectall(prova) {
    var x = document.getElementsByClassName(prova);
    var count = 0;
    for(i=0;i<x.length;i++){
        if(x[i].checked == true){
            count = count + 1;
        }   
    }
    if(count == 0){
        for(j=0;j<x.length;j++)
            x[j].checked = true
    }
    if(count <= x.length && count != 0){
        for(z=0;z<x.length;z++)
            x[z].checked = false
    }
 }
 //funzioni per cambiare colore tabella
 function colonnaover(prova) {
    $('td[name$="'+prova+'"]').css('backgroundColor', '#dedede');
 }
 function colonnaout(prova) {
    $('td[name$="'+prova+'"]').css('backgroundColor', '#efefef');
 }
  function rigaover(prova) {
    $('td[id="'+prova+'"]').css('backgroundColor', '#dedede');
 }
 function rigaout(prova) {
    $('td[id="'+prova+'"]').css('backgroundColor', '#efefef');
 }
 //funzione per selezionare tutte le colonne
 function colselectall(prova) {
    var x = $('input[name$="'+prova+'"]');
    var count = 0;
    for(i=0;i<x.length;i++){
        if(x[i].checked == true){
            count = count + 1;
        }   
    }
    if(count == 0){
        for(j=0;j<x.length;j++)
            x[j].checked = true
    }
    if(count <= x.length && count != 0){
        for(z=0;z<x.length;z++)
            x[z].checked = false
    }
 }
 //funzione relativa ai bottoni minisat e calcola per calcolare l'orario
 var wtimer;
 function calcolaorario(mode) {
    $('.calcolaorariom').attr("disabled", "disabled");
    $('.calcolaorariob').attr("disabled", "disabled");
    $('.counterdiv').html("");
    $('#kill').show();
    var left = (screen.width/2)-(250/2);
    var top = (screen.height/2)-(160/2);
    wtimer = window.open("../timer.php", "Running", 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=250, height=160, top='+top+', left='+left);
    $('#ccounterdiv').show();
    $.ajax({
      type:"POST",
      url : "../writetofile.php",
      data : "mode="+mode,
      dataType: "html",
      success : function (data){
      $('.calcolaorariom').removeAttr("disabled")
      $('.calcolaorariob').removeAttr("disabled")
      $('#kill').hide();
      $('#ccounterdiv').hide();
      if(data == 0){
        alert("il problema non ha soluzione");
        wtimer.close();

      }
      else if(data == 2){
      alert("esecuzione terminata dall utente");
         wtimer.close();
      }
      else{
        window.open("../risultato.php","width=xxx,height=yyy"); 
        wtimer.close();
      }
      },
      error : function (richiesta,stato,errori) {
          alert("E' evvenuto un errore. lo stato della chiamata: "+stato+richiesta+errori);
      }
});
}
//funzione relativa alla chiusura del processo glpsol da parte dell utente
window.onbeforeunload = closingCode;
function closingCode(){
  wtimer.close();
   $.ajax({
    type:"POST",
    url : "../killprocess.php",
    dataType: "html",
    success : function (data) {
    },
    error : function (richiesta,stato,errori) {
    }
});
   return null;
}
</script>
</html>