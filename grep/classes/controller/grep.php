<?php

namespace Grep;
class Controller_Grep extends \Controller_Base 
{
	public function action_index()
	{
		$data['greps'] = Model_Grep::find('all');
		$this->template->title = "Greps";
		$this->template->content = \View::forge('grep/index', $data);

	}

	public function action_view($id = null)
	{
		$data['grep'] = Model_Grep::find($id);
		\Response::redirect('grep/grepcondition');
		
	}

	public function action_create()
	{
		if (\Input::method() == 'POST')
		{
			$val = Model_Grep::validate('create');

			if ($val->run())
			{
				$grep = Model_Grep::forge(array(
					'user_id' => \Input::post('user_id'),
					'path' => \Input::post('path'),
				));

				if ($grep and $grep->save())
				{
					\Session::set_flash('success', e('Added grep #'.$grep->id.'.'));

					\Response::redirect('grep');
				}

				else
				{
					\Session::set_flash('error', e('Could not save grep.'));
				}
			}
			else
			{
				\Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Greps";
		$this->template->content = \View::forge('grep/create');

	}

	public function action_edit($id = null)
	{
		$grep = Model_Grep::find($id);
		$val = Model_Grep::validate('edit');

		if ($val->run())
		{
			$grep->user_id = \Input::post('user_id');
			$grep->path = \Input::post('path');

			if ($grep->save())
			{
				\Session::set_flash('success', e('Updated grep #' . $id));

				\Response::redirect('grep');
			}

			else
			{
				\Session::set_flash('error', e('Could not update grep #' . $id));
			}
		}

		else
		{
			if (\Input::method() == 'POST')
			{
				$grep->user_id = $val->validated('user_id');
				$grep->path = $val->validated('path');

				\Session::set_flash('error', $val->error());
			}

			$this->template->set_global('grep', $grep, false);
		}

		$this->template->title = "Greps";
		$this->template->content = \View::forge('grep/edit');

	}

	public function action_delete($id = null)
	{
		if ($grep = Model_Grep::find($id))
		{
			$grep->delete();

			\Session::set_flash('success', e('Deleted grep #'.$id));
		}

		else
		{
			\Session::set_flash('error', e('Could not delete grep #'.$id));
		}

		\Response::redirect('grep');

	}


}
