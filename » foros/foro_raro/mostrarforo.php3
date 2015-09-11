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

?>
<HTML>
<HEAD>
<TITLE> Foro </TITLE>
</HEAD>
<BODY  TEXT="#000000" BGCOLOR="#ffffff" link="#000080">
<FONT FACE=Arial SIZE=2>
<P>
<?php
  BuscarHD(0);
?>
</TABLE>
<BR><HR SIZE=10 WIDTH=75%><BR>
<I><CENTER><H2> Agregar nueva nota</H2></CENTER></I>
<FORM ACTION="addforo.php3" METHOD=POST>
<INPUT TYPE="hidden" NAME="pid" VALUE="0">
Nombre: <INPUT TYPE="text" NAME="nombre"><BR>
Titulo: <INPUT TYPE="text" NAME="texto"><BR>
Texto:  <BR><TEXTAREA NAME="texto2" ROWS=8 COLS=60></TEXTAREA><BR>
<INPUT TYPE="submit" VALUE="Enviar"><INPUT TYPE="reset" VALUE="Borrar">
</FORM>
</BODY>
</HTML>

