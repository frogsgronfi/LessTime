<?php
//funzione per simulare thread che chiude il processo di glpsol
session_start();
	$store = array( 
          'value' => 1 
        );
$fp = fopen('info.txt','w');
fwrite($fp,serialize($store)); 
fclose($fp);
$_SESSION = array();
// Infine distrugge la sessione.
session_destroy();
?>