

<html>
    <head>
        <script type="text/javascript">
            var centreGot = false;
        </script>
        <?php echo $map['js']; ?>
        <link rel="stylesheet" href="<?php echo base_url() ?>/assets/bootstrap5/css/bootstrap.css" />
    </head>
    <body>
        <a class="btn btn-primary" href="<?= base_url()?>/listar_usuarios">Atrás <i class="fa fa-building" aria-hidden="true"></i></a>
        <?php echo $map['html']; ?>
        <div id="directionsDiv"></div>
    </body>
</html>