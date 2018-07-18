<?php
	class Alumnos extends Illuminate\Database\Eloquent\Model {
		protected $table = 'alumnos';
		protected $primaryKey = 'idAlumno';
		public $timestamps = false;
	}
?>