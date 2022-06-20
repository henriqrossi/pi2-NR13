<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class General_model extends CI_Model {

	public function checaLogin($login,$password)
	{
		$this->db->select('*');
		$this->db->from('usuario');
		$this->db->where('email',$login);
		$this->db->where('senha',$password);
		return $this->db->get()->result();
	}

	public function buscaGaleria($id)
	{
		$this->db->select('*');
		$this->db->from('imgGaleria');
		$this->db->where('idProd',$id);
		$this->db->where('excluido',0);
		return $this->db->get()->result();
	}

	public function updateSenha($data,$login)
	{
		$this->db->where('login', $login);
		return $this->db->update('usuario', $data);
	}

	public function buscaProdRel($depart,$id)
	{
		$this->db->select('*');
		$this->db->from('produtos');
		$this->db->where('id_depart',$depart);
		$this->db->where('id != ',$id);
		$this->db->where('excluido',0);
		return $this->db->get()->result();
	}

	public function buscaDestaques()
	{
		$this->db->select('*');
		$this->db->from('produtos');
		$this->db->where('destaque',1);
		$this->db->where('excluido',0);
		return $this->db->get()->result();
	}

	public function buscaProds($id = false)
	{
		$this->db->select('p.*,b.descricao as descBrand');
		$this->db->from('produtos as p');
		$this->db->join('brand as b','b.id = p.id_brand');
		$this->db->where('p.excluido',0);
		if($id) {
			$this->db->where('p.id',$id);
		}
		return $this->db->get()->result();
	}

	public function buscaDiversos($id = false,$tipo = false)
	{
		$this->db->select('p.*,b.descricao as descBrand');
		$this->db->from('produtos as p');
		$this->db->join('brand as b','b.id = p.id_brand');
		$this->db->where('p.excluido',0);
		if($tipo == 1) {
			$this->db->where('p.id_depart',$id);
		} else if($tipo == 2) {
			$this->db->where('p.id_categ',$id);
		} else if($tipo == 3) {
			$this->db->where('p.id_brand',$id);
		} else if($tipo == 4) {
			$this->db->where('p.destaque',1);
		} else if($tipo == 5) {
			$this->db->like('p.titulo',$id);
		}
		return $this->db->get()->result();
	}

	public function busca_dados($tabela,$id = false)
	{
		$this->db->select('*');
		$this->db->from($tabela);
		// $this->db->where('excluido',0);
		if($id) {
			$this->db->where('id',$id);
		}
		return $this->db->get()->result();
	}

	public function getProds()
	{
		$this->db->select('*');
		$this->db->from('produtos');
		$this->db->where('excluido',0);
		$this->db->limit(30);
		return $this->db->get()->result();
	}

	public function buscaMini()
	{
		$this->db->select('*');
		$this->db->from('banners_mini');
		$this->db->where('ativo',1);
		$this->db->where('excluido',0);
		return $this->db->get()->result();
	}

	public function buscaCatsMenu()
	{
		$this->db->select('p.id_depart,p.id_categ,ct.descricao');
		$this->db->from('produtos as p');
		$this->db->join('categoria as ct','ct.id = p.id_categ');
		$this->db->where('p.excluido',0);
		$this->db->group_by('p.id_depart,p.id_categ');
		return $this->db->get()->result();
	}

	public function gravaCart($data)
	{
		$this->db->select('*');
		$this->db->from('cart');
		$this->db->where('chave',$data['chave']);
		$this->db->where('prod',$data['prod']);
		$prod = $this->db->get()->result();
		if($prod) {
			$prd['qtd'] = $data['qtd'];
			$this->db->where('chave',$data['chave']);
			$this->db->where('prod',$data['prod']);
			return $this->db->update('cart',$prd);
		} else {
			return $this->db->insert('cart',$data);
		}
	}

	public function buscaCart($chave)
	{
		$this->db->select('c.*,p.titulo,p.imagem');
		$this->db->from('cart as c');
		$this->db->join('produtos as p','p.id = c.prod');
		$this->db->where('c.chave',$chave);
		$prod = $this->db->get()->result();
		$retorno = '';
		if($prod) {
			foreach($prod as $p):
				$retorno .= '<div class="row">
								<div class="col-2"><img src="'.base_url('assets/img/produtos/'.$p->imagem).'" class="w-100"></div>
								<div class="col-6">'.$p->titulo.'</div>
								<div class="col-3"><input type="number" class="form-control" min="0" value="'.$p->qtd.'" onclick="altera('.$p->prod.','.$p->chave.',this.value)" onblur="altera('.$p->prod.','.$p->chave.',this.value)"></div>
								<div class="col-1"><i class="fas fa-trash-alt" style="color: red; cursor: pointer" onclick="remove('.$p->prod.','.$p->chave.')"></i></div>
							</div>';
			endforeach;
		} else {
			$retono = "Você ainda não tem produtos cadastrados!";
		}
		return $retorno;
	}

	public function removeCart($data)
	{
		$this->db->where('chave',$data['chave']);
		$this->db->where('prod',$data['prod']);
		$this->db->delete('cart');
		return $this->buscaCart($data['chave']);
	}

	public function alteraCart($data)
	{
		$this->db->where('chave',$data['chave']);
		$this->db->where('prod',$data['prod']);
		$this->db->update('cart',$data);
		return $this->buscaCart($data['chave']);
	}

	public function buscaCartF($data)
	{
		$this->db->select('c.*,p.titulo,p.imagem');
		$this->db->from('cart as c');
		$this->db->join('produtos as p','p.id = c.prod');
		$this->db->where('c.chave',$data['chave']);
		$prod = $this->db->get()->result();
		$retorno = '';
		if($prod) {
			foreach($prod as $p):
				$retorno .= '<div class="row">
								<input type="hidden" name="key" value="'.$data['chave'].'">
								<div class="col-2"><img src="'.base_url('assets/img/produtos/'.$p->imagem).'" class="w-100"></div>
								<div class="col-6">'.$p->titulo.'</div>
								<div class="col-3">
									<input type="hidden" name="idProd[]" value="'.$p->prod.'">
									<input type="number" class="form-control" min="0" value="'.$p->qtd.'" onclick="altera('.$p->prod.','.$p->chave.',this.value)" onblur="altera('.$p->prod.','.$p->chave.',this.value)" name="qtd[]">
								</div>
								<div class="col-1"><i class="fas fa-trash-alt" style="color: red; cursor: pointer" onclick="remove('.$p->prod.','.$p->chave.')"></i></div>
							</div>';
			endforeach;
		} else {
			$retono = '<div class="row">Você ainda não tem produtos cadastrados!</div>';
		}
		return $retorno;
	}

	public function gravaOrc($data)
	{
		$this->db->select('id');
		$this->db->from('comprador');
		$this->db->where('email',$data['email']);
		$id = $this->db->get()->result();
		if($id) {
			$id = $id[0]->id;
		} else {
			$comp['nome'] = $data['nome'];
			$comp['email'] = $data['email'];
			$comp['tel'] = $data['tel'];
			$this->db->insert('comprador',$comp);
			$id = $this->db->insert_id();
		}
		$ped['idComp'] = $id;
		$this->db->insert('pedido',$ped);
		$prod['idPed'] = $this->db->insert_id();
		for ($i=0; $i < count($data['idProd']) ; $i++) { 
			$prod['idProd'] = $data['idProd'][$i];
			$prod['qtdProd'] = $data['qtd'][$i];
			$p = $this->db->insert('itens',$prod);
		}
		if($p) {
			$this->db->where('chave',$data['key']);
			$this->db->delete('cart');
			return true;
		} else {
			return false;
		}
	}

	public function setCurr()
	{
		$dt = $this->input->post();
		if($_FILES['arquivo']['name'] != '') {
			$dt['arquivo'] = md5($_FILES['arquivo']['name'].(date('dmyhis'))).'.'.array_reverse(explode('.',$_FILES["arquivo"]["name"]))[0];
			if(file_put_contents('./assets/curriculos/'.$dt['arquivo'],file_get_contents($_FILES['arquivo']['tmp_name']))) {
				if($this->db->insert('curriculos',$dt)){
					echo "<script>alert('Curriculo gravado com sucesso');window.location.href = '".base_url()."'</script>";
				} else {
					echo "<script>alert('Houve uma falha no gravar seus dados, por favor tente novamente');window.location.href = '".base_url()."'</script>";
				}
			} else {
				echo "<script>alert('Houve uma falha no gravar seu curriculo, por favor tente novamente');window.location.href = '".base_url()."'</script>";
			}
		} else {
			echo "<script>alert('Houve uma falha na transmissão dos dados, por favor tente novamente');window.location.href = '".base_url()."'</script>";
		}
	}

	public function buscaTudo($data,$busca = false)
	{
		$this->db->select('*');
		$this->db->from('produtos');
		if($busca) {
			$this->db->like('titulo', $busca);
		}
		$this->db->where('dataini >=', $data['dataini']);
		$this->db->where('datafim <=', $data['datafim']);
		return $this->db->get()->result();
	}

}