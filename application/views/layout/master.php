<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo isset($title) ? $title : APP_NAME; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/global.css" />
        <?php
        if (isset($css)) {
            if (is_array($css)) {
                foreach ($css as $val) {
                    echo '<link rel="stylesheet" type="text/css" href="' . $val . '" />';
                }
            } else {
                echo '<link rel="stylesheet" type="text/css" href="' . $css . '" />';
            }
        }
        ?>
    </head>
    <body>
        <div class="container">
            <?php
            $this->load->view('layout/nav');
            $this->load->view($content);
            ?>


            <footer>
                <div class="container">
                    <p class="pull-right"><a href="#">Back to top</a></p>
                </div>
            </footer>
        </div>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
        <?php
        if (isset($script)) {
            if (is_array($script)) {
                foreach ($script as $val) {
                    echo $val;
                }
            } else {
                echo $script;
            }
        }
        ?>
        <?php
        if (isset($js)) {
            if (is_array($js)) {
                foreach ($js as $val) {
                    echo '<script type="text/javascript" src="' . $val . '"></script>';
                }
            } else {
                echo '<script type="text/javascript" src="' . $js . '"></script>';
            }
        }
        ?>
    </body>
</html>