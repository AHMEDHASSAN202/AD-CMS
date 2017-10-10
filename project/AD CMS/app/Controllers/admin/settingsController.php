<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 8/3/2017
 * Time: 4:41 AM
 */

namespace app\Controllers\admin;


use System\Controller;

class settingsController extends Controller
{
    public function index()
    {
        $data['title'] = 'settings';

        return $this->app->adminLayout->render('admin/settings' , $data);
    }
}