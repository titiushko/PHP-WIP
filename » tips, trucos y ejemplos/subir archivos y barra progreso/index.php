<!--www.codigo-fuente.com-->
<?php
  //Creamos un id único para cada subida
  $id=md5(uniqid(rand(), true));
?>
<html>
<head>
	<script>
		/*MODIFICAR ESTA VARIABLE*/
		/**/var url_cgi = "http://codigo-fuente.com/cgi-bin/subir_archivos_barra_progreso_2/upload.cgi"	;
		/*FIN MODIFICACION*/
			var error;
		function crearXMLHTTP(){
			var cxm = null;
			try{
				cxm = new XMLHttpRequest();
			}catch(e){
				cxm = new ActiveXObject("Microsoft.XMLHTTP");
			}
			return cxm;
		}
		function subirArchivo(){
			
			var nombre_path = document.getElementById("archivo").value.split("\\");
			var nombre_archivo = nombre_path[nombre_path.length-1];
			var id ="<?=$id?>";
             //Filtramos la ruta y comprobamos que cumpla el archivocon la extensión permitida
			var extension_archivo = nombre_archivo.split(".");
			var extension = extension_archivo[extension_archivo.length-1];
		 	if( !extension.match(/(jpg)|(JPG)|(jpeg)|(JPEG)|(gif)|(png)|(zip)|(pdf)|(rar)|(nrg)/) )
			{
				alert ( "Sólo se permite subir archivo: jpg, gif, png, pdf y zip" );
				return false;
			}
			
			error = 0;
				
			//Montamos el action para el form
			document.forms[0].action = url_cgi+"?n_archivo="+nombre_archivo+"&id="+id;
      		//Enviamos el archivo a la ruta anteriror
      		document.forms[0].submit();

      		//Sacamos la información del archivo
			setTimeout("infoFile()",500);
			
		}
		function infoFile()
		{
			var url = "proceso.php"; //Archivo donde se irá comprobando el estado
			var tipo_contenido = "application/x-www-form-urlencoded";
     		var metodo = "post";
		  	var paramentros="op=info&id=<?=$id?>";
			//Obtenemos nuestro objeto XMLHttp
			var obcxm = crearXMLHTTP();
			//Abrimos la conexión
			obcxm.open(metodo, url, true);
			obcxm.setRequestHeader('Content-Type', tipo_contenido);
			//Mientras hayan cambios de estado ejecutamos la función estadoPeticion()
			obcxm.onreadystatechange = function(){
          		if (obcxm.readyState == 4){
    				if(obcxm.status == 200){	
    					if(obcxm.responseText!=""){
                  			enviarPeticion();
              			}
    				}else{}
    			}
      		};
			//Le pasamos los parametros anteriormente declarados
			obcxm.send(paramentros);
		}
		function enviarPeticion(){
			
			//Obtenemos nuestro objeto XMLHttp
			var obcxm = crearXMLHTTP();
			var url = "proceso.php"; //Archivo donde se irá comprobando el estado
			var tipo_contenido = "application/x-www-form-urlencoded";
     		var metodo = "post";			
			var paramentros="op=status&id=<?=$id?>"; 
			//Abrimos la conexión
			obcxm.open(metodo, url, true);
			obcxm.setRequestHeader('Content-Type', tipo_contenido);
			//Mientras hayan cambios de estado ejecutamos la función estadoPeticion()
			obcxm.onreadystatechange = function(){
				if (obcxm.readyState == 4){
					if(obcxm.status == 200){	
						if(obcxm.responseText!="100" && error == 0){
							//Mientras no haya llegado al 100 ejecutamos la función enviarPeticion() para saber su estado
							setTimeout("enviarPeticion()",100);
							//Enviamos el tanto por ciento para pintar la barra
							barraProgreso(obcxm.responseText);
						}	
	
					}
				}
			};
			//Le pasamos los parametros anteriormente declarados
			obcxm.send(paramentros);			
		}
		function barraProgreso(info)
		{
		      var arr = info.split("###");
		      if(arr[1]=="ERROR" || arr[1]=="ERROR2")//Detenemos el action
		      {
		          error = 1;
		          try
		          {
		           	//Sólo en IE  
                  	document.execCommand("Stop");
             	  }catch(err){
                  	//En firefox
                  	window.stop();
              	  }
              if(arr[1]=="ERROR")
              {
                	document.getElementById("total").innerHTML ="Total : "+ arr[2];
        		    document.getElementById("cargando").innerHTML ="Tama&ntilde;o de archivo no permitido, m&aacute;ximo "+arr[0];
              }else{
                	document.getElementById("total").innerHTML ="";
        		    document.getElementById("cargando").innerHTML ="Error con el archivo";              
              }
          }else{
  		     //Pintamos la barra incrementando el width
        		document.getElementById("por").style["width"]=arr[0]+"%";
        		document.getElementById("total").innerHTML ="Total : "+ arr[2];
        		document.getElementById("cargando").innerHTML ="Cargando : "+ arr[1];
        		document.getElementById("por").innerHTML = arr[0] + "%";
        	}
    	}		
	</script>
	<style type="text/css">
		#caja{
			width:350px;
			height:90px;
		}
		#barra{
			width:290px;
			height:20px;
			border:1px solid #000000;
			margin-top:10px;
		}
		#por{
		  width:0%;
		  height:20px;
		  float:left;
		  background-image:url(img/bar.png);
		  text-align:right;
		}
	</style>
</head>
<body>
	<form name="forumlario" id="forumlario" enctype="multipart/form-data" method="post" target="_self">
	<div id="caja">
		<input type="file" name="archivo" id="archivo" />
		<input type="button" name="boton" value="Enviar" onClick="subirArchivo()"/>
		<div id="barra">
		<div id="por"></div>
      </div>
      <div id="info">
        <div id="total">Total : </div>
        <div id="cargando">Cargando : </div>
      </div>
	</div>
	</form>
</body>
</html>