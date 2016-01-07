<?php
	$url = 'http://api.cstp.it:3030/api/stops/trip/'.$_GET['trip_id'];
	$json = file_get_contents($url); 
	$obj = json_decode($json,true);
	$n = $obj["length"];
	//$n1 = round (18/8, 0, PHP_ROUND_HALF_DOWN);
	echo $obj["data"][0]["stop_lat"].'-'.$obj["data"][0]["stop_lon"].';';

	if($obj["data"][0]["stop_id"] == $_GET['partenza'] && $obj["data"][$n-1]["stop_id"] == $_GET['destinazione'])
		for($i=1; $i<=8;$i++)
			echo $obj["data"][$i]["stop_lat"].'-'.$obj["data"][$i]["stop_lon"].';';
		
	else if($obj["data"][0]["stop_id"] == $_GET['partenza'])
	{	
		$flag=0;
		for($i=1;$i<=8;$i++)
		{
			if($obj["data"][$i]["stop_id"] == $_GET['destinazione'])
			{
				$flag=1;
				echo $obj["data"][$i]["stop_lat"].'-'.$obj["data"][$i]["stop_lon"].';';
			}	
			else if($i == 8 && $flag == 0 && $obj["data"][$i]["stop_id"] != $_GET['destinazione'])
			{
				for($j=9;$j<$n;$j++)
					if($obj["data"][$j]["stop_id"] == $_GET['destinazione'])
						echo $obj["data"][$j]["stop_lat"].'-'.$obj["data"][$j]["stop_lon"].';';		
			}
			else	
				echo $obj["data"][$i]["stop_lat"].'-'.$obj["data"][$i]["stop_lon"].';';
		}	
	}
	
	else if($obj["data"][$n-1]["stop_id"] == $_GET['destinazione'])
	{
		$flag=0;
		for($i=1;$i<=8;$i++)
		{
			if($obj["data"][$i]["stop_id"] == $_GET['partenza'])
			{
				$flag=1;
				echo $obj["data"][$i]["stop_lat"].'-'.$obj["data"][$i]["stop_lon"].';';
			}	
			else if($i == 8 && $flag == 0 && $obj["data"][$i]["stop_id"] != $_GET['partenza'])
			{
				for($j=9;$j<$n;$j++)
					if($obj["data"][$j]["stop_id"] == $_GET['partenza'])
						echo $obj["data"][$j]["stop_lat"].'-'.$obj["data"][$j]["stop_lon"].';';		
			}
			else	
				echo $obj["data"][$i]["stop_lat"].'-'.$obj["data"][$i]["stop_lon"].';';
		}	
	}	

	else
	{
		$flagP = 0;
		$flagD = 0;
		for($i=1;$i<=6;$i++)
		{
			if($obj["data"][$i]["stop_id"] == $_GET['partenza'])
				$flagP = 1;
			if($obj["data"][$i]["stop_id"] == $_GET['destinazione'])
				$flagD = 1;	
			echo $obj["data"][$i]["stop_lat"].'-'.$obj["data"][$i]["stop_lon"].';';
		}
		if($flagP==1 && $flagD==1)
		{
			echo $obj["data"][$i+1]["stop_lat"].'-'.$obj["data"][$i+1]["stop_lon"].';';
			echo $obj["data"][$i+2]["stop_lat"].'-'.$obj["data"][$i+2]["stop_lon"].';';
		}
		else if($flagP==1 && $flagD==0)
		{
			for($j = $i+1;$j<$n;$j++)
				if($obj["data"][$j]["stop_id"] == $_GET['destinazione'])
					echo $obj["data"][$j]["stop_lat"].'-'.$obj["data"][$j]["stop_lon"].';';
		}
		else if($flagP==0)
		{
			for($j = $i+1;$j<$n;$j++)
				if($obj["data"][$j]["stop_id"] == $_GET['partenza'] || $obj["data"][$j]["stop_id"] == $_GET['destinazione'])
					echo $obj["data"][$j]["stop_lat"].'-'.$obj["data"][$j]["stop_lon"].';';
		}	
	}	




	echo $obj["data"][$n-1]["stop_lat"].'-'.$obj["data"][$n-1]["stop_lon"].';';	
?>