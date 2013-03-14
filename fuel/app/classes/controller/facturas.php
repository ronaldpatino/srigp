<?php
class Controller_Facturas extends Controller_Seguro
{

	public function action_index()
	{

        $page = Input::get('page')? Input::get('page'):1;

        $auth = Auth::instance();
        $user_id = $auth->get_user_id();

        $query = DB::query('SELECT
                                    ruc,
                                    nombre ,
                                    tipo,
                                    ( SELECT
                                            SUM(valor)
                                       FROM
                                            facturas si
                                       WHERE
                                            si.ruc like so.ruc)
                                    total
                            FROM
                                facturas so
                            WHERE
                                user_id = '. $user_id[1].
                            ' GROUP BY ruc

                            ORDER BY nombre  ASC, ruc ASC')->as_object('Model_Factura')->execute();

        // pagination  config
        $config = array(

            'total_items' => $query->count(),
            'per_page' => 10,
            'uri_segment' => 'page',
            'current_page' => $page,
            'template' => array(
                'wrapper_start' => '<div class="pagination"> ',
                'wrapper_end' => ' </div>',
            ),
        );

        $pagination = Pagination::forge('mypagination', $config);


        $data['facturas'] = DB::query("SELECT
                                            ruc, nombre , tipo,( SELECT
                                                                        SUM(valor)
                                                                   FROM
                                                                        facturas si
                                                                   WHERE
                                                                        si.ruc like so.ruc) total
                                            FROM
                                                facturas so
                                            WHERE
                                                user_id = {$user_id[1]}
                                            GROUP BY
                                                ruc
                                            ORDER BY
                                                nombre  ASC, ruc ASC
                                            LIMIT {$pagination->offset},{$pagination->per_page}
                                            ")->as_object('Model_Factura')->execute();

        $data['pagination'] = $pagination;
        $view = View::forge('facturas/index', $data);
        $view->set_global('gastos', '1');
        $this->template->title = "Gastos";
		$this->template->content = $view;

	}

	public function action_view($ruc = null)
	{
		is_null($ruc) and Response::redirect('Facturas');

        $auth = Auth::instance();
        $user_id = $auth->get_user_id();
        $page = Input::get('page')? Input::get('page'):1;

        $query = Model_Factura::find()->where('ruc', $ruc)->where('user_id', $user_id[1]);

        // pagination  config
        $config = array(

            'total_items' => $query->count(),
            'per_page' => 10,
            'uri_segment' => 'page',
            'current_page' => $page,
            'template' => array(
                'wrapper_start' => '<div class="pagination"> ',
                'wrapper_end' => ' </div>',
            ),
        );

        $pagination = Pagination::forge('mypagination', $config);

        if ( ! $data['facturas'] = Model_Factura::find('all',
                                                            array(
                                                            'where' =>
                                                                    array(array('ruc'=> $ruc), array('user_id'=>$user_id[1])),
                                                            'order_by' => array('fecha' => 'desc', 'tipo'=>'asc'),
                                                            'limit' =>$pagination->per_page,
                                                            'offset' => $pagination->offset
                                                            )
        ))
		{
			Session::set_flash('error', 'Could not find factura #'.$ruc);
			Response::redirect('Facturas');
		}


        $proveedor = Model_Ruc::find('first',array('where'=>array('ruc'=>$ruc)));
        $data['pagination'] = $pagination;
        $data['proveedor'] =  $proveedor->nombre;

        $view = View::forge('facturas/view', $data);
        $view->set_global('gastos', '1');
        $view->set_global('tipos_deducibles', $this->get_categorias());
        $this->template->title = "Gastos";
		$this->template->content = $view;

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Factura::validate('create');
            $auth = Auth::instance();
            $user_id = $auth->get_user_id();

			if ($val->run())
			{
				$factura = Model_Factura::forge(array(
					'ruc' => Input::post('ruc'),
					'nombre' => Str::upper(Input::post('nombre')),
                    'tipo' => Input::post('tipo'),
					'fecha' => Input::post('fecha'),
                    'numero_factura' => Input::post('numero_factura'),
					'valor' => Input::post('valor'),
                    'user_id' => $user_id[1],
                    'comentario' => Input::post('comentario'),
				));

				if ($factura and $factura->save())
				{

                    $ruc = Model_Ruc::query()->where('ruc', Input::post('ruc'))->where('user_id', $user_id[1]);

                    if ($ruc->count() == 0)
                    {
                        $ruc_nuevo = Model_Ruc::forge(array(
                            'ruc' => Input::post('ruc'),
                            'nombre' => Str::upper(Input::post('nombre')),
                            'user_id' => $user_id[1],
                        ));

                        $ruc_nuevo->save();
                    }


                    Session::set_flash('success', 'He guardado una nueva factura de: '.Str::upper(Input::post('nombre')).' por un valor de $ '.Input::post('valor'));

					Response::redirect('facturas/create');
				}

				else
				{
					Session::set_flash('error', 'No pude guardar la factura.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Facturas";
        $view = View::forge('facturas/create');
        $view->set_global('home', '1');
        $view->set_global('tipos_deducibles', $this->get_categorias());
		$this->template->content = $view;


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
			$factura->nombre = Str::upper(Input::post('nombre'));
			$factura->fecha = Input::post('fecha');
            $factura->tipo = Input::post('tipo');
            $factura->numero_factura = Input::post('numero_factura');
			$factura->valor = Input::post('valor');
            $factura->comentario = Input::post('comentario');

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
                $factura->numero_factura = $val->validated('numero_factura');
                $factura->tipo = $val->validated('tipo');
                $factura->comentario = $val->validated('comentario');

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

    private function get_categorias()
    {
        $categorias = Model_Categoria::find('all');
        foreach($categorias as $c)
        {
            $resultado[$c->id] = $c->nombre;
        }

        return isset($resultado)?$resultado:0;

    }

}