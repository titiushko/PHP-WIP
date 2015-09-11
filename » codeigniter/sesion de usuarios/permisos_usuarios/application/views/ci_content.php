<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<div class="container">
    <div class="hero-unit-table">
        <?php foreach ($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>
        <?php foreach ($js_files as $file): ?>
                <script src="<?php echo $file; ?>"></script>
        <?php endforeach; ?>
                <div style="padding-top: 5px">
            <?php echo $output; ?>
        </div></div>
</div>

