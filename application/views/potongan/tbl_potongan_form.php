<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_POTONGAN</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Nama Potongan <?php echo form_error('nama_potongan') ?></td><td><input type="text" class="form-control" name="nama_potongan" id="nama_potongan" placeholder="Nama Potongan" value="<?php echo $nama_potongan; ?>" /></td></tr>
	    <tr><td width='200'>Potongan <?php echo form_error('potongan') ?></td><td><input type="text" class="form-control" name="potongan" id="potongan" placeholder="Potongan" value="<?php echo $potongan; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_potongan" value="<?php echo $id_potongan; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('potongan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>