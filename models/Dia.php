<?php 
	class Dia extends Illuminate\Database\Eloquent\Model {
		protected $table = 'c_dia';
		protected $primaryKey = 'id';

		public function horarios(){
			return $this->hasMany('Horario','c_dia_id');
		}
	}

?>