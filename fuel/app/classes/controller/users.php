<?php

class Controller_Users extends Controller_Template
{
    public $template = 'template_login';
	public function action_login()
	{
        if(Auth::check())
        {
            Response::redirect('facturas/create'); // user already logged in
        }

        $val = Model_User::validate('login');

        if ($val->run())
        {
            $auth = Auth::instance();

            if($auth->login($val->validated('username'), $val->validated('password')))
            {
                Response::redirect('facturas/create');
            }
            else
            {
                Session::set_flash('error', 'Usuario o password incorrectos.' . ' Intente nuevamente.');

            }
        }
        else
        {
            Session::set_flash('error', $val->error());
        }

		$this->template->title = 'Users &raquo; Login';
		$this->template->content = View::forge('users/login');
	}

	public function action_logout()
	{
        Auth::instance()->logout();
        Session::destroy();
        Response::redirect('/users/login');
	}

}
