<div class="content-wrapper">
    
    <section class="content">
        <div class="box box-warning box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">INPUT DATA TBL_OVERTIME</h3>
            </div>
            <form action="<?php echo $action; ?>" method="post">
            
<table class='table table-bordered>'        

	    <tr><td width='200'>Overtime <?php echo form_error('overtime') ?></td><td><input type="text" class="form-control" name="overtime" id="overtime" placeholder="Overtime" value="<?php echo $overtime; ?>" /></td></tr>
	    <tr><td width='200'>Tambahan Overtime <?php echo form_error('tambahan_overtime') ?></td><td><input type="text" class="form-control" name="tambahan_overtime" id="tambahan_overtime" placeholder="Tambahan Overtime" value="<?php echo $tambahan_overtime; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="id_overtime" value="<?php echo $id_overtime; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('overtime') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a></td></tr>
	</table></form>        </div>
</div>
</div>