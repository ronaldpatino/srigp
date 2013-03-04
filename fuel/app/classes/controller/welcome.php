<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.5
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Welcome extends Controller_Template
{

	/**
	 * The basic welcome message
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{

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
                            GROUP BY ruc

                            ORDER BY nombre  ASC, ruc ASC')->as_object('Model_Factura')->execute();

        $datos = array();
        $label = array();
        foreach($query as $r)
        {
            array_push($datos, $r->total);
            array_push($label, $r->nombre);
        }
        $data['datos'] = '[' . implode(',',$datos) . ']';
        $data['label'] = "['%%.%% - " . implode("','%%.%% - ",$label) . "']";


        /*****************************************************************************/


        $query = DB::query('SELECT
                                    ( SELECT
                                            SUM(valor)
                                       FROM
                                            facturas si
                                       WHERE
                                            si.tipo = 1)
                                    tipo1,
                                    ( SELECT
                                            SUM(valor)
                                       FROM
                                            facturas si
                                       WHERE
                                            si.tipo = 2)
                                    tipo2,
                                    ( SELECT
                                            SUM(valor)
                                       FROM
                                            facturas si
                                       WHERE
                                            si.tipo = 3)
                                    tipo3,
                                    ( SELECT
                                            SUM(valor)
                                       FROM
                                            facturas si
                                       WHERE
                                            si.tipo = 4)
                                    tipo4,
                                    ( SELECT
                                            SUM(valor)
                                       FROM
                                            facturas si
                                       WHERE
                                            si.tipo = 5)
                                    tipo5
                            FROM
                                facturas so
                            GROUP BY tipo')->as_object('Model_Factura')->execute();

        $datos = array();



            array_push($datos, ($query[0]->tipo1 >0)?$query[0]->tipo1:0);
            array_push($datos, ($query[0]->tipo2 >0)?$query[0]->tipo2:0);
            array_push($datos, ($query[0]->tipo3 >0)?$query[0]->tipo3:0);
            array_push($datos, ($query[0]->tipo4 >0)?$query[0]->tipo4:0);
            array_push($datos, ($query[0]->tipo5 >0)?$query[0]->tipo51:0);



        $data['datos_categoria'] = '[' . implode(',',$datos) . ']';
        $data['label_categoria'] = "['%%.%% - uno','%%.%% - dos','%%.%% - tres','%%.%% - cuatro','%%.%% - cinco']";

        $view = View::forge('welcome/index', $data);
        $this->template->title = "Facturas";
        $this->template->content = $view;
	}

	/**
	 * A typical "Hello, Bob!" type example.  This uses a ViewModel to
	 * show how to use them.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_hello()
	{
		return Response::forge(ViewModel::forge('welcome/hello'));
	}

	/**
	 * The 404 action for the application.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_404()
	{
		return Response::forge(ViewModel::forge('welcome/404'), 404);
	}
}
