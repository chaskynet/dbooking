<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*****************************************
*
* Author: Jorge Anibal Zapata Agreda
* 
*****************************************/
class Clientes_model extends CI_Model
{
	public function lista_clientes(){
		$query = $this->db->query("SELECT * FROM clientes");
		return $query->result();
	}

}