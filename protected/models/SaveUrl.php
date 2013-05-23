<?php //modelo utilizado para guardar datos por get (sin reglas en codigo)
class SaveUrl extends CActiveRecord 
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function tableName()
	{
		return 'track_tr_tracking';
	}

	
}
 ?>