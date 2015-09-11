<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<html xmlns="http://www.w3.org/1999/xhtml">
   <link rel="stylesheet" type="text/css" href="style/style106_right.css" />
   <link rel="stylesheet" type="text/css" href="style/colour2.css" />
   <LINK href="style/style.css" type=text/css rel=StyleSheet>
   <LINK href="style/style1.css" type=text/css rel=StyleSheet>
    <LINK href="style/stilo.css" type=text/css rel=StyleSheet>
	<style type="text/css">
<!--
.borde {border: #2ea3d0 3px solid;}
.more {font-size:12px; color:#FFFFFF; font-family:Arial;}
.more1 {font-size:10px; font-family:Arial}
.more2 {font-size:12px; font-family:Arial}

-->
</style>
<head>
<title>Catalogo Empleados</title>
<script language="JavaScript" type="text/javascript" src="ajax.js"></script>

<style type="text/css">
body {
      font-family: Verdana, Arial, Helvetica, sans-serif;
      font-size: 10px;
      background-color: #FFFFFF;
      margin-left: 100px;
      margin-right: 100px;
}
#ContTabul {
      border-left: 1px solid #CCC;
      border-right: 1px solid #CCC;
      border-bottom: 1px solid #CCC;
      padding: 10px 5px 6px 5px;
	  background-color:#FFFFFF;
}
ul#tabnav {
      list-style-type: none;
      margin: 0;
      padding-left: 40px;
      padding-bottom: 24px;
      border-bottom: 1px solid #CCC;
      font: 11px verdana, arial, sans-serif;
}
ul#tabnav li {
      float: left;
      height: 21px;
      background-color: #E4E4E4;
      color: #666;
      margin: 2px 10px 0 2px;
      border: 1px solid #CCC;
}
ul#tabnav a:link, ul#tabnav a:visited {
      display: block;
      color: #666;
      text-decoration: none;
      padding: 4px;
}
ul#tabnav a:hover {
      background-color: #CCC;
      color: #666;
}
#tabnav .activo {
      border-bottom: 1px solid #fff;
      color: #000000;
      background-color: #FFFFFF;
}
#tabnav .inactivo {}

</style>
<script language = "javascript">
var peticion = false; 
if (window.XMLHttpRequest) {
      peticion = new XMLHttpRequest();
      } else if (window.ActiveXObject) {
            peticion = new ActiveXObject("Microsoft.XMLHTTP");
}


function ObtenerDatos(datos,divID) { 
if(peticion) {
     var obj = document.getElementById(divID); 
     peticion.open("GET", datos); 
     peticion.onreadystatechange = function()  { 
          if (peticion.readyState == 4) { 
               obj.innerHTML = peticion.responseText; 
          } 
     } 
peticion.send(null); 
}
}

function CambiarEstilo(id) {
	var elementosMenu = getElementsByClassName(document, "li", "activo");
	for (k = 0; k< elementosMenu.length; k++) {
	elementosMenu[k].className = "inactivo";
	}
	var identity=document.getElementById(id);
	identity.className="activo";
}


function getElementsByClassName(oElm, strTagName, strClassName){
    var arrElements = (strTagName == "*" && document.all)? document.all : oElm.getElementsByTagName(strTagName);
    var arrReturnElements = new Array();
    strClassName = strClassName.replace(/\-/g, "\\-");
    var oRegExp = new RegExp("(^|\\s)" + strClassName + "(\\s|$)");
    var oElement;
    for(var i=0; i<arrElements.length; i++){
        oElement = arrElements[i];      
        if(oRegExp.test(oElement.className)){
            arrReturnElements.push(oElement);
        }   
    }
    return (arrReturnElements)
}


</script>
</head>
</head>

<body>
  <div id="main">
    
  <div id="links"> </div>
    <div id="logo"><h1>Aplicacion AJAX</h1></div>
    
  <div id="content"> 
 
<div id="ContTabul">
<center>
<h2>Empleados</h2></center>
<div id="formulario" style="display:none;background:url(images/nav2_bg.gif);color:#000000;border:1;">
</div>
<div id="resultado">
<?php require "index3.php"; ?>
</div>
</div>


</div>
    <div id="footer">
      &copy; 2007 Desarrollado por Erik Blanco Bates
    </div>
  </div>
</body>
</html>
