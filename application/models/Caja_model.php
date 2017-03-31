<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*****************************************
*
* Author: Jorge Anibal Zapata Agreda
* 
*****************************************/
class Caja_model extends CI_Model
{
	public function estado_caja(){
		$query = $this->db->query("SELECT * FROM estado_caja WHERE vigente = true");
		return $query->result();
	}

	public function estado_caja_ses(){
		$query = $this->db->query("SELECT * FROM estado_caja WHERE vigente = true");
		return $query->row();
	}

	public function monto_cierre(){
		$query = $this->db->query("SELECT * FROM `estado_caja` WHERE vigente = true and estado = 'cerrado'");
		return $query->row();
	}

	public function apertura_caja($datos){
		$data = json_decode($datos);
		$usuario = $this->session->userdata('usuario');
		$actualizacio = $this->db->query("UPDATE estado_caja SET vigente = false");
		$query = $this->db->query("INSERT INTO estado_caja (id_estado_caja, estado, fecha, obs, monto,usuario, vigente) values('', 'abierto',now(),'$data->obs', '$data->monto','$usuario',true)");
		$id_caja = $this->db->insert_id();
		$this->session->set_userdata('id_caja', $id_caja);
		$this->session->set_userdata('estado_caja', 'abierto');
		$guarda_mov = $this->db->query("INSERT INTO caja (id_caja, tipo_mov, tipo_doc, num_doc, monto, concepto, fecha, hora, usuario, id_estado_caja) values('', 'ingreso', '', '', '$data->monto', 'Apertura', curdate(), curtime(), '$usuario', '$id_caja')");
		return $query;
	}

	public function cierre_caja($datos){
		$data = json_decode($datos);
		$usuario = $this->session->userdata('usuario');
		$actualizacio = $this->db->query("UPDATE estado_caja SET vigente = false");
		$query = $this->db->query("INSERT INTO estado_caja (id_estado_caja, estado, fecha, obs, monto, usuario, vigente) values('', 'cerrado',now(),'$data->obs_cierre', '$data->monto_cierre', '$usuario',true)");
		$id_caja = $this->db->insert_id();
		$this->session->set_userdata('id_caja', $id_caja);
		$this->session->set_userdata('estado_caja', 'cerrado');
		return $query;
	}

	public function busca_cierre_caja($datos){
		$data = json_decode($datos);
		$query = $this->db->query("SELECT * FROM estado_caja where estado = 'cerrado' and DATE_FORMAT(fecha,'%d-%m-%Y') >= '$data->fch_cierre'");
		return $query->result();
	}

	public function guarda_mov_caja($datos){
		$data = json_decode($datos);
		$usuario = $this->session->userdata('usuario');
		$guarda_mov = $this->db->query("INSERT INTO caja (id_caja, tipo_mov, tipo_doc, num_doc, monto, concepto, fecha, hora, usuario, id_estado_caja) values('', '$data->tipo', '$data->tipo_doc', '$data->num_doc', '$data->monto', '$data->concepto', curdate(), curtime(), '$usuario', '$data->id_estado_caja')");
		return $guarda_mov;
	}

	public function detalle_caja(){
		$detalle_caja = $this->db->query("SELECT * FROM `caja` WHERE id_estado_caja in (select e.id_estado_caja from estado_caja e where e.vigente = 1)");
		return $detalle_caja->result();
	}

	public function detalle_caja_pdf($id){
		$detalle_caja = $this->db->query("SELECT * FROM `caja` WHERE id_estado_caja in (select e.id_estado_caja from estado_caja e where e.id_estado_caja = '$id')");
		return $detalle_caja->result();
	}

}