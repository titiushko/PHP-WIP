<?
/**
* @author L.I. Juan José Esparza barajas
* @date Lunes, 18 de junio de 2008
* @copyright 2008
* @Version 1.0
* @License Freeware
*/
Class MySql_Class{
// function conection
var $user= "root";
var $password= "root";
var $server= "localhost";
var $db="paises";
var $erroconec="Error conectando a la base de datos";
var $errodatabase="Error conectando a la base de datos";
// function query
var $errorempty="La consulta se encuentra vacia";
var $errorquery="<b>Error al ejecutar la consulta:</b>";
var $result;
//function query -pagination
var $itemspage = 4;
var $label_next = "Siguiente";
var $label_previous= "Anterior";
var $amountitems=0;
var $home = 0;
var $end =0;
var $page=1;
var $numPages=0;
var $labelpagination="Páginas";
var $divclass = "pagination";
var $hrefclass= "a_paginado";
var $hreftext = "Texto";
// For connection to the database
function conection(){
if (!($link=mysql_connect($this->server,$this->user,$this->password))){
die($this->$erroconec);
}
if (!$link=mysql_select_db($this->db,$link)){
die($this->$errodatabase);
}
return($link);
}
//Run SQL
function query($sql,$pagination=''){
if(empty($sql)){
die($this->errorempty);
}
$tipo = explode(" ",$sql);
if(strtoupper($tipo[0])=="SELECT"){
$select = true;
}
if(strtoupper($tipo[0])=="INSERT"){
$insert = true;
}
if($pagination=='P'){ // Pagination
if($_REQUEST["page"]){
$this->page=$_REQUEST["page"];
}
$this->result = mysql_query($sql);
$this->amountitems = mysql_num_rows($this->result);
if(empty($this->page)){
$this->page=1;
$this->home=1;
$this->end=$this->itemspage;
}
$limitInf=(($this->page-1) * $this->itemspage);
$this->numPages=ceil($this->amountitems/$this->itemspage);
if(empty($this->page)){
$this->page=1;
$this->home=1;
$this->end= $this->itemspage;
}else{
$seccionActual=intval(($this->page-1)/$this->itemspage);
$this->home=($seccionActual*$this->itemspage)+1;
if($this->page< $this->numPages){
$this->end=$this->home + $this->itemspage-1;
}else{
$this->end=$this->itemspage;
}
if ($this->end>$this->numPages){
$this->end=$this->numPages;
}
}
$sql = $sql." LIMIT ".$limitInf.",".$this->itemspage;
}
$this->result = mysql_query($sql);
if($this->result){
$return["success"] = true;
if($select){
while($rs = mysql_fetch_array($this->result)){
$return["data"][]=$rs;
}
$amount = mysql_num_rows($this->result);
if($amount >0){
$return["amount"]=$amount;
}else{
$return["amount"] = 0;
}
}
if($insert){
$return["insert_id"]=mysql_insert_id();
}
}else{
die($this->errorquery."<br><b>".$sql."</b><br>".mysql_error());
}
$return["SQL"]=$sql;
return($return);
}
// To clean the problem quotes
function sql_quotes($value){
if(get_magic_quotes_gpc())
$value = stripslashes($value);
//check if this function exists
if(function_exists("mysql_real_escape_string"))
$value = mysql_real_escape_string($value);
else//for PHP version < 4.3.0 use addslashes
$value = addslashes( $value );
return $value;
}
// Count items SQL
function countitems($sql){
$result = mysql_query($sql);
if($result){
$cant = mysql_num_rows($result);
$salida=$cant;
}else{
die($this->errorquery."<br><b>".$sql."</b><br>".mysql_error());
}
return($salida);
}
// show pagination
function showpagination($morevar=''){
if($this->amountitems>0){
echo '<div align="right" class="'.$this->divclass.'">';
echo '<b>'.$this->labelpagination.': </b>';
if($this->page>1){
echo '<a class="'.$this->hrefclass.'" href="'.$_SERVER['PHP_SELF']."?page=".($this->page-1).'&'.$morevar.'"> '.$this->label_previous.'</a>';
}
for($i=$this->home;$i<=$this->end;$i++){
if($i==$this->page){
echo ' <span class="'.$this->hreftext.'">'.$i.'</spaa>';
}else{
echo ' <a class="'.$this->hrefclass.'" href="'.$_SERVER['PHP_SELF']."?page=".$i.'&'.$morevar.'">'.$i.'</a>';
}
}
if($this->page<$this->numPages){
echo '<a class="'.$this->hrefclass.'" href="'.$_SERVER['PHP_SELF']."?page=".($this->page+1).'&'.$morevar.'"> '.$this->label_next.'</a>';
}
echo "</div>";
}
}
}
?>