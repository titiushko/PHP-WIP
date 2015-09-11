<?php
  function BuscarHD($PID, $es = 0){
    $link = mysql_connect("localhost", "root", "");
    mysql_selectdb("php", $link);
    $res = mysql_query("SELECT * FROM foro WHERE PID = '".$PID."'", $link);
    $num = mysql_num_rows($res);
    if (!$num) {mysql_free_result($res); return FALSE;}
    for ($num--; $num >= 0; $num--){
      $tam = $es * 30;
      echo "<SPACER SIZE=".$tam.">\n";
      if ($es > 0) echo "<IMG SRC='seg.gif'>\n";
      mysql_data_seek($res, $num);
      $row = mysql_fetch_array($res);
      echo "<A HREF='verforo.php3?id=".$row["ID"]."'>".$row["texto"]."</A> - ".$row["nombre"]."<BR>\n";
      BuscarHD($row["ID"], $es + 1);
    }
    mysql_free_result($res);
    return TRUE;
  }
  
  $link2 = mysql_connect("localhost", "root", "");
  mysql_selectdb("php", $link2);
  $res2 = mysql_query("SELECT * FROM foro WHERE ID='".$id."'", $link2);
  if (mysql_num_rows($res2) != 1) { echo "<H1> Error </H1>"; exit;}
  $row = mysql_fetch_array($res2);  
?>

<HTML>
<HEAD>
<TITLE> Ver Foro </TITLE>
</HEAD>
<BODY TEXT="#000000" BGCOLOR="#ffffff" link="#000080">
<FONT FACE=Arial SIZE=2>
<TABLE BORDER=0 WIDTH=100%>
<TR><TD BGCOLOR=#6666BB><?php echo $row["nombre"];?>: [<?php echo $row["texto"]; ?>] escribio: </TD></TR>
</TABLE>
<P ALIGN="justify">
<?php echo $row["texto2"]; ?>
</p>
<TABLE BORDER=0 WIDTH=100%>
<TR><TD BGCOLOR=#6666BB>Fin mensaje</TD></TR>
</TABLE>
<H5>Notas siguientes:</H5>
<?php
  if (!BuscarHD($id)) echo "<H6> Vacio </H6>";
?>
<BR>
<H2> Responder </H2>
<FORM ACTION="addforo.php3" METHOD=POST>
<INPUT TYPE="hidden" NAME="pid" VALUE="<?php echo $row["ID"]; ?>">
Nombre: <INPUT TYPE="text" NAME="nombre"><BR>
Titulo: <INPUT TYPE="text" NAME="texto" VALUE="RE: <?php echo $row["texto"]; ?>"><BR>
Texto:  <BR><TEXTAREA NAME="texto2" ROWS=6 COLS=60></TEXTAREA><BR>
<INPUT TYPE="submit" VALUE="Enviar"><INPUT TYPE="reset" VALUE="Borrar">
</FORM>
</BODY>
</HTML>

<?php mysql_free_result($res2); ?>
