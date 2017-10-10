<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 8/7/2017
 * Time: 4:27 AM
 */

namespace app\Models;


use System\Model;

class usersGroupsModel extends Model
{
    /**
     * Table Name
     *
     * @var string
     */
    private $_table = 'users_group';


    public function getGroups()
    {
        return $this->getAll($this->_table);
    }
}