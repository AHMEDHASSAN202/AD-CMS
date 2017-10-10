<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 8/1/2017
 * Time: 4:20 AM
 */

namespace app\Controllers\admin;

use System\Controller;

class accessController extends Controller
{

    /**
     * ignore pages
     *
     * @var array
     */
    private $_ignorePages = ['admin/login' , 'admin/login/submit'];


    /**
     * Check User Permission to access admin page
     *
     * @return void
     */
    public function index()
    {
        if (!$this->app->load->model('login')->isLogged()) {

            if (!in_array($this->app->route->getCurrentUrlRoute() , $this->_ignorePages)) {

                return $this->app->url->redirect('/admin/login');

            }
        }

    }

}