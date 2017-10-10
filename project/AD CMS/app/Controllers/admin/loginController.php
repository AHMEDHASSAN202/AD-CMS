<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 7/26/2017
 * Time: 5:06 PM
 */

namespace app\Controllers\admin;
use System\Controller;


class loginController extends Controller
{
    /**
     * Container Errors
     *
     * @var array
     */
    private $_error = [];


    public function index()
    {
        //if the admin is logged we will redirect to dashboard
        if ($this->app->load->model('login')->isLogged()) {
            return $this->app->url->redirect('/admin/dashboard');
        }

        $data['action'] = url('admin/login/submit');

        return $this->app->view->render('admin/login/login' , $data);
    }

    /**
     * Submit Function
     *
     * @return string
     */
    public function submit()
    {
        $json = [];

        $email = cleanInput($this->app->request->post('email')) ?: null;
        $password = cleanInput($this->app->request->post('password')) ?: null;
        $rememberMe = cleanInput($this->app->request->post('rememberMe')) ?: null;


        if (!$this->validData($email , $password)) {
            $json['errors'] = $this->_error[0];  //get the first errors
            return $this->json($json);
        }

        $loginModel = $this->app->load->model('login');

        if (!$loginModel->isValidLogin($email , $password)) {
            $json['errors'] = 'invalid login. please try again';
            return $this->json($json);
        }


        if ($rememberMe) {

            $this->app->cookie->set('login' , $loginModel->getInfoUser()->code , 100);

        }else {

            $this->app->session->set('login' , $loginModel->getInfoUser()->code);
        }

        $json['success'] = 'success login';
        $json['redirectTo'] = $this->app->url->url('admin/dashboard');
        return $this->json($json);
    }


    /**
     * Determine if Valid email and password
     *
     * @param $email
     * @param $password
     * @return bool
     */
    private function validData($email , $password)
    {
        if (is_null($email) && is_null($password)) {
            $this->_error[] = 'email and password is required';
        }

        if (is_null($email)) $this->_error[] = 'email is required';
        if (is_null($password)) $this->_error[] = 'password is required';

        if (!filter_var($email , FILTER_VALIDATE_EMAIL) && !is_null($email)) $this->_error[] = 'invalid email';

        return empty($this->_error);
    }
}