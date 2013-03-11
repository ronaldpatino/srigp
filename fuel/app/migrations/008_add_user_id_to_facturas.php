<?php

namespace Fuel\Migrations;

class Add_user_id_to_facturas
{
	public function up()
	{
		\DBUtil::add_fields('facturas', array(
			'user_id' => array('constraint' => 11, 'type' => 'int'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('facturas', array(
			'user_id'

		));
	}
}