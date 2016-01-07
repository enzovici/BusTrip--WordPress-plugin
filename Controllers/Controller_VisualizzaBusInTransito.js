	
function visualizzaBusInTransito(){
		
			var sel = document.getElementById("sel1").value;

			
			var ora= document.getElementById("inputOra").value;

		
		
			var xhttp = new XMLHttpRequest();
			if (xhttp==null) {
				alert("Il tuo browser non supporta AJAX!");
			}
			xhttp.onreadystatechange = function() {
			
				if (xhttp.readyState == 4 && xhttp.status == 200) {	//controlli
				
					tbody = document.getElementById("risultato");
					
					str='';
					righe = xhttp.responseText.split(';');
					n = righe.length-1;
					for(i = 0; i < n; i++)
					{
			 			str += "<tr>";
			 			valore = righe[i].split(',');
						m = valore.length;
						for(j = 0; j < m; j++)
			 			{
			 			  str += "<td>" + valore[j] + "</td>";
						}
						str += "</tr>";
       				}
					
					tbody.innerHTML = str;
				
				}
			};
			
			var url="/wp-content/plugins/bustrip/Models/Model_VisualizzaBusInTransito.php?selezione="+sel+"&ora="+ora;
			url=url+"&sid="+Math.random();
			xhttp.open("GET", url, true);
			xhttp.send(null);
		
		}
		
function popolaSelectVisualizzaBusInTransito(){

	var sel1 = document.getElementById("sel1");

    
    req= new XMLHttpRequest();
    req.onreadystatechange=function(){
    
    	if((req.readyState==4)&&(req.status==200)){
	
			
    		sel1.innerHTML=req.responseText;
    
    	}
    }
    req.open("Get","/wp-content/plugins/bustrip/Scripts/Script_VisualizzaBusInTransito_Select.php",true);
    req.send(null);

}