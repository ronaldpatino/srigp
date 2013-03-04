<?php

namespace Fuel\Migrations;

class Create_categorias
{
	public function up()
	{
		\DBUtil::create_table('categorias', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'nombre' => array('constraint' => 50, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('categorias');
	}
}