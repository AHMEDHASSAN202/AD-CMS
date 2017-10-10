<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 7/10/2017
 * Time: 2:27 AM
 */

namespace System;

abstract class Model
{
    /**
     * Application Class
     *
     * @var object
     */
    protected $app;

    /**
     * Model Constructor
     *
     * @param \System\App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    /**
     * Get All Data From Table
     *
     * @param $table
     * @return mixed
     */
    public function getAll($table)
    {
        return $this->app->db->select('*')->from($table)->fetchAll();
    }

    /**
     * Get One Result With ID
     *
     * @param $table
     * @param $id
     */
    public function get($table , $id)
    {
        return $this->app->db->select('*')->from($table)->where('id = ?' , $id)->fetch();
    }

    /**
     * Put Key in Settings
     *
     * @param $table
     * @param $key
     * @param $value
     * @return void
     */
    public function putKeyInSettings($key , $value , $table = 'settings' )
    {
        return $this->app->db->table($table)->data(['key' => $key, 'value' => $value])->insert();
    }

    /**
     * Check if id Exists
     *
     * @param $id;
     * @param $table;
     * @return bool
     */
    public function exists($table, $id)
    {
        return $this->app->db->select('COUNT(*) AS count')->from($table)->where('id = ?', $id)->fetch()->count;
    }


    /**
     * Magic Method get
     *
     * @param $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->app->db;
    }


}