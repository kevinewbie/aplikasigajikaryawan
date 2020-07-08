<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Penggajian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_penggajian_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','penggajian/tbl_penggajian_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_penggajian_model->json();
    }
	
	
	
	
	function autocomplate_karyawan() {
        $this->db->like('nama_karyawan', $_GET['term']);
        $this->db->select('nama_karyawan');
        $dataKaryawan = $this->db->get('tbl_karyawan')->result();
        foreach ($dataKaryawan as $karyawan) {
            $return_arr[] = $karyawan->nama_karyawan;
        }

        echo json_encode($return_arr);
    }
	
	  function autofill(){
        $nama_karyawan = $_GET['nama_karyawan'];
        $this->db->where('nama_karyawan',$nama_karyawan);
        $warga = $this->db->get('tbl_karyawan')->row_array();
        $data = array(
                   
                    'nomor_karyawan'   =>  $warga['nomor_karyawan'],
					'divisi_karyawan'   =>  $warga['divisi_karyawan'],);
					
         echo json_encode($data);
    }
	
	
	function detail(){
	 
	$id_gaji = substr($this->uri->uri_string(3),18);
	
	$sql_gaji		= "SELECT tg.nama_karyawan,tg.nomor_karyawan,tg.divisi_karyawan,tk.nomor_karyawan,tk.nama_karyawan,tk.pendidikan_terakhir,tk.divisi_karyawan,tt.jabatan,tt.tunjangan_jabatan,tt.tunjangan_makan,tt.tunjangan_transport,pk.jabatan,pk.gaji_pokok
					FROM  tbl_penggajian as tg, tbl_karyawan as tk, tbl_tunjangan as tt, tbl_gajipokok as pk
					WHERE tg.nama_karyawan=tk.nama_karyawan and tg.divisi_karyawan=tk.divisi_karyawan and tt.jabatan=pk.jabatan and tt.jabatan=tg.divisi_karyawan and tg.id_gaji='$id_gaji'";
	$sql_gajipokok	= "SELECT gp.jabatan,pk.jabatan,pk.gaji_pokok
					FROM tbl_riwayatgajipokok as gp, tbl_gajipokok as pk 
					WHERE gp.jabatan=pk.jabatan and gp.id_gaji='$id_gaji'";	
	$sql_overtime	= "SELECT tl.overtime,tl.tambahan_overtime,rl.overtime,rl.id_gaji
					   FROM tbl_overtime as tl, tbl_riwayatovertime as rl 
					   WHERE tl.overtime=rl.overtime and rl.id_gaji='$id_gaji'";	
	$sql_potongan	= "SELECT tp.nama_potongan,tp.potongan,rp.nama_potongan,rp.id_gaji
					 FROM tbl_potongan as tp, tbl_riwayatpotongan as rp 
					   WHERE tp.nama_potongan=rp.nama_potongan and rp.id_gaji='$id_gaji'";	
					




	$data['penggajian']				=  $this->db->query($sql_gaji)->row_array();
	$data['overtime']				=  $this->db->query($sql_overtime)->row_array();
	$data['potongan']				=  $this->db->query($sql_potongan)->row_array();
	$data['gajipokok']				=  $this->db->query($sql_gajipokok)->row_array();
	$data['id_gaji'] 				= $id_gaji;
	$data['riwayat_gajipokok'] 		= $this->db->query($sql_gaji)->result();
	$data['riwayat_potongan'] 		= $this->db->query($sql_potongan)->result();
	$data['riwayat_overtime'] 		= $this->db->query($sql_overtime)->result();
	$this->template->load('template','penggajian/detail',$data);
}

function gajipokok_action(){
	

		
	
        $jabatan    = $this->input->post('jabatan');
      
        $id_gaji       	  = $this->input->post('id_gaji');
        
        $data = array(
            'jabatan'      =>  $jabatan,
            'id_gaji'   =>  $id_gaji);
        $this->db->insert('tbl_riwayatgajipokok',$data);
        redirect('penggajian/detail/'.$id_gaji);
}	


function overtime_action(){
	

		
	
        $overtime    = $this->input->post('overtime');
      
        $id_gaji       	  = $this->input->post('id_gaji');
        
        $data = array(
            'overtime'      =>  $overtime,
            'id_gaji'   =>  $id_gaji);
        $this->db->insert('tbl_riwayatovertime',$data);
        redirect('penggajian/detail/'.$id_gaji);
}	




function potongan_action(){
	

		
	
        $nama_potongan    = $this->input->post('nama_potongan');
      
        $id_gaji       	  = $this->input->post('id_gaji');
        
        $data = array(
            'nama_potongan'      =>  $nama_potongan,
            'id_gaji'   =>  $id_gaji);
        $this->db->insert('tbl_riwayatpotongan',$data);
        redirect('penggajian/detail/'.$id_gaji);
}	






function total_action(){
	

		 $id_gaji       	  	= $this->input->post('id_gaji');
		
        $total_penerimaan    	= $this->input->post('total_penerimaan');
      
        $total_potongan     	= $this->input->post('total_potongan');
		
		 $total_akhir       	= $this->input->post('total_akhir');
        
        $data = array(
        'total_penerimaan'      =>  $total_penerimaan,
	    'total_potongan'     =>  $total_potongan,
		'total_akhir'      		=>  $total_akhir,
        'id_gaji'  			    =>  $id_gaji);
        $this->db->insert('tbl_total',$data);
        redirect('penggajian/detail/'.$id_gaji);
}	




function cetak_laporan(){
	 
		$id_gaji = substr($this->uri->uri_string(3),25);
		$sql_gaji		= "SELECT tg.nama_karyawan,tg.nomor_karyawan,tg.divisi_karyawan,tk.nomor_karyawan,tk.nama_karyawan,tk.pendidikan_terakhir,tk.divisi_karyawan,tt.jabatan,tt.tunjangan_jabatan,tt.tunjangan_makan,tt.tunjangan_transport,pk.jabatan,pk.gaji_pokok
					FROM  tbl_penggajian as tg, tbl_karyawan as tk, tbl_tunjangan as tt, tbl_gajipokok as pk
					WHERE tg.nama_karyawan=tk.nama_karyawan and tg.divisi_karyawan=tk.divisi_karyawan and tt.jabatan=pk.jabatan and tt.jabatan=tg.divisi_karyawan and tg.id_gaji='$id_gaji'";
	$sql_gajipokok	= "SELECT gp.jabatan,pk.jabatan,pk.gaji_pokok
					FROM tbl_riwayatgajipokok as gp, tbl_gajipokok as pk
					WHERE gp.jabatan=pk.jabatan and gp.id_gaji='$id_gaji'";	
	$sql_overtime	= "SELECT tl.overtime,tl.tambahan_overtime,rl.overtime,rl.id_gaji
					   FROM tbl_overtime as tl, tbl_riwayatovertime as rl 
					   WHERE tl.overtime=rl.overtime and rl.id_gaji='$id_gaji'";	
	$sql_potongan	= "SELECT tp.nama_potongan,tp.potongan,rp.nama_potongan,rp.id_gaji
					 FROM tbl_potongan as tp, tbl_riwayatpotongan as rp 
					   WHERE tp.nama_potongan=rp.nama_potongan and rp.id_gaji='$id_gaji'";	
					   
	$sql_total	= "SELECT tq.total_penerimaan,tq.total_potongan,tq.total_akhir,tq.id_gaji
					 FROM tbl_total as tq
					   WHERE  tq.id_gaji='$id_gaji'";					   
					   
					   
					    $this->load->library('pdf');
        $pdf = new FPDF('l', 'mm', 'A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 12);
        
      	$pdf->Image('http://localhost/gajikp/assets/fto/logo.png',20,2,30);
        //$pdf->Image($file, $x, $y, $w, $h)
        
        // mencetak string 
         $pdf->Cell(190, 7, 'PT PRIMA', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(190, 6, 'JALAN RAYA DUMAI', 0, 1, 'C');
        $pdf->Cell(190, 6, '0765-592324', 0, 1, 'C');
        $pdf->Line(20, 33, 210-20, 33); 
        $pdf->Line(20, 34, 210-20, 34);
        $pdf->Cell(8, 8, '',0,1);
        $pdf->Cell(190, 7, 'SLIP GAJI', 0, 1, 'C');
		
		
		
		
        
         $pdf->SetFont('Arial', '', 12);
        // data gaji
		
		
		
		
		
		
		
		
		$gaji = $this->db->query($sql_gaji)->row_array();
		$overtime = $this->db->query($sql_overtime)->row_array();
		$potongan = $this->db->query($sql_potongan)->row_array();
		$total = $this->db->query($sql_total)->row_array();
        
         $pdf->Cell(30, 6, 'Nama', 0, 0, 'l');
         $pdf->Cell(70, 6, ': '.$gaji['nama_karyawan'], 0, 0, 'l');
         
         $pdf->Cell(40, 6, 'Nomor', 0, 0, 'l');
         $pdf->Cell(30, 6, ': '.$gaji['nomor_karyawan'], 0, 1, 'l');
        
         
         $pdf->Cell(30, 6, 	'Jabatan', 0, 0, 'l');
         $pdf->Cell(70, 6, ': '.$gaji['divisi_karyawan'], 0, 0, 'l');
		 
         
         $pdf->Cell(40, 6, 'Pendidikan Terakhir', 0, 0, 'l');
         $pdf->Cell(30, 6, ': '.$gaji['pendidikan_terakhir'], 0, 1, 'l');
		 
		 
		 
		 
		 
		 
		 
    
		  $pdf->Cell(8, 8, '',0,1);
		  $pdf->Cell(30, 6, '+(PENERIMAAN)', 0, 1, 'l');
		 
		 
		 
		 $pdf->Cell(30, 6, 'Gaji Pokok ', 0, 0, 'l');
         $pdf->Cell(70, 6, ': '.$gaji['gaji_pokok'], 0, 0, 'l');
		 
		 
		 
		 
		 $pdf->Cell(40, 6, 'Potongan', 0, 0, 'l');
         $pdf->Cell(30, 6, ': '.$total['total_potongan'], 0, 1, 'l');
		 
		 
		 
         
         $pdf->Cell(30, 6, 'T.Jabatan', 0, 0, 'l');
         $pdf->Cell(70, 6, ': '.$gaji['tunjangan_jabatan'], 0, 1, 'l');
        
         
         $pdf->Cell(30, 6, 	'T.Makan', 0, 0, 'l');
         $pdf->Cell(70, 6, ': '.$gaji['tunjangan_makan'], 0, 1, 'l');
		 
         
         $pdf->Cell(30, 6, 'T.Transport', 0, 0, 'l');
         $pdf->Cell(70, 6, ': '.$gaji['tunjangan_transport'], 0, 1, 'l');
		 
		 $pdf->Cell(30, 6, 'Overtime', 0, 0, 'l');
         $pdf->Cell(70, 6, ': '.$overtime['tambahan_overtime'], 0, 1, 'l');
		  
		
		 
		         $pdf->Line(200, 100, 60-50, 100); 
		  $pdf->Cell(60,5,'',0,0);
		 $pdf->Cell(30, 6, 'T.Masukan', 0, 0, 'l');
         $pdf->Cell(70, 6, ': '.$total['total_penerimaan'], 0, 1, 'l');
		 $pdf->Cell(60,5,'',0,0);
		 $pdf->Cell(30, 6, 'T.Potongan', 0, 0, 'l');
         $pdf->Cell(70, 6, ': '.$total['total_potongan'], 0, 1, 'l');
		 $pdf->Cell(60,5,'',0,0);
		 $pdf->Cell(30, 6, 'T.Penerimaan', 0, 0, 'l');
         $pdf->Cell(70, 6, ': '.$total['total_akhir'], 0, 1, 'l');
            
         $pdf->Cell(120,1,'',0,0);
         $pdf->Cell(50,5,'Duri,'.date('d/m/Y'),0,1,'C');
         $pdf->Cell(120,5,'',0,0);
         $pdf->Cell(50,5,'Direktur',0,1,'C');
         

         

        
        $pdf->Output();
    }
	
	
	
	
	
	
	 function cetak_lapor4n(){
		 $no = 1; 
		
		$sql_gaji		= "SELECT tg.nama_karyawan,tg.nomor_karyawan,tg.divisi_karyawan,tk.nomor_karyawan,tk.nama_karyawan,tk.pendidikan_terakhir,tk.divisi_karyawan,tt.jabatan,tt.tunjangan_jabatan,tt.tunjangan_makan,tt.tunjangan_transport,pk.jabatan,pk.gaji_pokok,tq.total_akhir
					FROM  tbl_penggajian as tg, tbl_karyawan as tk, tbl_tunjangan as tt, tbl_gajipokok as pk, tbl_total as tq 
					WHERE tg.nama_karyawan=tk.nama_karyawan and tg.divisi_karyawan=tk.divisi_karyawan and tt.jabatan=pk.jabatan and tt.jabatan=tg.divisi_karyawan and tg.id_gaji=tq.id_gaji ";

					   
	$sql_total	= "SELECT tq.total_penerimaan,tq.total_potongan,tq.total_akhir,tq.id_gaji
					 FROM tbl_total as tq
					   WHERE  tq.id_gaji";					   
					   
					   
					    $this->load->library('pdf');
        $pdf = new FPDF('l', 'mm', 'A5');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial', 'B', 12);
        
      	$pdf->Image('http://localhost/gajikp/assets/fto/logo.png',20,2,30);
        //$pdf->Image($file, $x, $y, $w, $h)
        
        // mencetak string 
         $pdf->Cell(190, 7, 'PT PRIMA', 0, 1, 'C');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(190, 6, 'JALAN RAYA DUMAI', 0, 1, 'C');
        $pdf->Cell(190, 6, '0765-592324', 0, 1, 'C');
        $pdf->Line(20, 33, 210-20, 33); 
        $pdf->Line(20, 34, 210-20, 34);
        $pdf->Cell(8, 8, '',0,1);
        $pdf->Cell(190, 7, 'LAPORAN PENGGAJIAN', 0, 1, 'C');
		
		
		
		
        
         $pdf->SetFont('Arial', '', 12);
        // data gaji
		
		
		
		
		
		
		
		
		$gaji = $this->db->query($sql_gaji)->row_array();
		
		$total = $this->db->query($sql_total)->row_array();
         
         
         
         // tabel hasil pemeriksaan
		 

         $pdf->Cell(10, 7, 'No', 1, 0,5, '');
        $pdf->Cell(45, 7, 'Nama Karyawan', 1, 0, 'C');
		 $pdf->Cell(40, 7, 'Nomor Karyawan', 1, 0, 'C');
		 $pdf->Cell(40, 7, 'Jabatan', 1, 0, 'C');
      	 $pdf->Cell(50, 7, 'TOTAL TERIMA', 1, 1, 'C');
		  
				  
				  
				  
		$daftar = $this->db->query($sql_gaji)->result();
		$total_semua = 0;	
	     foreach ($daftar as $l){
		 $pdf->Cell(10, 7, $no, 1, 0,5, '');
         $pdf->Cell(45, 7, $l->nama_karyawan, 1, 0, 'C');
		 $pdf->Cell(40, 7, $l->nomor_karyawan, 1, 0, 'C');
		 $pdf->Cell(40, 7, $l->jabatan, 1, 0, 'C');
		 	 $pdf->Cell(50, 7, $l->total_akhir, 1, 1, 'C');
			 $total_semua = $total_semua + ($l->total_akhir);
		 $no++;   
		 
		 
		 
		 
		 
		
		 }
		  $pdf->SetFont('Arial', '', 12);
		          $pdf->Cell(135, 7, 'Jumlah', 1, 0, 'C');
				   $pdf->Cell(50, 7, $total_semua, 1, 0, 'C');
		 /* $daftar = $this->db->query($sql_warga)->result();
	
         foreach ($daftar as $l){
		 $pdf->Cell(10, 7, $no, 1, 0,5, '');
        $pdf->Cell(10, 7, $l->nama_kk, 1, 0, 'C');
		 $pdf->Cell(35, 7, $l->no_kk, 1, 0, 'C');
		 
        	$no++;   		
		 } */
		 
		 
		
	   $pdf->Cell(8, 8, '',0,1);
	 
         
         $pdf->Cell(120,5,'',0,0);
         $pdf->Cell(10,1,'',0,1);
         $pdf->Cell(120,1,'',0,0);
         $pdf->Cell(50,5,'Duri,'.date('d-m-Y'),0,1,'C');
         $pdf->Cell(120,5,'',0,0);
         $pdf->Cell(50,5,'Direktur',0,1,'C');
         
         $pdf->Cell(1,7,'',0,1);
         
         $pdf->Cell(120,5,'',0,0);
         $pdf->Cell(50,5,'Kevin Admansyah',0,1,'C');
        
        $pdf->Output();
    }
         
	


    public function read($id) 
    {
        $row = $this->Tbl_penggajian_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_gaji' => $row->id_gaji,
		'nama_karyawan' => $row->nama_karyawan,
		'nomor_karyawan' => $row->nomor_karyawan,
		'divisi_karyawan' => $row->divisi_karyawan,
		'tanggal' => $row->tanggal,
	    );
            $this->template->load('template','penggajian/tbl_penggajian_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penggajian'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('penggajian/create_action'),
	    'id_gaji' => set_value('id_gaji'),
	    'nama_karyawan' => set_value('nama_karyawan'),
	    'nomor_karyawan' => set_value('nomor_karyawan'),
	    'divisi_karyawan' => set_value('divisi_karyawan'),
	    'tanggal' => set_value('tanggal'),
	);
        $this->template->load('template','penggajian/tbl_penggajian_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_karyawan' => $this->input->post('nama_karyawan',TRUE),
		'nomor_karyawan' => $this->input->post('nomor_karyawan',TRUE),
		'divisi_karyawan' => $this->input->post('divisi_karyawan',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
	    );

            $this->Tbl_penggajian_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('penggajian'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_penggajian_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('penggajian/update_action'),
		'id_gaji' => set_value('id_gaji', $row->id_gaji),
		'nama_karyawan' => set_value('nama_karyawan', $row->nama_karyawan),
		'nomor_karyawan' => set_value('nomor_karyawan', $row->nomor_karyawan),
		'divisi_karyawan' => set_value('divisi_karyawan', $row->divisi_karyawan),
		'tanggal' => set_value('tanggal', $row->tanggal),
	    );
            $this->template->load('template','penggajian/tbl_penggajian_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penggajian'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_gaji', TRUE));
        } else {
            $data = array(
		'nama_karyawan' => $this->input->post('nama_karyawan',TRUE),
		'nomor_karyawan' => $this->input->post('nomor_karyawan',TRUE),
		'divisi_karyawan' => $this->input->post('divisi_karyawan',TRUE),
		'tanggal' => $this->input->post('tanggal',TRUE),
	    );

            $this->Tbl_penggajian_model->update($this->input->post('id_gaji', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('penggajian'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_penggajian_model->get_by_id($id);

        if ($row) {
            $this->Tbl_penggajian_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('penggajian'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('penggajian'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_karyawan', 'nama karyawan', 'trim|required');
	$this->form_validation->set_rules('nomor_karyawan', 'nomor karyawan', 'trim|required');
	$this->form_validation->set_rules('divisi_karyawan', 'divisi karyawan', 'trim|required');
	$this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');

	$this->form_validation->set_rules('id_gaji', 'id_gaji', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Penggajian.php */
/* Location: ./application/controllers/Penggajian.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-12-12 19:54:30 */
/* http://harviacode.com */