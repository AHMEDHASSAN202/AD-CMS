<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 7/27/2017
 * Time: 1:01 AM
 */

namespace app\Controllers\admin\layout;


use System\Controller;

class leftSidebarController extends Controller
{
    public function index()
    {
        $user = $this->app->load->model('login')->getInfoUser();

        $data['user'] = $user;
        $data['logoutLink'] = $this->app->url->url('admin/logout');
        $data['profileLink'] = $this->app->url->url('admin/profile');
        $data['settingsLink'] = $this->app->url->url('admin/settings');

        $data['linksMenu'] = [
            [
                'name'  => 'Dashboard',
                'url'   =>  $this->app->url->url('admin/dashboard'),
                'icon'  => 'dashboard'
            ],
            [
                'name'  => 'Users',
                'url'   =>  $this->app->url->url('admin/users'),
                'icon'  => 'people'
            ],
            [
                'name'  => 'Categories',
                'url'   =>  $this->app->url->url('admin/categories'),
                'icon'  => 'extension'
            ],
            [
                'name'  => 'Posts',
                'url'   =>  $this->app->url->url('admin/posts'),
                'icon'  => 'create'
            ],
            [
                'name'  => 'Users Groups',
                'url'   =>  $this->app->url->url('admin/users-groups'),
                'icon'  => 'group_work'
            ],
            [
                'name'  => 'Ads',
                'url'   =>  $this->app->url->url('admin/ads'),
                'icon'  => 'font_download'
            ],
            [
                'name'  => 'Settings',
                'url'   =>  $this->app->url->url('admin/settings'),
                'icon'  => 'settings'
            ],
        ];

        return $this->app->view->render('admin/layout/left sidebar' , $data);
    }
}