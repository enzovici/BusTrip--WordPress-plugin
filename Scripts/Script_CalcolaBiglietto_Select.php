<?php
$url = "Stub_CalcolaBiglietto_Select.json";
$json = file_get_contents($url);
$obj = json_decode($json,true);
$n = $obj["length"];
$str="";
for($i=0;$i<$n;$i++){
$nome = $obj["data"][$i]["city_name"];
$str = $str."<option value=\"".urlencode($nome)."\">$nome</option><br/>";
}
echo $str;
?>