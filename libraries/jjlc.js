/**
 * @author José Correia 
 */

var xmlhttp;

/**
 * @name carrega
 * @param target
 * @param destination
 * @returns
 * 
 * This funtion loads a page (target) in to a html element (destination)
 */
function carrega(target, destination)
{
	xmlhttp=new XMLHttpRequest();
	xmlhttp.open("GET",target, true);
	xmlhttp.onreadystatechange= function()
								{
		 							if (xmlhttp.readyState == 4)
		 							{
		 								document.getElementById(destination).innerHTML = xmlhttp.responseText;
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