<?php
include_once('../adodb/adodb.inc.php');

$tnsName="dwdb";
$usuario = "jzepeda";
$contrasenna = "jzepeda$1234";

$db = ADONewConnection('oci8');	
$db->debug = false; 
$con = $db->PConnect('192.168.10.124',$usuario,$contrasenna,'DW');

$SQL = "select ENAME,SAL from SCOTT.EMP";		

$rs = $db->Execute($SQL);						 

$labelx=array();
$datay=array();
$cadena='';

	do{
	   array_push($datay, $rs->fields["SAL"]/1000);
	   array_push($labelx, $rs->fields["ENAME"]);
	   $rs->MoveNext();
	}while(!$rs->EOF);
	
$cadena.="<graph caption=' Salarios' subcaption='000´s' numdivlines='4' linethickness='2' showValues='1' numVDivLines='10' 	formatNumberScale='1' rotateNames='1' decimalPrecision='1' anchorRadious='2' anchorBgAlpha='0' numberPrefix='' divLineAlpha='30' showAlternateHgridColor='1' yAxisMinValue='800000' shadowAlpha='50'>"; 
			$pos = 0; 
			$cadena.="<categories>"; 
			foreach ($labelx as $valor) 
				{ 
					$cadena.="<category Name='$valor' />"; 
				}
			$cadena.="</categories>"; 	
			$cadena.="<dataset seriesName='Salarios' color='FF0000' anchorBorderColor='CCCCCC' anchorRadious='4'>"; 
			foreach ($datay as $valor) 
				{ 
					$cadena.="<set value='$valor' />"; 
				} 
			$cadena.="</dataset>"; 
	        $cadena.="</graph>";
			
			 

?>

<center>
  <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/
		flash/swflash.cab#version=6,0,0,0" width="770" height="402" id="FC_2_3_Column3D" align="">
    <param name=movie value="Line.swf" />
    <param name="FlashVars" value="&dataXML=<?php echo $cadena;?>&chartWidth=750&chartHeight=402" />
    <param name=quality value=high />
    <param name=bgcolor value=#FFFFFF />
    <embed src="Line.swf" flashvars="&dataXML=<?php echo $cadena; ?>&chartWidth=750&chartHeight=402" quality=high bgcolor=#FFFFFF width="770" 
height="402" name="FC_2_3_Column3D" align="" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer"></embed>
  </object>
</center>