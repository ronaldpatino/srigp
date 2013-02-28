<?php

namespace Fuel\Migrations;

class Create_rucs
{
	public function up()
	{
		\DBUtil::create_table('rucs', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'ruc' => array('constraint' => 13, 'type' => 'varchar'),
			'nombre' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('rucs');
	}
}