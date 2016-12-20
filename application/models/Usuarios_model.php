<?php
class Usuarios_model extends CI_Model{
	public function puede_entrar(){
		$this->db->where('uname', $this->input->post('usuario'));
		$this->db->where('password', md5($this->input->post('password')));
		//$this->db->where('estado_usuario', '1');
		$query = $this->db->get('usuarios');
		$estado = 0;
		if($query->num_rows() == 1){
			foreach ($query->result() as $key) {
				$estado = $key->estado;
			}
			return $estado;
		}else{
		return $estado;
		}
	}

	public function lista_usuarios(){
		$query = $this->db->get('usuarios');
		return $query->result();
	}

	public function nuevo_usuario($usuario){
		$nuevo_usuario = json_decode($usuario);
		foreach ($nuevo_usuario[0] as $key ) {
			$query = $this->db->query("INSERT INTO usuarios (id_usuario, uname, password, nombre, apaterno, amaterno, ci, estado) values ('', '$key->uname', md5('$key->password'), '$key->nombre', '$key->apaterno', '$key->amaterno', '$key->ci', 1)");
		}
		$id_usuario = $this->db->insert_id();
		foreach ($nuevo_usuario[1] as $key) {
			$query_permisos = $this->db->query("INSERT INTO permisos (id_permisos, id_usuario, permiso, fecha) values ('', '$id_usuario', '$key', now())");		
		}
		
		return true;
	}

	public function carga_datos_usuario($id_usuario){
		$this->db->where('id_usuario', $id_usuario);
		$query = $this->db->get('usuarios');
		return $query->result();
	}

	public function carga_permisos_usuario($id_usuario){
		$this->db->where('id_usuario', $id_usuario);
		$query = $this->db->get('permisos');
		$lista_permisos = array();
		foreach ($query->result() as $key) {
			array_push($lista_permisos, $key->permiso);
		}
		return $lista_permisos;
	}

	public function actualizar_usuario($usuario){
		$nuevo_usuario = json_decode($usuario);
		$id_usuario = '';
		
		foreach ($nuevo_usuario[0] as $key ) {
			if($key->password){
				$query_usuario = $this->db->query("UPDATE usuarios SET  uname = '$key->uname', nombre = '$key->nombre', apaterno = '$key->apaterno', amaterno = '$key->amaterno', ci = '$key->ci', password = md5('$key->password') WHERE id_usuario = $key->id_usuario");
			}
			else {
				$query_usuario = $this->db->query("UPDATE usuarios SET  uname = '$key->uname', nombre = '$key->nombre', apaterno = '$key->apaterno', amaterno = '$key->amaterno', ci = '$key->ci' WHERE id_usuario = $key->id_usuario");
			}
			$query_borra_permisos = $this->db->query("DELETE FROM permisos WHERE id_usuario = $key->id_usuario");
			$id_usuario = $key->id_usuario;
		}
		
		foreach ($nuevo_usuario[1] as $key) {
			$query_permisos = $this->db->query("INSERT INTO permisos (id_permisos, id_usuario, permiso, fecha) values ('', '$id_usuario', '$key', now())");		
		}

		return $query_permisos;
	}

	public function elimina_usuario($usuario){
		$query = $this->db->query("DELETE FROM usuarios where id_usuario = $usuario");
		$query_borra_permisos = $this->db->query("DELETE FROM permisos WHERE id_usuario = $usuario");
		return $query;
	}

	public function permisos($usuario, $password){
		$query = $this->db->query("SELECT permiso FROM `permisos` where id_usuario in (select a.id_usuario from usuarios a where a.uname = '$usuario' and a.password = md5('$password'))");
		$lista_permisos = array();
		foreach ($query->result() as $key) {
			array_push($lista_permisos, $key->permiso);
		}
		return $lista_permisos;
	}
}
