<h1>Eliminar Contacto</h1>
<br/>

Esta Seguro de Eliminar el Contacto: <b><?php echo $datos_contacto[0]->con_nombre ?></b>

<?php

$input_con_id = array(
              'con_id'        => $datos_contacto[0]->con_id,
            );

?>


<?php echo form_open(); ?><br/>
<?php echo form_hidden($input_con_id); ?><br/>
<?php echo form_submit('btn_guardar','Si Estoy Seguro!'); ?>
<?php echo form_close(); ?><br/>