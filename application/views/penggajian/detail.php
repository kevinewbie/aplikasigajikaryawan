<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
                        <div class="box-header">
                        <h3 class="box-title">DATA PEGAWAI</h3>
                    </div>
        
        <div class="box-body">
       
        <table class="table table-bordered table-striped" id="mytable">
		<tr><td width="200">Nama Karyawan</td><td><?php echo $penggajian['nama_karyawan'] ?></td></tr>
		<tr><td>Nomor Karyawan</td><td><?php echo $penggajian['nomor_karyawan'] ?></td></tr>
		<tr><td>Divisi</td><td><?php echo $penggajian['divisi_karyawan'] ?></td></tr>
		<tr><td>Pendidikan Terakhir</td><td><?php echo $penggajian['pendidikan_terakhir'] ?></td></tr>
		
		
        </table>
		 <!-- Button trigger modal -->
                       
                       <!-- Trigger the modal with a button -->
					   <button type="button" class="btn btn-info" data-toggle="modal" data-target="#tanggungan">Overtime</button>
                       <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#listrik">POTONGAN</button>
					    <?php echo anchor('penggajian/cetak_laporan/'.$id_gaji,'CETAK LAPORAN PERORANGAN',"class='btn btn-success' target='new'")?>
						
						
						
						<!------------------------------------------------------------------------------------- Modal TANGGUNGAN--------------------------------------------------------- -->
                        <div id="tanggungan" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
									
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Masukkan Jabatan</h4>
                                    </div>
                                  <?php echo form_open('penggajian/overtime_action'); ?>
                                    <div class="modal-body">
									
                                      <input value="<?php echo $id_gaji; ?>" type="hidden" name="id_gaji">
                                        <table class="table table-bordered">
										   <tr><td width='200'>GAJI POKOK </td><td>
                           
							 <input readonly="" value=" <?php echo $penggajian['divisi_karyawan'] ?>" name="jabatan"></br>
							    <tr><td width='200'>OVERTIME </td><td>
							 <input  value=" <?php echo $overtime['overtime'] ?>" name="overtime">
							
                           
						
                                          
                                          
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Simpan</button>
                                    </div>
                                </div>
                                </form>

                            </div>
							
					
        </div>
        </div>
            </div>
		
			<div class="col-xs-12">
                <div class="box box-warning box-solid">
                        <div class="box-header">
                        <h3 class="box-title">GAJI</h3>
                    </div>
        
        <div class="box-body">
       
        <table class="table table-bordered table-striped" id="mytable">
		
		<tr><th>RINCIAN</th>
							<th>JUMLAH</th>
							
							
                               
								
                            <?php
                            $no = 1;
                             $total_gaji = 0;
                            foreach ($riwayat_gajipokok as $r) {
                                echo "<tr>
                                    <td>Gaji Pokok</td>
                                    <td>$r->gaji_pokok</td></tr>
									<td>Tunjangan Jabatan</td>
                                    <td>$r->tunjangan_jabatan</td></tr>
									<td>Tunjangan Makan</td>
                                    <td>$r->tunjangan_makan</td></tr>
									<td>Tunjangan Transport</td>
                                    <td>$r->tunjangan_transport</td></tr>
									
									
									</tr>";
                                $no++;
                              $total_gaji = $total_gaji + $r->gaji_pokok + $r->tunjangan_jabatan + $r->tunjangan_makan + $r->tunjangan_transport;
                            }
                            ?>
							
							<?php
                            $no = 1;
                             $total_overtime = 0;
                            foreach ($riwayat_overtime as $l) {
                                echo "<tr>
                                    <th>Gaji overtime</th>
									 <td>$l->tambahan_overtime</td></tr>
                                    
									
									
									</tr>";
                                $no++;
                               $total_overtime = $total_overtime + $l->tambahan_overtime;
                            }
                            ?>
							
							
							<?php
							
                            
                            $total_semua = $total_overtime + $total_gaji  ;?>
							 <th>Total</th>
									 <th><?php echo $total_semua; ?></th></tr>
							
							
		
        </table>
        </div>
                    </div>
            </div>
			
			<!------------------------------------------------------------------------------MODAL LISTRIK----------------------------------------------------------------------------->
                      

			            <div id="listrik" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
									
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Potongan</h4>
                                    </div>
                                   <?php echo form_open('penggajian/potongan_action'); ?>
                                    <div class="modal-body">
									
                                      <input value="<?php echo $id_gaji; ?>" type="hidden" name="id_gaji">
                                        <table class="table table-bordered">
										   <tr><td width='200'>Jabatan </td><td>
                             <?php echo cmb_dinamis('nama_potongan', 'tbl_potongan', 'nama_potongan', 'nama_potongan',$potongan['nama_potongan']) ?></td></tr>
                                          
                                          
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Simpan</button>
                                    </div>
                                </div>
                                </form>

                            </div>
							
					
        </div>
        </div>
            </div>
			
			
			
			<div class="col-xs-12">
                <div class="box box-warning box-solid">
                        <div class="box-header">
                        <h3 class="box-title">POTONGAN</h3>
                    </div>
        
        <div class="box-body">
       
        <table class="table table-bordered table-striped" id="mytable">
		
		
		<tr><th>NAMA POTONGAN</th>
							<th>JUMLAH</th>
							
							
                               
								
                            <?php
                            $no = 1;
                             $total_potongan = 0;
                            foreach ($riwayat_potongan as $p) {
                                echo "<tr>
                                    <td>$p->nama_potongan</td>
                                    <td>$p->potongan</td></tr>
									
									
									
									</tr>";
                                $no++;
                              $total_potongan = $total_potongan + $p->potongan;
                            }
                            ?>
							
		<th>Total</th>
									 <th><?php echo $total_potongan; ?></th></tr>
		
		
        </table>
        </div>
           </div>        
           
			
			
			
			
			
			
			<div class="col-xs-12">
                <div class="box box-warning box-solid">
                        <div class="box-header">
                        <h3 class="box-title">JUMLAH</h3>
                    </div>
        
        <div class="box-body">
       
        <table class="table table-bordered table-striped" id="mytable">
		<?php
							
                            
                            $total_akhir = $total_semua - $total_potongan  ;?>
							 <th>Total</th>
									 <th><?php echo $total_akhir; ?></th></tr>
									 
									  <center><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#total">LIHAT TOTAL</button></center>
							
		
		
		
        </table>
        </div>
                    </div>
           
			
			
			
			
			
			
			
		

			            <div id="total" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-lg">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
									
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Potongan</h4>
                                    </div>
                                     <?php echo form_open('penggajian/total_action'); ?>
                                    <div class="modal-body">
									
                                      <input value="<?php echo $id_gaji; ?>" type="hidden" name="id_gaji">
                                        <table class="table table-bordered">
										  
                             
                                            <tr><td width='200'>Total Penerimaan </td><td>
                           
							 <input readonly="" value=" <?php echo $total_semua ?>" name="total_penerimaan"></br>
							    <tr><td width='200'>Total Potongan </td><td>
							 <input readonly="" value=" <?php echo $total_potongan ?>" name="total_potongan">
							   <tr><td width='200'>TotalAkhir </td><td>
							 <input readonly="" value=" <?php echo $total_akhir ?>" name="total_akhir">
							
                                          
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-danger">Simpan</button>
                                    </div>
                                </div>
                                </form>

        </div></div>	
			
           
    </section>
</div>
                 
							
					
     


