<div class="container">
    <div class="hero-unit">
        <h1>Bienvenido <?php echo $this->session->userdata['firstname'].' '.$this->session->userdata['lastname']; ?></h1>
            <div style="padding-top: 15px"><p><?php echo $description_privilegio;?></p></div>
    </div>
</div>


