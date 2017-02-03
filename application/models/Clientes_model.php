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

	public function elimina_cliente($cliente){
		$query = $this->db->query("DELETE FROM clientes WHERE id_clientes = '$cliente'");
		return $query;
	}

	public function actualiza_cliente($datos){
		$data = json_decode($datos);
		$query = $this->db->query("UPDATE clientes SET rsocial = '$data->nombre_cliente',
									nit_cliente = '$data->num_doc_cliente',
									pais = '$data->pais_cliente',
									ciudad = '$data->ciudad_cliente',
									direccion = '$data->direccion_cliente',
									telefono = '$data->telefono_cliente' 
									WHERE id_clientes = '$data->id_cliente'");
		return $query;
	}

}