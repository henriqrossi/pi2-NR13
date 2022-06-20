<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class General_model extends CI_Model {

	public function buscaDocs($data,$busca = false)
	{
		$this->db->select('*');
		$this->db->from('documentos');
		if($busca) {
			$this->db->like('nome', $busca);
		}
		$this->db->where('excluido', 0);
		return $this->db->get()->result();
	}

}