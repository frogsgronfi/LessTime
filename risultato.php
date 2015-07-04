<!--PAGINA PER LA VISUALIZZAZIONE DEL RISULTATO-->
<html>
 <head>
  <link href="stile.css" rel="stylesheet" type="text/css">
   <script type="text/javascript" src="libraries/jquery-2.1.4.min.js"/></script> 
   <script type="text/javascript" src="libraries/htmltable_export/tableExport.js"></script> 
  <script type="text/javascript" src="libraries/htmltable_export/jquery.base64.js"></script> 
 </head>
 <div class ='header'>
	<h1>GESTIONE DELL' ORARIO</h1>
    <h3>Risultato</h3>
</div>
 <div class ='segreteriadiv'>
</div>
<div class ='annoorario' id='annoorario'>
</div>
<div class = "result" name="result" id="result">
</div>
<div class = 'export' name = 'export' id= "export">
	<input type='button' id='cmd' onclick='expor()' value='Esporta Pdf' hidden></input>
  <input type='button' id='csv' onclick='exporcsv()' value='Esporta Csv' hidden></input>
  <div class='download'></div>
</div>
<script type="text/javascript">
$('.segreteriadiv').load("orario.html #tablerlink");
//funzione per visualizzare il risultato
function view(y){
	var load = "orario.html #"+y;
	$('#result').load(load);
  $('#annoorario').html(""+y);
  $('#cmd').removeAttr("hidden");
  $('#csv').removeAttr("hidden");
  $('#aexport').remove();
}
//funzione per effettuare l'esportazione in pdf
function expor(){
   var anno = $('#annoorario').text();
 	 var content = $('#result').html();
 	 $.ajax({
    	  type: "POST",
   	   	  url: "risultato.php",
          data : "contents="+content+"&anno="+anno,
          success: function(msg)
          {
            $('.download').html("<a id='aexport' href='"+anno+".pdf'"+"download>download pdf</a>");
          },
          error: function()
          {
          alert("Chiamata fallita, si prega di riprovare...");
          }
       });
}
//funzione per effettuare l'esportazione in csv
function exporcsv(){
  $('#tabellarisultato').tableExport({type:'csv',escape:'false'});
}
</script>
<?php
if($_POST){
  $anno = $_POST['anno'];
  $filename = $anno.".html";
	$file=fopen($filename,"w+");
	$contenuto = $_POST['contents'];
	fwrite($file,$contenuto);
  chmod($filename,"0777");
  //utilizzo una funzione esterna per trasformare in pdf il risultato che poi verrà esportato
  exec("xvfb-run -a wkhtmltopdf ".$filename." ".$anno.".pdf");
  exec("rm ".$filename);
}
 ?>
</html>