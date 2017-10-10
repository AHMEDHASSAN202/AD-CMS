<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 8/16/2017
 * Time: 3:09 AM
 */

namespace app\Controllers\admin\layout;

use System\Controller;

class footerController extends Controller
{
    public function index()
    {
        $data = [];

        return $this->app->view->render('admin/layout/footer', $data);
    }
}