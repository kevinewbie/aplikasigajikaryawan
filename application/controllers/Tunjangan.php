<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tunjangan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_tunjangan_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','tunjangan/tbl_tunjangan_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_tunjangan_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbl_tunjangan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_jabatan' => $row->id_jabatan,
		'jabatan' => $row->jabatan,
		'tunjangan_jabatan' => $row->tunjangan_jabatan,
		'tunjangan_makan' => $row->tunjangan_makan,
		'tunjangan_transport' => $row->tunjangan_transport,
	    );
            $this->template->load('template','tunjangan/tbl_tunjangan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tunjangan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tunjangan/create_action'),
	    'id_jabatan' => set_value('id_jabatan'),
	    'jabatan' => set_value('jabatan'),
	    'tunjangan_jabatan' => set_value('tunjangan_jabatan'),
	    'tunjangan_makan' => set_value('tunjangan_makan'),
	    'tunjangan_transport' => set_value('tunjangan_transport'),
	);
        $this->template->load('template','tunjangan/tbl_tunjangan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'jabatan' => $this->input->post('jabatan',TRUE),
		'tunjangan_jabatan' => $this->input->post('tunjangan_jabatan',TRUE),
		'tunjangan_makan' => $this->input->post('tunjangan_makan',TRUE),
		'tunjangan_transport' => $this->input->post('tunjangan_transport',TRUE),
	    );

            $this->Tbl_tunjangan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('tunjangan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_tunjangan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tunjangan/update_action'),
		'id_jabatan' => set_value('id_jabatan', $row->id_jabatan),
		'jabatan' => set_value('jabatan', $row->jabatan),
		'tunjangan_jabatan' => set_value('tunjangan_jabatan', $row->tunjangan_jabatan),
		'tunjangan_makan' => set_value('tunjangan_makan', $row->tunjangan_makan),
		'tunjangan_transport' => set_value('tunjangan_transport', $row->tunjangan_transport),
	    );
            $this->template->load('template','tunjangan/tbl_tunjangan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tunjangan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jabatan', TRUE));
        } else {
            $data = array(
		'jabatan' => $this->input->post('jabatan',TRUE),
		'tunjangan_jabatan' => $this->input->post('tunjangan_jabatan',TRUE),
		'tunjangan_makan' => $this->input->post('tunjangan_makan',TRUE),
		'tunjangan_transport' => $this->input->post('tunjangan_transport',TRUE),
	    );

            $this->Tbl_tunjangan_model->update($this->input->post('id_jabatan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tunjangan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_tunjangan_model->get_by_id($id);

        if ($row) {
            $this->Tbl_tunjangan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tunjangan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tunjangan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required');
	$this->form_validation->set_rules('tunjangan_jabatan', 'tunjangan jabatan', 'trim|required');
	$this->form_validation->set_rules('tunjangan_makan', 'tunjangan makan', 'trim|required');
	$this->form_validation->set_rules('tunjangan_transport', 'tunjangan transport', 'trim|required');

	$this->form_validation->set_rules('id_jabatan', 'id_jabatan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Tunjangan.php */
/* Location: ./application/controllers/Tunjangan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-12-10 00:34:47 */
/* http://harviacode.com */