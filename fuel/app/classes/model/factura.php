<?php
use Orm\Model;

class Model_Factura extends Model
{
	protected static $_properties = array(
		'id',
		'ruc',
		'nombre',
		'fecha',
        'numero_factura',
        'tipo',
		'valor',
        'comentario',
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
		$val->add_field('ruc', 'Ruc', 'required|valid_string[numeric]|exact_length[13]|ruc');
		$val->add_field('nombre', 'Nombre', 'required|max_length[255]');
		$val->add_field('fecha', 'Fecha', 'required');
        $val->add_field('numero_factura', 'Valor', 'required|decimal|factura_unique');
		$val->add_field('valor', 'Valor', 'required|decimal');
        $val->add_field('comentario', 'Valor', 'max_length[255]');
		return $val;
	}

}