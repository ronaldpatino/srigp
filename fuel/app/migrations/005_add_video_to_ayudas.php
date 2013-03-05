<?php

namespace Fuel\Migrations;

class Add_video_to_ayudas
{
	public function up()
	{
		\DBUtil::add_fields('ayudas', array(
			'video' => array('type' => 'text'),

		));
	}

	public function down()
	{
		\DBUtil::drop_fields('ayudas', array(
			'video'

		));
	}
}