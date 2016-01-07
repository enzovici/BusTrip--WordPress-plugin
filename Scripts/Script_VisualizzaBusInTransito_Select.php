<?php
$url = "Stub_VisualizzaBusInTransito_Select.json";
$json = file_get_contents($url);
$obj = json_decode($json,true);
$n = $obj["length"];
$str="";
for($i=0;$i<$n;$i++){

	$stop_nome = $obj["data"][$i]["stop_name"];
	$stop_id = $obj["data"][$i]["stop_id"];
	if(($stop_id=="SA001FS")||($stop_id=="SA113ME")||($stop_id=="SA350CA")){

		$str = $str."<option value=\"".$stop_id."\">$stop_nome</option><br/>";
	}
	else{
	
		$str = $str."<option value=\"".$stop_id."\" disabled>$stop_nome</option><br/>";
	}
}
echo $str;
?>