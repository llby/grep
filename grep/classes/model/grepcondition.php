<?php

namespace Grep;
class Model_Grepcondition extends \Orm\Model
{
	protected static $_belongs_to = array('grep');
	protected static $_has_many = array('grepresult');

	protected static $_properties = array(
		'id',
		'grep_id',
		'condition',
		'kind',
		'comment',
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
		$val = \Validation::forge($factory);
		$val->add_field('condition', 'Condition', 'required|max_length[255]');
		$val->add_field('kind', 'Kind', 'required|valid_string[numeric]');
		$val->add_field('comment', 'Comment', 'required|max_length[255]');

		return $val;
	}

}
