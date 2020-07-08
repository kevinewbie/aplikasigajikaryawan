<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Potongan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_potongan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/potongan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/potongan/index/';
            $config['first_url'] = base_url() . 'index.php/potongan/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Tbl_potongan_model->total_rows($q);
        $potongan = $this->Tbl_potongan_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'potongan_data' => $potongan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','potongan/tbl_potongan_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_potongan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_potongan' => $row->id_potongan,
		'nama_potongan' => $row->nama_potongan,
		'potongan' => $row->potongan,
	    );
            $this->template->load('template','potongan/tbl_potongan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('potongan'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('potongan/create_action'),
	    'id_potongan' => set_value('id_potongan'),
	    'nama_potongan' => set_value('nama_potongan'),
	    'potongan' => set_value('potongan'),
	);
        $this->template->load('template','potongan/tbl_potongan_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_potongan' => $this->input->post('nama_potongan',TRUE),
		'potongan' => $this->input->post('potongan',TRUE),
	    );

            $this->Tbl_potongan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('potongan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_potongan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('potongan/update_action'),
		'id_potongan' => set_value('id_potongan', $row->id_potongan),
		'nama_potongan' => set_value('nama_potongan', $row->nama_potongan),
		'potongan' => set_value('potongan', $row->potongan),
	    );
            $this->template->load('template','potongan/tbl_potongan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('potongan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_potongan', TRUE));
        } else {
            $data = array(
		'nama_potongan' => $this->input->post('nama_potongan',TRUE),
		'potongan' => $this->input->post('potongan',TRUE),
	    );

            $this->Tbl_potongan_model->update($this->input->post('id_potongan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('potongan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_potongan_model->get_by_id($id);

        if ($row) {
            $this->Tbl_potongan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('potongan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('potongan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_potongan', 'nama potongan', 'trim|required');
	$this->form_validation->set_rules('potongan', 'potongan', 'trim|required');

	$this->form_validation->set_rules('id_potongan', 'id_potongan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Potongan.php */
/* Location: ./application/controllers/Potongan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-12-18 22:52:01 */
/* http://harviacode.com */