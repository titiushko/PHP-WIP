<?
session_start();
if(!isset($_SESSION["login"])){
header("location:login.php");
} else {
echo "<html><body>";
echo "<h1>SectorWeb.net</h1>";
echo "Bienvenido al Area de usurios: <strong>";
echo $_SESSION["nombre"]." ".$_SESSION["apaterno"]." ".$_SESSION["amaterno"]." ";
echo "</strong><br>Has entrado con el nick: <strong> ";
echo $_SESSION["login"];
echo "</strong><br>Para cerrar la sesión, pulsa: <a href='logout.php'>Aqui</a>";
echo "</body></html>".isset($_SESSION);
}
?>
