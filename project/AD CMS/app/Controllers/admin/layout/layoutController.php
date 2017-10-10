<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 7/27/2017
 * Time: 12:47 AM
 */

namespace app\Controllers\admin\layout;

use System\Controller;

class layoutController extends Controller
{
    public function render($view, $data = [])
    {
        $layout['header']  = $this->app->load->controller('admin/layout/header')->index();
        $layout['leftSidebar'] = $this->app->load->controller('admin/layout/leftSidebar')->index();
        $layout['rightSidebar'] = $this->app->load->controller('admin/layout/rightSidebar')->index();
        $layout['content'] = $this->app->view->render($view , $data);
        $layout['footer'] = $this->app->load->controller('admin/layout/footer')->index();

        return $this->app->view->render('admin/layout/layout' , $layout);
    }


    public function mainLayout($view, $data = [])
    {
        $layout['header']  = $this->app->load->controller('admin/layout/header')->index();
        $layout['content'] = $this->app->view->render($view , $data);
        $layout['footer'] = $this->app->load->controller('admin/layout/footer')->index();

        return $this->app->view->render('admin/layout/layout' , $layout);
    }

}