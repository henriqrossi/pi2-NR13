<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('general_model');
	}

	public function index()
	{
		$this->load->view('home');
	}

	public function busca_docs()
	{
		$data = $this->input->post();
		$data['result'] = $this->general_model->buscaDocs($data,$this->input->post('busca'));
		$this->load->view('resultado',$data);
	}

	public function sobre()
	{
		$this->load->view('sobre');
	}
}
