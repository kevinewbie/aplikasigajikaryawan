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
        <h2 style="margin-top:0px">Tbl_gaji Read</h2>
        <table class="table">
	    <tr><td>Nama Karyawan</td><td><?php echo $nama_karyawan; ?></td></tr>
	    <tr><td>Nomor Karyawan</td><td><?php echo $nomor_karyawan; ?></td></tr>
	    <tr><td>Divisi Karyawan</td><td><?php echo $divisi_karyawan; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tbl_gaji') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>