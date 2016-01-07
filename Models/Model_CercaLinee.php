<?php

	$tip=$_GET['tipologia'];
	
	
	$json=file_get_contents('Stub_CercaLinee.json');
	
	$obj = json_decode($json,true);
	$n = $obj["length"];
	
	$str="";
	
	if($tip=="Universitaria"){
			for($i=0 ; $i < $n ;$i++){
				if($obj["data"][$i]["category"]==='Universitaria'){
					$tmp=$obj["data"][$i]["route_long_name"];

					if (0 === strpos($tmp, 'Linea')) {
  						 $tmp2=split(":",$tmp);
  						 $tmp3=split("-",$tmp2[1]);
					}
					else{
  						 $tmp2=split(":",$tmp);
  						 $tmp3=split("-",$tmp2[0]);
					}
					$count=count($tmp3)-1;
					$id=$obj["data"][$i]["route_id"];
					$str=$str."$id,$tmp3[0],$tmp3[$count];";
				}
			}
	}else if($tip=="Interurbana"){
			for($i=0 ; $i < $n ;$i++){
				if($obj["data"][$i]["category"]==='Urbana'){
					$tmp=$obj["data"][$i]["route_long_name"];

					if (0 === strpos($tmp, 'Linea')) {
  						 $tmp2=split(":",$tmp);
  						 $tmp3=split("-",$tmp2[1]);
					}
					else{
  						 $tmp2=split(":",$tmp);
  						 $tmp3=split("-",$tmp2[0]);
					}
					$count=count($tmp3)-1;
					$id=$obj["data"][$i]["route_id"];
					$str=$str."$id,$tmp3[0],$tmp3[$count];";
				}
			}
	}else if($tip=="Urbana"){
			for($i=0 ; $i < $n ;$i++){
				if($obj["data"][$i]["category"]==='Interurbana'){
					$tmp=$obj["data"][$i]["route_long_name"];

					if (0 === strpos($tmp, 'Linea')) {
  						 $tmp2=split(":",$tmp);
  						 $tmp3=split("-",$tmp2[1]);
					}
					else{
  						 $tmp2=split(":",$tmp);
  						 $tmp3=split("-",$tmp2[0]);
					}
					$count=count($tmp3)-1;
					$id=$obj["data"][$i]["route_id"];
					$str=$str."$id,$tmp3[0],$tmp3[$count];";
				}
			}
	}else if($tip=="Qualsiasi"){
			for($i=0 ; $i < $n ;$i++){
					$tmp=$obj["data"][$i]["route_long_name"];
					
					if (0 === strpos($tmp, 'Linea')) {
  						 $tmp2=split(":",$tmp);
  						 $tmp3=split("-",$tmp2[1]);
					}
					else{
  						 $tmp2=split(":",$tmp);
  						 $tmp3=split("-",$tmp2[0]);
					}
					$count=count($tmp3)-1;
					$id=$obj["data"][$i]["route_id"];
					$str=$str."$id,$tmp3[0],$tmp3[$count];";			
			}
	}						
		
	echo $str;
?>