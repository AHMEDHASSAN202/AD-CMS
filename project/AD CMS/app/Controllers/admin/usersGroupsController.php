<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 9/25/2017
 * Time: 9:46 PM
 */

namespace app\Controllers\admin;

use System\Controller;
use System\View\view;

class usersGroupsController extends Controller
{
    /**
     * Main View
     *
     * @return view
     */
    public function index()
    {
        $data['header'] = 'Users Groups';
        $data['headerCard'] = 'Manage Users Groups';
        $data['smallHeader'] = 'Add, Edit and Delete Groups';
        $data['navLinks'] = [
            'GROUPS'       => $this->app->url->url('admin/users-groups/index'),
            'ADD GROUP'    => $this->app->url->url('admin/users-groups/add'),
        ];


        return $this->app->adminLayout->render('admin/users-groups/main-view', $data);
    }

    /**
     * Default Section View
     * All Users Groups
     *
     * @return view
     */
    public function allGroups()
    {
        echo 'here table all users groups';
    }
}