function showHintWork(str) {
    		if (str.length == 0) { 
        		document.getElementById("txtHint").innerHTML = "";
        		return;
    		}
    		else {
        		var xmlhttp = new XMLHttpRequest();
        		xmlhttp.onreadystatechange = function() {
            		if (this.readyState == 4 && this.status == 200) {
                		document.getElementById("txtHint").innerHTML = this.responseText;
            		}
        		};
        	xmlhttp.open("GET", "revstatuscheck.php?q=" + str, true);
        	xmlhttp.send();
    		}
		}

function showHintBuy(str) {
            if (str.length == 0) { 
                document.getElementById("txtHint").innerHTML = "";
                return;
            }
            else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("txtHint").innerHTML = this.responseText;
                    }
                };
            xmlhttp.open("GET", "statuscheckbuy.php?q=" + str, true);
            xmlhttp.send();
            }
        }
function ajaxFunction(){
   var ajaxRequest;  // The variable that makes Ajax possible!
   try{
   
      // Opera 8.0+, Firefox, Safari
      ajaxRequest = new XMLHttpRequest();
   }catch (e){
      
      // Internet Explorer Browsers
      try{
         ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
      }catch (e) {
         
         try{
            ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
         }catch (e){
         
            // Something went wrong
            alert("Your browser broke!");
            return false;
         }
      }
   }
   
   // Create a function that will receive data
   // sent from the server and will update
   // div section in the same page.
   ajaxRequest.onreadystatechange = function(){
   
      if(ajaxRequest.readyState == 4){
         var ajaxDisplay = document.getElementById('ajaxDiv');
         ajaxDisplay.innerHTML = ajaxRequest.responseText;
      }
   }
   
   // Now get the value from user and pass it to
   // server script.
   var order = document.getElementById('order').value;
   var part = document.getElementById('part').value;
   var queryString = "?order=" + order ;
   queryString +=  "&part=" + part;

   ajaxRequest.open("GET", "php/getlogs.php" + queryString, true);
   ajaxRequest.send(null); 
}
//-->

function showOrder(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","php/getorder.php?q="+str,true);
        xmlhttp.send();
    }
}

function showProduct(str){
   if (str == "") {
        document.getElementById("productHint").innerHTML = "";
        return;
    }
    else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        }
        else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("productHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","php/getproduct.php?prod="+str,true);
        xmlhttp.send();
    }
}


