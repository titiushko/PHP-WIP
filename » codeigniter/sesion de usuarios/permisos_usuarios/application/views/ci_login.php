 <div class="container">
<div class="form-actions" align="center">
  <div align="center"><h2>Autenticarse</h2> </div>
  </div>
  <div class="alert alert-info" align="center">
        <?php echo form_open('index.php/welcome'); ?>
        <div align="center" style="padding-top: 20px"><strong>Nombre de Usuario:</strong> <input class="span3" type="text" placeholder="Nombre de Usuario" name="username"></div>
        <div align="center" style="padding-top: 10px"><strong>Contraseña:</strong> <input class="span3" type="password" placeholder="Contraseña" name="password"></div>
        <div align="center" style="padding-top: 20px"><button class="btn btn-primary" type="submit" id="b_login">Entrar</button></div>
        <?php echo form_close(); ?>
		</div>
        <?php if (!empty($error)) {
 ?>
   <div align="center" class="alert alert-error"><strong>Error! </strong><?php echo $error; ?></div>
<?php } ?>
</div>
