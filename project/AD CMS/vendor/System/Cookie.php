<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 7/8/2017
 * Time: 5:46 AM
 */

namespace System;


class Cookie
{
    /**
     * App Class
     *
     * @var object
     */
    private $app;

    /**
     * cookie Constructor
     *
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * Set Cookie
     *
     * @param $key
     * @param $value
     * @param $time [time with day]
     * @return mixed
     */
    public function set($key , $value , $time = NULL)  {

        if (is_null($time)) {

            $time = Config::get('cookie/default_expire'); //30

        }

        $expire = $time == -1 ? -1 : time() + (86400 * $time);

        if (setcookie($key , $value , $expire , '/' , '' , false , true)) {
            $_COOKIE[$key] = $value;
        }
    }

    /**
     * Get Cookie
     *
     * @param $key
     * @return mixed
     */
    public function get($key)  {

        return $_COOKIE[$key];

    }

    /**
     * Determine if Key exists in Cookie
     *
     * @param $key
     * @return bool
     */
    public function has($key)  {

        return isset($_COOKIE[$key]);

    }

    /**
     * Remove Cookie
     *
     * @param $key
     * @return mixed
     */
    public function remove($key)  {

        $this->set($key , false , -1);

        unset($_COOKIE[$key]);
    }

    /**
     * Destroy Cookie
     *
     * @return void
     */
    public function destroy()  {

        foreach ($_COOKIE as $key => $value) {

            $this->set($key , null , -1);

        }

        unset($_COOKIE);

    }

    /**
     * Get All Cookie
     *
     * @return array
     */
    public function all()
    {
        return $_COOKIE;
    }

}