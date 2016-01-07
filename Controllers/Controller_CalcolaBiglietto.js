 function calcolaBiglietto(){
     var partenza = document.getElementById("selectPartenza").value;


   	 var destinazione = document.getElementById("selectDestinazione").value;

     var url = "/wp-content/plugins/bustrip/Models/Model_CalcolaBiglietto.php?partenza="+partenza+"&destinazione="+destinazione; //prendere la roba dalle select
    file=new XMLHttpRequest();
 	file.onreadystatechange=function(){
    
          if ((file.readyState == 4) && (file.status == 200)) {
          	div = document.getElementById("divRisultato");
         	righe = file.responseText.split(';');
    		n = righe.length;
     		str = "<div id=\"table-wrapper\"><div id=\"table-scroll\">" +
     		"<table class=\"table table-condensed table-striped\">" +
		 	"<thead><tr><th>Tariffa</th><th>Corsa Singola</th><th>Giornaliero</th>" +
     		"<th>Settimanale</th><th>Mensile</th><th>Annuale</th></tr></thead><tbody>";
     		for(i = 0; i < n; i++){
      			str += "<tr>";
       			valore = righe[i].split(',');
       			m = valore.length;
       			for(j = 0; j < m; j++){
       				if((j>0)&&(valore[j]!="-")){
       					str += "<td>&#8364;&nbsp;&nbsp;" + valore[j] + "</td>";
       				}
       				else{
       				
         			str += "<td>" + valore[j] + "</td>";
         			}
      			}
      			 str += "</tr>";
     		}

     		str += "</tbody></table></div></div>";
            div.innerHTML = str;
    	 }
	}
        file.open("GET",url,true);
        file.send(null);
   }
   
   
function popolaSelectCalcolaBiglietto(){

	var selPartenza = document.getElementById("selectPartenza");
    var selDestinazione = document.getElementById("selectDestinazione");
    
    req= new XMLHttpRequest();
    req.onreadystatechange=function(){
    
    	if((req.readyState==4)&&(req.status==200)){
	
			
    		selPartenza.innerHTML=req.responseText;
    		selDestinazione.innerHTML=req.responseText;
    	}
    }
    req.open("Get","/wp-content/plugins/bustrip/Scripts/Script_CalcolaBiglietto_Select.php",true);
    req.send(null);

}