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

}
