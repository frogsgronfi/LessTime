<!--PAGINA RELATIVA ALL INSERIMENTO DI UN NUOVO CORSO -->
<html>
<head>
 <link href="stile.css" rel="stylesheet" type="text/css">
<title>Inerisci Nuovo Corso</title>
<basefont size=2 face=Tahoma>
</head>
<body topmargin=50>
<div align=center>
<h3>Inserisci Corso</h3>
<!--IL FORM RIMANDA ALLA PAGINA corsidb.php PER SALVARE IL CORSO ALL INTERNO DEL DATABASE -->
<form name='inserimento'>
  <table>
    <tr><td>Nome Corso</td><td><input type='text' id='corso' name='Ncorso'></td><td><div id='Ncorsos' class='error' hidden>Inserire nome del corso</div></td></tr>
    <tr><td>Id Corso</td><td><input type='text' id='Idcorso' size='5' maxlength='5' name='Idcorso'></td><td><div id='Idcorsos' hidden class='error'>Inserire id del corso</div></td></tr>
    <tr><td>Nr Crediti</td><td><input type='text' id='Crediti' size='2' maxlength='2' name='Crediti'></td><td><div id='Credites' hidden class='error'>Inserire nr crediti</div></td></tr>
    <tr><td>Professore</td><td><select type='select' id='Prof' name='Prof'>
    <!--ALL INTERNO DELLA SCELTA DEL TITOLARE DEL CORSO INSERISCO LA POSSIBLITà DI SCEGLIERE TRA I PROF REGISTRATI-->
    <?php
    include "../../config.php";
    $connessione = mysql_connect($nomehost,$nomeuser,$psw);
    mysql_select_db("$db_name",$connessione);
    $query = "SELECT COGNOME FROM LogIn where Ruolo = 'professore' ORDER BY COGNOME";
    $ris = mysql_query($query) or die (mysql_error());
    while($row = mysql_fetch_row($ris)){
      echo "<option value='".$row[0]."'>".$row[0]."</option>";
    }
    ?>
    <select></td></tr>
    <tr><td>Anno Corso</td><td><select id='Acorso' name='Acorso'><option value='1info'>1info</option><option value='2info'>2info</option><option value='3info'>3info</option><option value='1ipm'>1ipm</option><option value='2ipm'>2ipm</option><option value='3ipm'>3ipm</option><option value='1mag'>1mag</option><option value='2mag'>2mag</option></select></td></tr>
    <tr><td><input type='button' id="botcorso" value='Salva'></td></tr>
  </table>
</form>
</div>
<script type="text/javascript">
//funzione che controlla i dati inseriti per un corso nuovo e li memorizza in corsidb
$(document).ready(function() {
  $("#botcorso").click(function(){
    var error = 0;
    $("#Ncorsos").hide();
    $("#Idcorsos").hide();
    $("#Credites").hide();
    $("#corso").css({'border': '1px solid #000000'});
    $("#Idcorso").css({'border': '1px solid #000000'});
    $("#Crediti").css({'border': '1px solid #000000'});
    var ncorso = $("#corso").val();
    var idcorso = $("#Idcorso").val();
    var crediti = $("#Crediti").val();
    var professore = $("#Prof").val();
    var acorso = $("#Acorso").val();
    if ($("#corso").val().length < 1){
        error = error + 1;
        $("#corso").css({'border': '1px solid #FF3333'});
        $("#Ncorsos").show();
    }
    if ($("#Idcorso").val().length < 1){
        error = error + 1;
        $("#Idcorso").css({'border': '1px solid #FF3333'});
        $("#Idcorsos").show();
    }
    if ($("#Crediti").val().length < 1){
        error = error + 1;
        $("#Crediti").css({'border': '1px solid #FF3333'});
        $("#Credites").show();
    }
    if(isNaN(crediti)){
            error = error + 1;
            $("#Crediti").css({'border': '1px solid #FF3333'});
            $("#Credites").html("Devi inserire un numero");
            $("#Credites").show();
    }
    if (error == 0) {
        $.ajax({
          type: "POST",
          url: "corsi/corsidb.php",
          data: "Ncorso=" + ncorso + "&Idcorso=" + idcorso + "&Crediti=" + crediti + "&Prof=" + professore + "&Acorso=" + acorso,
          dataType: "html",
          success: function(msg)
          {
          if(msg[0] == "D"){
            alert("Esiste gia un corso con l id inserito");
            $("#Idcorso").css({'border': '1px solid #FF3333'});
             window.location = "segreteriahome.php";
          }
          else{
            alert("inserimento avvenuto con successo");
          }
           window.location = "segreteriahome.php";
          },
          error: function()
          {
          alert("E stato inserito un id già presente all interno del database");
          }
       });
    }
  });
});
</script> 
</body>
</html>