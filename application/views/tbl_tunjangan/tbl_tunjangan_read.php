<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Tbl_tunjangan Read</h2>
        <table class="table">
	    <tr><td>Jabatan</td><td><?php echo $jabatan; ?></td></tr>
	    <tr><td>Tunjangan Jabatan</td><td><?php echo $tunjangan_jabatan; ?></td></tr>
	    <tr><td>Tunjangan Makan</td><td><?php echo $tunjangan_makan; ?></td></tr>
	    <tr><td>Tunjangan Transport</td><td><?php echo $tunjangan_transport; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tbl_tunjangan') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>