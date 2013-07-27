<?php

namespace Grep;
require_once( APPPATH .'modules/grep/classes/helper/grep_util.php');
class Controller_Grepcondition extends \Controller_Base 
{
	public function action_index($grep_id = null)
	{
		$data['grep'] = Model_Grep::find($grep_id);
		$data['grepconditions'] = \Grep\Model_Grepcondition::find('all',array(
			'where' => array(
				array( 'grep_id', '=', $grep_id )
			),
		));

		$this->template->title = "Grepconditions";
		$this->template->content = \View::forge('grepcondition/index', $data);
	}

	public function action_view($grep_id,$id)
	{
		$data['grep'] = Model_Grep::find($grep_id);
		$data['grepcondition'] = \Grep\Model_Grepcondition::find($id);
		$data['grepresults'] = \Grep\Model_Grepresult::find('all',array(
			'where' => array(
				array( 'grepcondition_id', '=', $id )
			),
		));

		// ファイルを開いて中身を取得する
		$safe_data['results'] = array();
		foreach( $data['grepresults'] as $key => $val ) {
			
			$safe_data['results'][$key] = "<pre>";
			$line =$val->line_number;
			$fp = fopen($val->file_name, 'r');
			$number = 1;
			while (!feof($fp)) {

				$line = fgets($fp);
				if ( $number >= ($val->line_number - 3) and $number <= ($val->line_number + 3)) {
					$safe_data['results'][$key] .= $line;
				}
				$number++;
			}
			$safe_data['results'][$key] .= "</pre>";
			fclose($fp);
		}

		$this->template->title = "Grepcondition";
		$this->template->content = \View::forge('grepcondition/view', $data);
		$this->template->content->set_safe('results', $safe_data['results']);
	}

	public function action_create($grep_id = null)
	{
		if (\Input::method() == 'POST')
		{
			$val = \Grep\Model_Grepcondition::validate('create');

			if ($val->run())
			{
				$grepcondition = \Grep\Model_Grepcondition::forge(array(
					'grep_id' => $grep_id,
					'condition' => \Input::post('condition'),
					'kind' => \Input::post('kind'),
					'comment' => \Input::post('comment'),
				));

				if ($grepcondition and $grepcondition->save())
				{
					\Session::set_flash('success', e('Added grepcondition #'.$grepcondition->id.'.'));

					\Response::redirect('grep/grepcondition/index/'.$grep_id);
				}

				else
				{
					\Session::set_flash('error', e('Could not save grepcondition.'));
				}
			}
			else
			{
				\Session::set_flash('error', $val->error());
			}
		}

		$grep = Model_Grep::find($grep_id);
		$this->template->set_global('grep', $grep, false);
		$this->template->title = "Grepconditions";
		$this->template->content = \View::forge('grepcondition/create');

	}

	public function action_edit($grep_id,$id)
	{
		$grepcondition = \Grep\Model_Grepcondition::find($id);
		$val = \Grep\Model_Grepcondition::validate('edit');

		if ($val->run())
		{
			$grepcondition->condition = \Input::post('condition');
			$grepcondition->kind = \Input::post('kind');
			$grepcondition->comment = \Input::post('comment');

			if ($grepcondition->save())
			{
			        $data = array();
			  	\Session::set_flash('success', e('Updated grepcondition #' . $id));
				\Response::redirect('grep/grepcondition/index/'.$grep_id);
			}

			else
			{
				\Session::set_flash('error', e('Could not update grepcondition #' . $id));
			}
		}

		else
		{
			if (\Input::method() == 'POST')
			{
				$grepcondition->condition = $val->validated('condition');
				$grepcondition->kind = $val->validated('kind');
				$grepcondition->comment = $val->validated('comment');

				\Session::set_flash('error', $val->error());
			}

			$this->template->set_global('grepcondition', $grepcondition, false);
		}

		$grep = Model_Grep::find($grep_id);
		$this->template->set_global('grep', $grep, false);
		$this->template->title = "Grepconditions";
		$this->template->content = \View::forge('grepcondition/edit');

	}

	public function action_delete($grep_id,$id)
	{
		if ($grepcondition = \Grep\Model_Grepcondition::find($id))
		{
			// 前回の結果を削除する
			$grepresult = \Grep\Model_Grepresult::find( 'all', array(
				'where' => array(
					 array( 'grepcondition_id', $id ),
				)
			));
			foreach( $grepresult as $key => $val )
			{
				$val->delete();
			}
			$grepcondition->delete();

			\Session::set_flash('success', e('Deleted grepcondition #'.$id));
		}

		else
		{
			\Session::set_flash('error', e('Could not delete grepcondition #'.$id));
		}

		\Response::redirect('grep/grepcondition/index/'.$grep_id);
	}

	public function action_grep($grep_id,$id)
	{
		$result = \Grep\Helper_Grep_Util::grep_insert($grep_id, $id);
		if ( $result )
		{

		}

		else
		{
			\Session::set_flash('error', e('Could not grep grepcondition #'.$id));

		}

		\Response::redirect('grep/grepcondition/index/'.$grep_id);
	}

}
