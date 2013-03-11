<?php

namespace Fuel\Migrations;

class Add_user_id_to_categorias
{
	public function up()
	{
		\DBUtil::add_fields('categorias', array(
			'user_id' => array('constraint' => 11, 'type' => 'int'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('categorias', array(
			'user_id'

		));
	}
}