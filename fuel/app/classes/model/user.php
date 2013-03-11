<?php

class Model_User extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'username',
		'password',
		'group',
		'email',
		'last_login',
		'login_hash',
		'profile_fields',
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
        $val = Validation::forge($factory);
        $val->add_field('username', 'Username', 'required');
        $val->add_field('password', 'Password', 'required');

        return $val;
    }

    protected static $_has_many = array(
        'categorias' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Categoria',
            'key_to' => 'user_id',
            'cascade_save' => true,
            'cascade_delete' => false,
        ),

        'facturas' => array(
            'key_from' => 'id',
            'model_to' => 'Model_Factura',
            'key_to' => 'user_id',
            'cascade_save' => true,
            'cascade_delete' => false,
        ),
    );

}
