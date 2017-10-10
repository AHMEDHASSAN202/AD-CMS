<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 9/25/2017
 * Time: 10:37 PM
 */

namespace app\Controllers\admin;


use System\Controller;
use System\View\view;

class adsController extends Controller
{
    /**
     * Model Name
     *
     * @var string
     */
    private $_model = 'ads';

    /**
     * Main View
     *
     * @return view
     */
    public function index()
    {
        $data['header'] = 'Ads';
        $data['headerCard'] = 'Manage Your Ads';
        $data['smallHeader'] = 'Add, Edit and Delete Ad';

        $data['navLinks'] = [
            'ADS'       => $this->app->url->url("admin/ads/index"),
            'ADD ADS'   => $this->app->url->url('admin/ads/add')
        ];


        return $this->app->adminLayout->render('admin/ads/main-view', $data);
    }

    /**
     * Default View
     *
     * @return view
     */
    public function allAds()
    {
        echo 'here table all ads';
    }
}