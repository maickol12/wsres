<?php
	class Usuarios extends Illuminate\Database\Eloquent\Model {
		protected $table = 'usuarios';
		protected $primaryKey = 'idUsuario';
		public $timestamps = false;
	}
?>