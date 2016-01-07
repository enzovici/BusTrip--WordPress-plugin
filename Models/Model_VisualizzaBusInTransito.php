<?php
	
	$dataOdierna = date("Y-m-d");

	$selezione = $_GET["selezione"];
	
	$ora= $_GET["ora"];
	
	$tempo=convertiInSecondi($ora);
	
	$linee=array();
	
	$str="";
	$strTmp="";
	
	$url='Stub_VisualizzaBusInTransito.json';
	
	$json = file_get_contents($url);
	$obj = json_decode($json,true);
	
	$n = $obj["length"];
	
	for($k=0; $k<$n; $k++){
		
		$stop_id= $obj["data"][$k]["stop_id"];
		
		if($stop_id==$selezione){
			$indice=$k;
			break;
		}
		
	}
	
	//SECONDA parte	
	
	$url1='Stub_VisualizzaBusInTransito_2.json';
	
	$json1 = file_get_contents($url1);
	$obj1 = json_decode($json1,true);
	
	$n1 = $obj1["length"];
		
	$count= $obj["data"][$indice];
	$count=count($count)-6; //perchè sono fissi i primi 6
	
	for($j=0; $j<$count; $j++){
		
		$route_id= $obj["data"][$indice]["route_id_".$j];
			
		for($k=0; $k < $n1; $k++ ){
			
			$route_id_2stub=$obj1["data"][$k]["route_id"];
			
			if($route_id_2stub==$route_id){
			
				$start_time = $obj1["data"][$k]["start_time"];
				$finish_time = $obj1["data"][$k]["finish_time"];
				
				$start_stop_name=$obj1["data"][$k]["start_stop_name"];
				$finish_stop_name=$obj1["data"][$k]["finish_stop_name"];
				
				$tempoInizio= convertiPiuSecondi($start_time);
				$tempoFine = convertiPiuSecondi($finish_time);
				
				if(($tempo>= $tempoInizio) && ($tempo<= $tempoFine) ){
					
					if(!isset($linee[$start_stop_name.$finish_stop_name])){
					
						$linee[$start_stop_name.$finish_stop_name]=$start_stop_name.$finish_stop_name;
						$str= $str.$route_id.','.$start_stop_name.','.$finish_stop_name.';';
					
					}
					
				}
			
			}
			
		}
	}
	
	echo $str;
	
	
	function convertiInSecondi($ora){
		
		$orario=explode(":",$ora); // ricavo ora e minuti separati
		$ore=$orario[0];
		$minuti=$orario[1];
		$tempo=($ore*3600)+($minuti*60);
		return $tempo;
	}
	
	function convertiPiuSecondi($ora){
			$orario1=explode(":",$ora);
			$ore1=$orario1[0];
			$minuti1=$orario1[1];
			$secondi1=$orario1[2];
			$tempo1=($ore1*3600)+($minuti1*60)+$secondi1;
			return $tempo1;
	}
	
	
	
?>