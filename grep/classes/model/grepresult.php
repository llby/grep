<?php

namespace Grep;
class Model_Grepresult extends \Orm\Model
{
	protected static $_belongs_to = array('grepcondition');

	protected static $_properties = array(
		'id',
		'grepcondition_id',
		'file_name',
		'line_number',
		'result',
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
}
