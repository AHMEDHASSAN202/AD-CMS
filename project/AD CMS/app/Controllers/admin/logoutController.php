<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 8/2/2017
 * Time: 4:37 AM
 */

namespace app\Controllers\admin;


use System\Controller;

class logoutController extends Controller
{
    /**
     * Remove login Session And  login Cookie
     *
     * @return mixed
     */
    public function index()
    {
        $this->app->session->remove('login');
        $this->app->cookie->remove('login');

        return $this->app->url->redirect('/admin/login');
    }
}