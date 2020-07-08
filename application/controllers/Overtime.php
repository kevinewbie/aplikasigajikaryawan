<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Overtime extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_overtime_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/overtime/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/overtime/index/';
            $config['first_url'] = base_url() . 'index.php/overtime/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Tbl_overtime_model->total_rows($q);
        $overtime = $this->Tbl_overtime_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'overtime_data' => $overtime,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','overtime/tbl_overtime_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_overtime_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_overtime' => $row->id_overtime,
		'overtime' => $row->overtime,
		'tambahan_overtime' => $row->tambahan_overtime,
	    );
            $this->template->load('template','overtime/tbl_overtime_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('overtime'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('overtime/create_action'),
	    'id_overtime' => set_value('id_overtime'),
	    'overtime' => set_value('overtime'),
	    'tambahan_overtime' => set_value('tambahan_overtime'),
	);
        $this->template->load('template','overtime/tbl_overtime_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'overtime' => $this->input->post('overtime',TRUE),
		'tambahan_overtime' => $this->input->post('tambahan_overtime',TRUE),
	    );

            $this->Tbl_overtime_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('overtime'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_overtime_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('overtime/update_action'),
		'id_overtime' => set_value('id_overtime', $row->id_overtime),
		'overtime' => set_value('overtime', $row->overtime),
		'tambahan_overtime' => set_value('tambahan_overtime', $row->tambahan_overtime),
	    );
            $this->template->load('template','overtime/tbl_overtime_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('overtime'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_overtime', TRUE));
        } else {
            $data = array(
		'overtime' => $this->input->post('overtime',TRUE),
		'tambahan_overtime' => $this->input->post('tambahan_overtime',TRUE),
	    );

            $this->Tbl_overtime_model->update($this->input->post('id_overtime', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('overtime'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_overtime_model->get_by_id($id);

        if ($row) {
            $this->Tbl_overtime_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('overtime'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('overtime'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('overtime', 'overtime', 'trim|required');
	$this->form_validation->set_rules('tambahan_overtime', 'tambahan overtime', 'trim|required');

	$this->form_validation->set_rules('id_overtime', 'id_overtime', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Overtime.php */
/* Location: ./application/controllers/Overtime.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-12-18 22:50:06 */
/* http://harviacode.com */