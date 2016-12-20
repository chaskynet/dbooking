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
			$this->load->view('main_view',$data);
		} else{
			$this->login();
		}
	}

	
	public function login(){
		if ($this->session->userdata('is_logged_in')){
			//$data['vacias'] = $this->Facturas_model->factu_vacias()->factu_vacias;
			// $this->load->view('main_view',$data);
			$this->load->view('main_view');
		} else{
			$this->load->view('login_view');
		}
	}

	public function principal(){
		if ($this->session->userdata('is_logged_in')){
			// $data['vacias'] = $this->Facturas_model->factu_vacias()->factu_vacias;
			//$this->load->view('main_view',$data);
			$this->load->view('main_view');
		} else{
			redirect('Main_controller/restringido');
		}
	}

	public function restringido(){
		$this->load->view('restringido_view');
	}
	
	/**
	*
	*
	*/
	public function login_validation(){
		
		$this->form_validation->set_rules('usuario', 'Usuario', 'required|trim|callback_validar_credenciales');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if($this->form_validation->run()){
			$this->load->model('Usuarios_model');

			$permisos = $this->Usuarios_model->permisos($this->input->post('usuario'), $this->input->post('password'));
			$data = array('usuario' => $this->input->post('usuario'),
					'permisos' => $permisos, 
					'is_logged_in' => 1
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
	* Des:
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
			$data['habitaciones'] = $this->Habitaciones_model->lista_habitaciones();
			$this->load->view('habitaciones_view', $data);
		} else{
			redirect('main/restringido');
		}
	}

	public function gestion_habitaciones(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Habitaciones_model');
			$data['habitaciones'] = $this->Habitaciones_model->lista_habitaciones();
			$data['tipos'] = $this->Habitaciones_model->lista_tipos();
			$this->load->view('gestion_habitaciones_view', $data);
		} else{
			redirect('main/restringido');
		}
	}

	public function lista_hab(){
		if ($this->session->userdata('is_logged_in')){
			$this->load->model('Habitaciones_model');
			$habitaciones = $this->Habitaciones_model->lista_habitaciones();
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
			$data['datos'] = $this->Habitaciones_model->datos_habitacion($_POST['data']);
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

	public function guarda_asignacion(){
		if ($this->session->userdata('is_logged_in')) {
			$datos = json_decode($_POST['data']);
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

	/**********  Seccion de Caja  *********************/
	public function vista_caja(){
		if ($this->session->userdata('is_logged_in')){
			$data['libres'] = $this->Habitaciones_model->libres();
			$data['ocupadas'] = $this->Habitaciones_model->ocupadas();
			$data['ingresos'] = $this->Habitaciones_model->ingresos();
			$this->load->view('caja_view',$data);
		} else{
			redirect('main/restringido');
		}
	}
}
