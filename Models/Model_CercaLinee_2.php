<?php
	
	$str="";
	
	$route_id=$_GET['route_id'];	
	
	$url="Stub_CercaLinee_2.json";
	
	$json = file_get_contents($url);
	
	$obj = json_decode($json,true);
    
	$n = $obj["length"];
    
	//$trovato = 0;
	for($i=0, $indice = 0, $trovato = 0;$i<$n;$i++){
        if($route_id == $obj["data"][$i]["route_id"]){
            $trovato++;
            $stop_name = $obj["data"][$i]["stop_name"];
            $time = $obj["data"][$i]["time"];
            $str = $str."$stop_name,$time;";
            $coordinate[$indice]["lat"] = $obj["data"][$i]["stop_lat"];
            //echo "Ho salvato la lat".$coordinate[$i]["lat"];
            $coordinate[$indice]["lon"] = $obj["data"][$i]["stop_lon"];
            //echo "Ho salvato la lon ".$coordinate[$i]["lon"];
            $indice++;
        }else{
            if($trovato > 0) break;
        }
	}
    //echo "In totale ho salvato ".count($coordinate)."elementi<br/>";
    //var_dump($coordinate);
	echo $str."|";
    //echo "<br/>".count($coordinate)."<br/>";
        
        //-- Gestione coordinate -- 
        $strCoordinate = "";
        
        if(($y = count($coordinate)) > 8){
            while(count($coordinate) > 8){
                $indice = 0;
                $eliminati = 0;
                for($x = 0,$indice = 0; $x < count($coordinate); $x++){
                    if($x > 1 and $x < count($coordinate)-1){ // Se non è né il primo né l'ultimo
                        if(((rand(0,1) == 1) and (count($coordinate) - $eliminati > 8))){
                            $eliminati++;
                            //echo "Ho eliminato $eliminati elementi<br/>";
                            continue;
                        }else{
                            $ris[$indice]["lat"] = $coordinate[$x]["lat"];
                            $ris[$indice]["lon"] = $coordinate[$x]["lon"];
                            $indice++;
                            //echo "Salvo. Ho salvato ".count($ris)." elementi.<br/>";
                        }
                    }else{ // il primo e l'ultimo devono essere salvati in ogni caso
                        $ris[$indice]["lat"] = $coordinate[$x]["lat"];
                        $ris[$indice]["lon"] = $coordinate[$x]["lon"];
                        $indice++;
                        //echo "Salvo. Ho salvato ".count($ris)." elementi.<br/>";
                    }
                }
                $coordinate = $ris;
                $ris = array();
//                echo "Alla fine del ciclo ris ha ".count($ris)." e coordinate ha ".count($coordinate)."<br/>";
            }
        }
        //echo "<br/>".count($coordinate)."<br/>";
        for($k = 0; $k < count($coordinate); $k++){
                $strCoordinate = $strCoordinate.$coordinate[$k]["lat"].",".$coordinate[$k]["lon"].";";
        }
        
        echo $strCoordinate;
?>