<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 7/27/2017
 * Time: 12:34 AM
 */

namespace app\Controllers\admin;

use System\Controller;


class dashboardController extends Controller
{
    public function index()
    {
        $this->app->html->setTitle('Dashboard');

        $data['titlePage'] = 'DASHBOARD';

        return $this->app->adminLayout->render('admin/dashboard/dashboard' , $data);
    }
}