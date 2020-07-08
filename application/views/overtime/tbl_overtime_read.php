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
        <h2 style="margin-top:0px">Tbl_overtime Read</h2>
        <table class="table">
	    <tr><td>Overtime</td><td><?php echo $overtime; ?></td></tr>
	    <tr><td>Tambahan Overtime</td><td><?php echo $tambahan_overtime; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('overtime') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>