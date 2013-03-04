<?php
class Controller_Categorias extends Controller_Template 
{

	public function action_index()
	{
		$data['categorias'] = Model_Categoria::find('all');
		$this->template->title = "Categorias";
		$this->template->content = View::forge('categorias/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('Categorias');

		if ( ! $data['categoria'] = Model_Categoria::find($id))
		{
			Session::set_flash('error', 'Could not find categoria #'.$id);
			Response::redirect('Categorias');
		}

		$this->template->title = "Categoria";
		$this->template->content = View::forge('categorias/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Categoria::validate('create');
			
			if ($val->run())
			{
				$categoria = Model_Categoria::forge(array(
					'nombre' => Input::post('nombre'),
				));

				if ($categoria and $categoria->save())
				{
					Session::set_flash('success', 'Added categoria #'.$categoria->id.'.');

					Response::redirect('categorias');
				}

				else
				{
					Session::set_flash('error', 'Could not save categoria.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Categorias";
		$this->template->content = View::forge('categorias/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('Categorias');

		if ( ! $categoria = Model_Categoria::find($id))
		{
			Session::set_flash('error', 'Could not find categoria #'.$id);
			Response::redirect('Categorias');
		}

		$val = Model_Categoria::validate('edit');

		if ($val->run())
		{
			$categoria->nombre = Input::post('nombre');

			if ($categoria->save())
			{
				Session::set_flash('success', 'Updated categoria #' . $id);

				Response::redirect('categorias');
			}

			else
			{
				Session::set_flash('error', 'Could not update categoria #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$categoria->nombre = $val->validated('nombre');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('categoria', $categoria, false);
		}

		$this->template->title = "Categorias";
		$this->template->content = View::forge('categorias/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('Categorias');

		if ($categoria = Model_Categoria::find($id))
		{
			$categoria->delete();

			Session::set_flash('success', 'Deleted categoria #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete categoria #'.$id);
		}

		Response::redirect('categorias');

	}


}