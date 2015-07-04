<?php
//pagina per scrivere il contenuto del database all interno di un file che verrà dato in input a glspol
include "config.php";
$connessione = mysql_connect($nomehost,$nomeuser,$psw);
mysql_select_db("$db_name",$connessione);  
$file=fopen("settings.dat","w+");
fwrite($file, "data;\n\n");
$query = "SELECT * FROM ImpOrario WHERE id='0' ";
$ris = mysql_query($query) or die (mysql_error());
$riga = mysql_fetch_assoc($ris);
$maxb = $riga['maxb'];
$nrslots = $riga['slots_per_day'];
fwrite($file, "param maxb := ".$maxb.";\n\n");
fwrite($file, "param max_slots_per_day := ".$riga['max_slots_per_day'].";\n\n");
fwrite($file, "param slots_per_day := ".$nrslots.";\n\n");
$query2 = "SELECT Nome FROM Aule ";
$ris2 = mysql_query($query2) or die (mysql_error());
$insertRooms = "";
while ($riga2 = mysql_fetch_assoc($ris2)){
	$insertRooms = $insertRooms."\"".$riga2['Nome']."\"".",";
}
$insertRooms = substr($insertRooms, 0, strlen($stringa)-1);
fwrite($file, "set Rooms := ".$insertRooms.";\n\n");
fwrite($file, "set Data := "."\n\n");
$query3 = "SELECT IdCorso,Professore,AnnoCorso FROM Corsi ";
$ris3 = mysql_query($query3) or die (mysql_error());
while ($riga3 = mysql_fetch_assoc($ris3)){
	$insertcourse="(\"".$riga3['IdCorso']."\", \"".$riga3['Professore']."\", \"".$riga3['AnnoCorso']."\")";
	fwrite($file, $insertcourse."\n");
	}
fwrite($file,"\n;\n");
fwrite($file, "param ns :"."\n");
for($i=1;$i<=$maxb;$i++){
	$count = $count."$i ";
}
fwrite($file, "\t\t"."$count :="."\n");
$query4 = "SELECT IdCorso,Blocchi FROM Corsi ";
$ris4 = mysql_query($query4) or die (mysql_error());
while ($riga4 = mysql_fetch_assoc($ris4)){
	$a = explode("-",$riga4['Blocchi']);
	for($j=0;$j<$maxb;$j++){
		if($a[$j] == 0){
			$a[$j] = ".";
		}
		$numbers = $numbers.$a[$j]." ";
	}
	fwrite($file, "\"".$riga4['IdCorso']."\" ".$numbers."\n");
	//echo "\"".$riga4['IdCorso']."\" ".$numbers."\n";
	$numbers = "";
}
fwrite($file, "\n;\n");
//Nel caso di glpsol normale
if($_POST['mode'] == 1){
	fwrite($file,"param weights :=\n\n");
	$query5 = "SELECT DISTINCT Professore FROM Corsi";
	$ris5 = mysql_query($query5) or die (mysql_error());
	while ($riga5 = mysql_fetch_assoc($ris5)){
		$query6 = "SELECT LUN,MAR,MER,GIO,VEN FROM "."`".$riga5['Professore']."`";
		$ris6 = mysql_query($query6) or die (mysql_error());
		$count = 0;
		$righe = array();
		$towrite = "";
		for($j=1;$j<=$nrslots;$j++){
			$riga6 = mysql_fetch_row($ris6);
			$towrite = $towrite.$j;
			for ($i = 0; $i < 5; $i++) {
				if($riga6[$i] == 2){
					array_push($preschedule,$j.",".$i.",".$riga5['Professore']);
					$towrite = $towrite."\t\t1";
				}
				else	
				 $towrite = $towrite."\t\t".$riga6[$i];
			 	if($riga6[$i] > 0){
			 		$count = $count + 1;
			 	}
			}
			$righe[$j] = $towrite."\n";
			$towrite = "";
		}
		//nel file scrivo solo se il professore ha inserito almeno 20 preferenze per l'orario in cui fare lezione
		if($count > 20){
			fwrite($file,"\n[\"".$riga5['Professore']."\",*,*] (tr) :\n");
			fwrite($file,"\t\t1\t\t2\t\t3\t\t4\t\t5 :=\n");
			for($r=1;$r<=count($righe);$r++){
				fwrite($file,$righe[$r]);
			}
		}
	}
}
//nel caso di minisat
if($_POST['mode'] == 0) {
fwrite($file,"param weights :=\n\n");
	$query5 = "SELECT DISTINCT Professore FROM Corsi";
	$ris5 = mysql_query($query5) or die (mysql_error());
	while ($riga5 = mysql_fetch_assoc($ris5)){
		$query6 = "SELECT LUN,MAR,MER,GIO,VEN FROM "."`".$riga5['Professore']."`";
		$ris6 = mysql_query($query6) or die (mysql_error());
		$count = 0;
		$righe = array();
		$towrite = "";
		for($j=1;$j<=$nrslots;$j++){
			$riga6 = mysql_fetch_row($ris6);
			$towrite = $towrite.$j;
			for ($i = 0; $i < 5; $i++) {
				if($riga6[$i] > 0){
				 $towrite = $towrite."\t\t1";
				}
				else{
				 $towrite = $towrite."\t\t0";
				}
			 	if($riga6[$i] > 0){
			 		$count = $count + 1;
			 	}
			}
			$righe[$j] = $towrite."\n";
			//fwrite($file,$towrite."\n");
			$towrite = "";
		}
		//nel file scrivo solo se il professore ha inserito almeno 20 preferenze per l'orario in cui fare lezione
		if($count > 20){
			fwrite($file,"\n[\"".$riga5['Professore']."\",*,*] (tr) :\n");
			fwrite($file,"\t\t1\t\t2\t\t3\t\t4\t\t5 :=\n");
			for($r=1;$r<=count($righe);$r++){
				fwrite($file,$righe[$r]);
			}
		}
	}
}
fwrite($file,"\n;\nparam room_course :=\n[*,*] (tr) :\n");
$result = mysql_query("SELECT * FROM DisponibilitaAule LIMIT 0,1");
$result = mysql_fetch_assoc($result);
$towrite = "\t\t";
$i = -1;
while(list($col_name, $row_val) = each($result)){
	if ($i != -1){
		$towrite = $towrite."\"$col_name\" ";
	}
	$i = $i + 1;
}
fwrite($file,$towrite.":=\n");
$query6 = "SELECT * FROM DisponibilitaAule";
$ris6 = mysql_query($query6) or die (mysql_error());
while($riga6 = mysql_fetch_row($ris6)){
	$towrite = "\"".$riga6[0]."\"\t";
	for($j=1;$j<=$i;$j++){
		$towrite = $towrite.$riga6[$j]."\t";
	}
	$towrite = $towrite."\n";
	fwrite($file,$towrite);
}
fwrite($file,";\nset ExtraConflicts :=\n;\n");
fwrite($file,"set pre_schedule :=\n");
$query = "SELECT * FROM Mandatory";
$ris = mysql_query($query) or die (mysql_error());
while($riga = mysql_fetch_assoc($ris)){
if($riga['Selected'] == 1){
	switch ($riga['Giorno']) {
    case "LUN":
        $giorno = 1;
        break;
    case "MAR":
        $giorno = 2;
        break;
    case "MER":
        $giorno = 3;
        break;
    case "GIO":
        $giorno = 4;
        break;
    case "VEN":
        $giorno = 5;
        break;
}
	$write = "(\"".$riga['IdCorso']."\","."\"".$riga['Aule']."\",".$giorno.",".$riga['Blocco'].",".$riga['InitSlot'].")";
	fwrite($file,$write."\n");
}
}
fwrite($file,";\nend;");
fclose($file);
/*----------------COMPUTAZIONE------------------------- */
$store = array( 
            'value' => 0 
        );        
$fp = fopen('info.txt','w'); 
fwrite($fp,serialize($store)); 
fclose($fp);
$descriptorspec = array(
0 => array('pipe', 'r'),  // stdin is a pipe that the child will read from
1 => array('pipe', 'w'),  // stdout is a pipe that the child will write to
2 => array('pipe', 'w')   // stderr is a pipe the child will write to
);
$term = false;
//normal
if($_POST['mode'] == 1){
	$process = proc_open('glpsol --math normal.mod --data settings.dat --cuts --pcost  --dual > orario.html', $descriptorspec, $pipes);
	if(!is_resource($process)) {
    	throw new Exception('bad_program could not be started.');
	}
}
//minisat
else{
	//exec('glpsol --math minisat.mod --data datiIciclo.dat --cuts --pcost  --dual --minisat > orario.html');
	$process = proc_open('glpsol --math minisat.mod --data settings.dat --cuts --pcost  --dual --minisat > orario.html', $descriptorspec, $pipes);
	if(!is_resource($process)) {
    	throw new Exception('bad_program could not be started.');
	}
}
while(true){
	sleep(2);
    $infotxt = file_get_contents('info.txt'); 
    $info = unserialize($infotxt); 
    $status = proc_get_status($process);
	if($status['running'] == true && $info['value'] == 1) { //process ran too long, kill it
    //close all pipes that are still open
    fclose($pipes[1]); //stdout
    fclose($pipes[2]); //stderr
    //get the parent pid of the process we want to kill
    $ppid = $status['pid'];
    //use ps to get all the children of this process, and kill them
    $pids = preg_split('/\s+/', `ps -o pid --no-heading --ppid $ppid`);
    foreach($pids as $pid) {
        if(is_numeric($pid)) {
            posix_kill($pid, 9); //9 is the SIGKILL signal
        }
    }  
    proc_close($process);
  	$term = true;
    break;
	}
	if($status['running'] == false){
		break;
	}
}
if($term == true){
	echo 2;
}
else{
	exec("chmod 777 orario.html");
	$tag = "<html>";
	$nosol = "HAS NO PRIMAL";
	$nosol2 = "UNSATISFIABLE";
	$file = "orario.html";
	$fr = fopen($file, 'r');
	$nuovo = "";
	$sol = true;
	while (!feof($fr)) {
	    $riga = fgets($fr);
	    if (strpos($riga, $nosol) !== false) {
	    	echo 0;
	    	$sol = false;
	    	break;
	    }
	    if (strpos($riga, $nosol2) !== false) {
	    	echo 0;
	    	$sol = false;
	    	break;
	    } 
	    if (strpos($riga, $tag) !== false) {
	        $nuovo .= $riga;
	    }
	}
	fclose($fr);
	if($sol == true){
		$fz = fopen($file, 'w+');
		fwrite($fz, $nuovo);
		fclose($fz);
		echo $nuovo;

	}
}
?>