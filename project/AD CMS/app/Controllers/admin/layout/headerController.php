<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 7/27/2017
 * Time: 1:01 AM
 */

namespace app\Controllers\admin\layout;


use System\Controller;

class headerController extends Controller
{
    public function index()
    {
        $data['title'] = $this->app->html->getTitle();
        $data['dashboardLink'] = $this->app->url->url('admin/dashboard');
        $data['logoutLink'] = $this->app->url->url('admin/logout');

        return $this->app->view->render('admin/layout/header' , $data);
    }
}