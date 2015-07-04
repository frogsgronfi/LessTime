<!--PAGINA RELATIVA ALL INSERIMENTO DELLE AULE ALL INTERNO DEL SISTEMA -->
<html>
<head>
  <link href="../../stile.css" rel="stylesheet" type="text/css">
<title>Inerisci Nuovo Corso</title>
<basefont size=2 face=Tahoma>
</head>
<body topmargin=50>
<div align=center>
<h3>Inserisci Aula</h3>
<form name='inserimento'>
<table>
<tr><td>Nome</td><td><input type='text' id='Nome' name='Nome' required maxlength="4"></td><td><div id='Nomes' class='error' hidden>Inserire nome</div></td></tr>
<tr><td>Ubicazione</td><td><input type='text' id='Ubicazione' name='Ubicazione' required></td><td><div id='Ubicaziones' class='error' hidden>Inserire Ubicazione</div></td></tr>
<tr><td>Capienza</td><td><input type='text' id='Capienza' name='Capienza' required></td><td><div id='Capienzas' class='error' hidden>Inserire Capienza</div></td></tr>
<tr><td><input type='button' id="bottone" value='Salva'></td></tr></table>
</form>
</div>
<script type="text/javascript">
//funzione che controlla i campi inseriti e se sono corretti li invia ad auledb
$(document).ready(function() {
  $("#bottone").click(function(){
  	var error = 0;
  	$("#Nomes").hide();
  	$("#Ubicaziones").hide();
  	$("#Capienzas").hide();

  	$("#Nome").css({'border': '1px solid #000000'});
  	$("#Ubicazione").css({'border': '1px solid #000000'});
  	$("#Capienza").css({'border': '1px solid #000000'});
    var nome = $("#Nome").val();
    var ubicazione = $("#Ubicazione").val();
    var capienza = $("#Capienza").val();
    if ($("#Nome").val().length < 1){
    	error = error + 1;
    	$("#Nome").css({'border': '1px solid #FF3333'});
    	$("#Nomes").show();
    }
    if ($("#Ubicazione").val().length < 1){
    	error = error + 1;
    	$("#Ubicazione").css({'border': '1px solid #FF3333'});
    	$("#Ubicaziones").show();
    }
    if ($("#Capienza").val().length < 1){
    	error = error + 1;
    	$("#Capienza").css({'border': '1px solid #FF3333'});
    	$("#Capienzas").show();
    }
    if(isNaN(capienza)){
    		error = error + 1;
    		$("#Capienza").css({'border': '1px solid #FF3333'});
    		$("#Capienzas").html("Devi inserire un numero");
    		$("#Capienzas").show();
    }
    if (error == 0) {
    	$.ajax({
    	  type: "POST",
   	   	  url: "aule/auledb.php",
   	   	  data: "Nome=" + nome + "&Ubicazione=" + ubicazione + "&Capienza=" + capienza,
          dataType: "html",
          success: function(msg)
          {
          if(msg[0] == "D"){
            alert("Esiste gia un aula con questo nome");
          }
          else
            alert("inserimento avvenuto con successo");
          window.location = "segreteriahome.php";
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
</body>
</html>