var tabLinks = new Array();//mi salvo i tabLink
var contentDivs = new Array();//mi salvo i contenitori associati ad ogni link

//mi restituisce il nome prelevandolo dall'href dell anchor
 function getName( url ) {
      var hashPos = url.lastIndexOf ( '#' );
      return url.substring( hashPos + 1 );
    }
    
//mi restituisce il riferimento al primo oggetto che tiene quel tagName    
	function getFirstChildWithTagName( element, tagName ) {
      for ( var i = 0; i < element.childNodes.length; i++ ) {
        if ( element.childNodes[i].nodeName == tagName ) return element.childNodes[i];
      }
    }

//Si prende tabs, e analizza il contenuto creando i riferimenti agli oggetti e salva negli appositi array
    function init() {

      var tabListItems = document.getElementById('tabs').childNodes;
     
      for ( var i = 0; i < tabListItems.length; i++ ) {
      
        if ( tabListItems[i].nodeName == "LI" ) {
  
          var tabLink = getFirstChildWithTagName( tabListItems[i], 'A' );
           
          var id = getName( tabLink.getAttribute('href') );
          tabLinks[id] = tabLink;
          contentDivs[id] = document.getElementById( id ); 
        }
      }  
      
//Assegna i listener al click sul Tab e cambia la classe del primo tab 
      var i = 0;

      for ( var id in tabLinks ) {
        tabLinks[id].onclick = showTab;
        tabLinks[id].onfocus = function() { this.blur() };
        if ( i == 0 ) tabLinks[id].className = 'active';
        i++;
      }
 
//Al click cambia la classe al tab cliccato e visualizza il relativo div      
  function showTab() {
      var selectedId = getName( this.getAttribute('href') );
    // Highlight the selected tab, and dim all others.
      // Also show the selected content div, and hide all others.
      for ( var id in contentDivs ) {
        if ( id == selectedId ) {
          tabLinks[id].className = 'active';
          contentDivs[id].className = 'tab-pane active';
        } else {
          tabLinks[id].className = '';
          contentDivs[id].className = 'tab-pane hidden';
        }
      }
      return false;
    }
    
 

//all'inizio nascondo tutti i div tranne il primo
      var i = 0;

      for ( var id in contentDivs ) {
        if ( i != 0 ) contentDivs[id].className = 'tab-pane hidden';
        i++;
      }
    }
function popolaSelectCalcolaPercorso(){

	var selPartenza = document.getElementById("CalcolaPercorsoSelectPartenza");
	var selDestinazione = document.getElementById("CalcolaPercorsoSelectDestinazione");

    
    req= new XMLHttpRequest();
    req.onreadystatechange=function(){
    
    	if((req.readyState==4)&&(req.status==200)){
	
			
    		selPartenza.innerHTML=req.responseText;
    
    	}
    }
    req.open("Get","/wp-content/plugins/bustrip/Scripts/Script_CalcolaPercorso_Select_1.php",true);
    req.send(null);
    
    
    req2= new XMLHttpRequest();
    req2.onreadystatechange=function(){
    
    	if((req2.readyState==4)&&(req2.status==200)){
	
			
    		selDestinazione.innerHTML=req2.responseText;
    
    	}
    }
    req2.open("Get","/wp-content/plugins/bustrip/Scripts/Script_CalcolaPercorso_Select_2.php",true);
    req2.send(null);

}