<?php

class Controller_Seguro extends Controller_Template {

    public function before()
    {
        parent::before();

        if(\Auth::check())
        {
            $access = Auth::has_access(\Request::active()->controller . "." . \Request::active()->action);
            if ($access)
            {
                $this->user_id = Auth::instance()->get_user_id();
                $this->user_id = $this->user_id[1];
                View::set_global('usuario', Auth::instance()->get_screen_name());
            }
            else
            {

                Response::redirect('welcome/404');
            }
        }
        else
        {
            Response::redirect('users/login');
        }

    }

}
