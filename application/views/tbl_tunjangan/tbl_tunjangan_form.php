<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_TUNJANGAN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Jabatan <?php echo form_error('jabatan') ?></td><td><input type="text" class="form-control" name="jabatan" id="jabatan" placeholder="Jabatan" value="<?php echo $jabatan; ?>" /></td></tr>
	    <tr><td width='200'>Tunjangan Jabatan <?php echo form_error('tunjangan_jabatan') ?></td><td><input type="text" class="form-control" name="tunjangan_jabatan" id="tunjangan_jabatan" placeholder="Tunjangan Jabatan" value="<?php echo $tunjangan_jabatan; ?>" /></td></tr>
	    <tr><td width='200'>Tunjangan Makan <?php echo form_error('tunjangan_makan') ?></td><td><input type="text" class="form-control" name="tunjangan_makan" id="tunjangan_makan" placeholder="Tunjangan Makan" value="<?php echo $tunjangan_makan; ?>" /></td></tr>
	    <tr><td width='200'>Tunjangan Transport <?php echo form_error('tunjangan_transport') ?></td><td><input type="text" class="form-control" name="tunjangan_transport" id="tunjangan_transport" placeholder="Tunjangan Transport" value="<?php echo $tunjangan_transport; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_jabatan" value="<?php echo $id_jabatan; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('tbl_tunjangan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>