<?php

namespace Fuel\Migrations;

class Create_facturas
{
	public function up()
	{
		\DBUtil::create_table('facturas', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'ruc' => array('constraint' => 13, 'type' => 'varchar'),
			'nombre' => array('constraint' => 255, 'type' => 'varchar'),
			'fecha' => array('type' => 'datetime'),
			'numero_factura' => array('constraint' => 15, 'type' => 'varchar'),
			'tipo' => array('constraint' => 1, 'type' => 'int'),
			'valor' => array('constraint' => '10,2', 'type' => 'decimal'),
			'comentario' => array('constraint' => 255, 'type' => 'varchar'),
            'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
            'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
        ), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('facturas');
	}
}