<?php
use Orm\Model;

class Model_Categoria extends Model
{
	protected static $_properties = array(
		'id',
		'nombre',
        'user_id',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = MyValidation::forge($factory);
		$val->add_field('nombre', 'Nombre', 'required|max_length[50]|unique[categorias.nombre]');

		return $val;
	}

}
