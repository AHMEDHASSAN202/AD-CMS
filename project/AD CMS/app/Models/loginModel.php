<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 8/1/2017
 * Time: 4:32 AM
 */

namespace app\Models;


use System\Model;

class loginModel extends Model
{
    /**
     * Table Name
     * @var string
     */
    private $_table = 'users';

    /**
     * Stored User Information
     *
     * @var \stdClass
     */
    private $_user;

    /**
     * Determine If Valid Login
     *
     * @param $email
     * @param $password
     * @return bool
     */
    public function isValidLogin($email , $password)
    {
        $user = $this->app->db->select('*')
                               ->from($this->_table)
                               ->where('email = ?' , $email)
                               ->fetch();

        if (!$user) {
            return false;
        }

        if ($user->users_group_id == 0) {
            return false;
        }

        return password_verify($password , $user->password) ? $this->_user = $user : false;
    }

    /**
     * Get Information User
     *
     * @return \stdClass
     */
    public function getInfoUser()
    {
        return $this->_user;
    }


    /**
     * Check if User is logged
     *
     * @return bool
     */
    public function isLogged()
    {
        if ($this->app->session->has('login')) {

            $code = $this->app->session->get('login');

        }elseif ($this->app->cookie->has('login')) {

            $code = $this->app->cookie->get('login');

        }else {

            return false;
        }

        $user = $this->app->db->select('*')
                              ->from($this->_table)
                              ->where('code = ?' , $code)
                              ->fetch();

        if (!$user) return false;

        $this->_user = $user;

        return true;
    }

}