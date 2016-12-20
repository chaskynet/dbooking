<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*****************************************
*
* Author: Jorge Anibal Zapata Agreda
* 
*
*****************************************/
class Habitaciones_model extends CI_Model{
	public function lista_habitaciones(){
		$query = $this->db->query("SELECT h.id_habitacion,h.codigo,(select t.descripcion from tipo_habitacion t where t.id_tipo_hab = h.id_tipo_hab) as descripcion,(select t.costo from tipo_habitacion t where t.id_tipo_hab = h.id_tipo_hab) as costo, h.estado, IFNULL((select k.obs from kardex_hab k where k.cod_hab = h.codigo and k.vigente = 1),'') as obs FROM `habitaciones` h");
		return $query->result();
	}

	public function lista_tipos(){
		$query = $this->db->query("SELECT * from tipo_habitacion");
		return $query->result();
	}

	public function guarda_hab($datos){
		$datos = json_decode($datos);
		$query = $this->db->query("INSERT INTO habitaciones (codigo, id_tipo_hab, estado) values('$datos->cod_hab','$datos->tipo_hab','$datos->estado_hab')");
		return $query;
	}

	public function elimina_hab($datos){
		$query = $this->db->query("DELETE FROM habitaciones where id_habitacion = '$datos'");
		return $query;
	}

	/***** Seccion para Tipos de Habitacón ******/
	public function lista_tipo_hab(){
		$query = $this->db->query("SELECT * FROM tipo_habitacion");
		return $query->result();
	}

	public function guarda_tipo_hab($datos){
		$datos = json_decode($datos);
		$query = $this->db->query("INSERT INTO tipo_habitacion (descripcion, personas,costo) values('$datos->desc_tipo_hab','$datos->num_personas','$datos->costo_hab')");

		return $this->db->insert_id();
	}

	public function edita_tipo_hab($datos){
		$datos = json_decode($datos);
		$query = $this->db->query("UPDATE tipo_habitacion SET descripcion = '$datos->tipo_desc', personas = '$datos->num_personas',costo = '$datos->costo' where id_tipo_hab = $datos->id_tipo");
		return $query;
	}

	public function datos_habitacion($codigo){
		$query = $this->db->query("SELECT *, 
									(SELECT c.rsocial FROM clientes c, kardex_hab k WHERE c.id_clientes = k.id_cliente and k.vigente = 1 and k.cod_hab = '$codigo') as nombre,
									(select costo from tipo_habitacion where id_tipo_hab = habitaciones.id_tipo_hab) as costo, 
									(select DATE_FORMAT(fecha_chk_in,'%d-%m-%Y') from kardex_hab k where k.cod_hab = habitaciones.codigo and k.vigente = '1') as fch_chkin, 
									(select hora_chk_in from kardex_hab k where k.cod_hab = habitaciones.codigo and k.vigente = '1') as hr_chkin, 
									(SELECT DATEDIFF(curdate(),concat(k.fecha_chk_in,' ',k.hora_chk_in)) from kardex_hab k WHERE k.cod_hab = '$codigo' and k.vigente = '1') as dias,
									(select k.obs from kardex_hab k WHERE k.cod_hab = '$codigo' and k.vigente = '1') as obs,
									(SELECT k.adelanto FROM kardex_hab k WHERE k.cod_hab = '$codigo' and k.vigente = '1') as adelanto
									FROM habitaciones where codigo = '$codigo'");
		return $query->row();
	}

	/*
	* Desc: Carga la Razon Social en base al Nit del Cliente
	*/
	public function carga_rsocial($nit_cliente){
		$query = $this->db->query("SELECT distinct(rsocial) from clientes where nit_cliente = $nit_cliente");
		return $query->result();
	}

	/*
	* Desc: Actualiza la Razon Social si esta cambia
	*/
	public function actualiza_rsocial($datos){
		$dato = json_decode($datos);
		$rsocial = addslashes($dato->rsocial);
		$query = $this->db->query("UPDATE clientes SET rsocial= '$rsocial' where nit_cliente = $dato->nit_cliente");
		return $query;
	}

	public function guarda_asignacion($datos){
		$ql = $this->db->select('id_clientes')->from('clientes')->where('nit_cliente',$datos->ci_passport)->get();

		if( $ql->num_rows() > 0 ) {
			$id_cliente = $ql->row()->id_clientes;
		} else {
		    $a = array('rsocial' => $datos->nombre_apell, 'nit_cliente' => $datos->ci_passport);
		    $this->db->insert('clientes', $a);
			$id_cliente = $this->db->insert_id();
		}
		//$query_clientes = $this->db->query("INSERT INTO clientes (id_clientes, rsocial, nit_cliente) values('','$datos->nombre_apell','$datos->ci_passport')");
		$usuario = $this->session->userdata["usuario"];
		$fecha_checkin = date_create($datos->fecha_checkin);
		$fecha_checkin = date_format($fecha_checkin, 'Y-m-d');
		$query_update_kardex = $this->db->query("UPDATE kardex_hab SET vigente = '0' WHERE cod_hab = '$datos->cod_hab'");
		$query_kardex = $this->db->query("INSERT INTO kardex_hab (id_kardex_hab, cod_hab, fecha_chk_in, hora_chk_in, num_personas, id_cliente, desayuno, adelanto, usuario, fecha_registro, obs, vigente) values('', '$datos->cod_hab', '$fecha_checkin', '$datos->hora_checkin', '$datos->num_personas',$id_cliente, '$datos->desayuno', '$datos->adelanto', '$usuario',now(), '$datos->observaciones', '1')");
		$query_habitaciones = $this->db->query("UPDATE habitaciones SET estado = 'ocupado' WHERE codigo = '$datos->cod_hab'");
		return $query_kardex;
	}

	public function guarda_checkout($dato){
		$dato = json_decode($dato);
		$usuario = $this->session->userdata["usuario"];
		$query = $this->db->query("UPDATE kardex_hab SET fecha_chk_out = curdate(), hora_chk_out = curtime(), total_cobrado = '$dato->total', usuario = '$usuario',fecha_registro = now() WHERE cod_hab = '$dato->cod_habitacion' and vigente = '1'");
		$query_estado = $this->db->query ("UPDATE habitaciones SET estado = 'libre' WHERE codigo = '$dato->cod_habitacion'");
		return $query;
	}

	public function guarda_habilitacion($dato){
		$query = $this->db->query("UPDATE habitaciones SET estado = 'libre' where codigo = '$dato'");
		return $guarda_habilitacion;
	}

	public function libres(){
		$query = $this->db->query("SELECT count(*) as libres from habitaciones where estado = 'libre'");
		return $query->row();
	}

	public function ocupadas(){
		$query = $this->db->query("SELECT count(*) as ocupadas from habitaciones where estado = 'ocupado'");
		return $query->row();
	}

	public function ingresos(){
		$usuario = $this->session->userdata['usuario'];
		$query = $this->db->query("SELECT ifnull(sum(total_cobrado),0) as ingresos from kardex_hab where usuario = '$usuario' and date(fecha_registro) = date(now())");
		return $query->row();
	}
}
