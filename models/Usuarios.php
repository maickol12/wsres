<?php

	class Usuarios extends Illuminate\Database\Eloquent\Model {
		protected $table = 'usuarios';
		protected $primaryKey = 'idUsuario';
		public $timestamps = false;

		  // Relación
    public function alumno() {
        return $this->hasOne('Alumnos', 'idUsuario'); // Le indicamos que se va relacionar con el atributo id
    }
	}
?>