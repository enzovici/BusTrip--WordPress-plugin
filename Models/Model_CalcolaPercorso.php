<?php
	$url = ''.$_GET['partenza'].'-'.$_GET['destinazione'].'.json';
	$json = file_get_contents($url); 
	$obj = json_decode($json,true);
	$n = $obj["length"];
	for($i = 0; $i < $n; $i++)
		echo $obj["data"][$i]["route_id"].'-'.$obj["data"][$i]["trip_id"].'-'.$obj["data"][$i]["start_stop_name"].'-'.$obj["data"][$i]["finish_stop_name"].';';
?>