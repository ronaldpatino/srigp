<?php
class Controller_Facturas extends Controller_Template 
{

	public function action_index()
	{
		$data['facturas'] = Model_Factura::find('all',array('order_by' => array('ruc' => 'asc')));
		$this->template->title = "Facturas";
		$this->template->content = View::forge('facturas/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('Facturas');

		if ( ! $data['factura'] = Model_Factura::find($id))
		{
			Session::set_flash('error', 'Could not find factura #'.$id);
			Response::redirect('Facturas');
		}

		$this->template->title = "Factura";
		$this->template->content = View::forge('facturas/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Factura::validate('create');
			
			if ($val->run())
			{
				$factura = Model_Factura::forge(array(
					'ruc' => Input::post('ruc'),
					'nombre' => Str::upper(Input::post('nombre')),
					'fecha' => Input::post('fecha'),
					'valor' => Input::post('valor'),
				));

				if ($factura and $factura->save())
				{

                    $ruc = Model_Ruc::forge(array(
                        'ruc' => Input::post('ruc'),
                        'nombre' => Str::upper(Input::post('nombre')),
                    ));
                    $ruc = Model_Ruc::query()->where('ruc', Input::post('ruc'));

                    if ($ruc->count() == 0)
                    {
                        $ruc_nuevo = Model_Ruc::forge(array(
                            'ruc' => Input::post('ruc'),
                            'nombre' => Input::post('nombre'),
                        ));

                        $ruc_nuevo->save();
                    }


                    Session::set_flash('success', 'Added factura #'.$factura->id.'.');

					Response::redirect('facturas');
				}

				else
				{
					Session::set_flash('error', 'Could not save factura.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Facturas";
		$this->template->content = View::forge('facturas/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('Facturas');

		if ( ! $factura = Model_Factura::find($id))
		{
			Session::set_flash('error', 'Could not find factura #'.$id);
			Response::redirect('Facturas');
		}

		$val = Model_Factura::validate('edit');

		if ($val->run())
		{
			$factura->ruc = Input::post('ruc');
			$factura->nombre = Input::post('nombre');
			$factura->fecha = Input::post('fecha');
			$factura->valor = Input::post('valor');

			if ($factura->save())
			{
				Session::set_flash('success', 'Updated factura #' . $id);

				Response::redirect('facturas');
			}

			else
			{
				Session::set_flash('error', 'Could not update factura #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$factura->ruc = $val->validated('ruc');
				$factura->nombre = $val->validated('nombre');
				$factura->fecha = $val->validated('fecha');
				$factura->valor = $val->validated('valor');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('factura', $factura, false);
		}

		$this->template->title = "Facturas";
		$this->template->content = View::forge('facturas/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('Facturas');

		if ($factura = Model_Factura::find($id))
		{
			$factura->delete();

			Session::set_flash('success', 'Deleted factura #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete factura #'.$id);
		}

		Response::redirect('facturas');

	}


}