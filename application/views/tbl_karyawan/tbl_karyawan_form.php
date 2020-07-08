<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_KARYAWAN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Nomor Karyawan <?php echo form_error('nomor_karyawan') ?></td><td><input type="text" class="form-control" name="nomor_karyawan" id="nomor_karyawan" placeholder="Nomor Karyawan" value="<?php echo $nomor_karyawan; ?>" /></td></tr>
	    <tr><td width='200'>Nama Karyawan <?php echo form_error('nama_karyawan') ?></td><td><input type="text" class="form-control" name="nama_karyawan" id="nama_karyawan" placeholder="Nama Karyawan" value="<?php echo $nama_karyawan; ?>" /></td></tr>
	    <tr><td width='200'>Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></td><td><input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis Kelamin" value="<?php echo $jenis_kelamin; ?>" /></td></tr>
	    <tr><td width='200'>Tanggal Lahir <?php echo form_error('tanggal_lahir') ?></td><td><input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" value="<?php echo $tanggal_lahir; ?>" /></td></tr>
	    <tr><td width='200'>Alamat Karyawan <?php echo form_error('alamat_karyawan') ?></td><td><input type="text" class="form-control" name="alamat_karyawan" id="alamat_karyawan" placeholder="Alamat Karyawan" value="<?php echo $alamat_karyawan; ?>" /></td></tr>
	    <tr><td width='200'>Pendidikan Terakhir <?php echo form_error('pendidikan_terakhir') ?></td><td><input type="text" class="form-control" name="pendidikan_terakhir" id="pendidikan_terakhir" placeholder="Pendidikan Terakhir" value="<?php echo $pendidikan_terakhir; ?>" /></td></tr>
	    <tr><td width='200'>Divisi Karyawan <?php echo form_error('divisi_karyawan') ?></td><td><input type="text" class="form-control" name="divisi_karyawan" id="divisi_karyawan" placeholder="Divisi Karyawan" value="<?php echo $divisi_karyawan; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_karyawan" value="<?php echo $id_karyawan; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('tbl_karyawan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>