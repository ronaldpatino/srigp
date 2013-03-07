<?php
class Controller_Rucs extends Controller_Seguro
{

	public function action_index()
	{
		$data['rucs'] = Model_Ruc::find('all');
		$this->template->title = "Rucs";
		$this->template->content = View::forge('rucs/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('Rucs');

		if ( ! $data['ruc'] = Model_Ruc::find($id))
		{
			Session::set_flash('error', 'Could not find ruc #'.$id);
			Response::redirect('Rucs');
		}

		$this->template->title = "Ruc";
		$this->template->content = View::forge('rucs/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Ruc::validate('create');
			
			if ($val->run())
			{
				$ruc = Model_Ruc::forge(array(
					'ruc' => Input::post('ruc'),
					'nombre' => Input::post('nombre'),
				));

				if ($ruc and $ruc->save())
				{
					Session::set_flash('success', 'Added ruc #'.$ruc->id.'.');

					Response::redirect('rucs');
				}

				else
				{
					Session::set_flash('error', 'Could not save ruc.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Rucs";
		$this->template->content = View::forge('rucs/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('Rucs');

		if ( ! $ruc = Model_Ruc::find($id))
		{
			Session::set_flash('error', 'Could not find ruc #'.$id);
			Response::redirect('Rucs');
		}

		$val = Model_Ruc::validate('edit');

		if ($val->run())
		{
			$ruc->ruc = Input::post('ruc');
			$ruc->nombre = Input::post('nombre');

			if ($ruc->save())
			{
				Session::set_flash('success', 'Updated ruc #' . $id);

				Response::redirect('rucs');
			}

			else
			{
				Session::set_flash('error', 'Could not update ruc #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$ruc->ruc = $val->validated('ruc');
				$ruc->nombre = $val->validated('nombre');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('ruc', $ruc, false);
		}

		$this->template->title = "Rucs";
		$this->template->content = View::forge('rucs/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('Rucs');

		if ($ruc = Model_Ruc::find($id))
		{
			$ruc->delete();

			Session::set_flash('success', 'Deleted ruc #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete ruc #'.$id);
		}

		Response::redirect('rucs');

	}


}