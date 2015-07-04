<?php
echo "eccomi";
$file=fopen("test.dat","w+");
fwrite($file,"param weights :=\n\n");
//$professori = array("Rambaldi","Mughetti","Bertossi","Morigi","Davoli","Vitali","Martini","Campanino","Asperti","Bononi","Casadei");
//completo secondo ciclo
//$professori = array("Rambaldi","Mughetti","Bertossi","Morigi","Davoli","Vitali","Martini","Campanino","Asperti","Bononi","Casadei","Aprile","Roccetti","Cagliari","Messina","Sangiorgi","Loli","Fumagalli","Marzolla","Gaspari");
//completo primo ciclo
//$professori = array("Sordoni","Ghini","Sacerdoti","Laneve","Davoli","Panzieri","Casciola","DalLago","Gorrieri","Asperti","Ciancarini","Babaoglu","Mollona","Montesi","Kiziltan","Finocchiaro","Ferretti","Fioretti","Tommasini","Donatiello","DiFelice","Rossi","Ruffino","Tamburini");
//$professori = array("Sordoni","Ghini","Sacerdoti","Laneve","Davoli","Panzieri","Casciola","DalLago","Gorrieri","Asperti","Ciancarini","Babaoglu","Mollona","Montesi");
//$professori = array("Rambaldi","Mughetti","Bertossi","Morigi","Davoli","Vitali","Martini","Campanino","Asperti","Bononi","Casadei","Aprile","Roccetti","Cagliari","Messina","Sangiorgi","Loli","Fumagalli");
//2triennali Iciclo
$professori = array("Sordoni","Ghini","Sacerdoti","Laneve","Davoli","Panzieri","Casciola","DalLago","Gorrieri","Asperti","Ciancarini","Babaoglu","Mollona","Montesi","Kiziltan","Finocchiaro","Ferretti","Fioretti","Tommasini","Donatiello","DiFelice","Rossi","Ruffino");
$nrslots = 11;
	for($k=0;$k<count($professori);$k++){
		$count = 0;
		$righe = array();
		$towrite = "";
		for($j=1;$j<=$nrslots;$j++){
			$towrite = $towrite.$j;
			for ($i = 0; $i < 5; $i++) {
				if(rand(0,100) < 80){
				 $towrite = $towrite."\t\t1";
				}
				else{
				 $towrite = $towrite."\t\t0";
				}
			}
			$righe[$j] = $towrite."\n";
			//fwrite($file,$towrite."\n");
			$towrite = "";
		}
		//nel file scrivo solo se il professore ha inserito almeno 20 preferenze per l'orario in cui fare lezione
			fwrite($file,"\n[\"".$professori[$k]."\",*,*] (tr) :\n");
			fwrite($file,"\t\t1\t\t2\t\t3\t\t4\t\t5 :=\n");
			for($r=1;$r<=count($righe);$r++){
				fwrite($file,$righe[$r]);
			}
	}
fwrite($file,";");
?>
