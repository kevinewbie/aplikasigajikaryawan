<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_penggajian extends CI_Controller
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
        $this->template->load('template','tbl_penggajian/tbl_penggajian_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_penggajian_model->json();
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
            $this->template->load('template','tbl_penggajian/tbl_penggajian_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_penggajian'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_penggajian/create_action'),
	    'id_gaji' => set_value('id_gaji'),
	    'nama_karyawan' => set_value('nama_karyawan'),
	    'nomor_karyawan' => set_value('nomor_karyawan'),
	    'divisi_karyawan' => set_value('divisi_karyawan'),
	    'tanggal' => set_value('tanggal'),
	);
        $this->template->load('template','tbl_penggajian/tbl_penggajian_form', $data);
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
            redirect(site_url('tbl_penggajian'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_penggajian_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_penggajian/update_action'),
		'id_gaji' => set_value('id_gaji', $row->id_gaji),
		'nama_karyawan' => set_value('nama_karyawan', $row->nama_karyawan),
		'nomor_karyawan' => set_value('nomor_karyawan', $row->nomor_karyawan),
		'divisi_karyawan' => set_value('divisi_karyawan', $row->divisi_karyawan),
		'tanggal' => set_value('tanggal', $row->tanggal),
	    );
            $this->template->load('template','tbl_penggajian/tbl_penggajian_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_penggajian'));
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
            redirect(site_url('tbl_penggajian'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_penggajian_model->get_by_id($id);

        if ($row) {
            $this->Tbl_penggajian_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_penggajian'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_penggajian'));
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

/* End of file Tbl_penggajian.php */
/* Location: ./application/controllers/Tbl_penggajian.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-12-12 19:52:07 */
/* http://harviacode.com */