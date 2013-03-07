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
class Controller_Reportes extends Controller_Template
{

	/**
	 * The basic reportes message
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
        $tipos_deducibles = $this->get_categorias();

        $tda = array();
        $group = array();
        foreach($tipos_deducibles as $i => $td)
        {

            $cadena = "(SELECT SUM(valor) FROM facturas si WHERE si.tipo = {$i}) tipo{$i}";
            array_push($tda, $cadena);
            array_push($group, "tipo{$i}");

        }

        $subsql = implode(',',$tda);
        $group = implode(',',$group);

        $query = DB::query('SELECT ' .
                                    $subsql .
                            ' FROM
                                facturas so
                            GROUP BY '. $group)->execute();

        $datos = array();
        $label_categoria = array();

        foreach($tipos_deducibles as $i => $td)
        {
            $indice = 'tipo' . $i;
            if ($query[0][$indice] >0)
            {
                array_push($datos, $query[0][$indice]);
                array_push($label_categoria, $td);
            }


        }

        $data['datos_categoria'] = '[' . implode(',',$datos) . ']';
        $data['label_categoria'] = $this->utf8_urldecode(  "['%%.%% - " . implode("','%%.%% - ",$label_categoria) . "']");


        $view = View::forge('reportes/index', $data);
        $view->set_global('reportes', '1');
        $this->template->title = "Reportes";
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
		return Response::forge(ViewModel::forge('reportes/hello'));
	}

	/**
	 * The 404 action for the application.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_404()
	{
		return Response::forge(ViewModel::forge('reportes/404'), 404);
	}

    private function get_categorias()
    {
        $categorias = Model_Categoria::find('all');
        foreach($categorias as $c)
        {
            $resultado[$c->id] = $c->nombre;
        }
        return isset($resultado)?$resultado:array();
    }

    private function utf8_urldecode($str) {
        $str = preg_replace("/%u([0-9a-f]{3,4})/i","&#x\\1;",urldecode($str));
        return html_entity_decode($str,null,'UTF-8');;
    }
}

