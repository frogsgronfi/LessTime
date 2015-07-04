<!--PAGINA DA CUI é POSSIBILE EFFETTUARE IL LOG IN-->
<html>
<head>
  <link href="stile.css" rel="stylesheet" type="text/css">
</head>
<div class ='header'>
	<h1>GESTIONE DELL' ORARIO</h1>
    <h3>Autenticazione Utente</h3>
</div> 
<body>
<div class='loginpage'>
    <form id="login" action="" method="post">
        <table id="login">
        	<tr><td>Username</td></tr>
        	<tr><td><input id="username" name="username" type="text" placeholder="Username" required></td></tr>
        	<tr><td>Password</td></tr>
        	<tr><td><input id="password" name="password" type="password" placeholder="Password" required></td></tr>
        	<tr><td>
            <input type="submit" id="submit" value="LogIn">
            </td></tr>
        </table>
    </form>
    </div>
</body>
<?php
include "config.php";
if($_POST){
//Prelevo i dati inseriti all interno della form
$username = $_POST['username']; 
$password= $_POST['password']; 
 $query = "SELECT * FROM LogIn WHERE Username = '$username' AND Password = '$password' ";
 $ris = mysql_query($query) or die (mysql_error());
 $riga = mysql_fetch_array($ris);  
//Verifico che username e password siano stati inseriti correttamente
$ruolo = $riga['Ruolo'];
//Se ruolo è NULL vuol dire che all interno del database non sono state trovate corrispondenze
if ($ruolo == NULL)
    $trovato = 0 ;
else{ 
    $trovato = 1;
    }
// Username e password corrette 
if($trovato === 1) {
    //se chi ha effettuato il log in è un professore visualizzo la pagina a lui relativa
  if($ruolo == "professore"){
    session_start();
    $_SESSION['username'] = $riga['Cognome'];
    mysql_close($connessione);
    echo '<script language=javascript>document.location.href="professore/professorehome.php"</script>'; 
  }
   //se chi ha effettuato il log in è un membro della segreterua visualizzo la pagina a lui relativa
  if($ruolo == "segreteria"){
    mysql_close($connessione);
    echo '<script language=javascript>document.location.href="segreteria/segreteriahome.php"</script>'; 
    }  
}
else{
    mysql_close($connessione);
    echo '<script language=javascript>alert("login o password errata ")</script>';
}
}
else{
session_start();
// Desetta tutte le variabili di sessione.
unset($_SESSION['status']);
unset($_SESSION['comp']);
}
?>
<script type="text/javascript">
document.cookie="idcorso=0"+"; path=/professore";
</script>
</html>