<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-dropdown.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/grocery_crud/js/jquery-1.7.1.min.js"></script>

    <?php if (isset($this->session->userdata['logged_in'])) {
 ?>
  <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <ul class="nav">
				<?php if (isset($this->session->userdata['logged_in']) && ($this->session->userdata['id_privilegio'] == 1)) {
                        ?>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown">Trazas<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo site_url('trazas'); ?>">Ver Trazas</a></li>
                                    <li><a href="<?php echo site_url('trazas/delete'); ?>">Borrar Trazas</a></li>
                                </ul>
                            </li>
                        <?php } ?>
						<?php if (isset($this->session->userdata['logged_in']) && ($this->session->userdata['id_privilegio'] == 1)) {
                        ?>
                            <li><a href="<?php echo site_url('backup_db'); ?>">Salvar Base de Datos</a></li>
                        <?php } ?>
						
						<?php if (isset($this->session->userdata['logged_in'])) {
                        ?>
                            <li><a href="<?php echo site_url('productos'); ?>">Productos</a></li>
                        <?php } ?>
                        
            </ul>
          <div class="btn-group pull-right">
            <a class="btn dropdown-toggle" data-toggle="dropdown">
              <i class="icon-user"></i><strong>Bienvenido:</strong> <?php echo $this->session->userdata['username'];?>
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo site_url('usuarios'); ?>">Usuario</a></li>
              <li class="divider"></li>
              <li><a href="<?php echo site_url('logout'); ?>">Cerrar Sesi&oacute;n</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
	<?php } ?>
 
<!-- Masthead
================================================== -->
<header class="jumbotron masthead">
  <div class="inner">
  <div align="center"><img src="<?php echo base_url(); ?>assets/images/logo-app.png" width="48" height="48"/></div>
    <h1>Ejemplo de Permisos</h1>
  </div>
</header>
</html>
