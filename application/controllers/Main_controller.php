<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Author: Jorge Anibal Zapata Agreda
*
**/
class Main_controller extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('Habitaciones_model');
	}
	
	/*************************************************************/
	public function index(){
		if ($this->session->userdata('is_logged_in')){
			$data['detalle_libres'] = $this->Habitaciones_model->detalle_libres();
			$data['detalle_ocupadas'] = $this->Habitaciones_model->detalle_ocupadas();
			$data['detalle_reservadas'] = $this->Habitaciones_model->detalle_reservadas();
			$data['ingresos'] = $this->Habitaciones_model->ingresos();
			$this->load->view('main_view',$data);
		} else{
			$this->login();
		}
	}
	
	public function login(){
		if ($this->session->userdata('is_logged_in')){
			$data['detalle_libres'] = $this->Habitaciones_model->detalle_libres();
			$data['detalle_ocupadas'] = $this->Habitaciones_model->detalle_ocupadas();
			$data['detalle_reservadas'] = $this->Habitaciones_model->detalle_reservadas();
			$data['ingresos'] = $this->Habitaciones_model->ingresos();

			$this->load->view('main_view', $data);
		} else{
			$this->load->view('login_view');
		}
	}

	public function principal(){
		if ($this->session->userdata('is_logged_in')){
			$data['detalle_libres'] = $this->Habitaciones_model->detalle_libres();
			$data['detalle_ocupadas'] = $this->Habitaciones_model->detalle_ocupadas();
			$data['detalle_reservadas'] = $this->Habitaciones_model->detalle_reservadas();
			$data['ingresos'] = $this->Habitaciones_model->ingresos();

			$this->load->view('main_view', $data);
		} else{
			redirect('Main_controller/restringido');
		}
	}

	public function restringido(){
		$this->load->view('restringido_view');
	}
	
	/**
	* Author: Jorge Anibal Zapata Agreda	* 
	*/
	public function login_validation(){
		
		$this->form_validation->set_rules('usuario', 'Usuario', 'required|trim|callback_validar_credenciales');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if($this->form_validation->run()){
			$this->load->model('Usuarios_model');
			$this->load->model('Caja_model');

			$permisos = $this->Usuarios_model->permisos($this->input->post('usuario'), $this->input->post('password'));
			$estado_caja = $this->Caja_model->estado_caja_ses()->estado;
			$id_caja = $this->Caja_model->estado_caja_ses()->id_estado_caja;
			$data = array('usuario' => $this->input->post('usuario'),
					'permisos' => $permisos, 
					'is_logged_in' => 1,
					'estado_caja' => $estado_caja,
					'id_caja' => $id_caja
					);
			$this->session->set_userdata($data);
			redirect('Main_controller/principal');
		} else{
			
			$this->load->view('login_view');
		}
	}

	/**
	*
	*/
	public function validar_credenciales(){
		$this->load->model('Usuarios_model');

		if($this->Usuarios_model->puede_entrar() == 1 ){

			return true;
		} elseif($this->Usuarios_model->puede_entrar() == 2 ){
			$this->form_validation->set_message('validar_credenciales', 'Usuario Bloqueado!');
			return false;
		} elseif ($this->Usuarios_model->puede_entrar() == 3 ) {
			$this->form_validation->set_message('validar_credenciales', 'Usuario Inactivo');
			return false;
		}
		else{
			$this->form_validation->set_message('validar_credenciales', 'Usuario/Password incorrectos!');
			return false;
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('Main_controller/login');
	}
	//------------ Fin modulo Login y Logout ---
	/****************************
	*							*
	* Desc: Gestion de Usuarios *
	*							*
	****************************/
	public function gestion_usuarios(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Usuarios_model');
			$data['usuarios'] = $this->Usuarios_model->lista_usuarios();
			$this->load->view('gestion_usuarios_view', $data);
		} else{
			$this->load->view('login_view');
		}
	}

	public function nuevo_usuario(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Usuarios_model');
			$nuevo_usuario = $this->Usuarios_model->nuevo_usuario($_POST['data']);
			
			echo $nuevo_usuario;
			
		} else{
			redirect('Main_controller/restringido');
		}
	}

	public function carga_datos_usuario(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Usuarios_model');
			$nuevo_usuario = $this->Usuarios_model->carga_datos_usuario($_POST['data']);
			$lista_permisos = $this->Usuarios_model->carga_permisos_usuario($_POST['data']);
			$datos_usuario['datos_usuario'] = $nuevo_usuario;
			$datos_usuario['permisos'] = $lista_permisos;
			//echo json_encode($nuevo_usuario);
			echo json_encode($datos_usuario);
		} else{
			redirect('Main_controller/restringido');
		}
	}

	/*
	*
	* Author: Jorge Anibal Zapata Agreda
	* Des: Actualización de usuarios
	*
	*/
	public function actualizar_usuario(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Usuarios_model');

			$actualizar_usuario = $this->Usuarios_model->actualizar_usuario($_POST['data']);
			echo json_encode($actualizar_usuario);
		} else{
			redirect('Main_controller/restringido');
		}
	}

	public function elimina_usuario(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Usuarios_model');

			$elimina_usuario = $this->Usuarios_model->elimina_usuario($_POST['data']);
			echo $elimina_usuario;
		} else{
			redirect('main/restringido');
		}
	}
	//---------------------- Fin modulo Usuarios --------------------

	/****************************************
	*										*
	* Author: Jorge Anibal Zapata Agreda	*
	*										*
	* Desc: Gestion de Habitaciones 		*
	*										*
	****************************************/
	public function asignar_habitaciones(){
		if ($this->session->userdata('is_logged_in')){
			if (isset($_POST['data'])) {
				$piso = $_POST['data'];
			} else{
				$piso = '';
			}
			$data['pisos'] = $this->Habitaciones_model->pisos_hab();
			$data['habitaciones'] = $this->Habitaciones_model->lista_habitaciones($piso);
			$data['reservadas'] = $this->Habitaciones_model->lista_hab_reservadas('Reservado');
			$this->load->view('habitaciones_view', $data);
		} else{
			redirect('main/restringido');
		}
	}

	public function busca_hab_estado(){
		if ($this->session->userdata('is_logged_in')) {
			$estado = $_POST['data'];
			$data['pisos'] = $this->Habitaciones_model->pisos_hab();
			$data['habitaciones'] = $this->Habitaciones_model->lista_hab_estado($estado);
			$data['reservadas'] = $this->Habitaciones_model->lista_hab_reservadas('Reservado');
			$this->load->view('habitaciones_view', $data);
		} else{
			redirect('main/restringido');
		}
	}

	public function gestion_habitaciones(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Habitaciones_model');
			if (isset($_POST['data'])) {
				$piso = $piso_habitacion;
			} else{
				$piso = '';
			}
			$data['habitaciones'] = $this->Habitaciones_model->lista_habitaciones($piso);
			$data['tipos'] = $this->Habitaciones_model->lista_tipos();
			$this->load->view('gestion_habitaciones_view', $data);
		} else{
			redirect('main/restringido');
		}
	}

	public function lista_hab(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Habitaciones_model');
			if (isset($_POST['data'])) {
				$piso = $piso_habitacion;
			} else{
				$piso = '';
			}
			$habitaciones = $this->Habitaciones_model->lista_habitaciones($piso);
			echo json_encode($habitaciones);
		} else{
			redirect('main/restringido');
		}
	}

	public function lista_tipo_hab(){
		if ($this->session->userdata('is_logged_in')) {
			$lista_tipo_hab = $this->Habitaciones_model->lista_tipo_hab();
			echo json_encode($lista_tipo_hab);
		} else{
			redirect('main/restringido');
		}
	}

	public function guarda_hab(){
		if ($this->session->userdata('is_logged_in')) {
			$datos = $_POST['data'];
			$guarda_hab = $this->Habitaciones_model->guarda_hab($datos);
			$datos =  $this->Habitaciones_model->lista_habitaciones();
			echo json_encode($datos);
		} else{
			redirect('main/restringido');
		}
	} 

	public function elimina_hab(){
		if ($this->session->userdata('is_logged_in')) {
			$datos = $_POST['data'];
			$elimina_hab = $this->Habitaciones_model->elimina_hab($datos);
			echo $elimina_hab;
		} else{
			redirect('main/restringido');
		}
	}

	public function elimina_tipo_hab(){
		if ($this->session->userdata('is_logged_in')) {
			$datos = $_POST['data'];
			$elimina_tipo_hab = $this->Habitaciones_model->elimina_tipo_hab($datos);
			echo $elimina_tipo_hab;
		} else{
			redirect('main/restringido');
		}
	}

	/******  Seccion para Tipos de Habitación ******/
	public function guarda_tipo_hab(){
		if ($this->session->userdata('is_logged_in')){
			$datos = $_POST['data'];
			$guarda_tipo_hab = $this->Habitaciones_model->guarda_tipo_hab($datos);
			echo $guarda_tipo_hab;
		} else{
			redirect('main/restringido');
		}
	}

	public function edita_tipo_hab(){
		if ($this->session->userdata('is_logged_in')){
			$datos = $_POST['data'];
			$edita_tipo_hab = $this->Habitaciones_model->edita_tipo_hab($datos);
			echo $edita_tipo_hab;
		} else{
			redirect('main/restringido');
		}
	}

	public function edita_hab(){
		if ($this->session->userdata('is_logged_in')){
			$datos = $_POST['data'];
			$edita_hab = $this->Habitaciones_model->edita_hab($datos);
			echo $edita_hab;
		} else{
			redirect('main/restringido');
		}
	}

	/*******************************/

	public function vista_checking(){
		if ($this->session->userdata('is_logged_in')){
			$data['datos'] = $this->Habitaciones_model->datos_habitacion($_POST['data']);
			$this->load->view('checking_view',$data);
		} else{
			redirect('main/restringido');
		}
	}

	public function carga_rsocial(){
		if ($this->session->userdata('is_logged_in')){
			$dato = $_POST['data'];
			$rsocial = $this->Habitaciones_model->carga_rsocial($dato);
			echo json_encode($rsocial);
		} else{
			redirect('main/restringido');
		}
	}

	public function actualiza_rsocial(){
		if ($this->session->userdata('is_logged_in')) {
			$dato = $_POST['data'];
			$rsocial = $this->Habitaciones_model->actualiza_rsocial($dato);
			echo $rsocial;
		} else{
			redirect('Main_controller/restringido');
		}
	}

	public function vista_checkout(){
		if ($this->session->userdata('is_logged_in')){
			$datos = $this->Habitaciones_model->datos_habitacion($_POST['data']);
			$data['datos'] = $datos;
			$data['clientes'] = $this->Habitaciones_model->lista_clientes($datos->clientes);
			$this->load->view('checkout_view',$data);
		} else{
			redirect('main/restringido');
		}
	}

	public function vista_habilitar(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->view('habilitar_view');
		} else{
			redirect('main/restringido');
		}
	}

	public function vista_reserva(){
		if ($this->session->userdata('is_logged_in')){
			$datos = json_decode($_POST['data']);
			$data['id_hab'] = $datos->id_hab;
			$this->load->view('reserva_view', $data);
		} else{
			redirect('main/restringido');
		}
	}

	public function vista_mantenimiento(){
		if ($this->session->userdata('is_logged_in')){
			$datos = json_decode($_POST['data']);
			$data['id_hab'] = $datos->id_hab;
			$this->load->view('mantenimiento_view',$data);
		} else{
			redirect('main/restringido');
		}
	}

	public function form_reserva_hab(){
		if ($this->session->userdata('is_logged_in')){
			if (!$this->input->is_ajax_request()) { exit('Requerimiento No Valido'); }
			$FormRules = array(
					array(
	                    'field' => 'clt_1',
	                    'label' => 'Cliente',
	                    'rules' => 'required'
	                ),
	                array(
	                    'field' => 'fch_reserva',
	                    'label' => 'Fecha',
	                    'rules' => 'required'
	                ),
	                array(
	                    'field' => 'hr_reserva',
	                    'label' => 'Hora',
	                    'rules' => 'required'
	                )
            );
			$this->form_validation->set_rules($FormRules);
			if ($this->form_validation->run() == TRUE)
            {
            	$fch = date_create($this->input->post('fch_reserva'));
            	$fch = date_format($fch, 'Y-m-d');
            	$id = $this->input->post('id_hab');
				// $data = array(
				// 	'id_habitacion' => $this->input->post('id_hab'),
				// 	'cliente'    	=> $this->input->post('clt_1'),
				// 	'fch_reserva'  	=> $fch,
				// 	'hr_reserva'	=> $this->input->post('hr_reserva'),
				// 	'fch_registro'=> date("Y-m-d h:i:s"),
				// 	'usuario'		=> $this->session->userdata('usuario')
				// );
				$data = array(
					'obs'    		=> $this->input->post('clt_1'),
					'estado'		=> 'Reservado',
					'fch_reserva'  	=> $fch,
					'hr_reserva'	=> $this->input->post('hr_reserva'),
				);
            	$nueva_reserva = $this->Habitaciones_model->guardaReserva($id, $data);
            	$status = 'OK';
                $msg = '<div class="col-md-7 col-md-offset-3 alert alert-success alert-dismissible text-center" role="alert" style= "font-size:13px;">
                			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                			<span aria-hidden="true">&times;</span>
	                		</button>
                			Reserva Guardada Correctamente!
                		</div>';
                echo json_encode( array('status' => $status, 'msg' => $msg));
            } else{
            	$status = 'NOK';
            	$errores = validation_errors();
                $msg = "<div class='col-md-7 col-md-offset-3 alert alert-danger alert-dismissible' role='alert' style='font-size:13px;'>
                		<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                			<span aria-hidden='true'>&times;</span>
                		</button>
						$errores
                </div>";
                echo json_encode( array('status' => $status, 'msg' => $msg));
            }
		} else{
			redirect('main/restringido');
		}
	}

	public function form_mante_hab(){
		if ($this->session->userdata('is_logged_in')){
			if (!$this->input->is_ajax_request()) { exit('Requerimiento No Valido'); }
			$FormRules = array(
	                array(
	                    'field' => 'motivo_mantenimiento',
	                    'label' => 'Motivo',
	                    'rules' => 'required'
	                )
            );
			$this->form_validation->set_rules($FormRules);
			if ($this->form_validation->run() == TRUE)
            {
            	$id = $this->input->post('id_hab');
				$data = array(
					'id_habitacion' => $id,
					'estado'		=> 'Mantenimiento',
					'obs'    		=> $this->input->post('motivo_mantenimiento')
				);
            	$this->Habitaciones_model->guardaMantenimiento($id, $data);
            	$status = 'OK';
                $msg = '<div class="col-md-7 col-md-offset-3 alert alert-success alert-dismissible text-center" role="alert" style= "font-size:16px;">
                			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	                			<span aria-hidden="true">&times;</span>
	                		</button>
                			Mantenimiento Guardado Correctamente!
                		</div>';
                echo json_encode( array('status' => $status, 'msg' => $msg));
            } else{
            	$status = 'NOK';
            	$errores = validation_errors();
                $msg = "<div class='col-md-7 col-md-offset-3 alert alert-danger alert-dismissible' role='alert'>
                		<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                			<span aria-hidden='true'>&times;</span>
                		</button>
						$errores
                </div>";
                echo json_encode( array('status' => $status, 'msg' => $msg));
            }
		} else{
			redirect('main/restringido');
		}
	}


	public function guarda_asignacion(){
		if ($this->session->userdata('is_logged_in')) {
			$datos = $_POST['data'];
			$guarda_asignacion = $this->Habitaciones_model->guarda_asignacion($datos);
			echo $guarda_asignacion;
		} else{
			redirect('main/restringido');
		}
	}

	public function guarda_checkout(){
		if ($this->session->userdata('is_logged_in')) {
			$dato = $_POST['data'];
			$guarda_checkout = $this->Habitaciones_model->guarda_checkout($dato);
			echo $guarda_checkout;
		} else{
			redirect('main/restringido');
		}
	}

	public function guarda_habilitacion(){
		if ($this->session->userdata('is_logged_in')) {
			$dato = $_POST['data'];
			$guarda_habilitacion = $this->Habitaciones_model->guarda_habilitacion($dato);
			echo $guarda_habilitacion;
		} else{
			redirect('main/restringido');
		}
	}

	public function actualizar_habitacion(){
		if ($this->session->userdata('is_logged_in')) {
			$dato = $_POST['data'];
			$actualizar_habitacion = $this->Habitaciones_model->actualizar_habitacion($dato);
			echo $actualizar_habitacion;
		} else{
			redirect('main/restringido');
		}
	}

	public function cambia_estado_hab(){
		if ($this->session->userdata('is_logged_in')) {
			$dato = $_POST['data'];
			$cambia_estado_hab = $this->Habitaciones_model->cambia_estado_hab($dato);
			echo $cambia_estado_hab;
		} else{
			redirect('main/restringido');
		}
	}

	/****************************
	*							*
	* Desc: Gestion de clientes *
	*							*
	****************************/
	public function gestion_clientes(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Clientes_model');
			$data['clientes'] = $this->Clientes_model->lista_clientes();
			$this->load->view('gestion_clientes_view', $data);
		} else{
			$this->load->view('login_view');
		}
	}

	public function elimina_cliente(){
		if ($this->session->userdata('is_logged_in')){
			$dato = $_POST['data'];
			$this->load->model('Clientes_model');
			$elimina_cliente = $this->Clientes_model->elimina_cliente($dato);
			echo $actualizar_habitacion;
		} else{
			$this->load->view('login_view');
		}
	}

	public function actualiza_cliente(){
		if ($this->session->userdata('is_logged_in')) {
			$datos = $_POST['data'];
			$this->load->model('Clientes_model');
			$actualizar_cliente = $this->Clientes_model->actualiza_cliente($datos);
			echo $actualizar_cliente;
		} else{
			redirect('main/restringido');
		}
	}

	/**********  Seccion de Caja  *********************/
	public function vista_caja(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Caja_model');
			$data['estado'] = $this->Caja_model->estado_caja();
			$data['detalle_mov'] = $this->Caja_model->detalle_caja();
			$this->load->view('caja_view', $data);
		} else{
			redirect('main/restringido');
		}
	}

	public function trae_monto_cierre(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Caja_model');
			$monto_cierre = $this->Caja_model->monto_cierre();
			echo json_encode($monto_cierre);
		} else{
			redirect('main/restringido');
		}
	}

	public function apertura_caja(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Caja_model');
			$apertura = $this->Caja_model->apertura_caja($_POST['data']);
			if ($apertura) {
				$data['estado'] = $this->Caja_model->estado_caja();
			}
			$this->load->view('caja_view', $data);
		} else{
			redirect('main/restringido');
		}
	}

	//*** Funcion de Apertura de Caja *****//
	public function guarda_mov_caja(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Caja_model');
			$apertura = $this->Caja_model->guarda_mov_caja($_POST['data']);
			if ($apertura) {
				//$data['detalle_mov'] = $this->Caja_model->detalle_mov();
			}
			$this->load->view('caja_view', $data);
		} else{
			redirect('main/restringido');
		}
	}

	//*** Funcion de Cierre de Caja *****//
	public function cierre_caja(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Caja_model');
			$cierre = $this->Caja_model->cierre_caja($_POST['data']);
			if ($cierre) {
				$data['estado'] = $this->Caja_model->estado_caja();
			}
			$this->load->view('caja_view', $data);
		} else{
			redirect('main/restringido');
		}
	}

	public function busca_cierre_caja(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Caja_model');
			$data['cierres_caja'] = $this->Caja_model->busca_cierre_caja($_POST['data']);
			$this->load->view('report_cierre_cja_view', $data);
		} else{
			redirect('main/restringido');
		}
	}

	public function trae_detalle_cierre_cja(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Caja_model');
			$data['detalle_mov'] = $this->Caja_model->detalle_caja_pdf($_POST['data']-1);
			$this->load->view('detalle_mov_cierre_cja_view', $data);
		} else{
			redirect('main/restringido');
		}
	}

	public function pdf_cierre_caja(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->library('MPDF53/Mpdf');
			$this->load->library('PdfPrint');
			$this->load->model('Caja_model');
			//$mpdf = new mPDF('utf-8', 'Letter',0,'',5,6,5,5,0,10);
			$mpdf = new PdfPrint('utf-8', 'Letter',0,'',7,8,5,1,0,0);
			ob_clean();
			$id_estado = $this->input->post('id_estado_caja');
			$data['detalle_mov'] = $this->Caja_model->detalle_caja_pdf($id_estado);
			$mpdf->WriteHTML($this->load->view('detalle_caja_pdf', $data, true));
			$mpdf->AutoPrint(true);
			$mpdf->Output();
			ob_clean();
		} else{
			redirect('Main_controller/restringido');
		}
	}

	/**
	* Desc: Imprime Reporte de Caja
	*
	*/
	public function to_pdf_caja(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->library('MPDF53/Mpdf');
			$this->load->library('PdfPrint');
			//$mpdf = new mPDF('utf-8', 'Letter',0,'',5,6,5,5,0,10);
			$mpdf = new PdfPrint('utf-8', 'Letter',0,'',7,8,5,1,0,0);
			ob_clean();
			$data['detalle_libres'] = $this->Habitaciones_model->detalle_libres();
			$data['detalle_ocupadas'] = $this->Habitaciones_model->detalle_ocupadas();
			$data['detalle_reservadas'] = $this->Habitaciones_model->detalle_reservadas();
			$data['ingresos'] = $this->Habitaciones_model->ingresos();
			$mpdf->WriteHTML($this->load->view('caja_pdf_view', $data, true));
			$mpdf->AutoPrint(true);
			$mpdf->Output();
			ob_clean();
		} else{
			redirect('Main_controller/restringido');
		}
	}

	/***********************************************
	 * *    *  Seccion Reportes     ****** *** *****
	 ***********************************************/
	public function vista_reportes(){
		if ($this->session->userdata('is_logged_in')){
			$data['detalle_libres'] = $this->Habitaciones_model->detalle_libres();
			$data['detalle_ocupadas'] = $this->Habitaciones_model->detalle_ocupadas();
			$data['detalle_reservadas'] = $this->Habitaciones_model->detalle_reservadas();
			$data['ingresos'] = $this->Habitaciones_model->ingresos();
			$this->load->view('reports_view', $data);
		} else{
			redirect('main/restringido');
		}
	}

	public function busca_hab_rep(){
		if ($this->session->userdata('is_logged_in')){
			$datos = $this->Habitaciones_model->datos_habitacion($_POST['buscar']);
			$data['clientes'] = $this->Habitaciones_model->lista_clientes($datos->clientes);
			$data['cod_hab'] = $_POST['buscar'];
			$this->load->view('reports_view',$data);
		} else{
			redirect('main/restringido');
		}
	}

	/**
	* Desc: Imprime Reporte de Caja
	*
	*/
	public function to_pdf_report(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->library('MPDF53/Mpdf');
			$this->load->library('PdfPrint');
			//$mpdf = new mPDF('utf-8', 'Letter',0,'',5,6,5,5,0,10);
			$mpdf = new PdfPrint('utf-8', 'Letter',0,'',7,8,5,1,0,0);
			ob_clean();
			$habitacion = $this->input->post('h_cod_hab');
			$datos = $this->Habitaciones_model->datos_habitacion($habitacion);
			$data['clientes'] = $this->Habitaciones_model->lista_clientes($datos->clientes);
			$data['cod_hab'] = $habitacion;
			$mpdf->WriteHTML($this->load->view('report_pdf_view', $data, true));
			$mpdf->AutoPrint(true);
			$mpdf->Output();
			ob_clean();
		} else{
			redirect('Main_controller/restringido');
		}
	}
}
