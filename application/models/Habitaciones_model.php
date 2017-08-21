<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*****************************************
*
* Author: Jorge Anibal Zapata Agreda
* 
*
*****************************************/
class Habitaciones_model extends CI_Model{
	public function lista_habitaciones($piso =''){
		if ($piso != '') {
			$condicion = "WHERE piso_hab = '$piso'";
		} else{
			$condicion = '';
		}

		$query = $this->db->query("SELECT h.id_habitacion, h.piso_hab, h.codigo,
									(select t.descripcion 
										from tipo_habitacion t 
										where t.id_tipo_hab = h.id_tipo_hab) as descripcion,
									(select t.costo 
										from tipo_habitacion t 
										where t.id_tipo_hab = h.id_tipo_hab) as costo, 
									h.estado, 
									IFNULL((select k.obs from kardex_hab k where k.cod_hab = h.codigo and k.vigente = 1),'') as obs 
									FROM `habitaciones` h $condicion");
		return $query->result();
	}

	public function lista_tipos(){
		$query = $this->db->query("SELECT * from tipo_habitacion");
		return $query->result();
	}

	public function guarda_hab($datos){
		$datos = json_decode($datos);
		$query = $this->db->query("INSERT INTO habitaciones (codigo, piso_hab,id_tipo_hab, estado) values('$datos->cod_hab', '$datos->piso_hab','$datos->tipo_hab','$datos->estado_hab')");
		return $query;
	}

	public function edita_hab($datos){
		$datos = json_decode($datos);
		$query = $this->db->query("UPDATE habitaciones set piso_hab = '$datos->piso_hab', codigo = '$datos->cod_hab', id_tipo_hab = '$datos->tipo_hab', estado = '$datos->estado_hab' where id_habitacion = '$datos->id_habitacion'");
		return $query;
	}

	public function elimina_hab($datos){
		$query = $this->db->query("DELETE FROM habitaciones where id_habitacion = '$datos'");
		return $query;
	}

	public function elimina_tipo_hab($datos){
		$query = $this->db->query("DELETE FROM tipo_habitacion where id_tipo_hab = '$datos'");
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
									(select costo from tipo_habitacion where id_tipo_hab = habitaciones.id_tipo_hab) as costo, 
									(select DATE_FORMAT(fecha_chk_in,'%d-%m-%Y') from kardex_hab k where k.cod_hab = habitaciones.codigo and k.vigente = '1') as fch_chkin, 
									(select hora_chk_in from kardex_hab k where k.cod_hab = habitaciones.codigo and k.vigente = '1') as hr_chkin, 
									(SELECT DATEDIFF(curdate(),concat(k.fecha_chk_in,' ',k.hora_chk_in)) from kardex_hab k WHERE k.cod_hab = '$codigo' and k.vigente = '1') as dias,
									(select k.obs from kardex_hab k WHERE k.cod_hab = '$codigo' and k.vigente = '1') as obs,
									(SELECT k.adelanto FROM kardex_hab k WHERE k.cod_hab = '$codigo' and k.vigente = '1') as adelanto,
									(SELECT k.id_clientes_registrados FROM kardex_hab k WHERE k.cod_hab = '$codigo' and k.vigente = '1') as clientes
									FROM habitaciones where codigo = '$codigo'");
		return $query->row();
	}

	public function lista_clientes($clientes){
		$query = $this->db->query("SELECT * FROM clientes where id_clientes in ($clientes)");
		return $query->result();
	}

	/*
	* Desc: Carga la Razon Social en base al Nit del Cliente
	*/
	public function carga_rsocial($nit_cliente){
		$query = $this->db->query("SELECT * from clientes where nit_cliente = '$nit_cliente' limit 1");
		return $query->result();
	}

	/*
	* Desc: Actualiza la Razon Social si esta cambia
	*/
	public function actualiza_rsocial($datos){
		$dato = json_decode($datos);
		$rsocial = addslashes($dato->rsocial);
		$query = $this->db->query("UPDATE clientes SET rsocial= '$rsocial' where nit_cliente = '$dato->nit_cliente'");
		return $query;
	}

	public function guarda_asignacion($datos){
		// Seccion de Guardado de Clientes
		$clientes = $datos[1];
		$lista_clientes = [];
		foreach ($clientes as $key) {
			$datos_cliente = json_decode($key);
			$ql = $this->db->select('id_clientes')->from('clientes')->where('nit_cliente',$datos_cliente->nit_cliente)->get();
			echo $ql->num_rows(); 
			if( $ql->num_rows() > 0 ) {
				$lista_clientes[] = $ql->row()->id_clientes;
			} else {
			    $a = array('rsocial' => $datos_cliente->rsocial, 
			    			'nit_cliente' => $datos_cliente->nit_cliente, 
			    			'pais' => $datos_cliente->nacionalidad, 
			    			'ciudad' => $datos_cliente->ciudad, 
			    			'empresa' => $datos_cliente->empresa,
			    			'ecivil' => $datos_cliente->ecivil,
			    			'email' => $datos_cliente->email,
			    			'telefono' => $datos_cliente->telefono);
			    $this->db->insert('clientes', $a);
				$id_cliente = $this->db->insert_id();
				$lista_clientes[] = $id_cliente;
			}
		}
		$lista_clientes = json_encode($lista_clientes);
		$lista_clientes = str_replace('[', '', $lista_clientes);
		$lista_clientes = str_replace(']', '', $lista_clientes);
		$lista_clientes = str_replace('"', '', $lista_clientes);

		// Seccion de Guardado datos de la Habitación
		$usuario = $this->session->userdata["usuario"];
		$cod_hab = $datos[0][0]['cod_hab'];
		$fecha_checkin = $datos[0][0]['fecha_checkin'];
		$hora_checkin = $datos[0][0]['hora_checkin'];
		$num_personas = count($lista_clientes);
		$desayuno = $datos[0][0]['desayuno'];
		$adelanto = $datos[0][0]['adelanto'];
		$observaciones = $datos[0][0]['observaciones'];
		$fecha_checkin = date_create($fecha_checkin);
		$fecha_checkin = date_format($fecha_checkin, 'Y-m-d');
		$query_update_kardex = $this->db->query("UPDATE kardex_hab SET vigente = '0' WHERE cod_hab = '$cod_hab'");
		$query_kardex = $this->db->query("INSERT INTO kardex_hab (id_kardex_hab, cod_hab, fecha_chk_in, hora_chk_in, num_personas, id_clientes_registrados, desayuno, adelanto, usuario, fecha_registro, obs, vigente) values('', '$cod_hab', '$fecha_checkin', '$hora_checkin', '$num_personas','$lista_clientes', '$desayuno', '$adelanto', '$usuario',now(), '$observaciones', '1')");
		$query_habitaciones = $this->db->query("UPDATE habitaciones SET estado = 'ocupado' WHERE codigo = '$cod_hab'");

		return $query_kardex;
	}

	public function guarda_checkout($dato){
		$dato = json_decode($dato);
		$usuario = $this->session->userdata["usuario"];
		$query = $this->db->query("UPDATE kardex_hab SET fecha_chk_out = curdate(), hora_chk_out = curtime(), total_cobrado = '$dato->total', usuario = '$usuario',fecha_registro = now() WHERE cod_hab = '$dato->cod_habitacion' and vigente = '1'");
		$query_estado = $this->db->query ("UPDATE habitaciones SET estado = '$dato->estado_hab' WHERE codigo = '$dato->cod_habitacion'");
		$id_caja = $this->session->userdata('id_caja');
		$query_caja = $this->db->query("INSERT INTO caja (id_caja, tipo_mov, tipo_doc, num_doc, monto, concepto, fecha, hora, usuario, id_estado_caja) values('', 'ingreso', 'F', '', '$dato->total', 'Hospedaje Hab.: $dato->cod_habitacion', curdate(), curtime(), '$usuario', '$id_caja')");
		return $query;
	}

	public function cambia_estado_hab($dato){
		$dato = json_decode($dato);
		$usuario = $this->session->userdata["usuario"];
		$query = $this->db->query ("UPDATE habitaciones SET estado = '$dato->opcion' WHERE codigo = '$dato->codigo'");
		return $query;
	}

	public function guarda_habilitacion($dato){
		$dato = json_decode($dato);
		$usuario = $this->session->userdata["usuario"];
		$query = $this->db->query("UPDATE habitaciones SET estado = 'libre', obs = '$dato->reporte' where codigo = '$dato->cod_habitacion'");
		$query_reporte = $this->db->query("INSERT INTO rep_camarera (id_repcamarera, cod_hab, fch_reporte, reporte, usuario) 
									VALUES('','$dato->cod_habitacion', now(), '$dato->reporte', '$usuario')");
		return $query_reporte;
	}

	public function actualizar_habitacion($dato){
		$datos = json_decode($dato);
		$query = $this->db->query("UPDATE kardex_hab SET obs = '$datos->observaciones', adelanto = '$datos->adelanto' where cod_hab = '$datos->cod_hab'");
		return $query;
	}

	public function buscar_habitacion($hab=''){
		$habitacion = $this->db->query("SELECT h.id_habitacion, h.piso_hab, h.codigo,
									(select t.descripcion 
										from tipo_habitacion t 
										where t.id_tipo_hab = h.id_tipo_hab) as descripcion,
									(select t.costo 
										from tipo_habitacion t 
										where t.id_tipo_hab = h.id_tipo_hab) as costo, 
									h.estado, 
									IFNULL((select k.obs from kardex_hab k where k.cod_hab = h.codigo and k.vigente = 1),'') as obs 
									FROM `habitaciones` h WHERE codigo like '%$hab%'");
		return $habitacion->result();
	}

	public function detalle_libres(){
		$query = $this->db->query("SELECT * FROM habitaciones WHERE estado = 'libre' or estado = 'limpio'");
		return $query->result();
	}

	public function detalle_ocupadas(){
		$query = $this->db->query("SELECT * FROM habitaciones WHERE estado = 'ocupado'");
		return $query->result();
	}

	public function detalle_reservadas(){
		$query = $this->db->query("SELECT * FROM habitaciones WHERE estado = 'reservado'");
		return $query->result();
	}

	public function ingresos(){
		$usuario = $this->session->userdata['usuario'];
		$query = $this->db->query("SELECT ifnull(sum(total_cobrado),0) as ingresos from kardex_hab where usuario = '$usuario' and date(fecha_registro) = date(now())");
		return $query->row();
	}

	public function pisos_hab(){
		$query = $this->db->query("SELECT piso_hab, count(piso_hab) as num_hab FROM habitaciones group by piso_hab");
		return $query->result();
	}

	public function guardaReserva($id, $datos){
		// $query = $this->db->insert('reservas', $datos);
		$this->db->where('id_habitacion', $id);
		$query = $this->db->update('habitaciones', $datos);
		return $query;
	}

	public function guardaMantenimiento($id, $datos){
		$this->db->where('id_habitacion', $id);
		$query = $this->db->update('habitaciones', $datos);
		return $query;
	}

	public function lista_hab_reservadas(){
		$this->db->where('estado', 'Reservado');
		$query = $this->db->get('habitaciones');
		return $query->result();
	}

	public function lista_hab_estado($estado){
		if ($estado == 'mantesucio') {
			$condicion = "WHERE (estado = 'sucio' or estado = 'Mantenimiento')";
		} else{
			$condicion = "WHERE estado = '$estado'";
		}
		$query = $this->db->query("SELECT h.id_habitacion, h.piso_hab, h.codigo,
									(select t.descripcion 
										from tipo_habitacion t 
										where t.id_tipo_hab = h.id_tipo_hab) as descripcion,
									(select t.costo 
										from tipo_habitacion t 
										where t.id_tipo_hab = h.id_tipo_hab) as costo, 
									h.estado, 
									IFNULL((select k.obs from kardex_hab k where k.cod_hab = h.codigo and k.vigente = 1),'') as obs 
									FROM `habitaciones` h $condicion");
		return $query->result();
	}

	public function repo_camarera(){
		$query = $this->db->query("SELECT * FROM rep_camarera");
		return $query->result();
	}
}
