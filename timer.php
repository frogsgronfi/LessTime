<!--PAGINA CHE GESTISCE IL TIMER DELLA COMPUTAZIONE E LA TERMINAZIONE -->
<html>
<head>
<script type="text/javascript" src="libraries/jquery-2.1.4.min.js"/></script> 
</head>
<?php
session_start();
$_SESSION['comp'] = 1;
?>
<div id='ccounterdiv'>
<input type='image' src='/img/cross.png' class='kill' id='kill' value='kill' onclick='javascript:killprocess()'>
<p>Il programma e in esecuzione</p>
<div id='counterdiv' class='counterdiv' name='counterdiv'></div>
</div>
<script type='text/javascript'>
window.onunload = killprocess;
  var test = document.getElementById('counterdiv');
    var counter = 0;  
    var timer = setInterval(function() {
    counter += 1;
    test.innerHTML = "sec: "+counter.toString() + '  ';
    }, 1000);
 function killprocess() {
  $.ajax({
    type:"POST",
    url : "killprocess.php",
    dataType: "html",
    success : function (data) {
    	clearInterval(timer);
    	window.close();
    },
    error : function (richiesta,stato,errori) {
        alert("E' evvenuto un errore. Il stato della chiamata: "+stato);
    }
});
}
</script>
</html>