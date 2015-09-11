<?php
if($_REQUEST){
	$id = $_REQUEST['parent_id'];
	$query = "select * from ajax_categories where pid = '$id'";
	$results = mysql_query( $query);
	echo "<select name='sub_category' id='sub_category_id'>";
	echo "<option value='' selected='selected'></option>";
	echo "<option value='0'>cero</option>";
	while ($rows = mysql_fetch_assoc($results)){
		echo "<option value='".$rows['id']."'>".$rows['category']."</option>";
	}
	echo "</select>	";
}
?>