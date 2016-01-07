<?php


	$partenza=urlencode($_GET["partenza"]);
	$destinazione=urlencode($_GET["destinazione"]);

	$url = "http://api.cstp.it:3030/api/ticket?from_city=".$partenza."&to_city=".$destinazione;

	$json = file_get_contents($url);

	$obj = json_decode($json,true);

	$n = $obj["length"];
    $str = "";
	for($i = 0;$i < $n;$i++){
		$tariffa = $obj["data"][$i]["type"];
		if($tariffa == 'null') $tariffa = '-';

		$corsaSingola = $obj["data"][$i]["single_fare"];
		if($corsaSingola == 'null') $corsaSingola = '-';

		$giornaliera = $obj["data"][$i]["daily_fare"];
		if($giornaliera == 'null') $giornaliera = '-';

		$settimanale = $obj["data"][$i]["weekly_fare"];
		if($settimanale == 'null') $settimanale = '-';

		$mensile = $obj["data"][$i]["monthly_fare"];
		if($mensile == 'null') $mensile = '-';

		$annuale = $obj["data"][$i]["annual_fare"];
		if($annuale == 'null') $annuale = '-';

		$str = $str."$tariffa,$corsaSingola,$giornaliera,$settimanale,$mensile,$annuale;";
	}
	echo $str;
?>