/**
 * 
 */
var xmlhttp;

function abre()
{
	xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET","../models/abremenu.php", true);
	xmlhttp.onreadystatechange= function()
								{
		 							if (xmlhttp.readyState == 4)
		 							{
		 								document.getElementById("footnote").innerHTML = xmlhttp.responseText;
		 							}
								}
	xmlhttp.send();
}

function GetXmlHttpObject()
{
	if (window.XMLHttpRequest)
	  {
	  // code for IE7+, Firefox, Chrome, Opera, Safari
		return new XMLHttpRequest();
	  }
	if (window.ActiveXObject)
	  {
	  // code for IE6, IE5
		return new ActiveXObject("Microsoft.XMLHTTP");
	  }
	return null;
}