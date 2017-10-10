<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 8/1/2017
 * Time: 3:56 PM
 */

namespace app\Models;


use System\Model;
use System\SSP;
use System\UploadedFile;

class usersModel extends Model
{
    /**
     * Table Name
     *
     * @var string
     */
    private $_table = 'users';

    /**
     * Users Groups Table
     *
     * @var string
     */
    private $_users_group = 'users_group';

    /**
     * Create New User [Register User]
     *
     * @return void
     */
    public function registerUser()
    {

        $this->app->db->table($this->_table)->data([
            'first_name'    => cleanInput($this->app->request->post('first_name')),
            'last_name'     => cleanInput($this->app->request->post('last_name')),
            'email'         => cleanInput($this->app->request->post('email')),
            'password'      => password_hash(cleanInput($this->app->request->post('password')) , PASSWORD_DEFAULT),
            'birthday'      => cleanInput(strtotime($this->app->request->post('birthday'))),
            'users_group_id'=> cleanInput($this->app->request->post('user_group')),
            'gender'        => cleanInput($this->app->request->post('gender')),
            'status'        => cleanInput($this->app->request->post('status')),
            'created'       => time(),
            'image'         => $this->uploadImage(),
            'code'          => generateCode(),
            'ip'            => $this->app->request->getIP(),
            'confirm_id'    => uniqueCode(),
        ])->insert();
    }

    /**
     * Get Image
     *
     * @return mixed
     */
    public function uploadImage()
    {
        $image = $this->app->request->file('image');

        if ($image->uploaded()) {

            $path = uploadedImagesDir('users/');

            $image->moveTo($path);

            return linkUploads('images/users/'.$image->nameImageAfterMovingIt());

        }else {

            $gender = $this->app->request->post('gender') ? 'male' : 'female';

            return defaultUserImage($gender);
        }
    }

    /**
     * Get All Users
     *
     * @return mixed
     */
    public function getAllUsers()
    {

        $users = $this->db->select('*, users.id AS `idUser`')->from($this->_table)
                          ->join('INNER JOIN users_group')
                          ->on('users.users_group_id = users_group.id')
                          ->orderBy('users.id' , 'ASC')
                          ->where('users.verified = ?' , 1)
                          ->fetchAll();

        return $users;
    }

    /**
     * Get All Admins
     *
     * @return \stdClass
     */
    public function getAdmins()
    {
        $admins = $this->app->db->select('* , users.id AS `idUser`')->from($this->_table)
                                ->join('INNER JOIN users_group')
                                ->on('users.users_group_id = users_group.id')
                                ->where('users.users_group_id >= ? AND users.verified = ?', 1 , 1)
                                ->orderBy('users.users_group_id' , 'ASC')
                                ->fetchAll();
        return $admins;
    }

    /**
     * Get Users Only
     *
     * @return \stdClass
     */
    public function getUsers()
    {
        return $this->db->select('users.*, users.id AS idUser')
                        ->where('users.users_group_id = ? AND users.verified = ?' , 0 , 1)
                        ->orderBy('users.id' , 'ASC')
                        ->fetchAll($this->_table);
    }

    /**
     * Get inactive Users
     *
     * @return \stdClass
     */
    public function getInactiveUsers()
    {
        return $this->db->where('users.verified = ?' , 0)->orderBy('users.id' , 'ASC')->fetchAll($this->_table);
    }

    /**
     * Get count inactive Users
     *
     * @return int
     */
    public function countWaitingActivationUser()
    {
        return $this->app->db->select('COUNT(id) AS `count`')->from($this->_table)->where('verified = ?', 0)->fetch()->count;
    }

    /**
     * Active User
     *
     * @return \stdClass
     */
    public function activeUser($id)
    {
        $this->app->db->data([
            'verified'   => 1,
            'confirm_id' => 0,
        ])->where('id = ?' , $id)->update($this->_table);

        return $this->db->count();
    }

    /**
     * Remove User
     *
     * @return void
     */
    public function removeUser($id)
    {

        $image = $this->app->db->select('image')->from($this->_table)->where('id = ? AND users_group_id != ?', $id, 1)->fetch()->image;

        //remove user image
        if ($image) {
            if ($image !== DEFAULT_IMAGE_MALE && $image !== DEFAULT_IMAGE_FEMALE) {
                removeFile($image);
            }
        }

        $this->db->where('id = ? AND users_group_id != ?' , $id , 1)->delete($this->_table);

        return $this->db->count();
    }


    /**
     * Edit Users
     *
     * @return void
     */
    public function editUser($id)
    {
        if (!is_numeric($id)) {
            return false;
        }

        if ($this->exists($this->_table, $id)) {

            $this->app->db->table($this->_table)->data([
                'first_name'    => cleanInput($this->app->request->post('first_name')),
                'last_name'     => cleanInput($this->app->request->post('last_name')),
                'email'         => cleanInput($this->app->request->post('email')),
                'birthday'      => cleanInput(strtotime($this->app->request->post('birthday'))),
                'users_group_id'=> cleanInput($this->app->request->post('user_group')),
                'gender'        => cleanInput($this->app->request->post('gender')),
                'status'        => cleanInput($this->app->request->post('status')),
            ])->where('`id` = ?', $id)->update();

            $password = cleanInput($this->app->request->post('password')) ?: null;
            $image = $this->app->request->file('image');

            if ($password) {
                $this->app->db->data(['password'=> password_hash($password, PASSWORD_DEFAULT)])->where('id = ?', $id)->update($this->_table);
            }
            if ($image->uploaded()) {
                //remove old user image
                unlink($this->db->select('image')->from($this->_table)->where('id = ?', $id)->fetch()->image);

                //update image
                $this->app->db->data(['image' => $this->uploadImage()])->where('id = ?', $id)->update($this->_table);
            }
            
            return $this->db->count() ? true : false;

        }else {
            return false;
        }
    }

    /**
     * Get User
     *
     * @return bool
     */
    public function getUser($id)
    {
        $user = (array)$this->get($this->_table , $id);
        $user['groupUser'] = $this->get($this->_users_group, $user['users_group_id']);
        $user['groups'] = $this->getAll($this->_users_group);

        //for adminstrator
        if ($user['users_group_id'] == 1) {
            return false;
        }

        return $this->app->db->count() ? $user : false;
    }
}