<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA PENGGAJIAN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Nama Karyawan <?php echo form_error('nama_karyawan') ?></td><td><input type="text" class="form-control" name="nama_karyawan"  onkeyup="autocomplate_karyawan()"  id="nama_karyawan" placeholder="Nama Karyawan" value="<?php echo $nama_karyawan; ?>" /></td></tr>
	    <tr><td width='200'>Nomor Karyawan <?php echo form_error('nomor_karyawan') ?></td><td><input type="text" class="form-control" name="nomor_karyawan" id="nomor_karyawan" placeholder="Nomor Karyawan" value="<?php echo $nomor_karyawan; ?>" /></td></tr>
	    <tr><td width='200'>Divisi Karyawan <?php echo form_error('divisi_karyawan') ?></td><td><input type="text" class="form-control" name="divisi_karyawan" id="divisi_karyawan" placeholder="Divisi Karyawan" value="<?php echo $divisi_karyawan; ?>" /></td></tr>
	    <tr><td width='200'>Tanggal <?php echo form_error('tanggal') ?></td><td><input type="date" class="form-control" name="tanggal" id="tanggal" placeholder="Tanggal" value="<?php echo date ('Y-m-d'); ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_gaji" value="<?php echo $id_gaji; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('penggajian') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>


<script type="text/javascript">
    
    function autocomplate_karyawan(){
        //autocomplete
    
        $("#nama_karyawan").autocomplete({
            source: "<?php echo base_url() ?>index.php/Penggajian/autocomplate_karyawan",
            minLength: 1
        });
        autoFill();
    }
    
    function autoFill(){
        var nama_karyawan = $("#nama_karyawan").val();
        $.ajax({
            url: "<?php echo base_url() ?>index.php/Penggajian/autofill",
            data:"nama_karyawan="+nama_karyawan ,
        }).success(function (data) {
            var json = data,
            obj = JSON.parse(json);
            $('#nomor_karyawan').val(obj.nomor_karyawan);
           $('#divisi_karyawan').val(obj.divisi_karyawan);
          
        });
    }
</script>