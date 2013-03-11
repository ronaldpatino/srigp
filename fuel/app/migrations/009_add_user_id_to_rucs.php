<?php

namespace Fuel\Migrations;

class Add_user_id_to_rucs
{
	public function up()
	{
		\DBUtil::add_fields('rucs', array(
			'user_id' => array('constraint' => 11, 'type' => 'int'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('rucs', array(
			'user_id'

		));
	}
}