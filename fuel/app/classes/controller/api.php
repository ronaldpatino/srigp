<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ba01000660
 * Date: 28/02/13
 * Time: 02:35 PM
 * To change this template use File | Settings | File Templates.
 */
class Controller_Api extends \Fuel\Core\Controller_Rest
{
    public function post_rucs()
    {
        $ruc = Input::post('ruc') . "%";
        $result = DB::select()->from('rucs')->where('ruc', 'like', $ruc)->order_by('ruc')->limit(Input::post('limit'))->execute();
        return $this->response($result);
    }


    public function post_create_categoria()
    {
        $val = Model_Categoria::validate('create');

        $auth = Auth::instance();
        $user_id = $auth->get_user_id();

        if ($val->run() && $user_id)
        {
            $categoria = Model_Categoria::forge(array(
                'nombre' => Str::upper(Input::post('nombre')),
                'user_id' => $user_id[1],
            ));

            if ($categoria and $categoria->save())
            {
                return $this->response(array('Agregada nueva categoria'), $http_code = 200);
            }

            else
            {

                return $this->response(array('Categoria no pudo ser agregada'), $http_code = 404);
            }
        }
        else
        {
            return $this->response($val->error('nombre')->get_message(), $http_code = 404);
        }

    }

    public function get_categorias()
    {
        $auth = Auth::instance();
        $user_id = $auth->get_user_id();

        $categorias = Model_Categoria::find('all', array(
                                                        'where' => array(
                                                            array('user_id', $user_id[1]),

                                                            'or' => array(
                                                                            array('user_id', 0),
                                                            ),
                                                        ),
                                            ));

        foreach($categorias as $c)
        {
            $result[$c->id] = $c->nombre;
        }

        if (isset($result))
        {
            return $this->response($result);
        }

        return $this->response(array());
    }

}