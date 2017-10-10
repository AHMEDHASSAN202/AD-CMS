<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 9/21/2017
 * Time: 9:03 PM
 */

namespace app\Controllers\errors;

use System\Controller;
use System\View;

class notFoundController extends Controller
{
    /**
     * Error Page
     *
     * @return  View\view
     */
    public function index()
    {

        $data['homepage'] = url('home');
        $data['button'] = "GO TO HOMEPAGE";
        $data['messageError'] = 'This page doesn\'t exist';


        return $this->app->view->render('errors/notFoundPage', $data);
    }

    /**
     * Section View For Error
     *
     * @return mixed
     */
    public function sectionView()
    {
        $data['homepage'] = url('');
        $data['button'] = "GO TO HOMEPAGE";
        $data['messageError'] = 'This Section doesn\'t exist';

        return $this->app->view->render('errors/notFoundSection', $data);
    }

}