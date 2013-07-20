<?php

namespace Grep;
class Helper_Grep_Util
{
  public static function grep_insert($grep_id, $id = null)
	{
		$grep = Model_Grep::find($grep_id);
		if ($grepcondition = Model_Grepcondition::find($id))
		{
			$grep_str  = "grep -Hinr ";
			$grep_str .= "'".$grepcondition->condition."' ";
			$grep_str .= $grep->path;
			$grep_str .= " | grep -v '.svn' ";
			$res = shell_exec( $grep_str );

			// 前回の結果を削除する
			$grepresults = \Grep\Model_Grepresult::find('all', array(
				'where' => array(
					array( 'grepcondition_id', '=', $id )
				)
			));
			foreach ( $grepresults as $grepresult )
			{
				$grepresult->delete();
			}

			$res1 = explode( "\n", $res );
			foreach ( $res1 AS $key => $val )
			{
				$res2 = explode( ":", $val, 3 );
				if ( count($res2) > 2 )
				{
					// grep結果からファイルパスを取得する
					// grep結果から行番号を取得する
					// grep結果文字列を取得する
					$data['res'][$key]['path'] = $res2[0];
					$data['res'][$key]['line'] = $res2[1];
					$data['res'][$key]['result'] = $res2[2];

					// 結果をDBに格納する
					$grepresult = \Grep\Model_Grepresult::forge(array(
						'grepcondition_id' => $id,
						'file_name' => $data['res'][$key]['path'],
						'line_number' => $data['res'][$key]['line'],
						'result' => $data['res'][$key]['result'],
					));
					$grepresult->save();
				}
			}
		}

		else
		{
		  return false;

		}

		return true;
	}
}
