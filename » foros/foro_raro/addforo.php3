<?php
  $link = mysql_connect("localhost", "root", "");
  mysql_selectdb("php", $link);
  $res = mysql_query("INSERT INTO foro (PID, nombre, texto, texto2) VALUES (".$pid.", '".$nombre."', '".$texto."', '".$texto2."')", $link);
  if (mysql_affected_rows($link) != 1) {echo "<H1> error </H1>"; exit;}
?>
<SCRIPT LANGUAGE="JavaScript">
  location.href="mostrarforo.php3";
</SCRIPT>