<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_karyawan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','karyawan/tbl_karyawan_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_karyawan_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbl_karyawan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_karyawan' => $row->id_karyawan,
		'nomor_karyawan' => $row->nomor_karyawan,
		'nama_karyawan' => $row->nama_karyawan,
		'jenis_kelamin' => $row->jenis_kelamin,
		'tanggal_lahir' => $row->tanggal_lahir,
		'alamat_karyawan' => $row->alamat_karyawan,
		'pendidikan_terakhir' => $row->pendidikan_terakhir,
		'divisi_karyawan' => $row->divisi_karyawan,
	    );
            $this->template->load('template','karyawan/tbl_karyawan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('karyawan/create_action'),
	    'id_karyawan' => set_value('id_karyawan'),
	    'nomor_karyawan' => set_value('nomor_karyawan'),
	    'nama_karyawan' => set_value('nama_karyawan'),
	    'jenis_kelamin' => set_value('jenis_kelamin'),
	    'tanggal_lahir' => set_value('tanggal_lahir'),
	    'alamat_karyawan' => set_value('alamat_karyawan'),
	    'pendidikan_terakhir' => set_value('pendidikan_terakhir'),
	    'divisi_karyawan' => set_value('divisi_karyawan'),
	);
        $this->template->load('template','karyawan/tbl_karyawan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nomor_karyawan' => $this->input->post('nomor_karyawan',TRUE),
		'nama_karyawan' => $this->input->post('nama_karyawan',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
		'alamat_karyawan' => $this->input->post('alamat_karyawan',TRUE),
		'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir',TRUE),
		'divisi_karyawan' => $this->input->post('divisi_karyawan',TRUE),
	    );

            $this->Tbl_karyawan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('karyawan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_karyawan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('karyawan/update_action'),
		'id_karyawan' => set_value('id_karyawan', $row->id_karyawan),
		'nomor_karyawan' => set_value('nomor_karyawan', $row->nomor_karyawan),
		'nama_karyawan' => set_value('nama_karyawan', $row->nama_karyawan),
		'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
		'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
		'alamat_karyawan' => set_value('alamat_karyawan', $row->alamat_karyawan),
		'pendidikan_terakhir' => set_value('pendidikan_terakhir', $row->pendidikan_terakhir),
		'divisi_karyawan' => set_value('divisi_karyawan', $row->divisi_karyawan),
	    );
            $this->template->load('template','karyawan/tbl_karyawan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_karyawan', TRUE));
        } else {
            $data = array(
		'nomor_karyawan' => $this->input->post('nomor_karyawan',TRUE),
		'nama_karyawan' => $this->input->post('nama_karyawan',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'tanggal_lahir' => $this->input->post('tanggal_lahir',TRUE),
		'alamat_karyawan' => $this->input->post('alamat_karyawan',TRUE),
		'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir',TRUE),
		'divisi_karyawan' => $this->input->post('divisi_karyawan',TRUE),
	    );

            $this->Tbl_karyawan_model->update($this->input->post('id_karyawan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('karyawan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_karyawan_model->get_by_id($id);

        if ($row) {
            $this->Tbl_karyawan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('karyawan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('karyawan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nomor_karyawan', 'nomor karyawan', 'trim|required');
	$this->form_validation->set_rules('nama_karyawan', 'nama karyawan', 'trim|required');
	$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
	$this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
	$this->form_validation->set_rules('alamat_karyawan', 'alamat karyawan', 'trim|required');
	$this->form_validation->set_rules('pendidikan_terakhir', 'pendidikan terakhir', 'trim|required');
	$this->form_validation->set_rules('divisi_karyawan', 'divisi karyawan', 'trim|required');

	$this->form_validation->set_rules('id_karyawan', 'id_karyawan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Karyawan.php */
/* Location: ./application/controllers/Karyawan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-12-10 02:25:41 */
/* http://harviacode.com */