<?php

namespace Fuel\Tasks;
require_once( APPPATH .'modules/grep/classes/model/grep.php');
require_once( APPPATH .'modules/grep/classes/model/grepcondition.php');
require_once( APPPATH .'modules/grep/classes/model/grepresult.php');
require_once( APPPATH .'modules/grep/classes/helper/grep_util.php');

class Grep_All
{
	public static function run($speech = null)
	{
		$greps = \Grep\Model_Grep::find('all');
		
		foreach( $greps as $grep_id => $grep ) {
		
			$grepconditions = \Grep\Model_Grepcondition::find('all',array(
				'where' => array(
					array( 'grep_id', '=', $grep_id )
				),
			));
			
			foreach( $grepconditions as $id => $grepcondition ) {
				\Grep\Helper_Grep_Util::grep_insert($grep_id, $id);
			}
		}
	}
}
