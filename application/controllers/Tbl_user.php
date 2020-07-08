<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_user extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_user_model');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','tbl_user/tbl_user_list');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Tbl_user_model->json();
    }

    public function read($id) 
    {
        $row = $this->Tbl_user_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_users' => $row->id_users,
		'full_name' => $row->full_name,
		'email' => $row->email,
		'password' => $row->password,
		'images' => $row->images,
		'id_user_level' => $row->id_user_level,
		'is_aktif' => $row->is_aktif,
	    );
            $this->template->load('template','tbl_user/tbl_user_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_user'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_user/create_action'),
	    'id_users' => set_value('id_users'),
	    'full_name' => set_value('full_name'),
	    'email' => set_value('email'),
	    'password' => set_value('password'),
	    'images' => set_value('images'),
	    'id_user_level' => set_value('id_user_level'),
	    'is_aktif' => set_value('is_aktif'),
	);
        $this->template->load('template','tbl_user/tbl_user_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'full_name' => $this->input->post('full_name',TRUE),
		'email' => $this->input->post('email',TRUE),
		'password' => $this->input->post('password',TRUE),
		'images' => $this->input->post('images',TRUE),
		'id_user_level' => $this->input->post('id_user_level',TRUE),
		'is_aktif' => $this->input->post('is_aktif',TRUE),
	    );

            $this->Tbl_user_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('tbl_user'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_user_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_user/update_action'),
		'id_users' => set_value('id_users', $row->id_users),
		'full_name' => set_value('full_name', $row->full_name),
		'email' => set_value('email', $row->email),
		'password' => set_value('password', $row->password),
		'images' => set_value('images', $row->images),
		'id_user_level' => set_value('id_user_level', $row->id_user_level),
		'is_aktif' => set_value('is_aktif', $row->is_aktif),
	    );
            $this->template->load('template','tbl_user/tbl_user_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_user'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_users', TRUE));
        } else {
            $data = array(
		'full_name' => $this->input->post('full_name',TRUE),
		'email' => $this->input->post('email',TRUE),
		'password' => $this->input->post('password',TRUE),
		'images' => $this->input->post('images',TRUE),
		'id_user_level' => $this->input->post('id_user_level',TRUE),
		'is_aktif' => $this->input->post('is_aktif',TRUE),
	    );

            $this->Tbl_user_model->update($this->input->post('id_users', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_user'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_user_model->get_by_id($id);

        if ($row) {
            $this->Tbl_user_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_user'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('full_name', 'full name', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	$this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('images', 'images', 'trim|required');
	$this->form_validation->set_rules('id_user_level', 'id user level', 'trim|required');
	$this->form_validation->set_rules('is_aktif', 'is aktif', 'trim|required');

	$this->form_validation->set_rules('id_users', 'id_users', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Tbl_user.php */
/* Location: ./application/controllers/Tbl_user.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-12-12 19:52:07 */
/* http://harviacode.com */