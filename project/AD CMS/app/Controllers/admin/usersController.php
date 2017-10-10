<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 8/3/2017
 * Time: 3:23 AM
 */

namespace app\Controllers\admin;


use System\Controller;
use System\SSP;
use System\View\view;

class usersController extends Controller
{

    /**
     * Main Model Class
     *
     * @var string
     */
    private $_model = 'users';

    /**
     * Users Groups Model
     *
     * @var string
     */
    private $_usersGroupModel = 'usersGroups';

    /**
     * Return Main Content Users Page
     *
     * @return view
     */
    public function index()
    {
        $this->app->html->setTitle('users');

        $data['header'] = 'USERS';
        $data['headerCard'] = 'Users Tabs';
        $data['smallHeader'] = 'Manage Your Users';
        $data['searchLink'] = $this->app->url->url('admin/users/search');

        $data['navLinks'] = [
            'ALL USERS'    => $this->app->url->url('admin/users/all'),
            'ADMINS'    => $this->app->url->url('admin/users/admins'),
            'USERS'    => $this->app->url->url('admin/users/users'),
            'ADD NEW USER'    => $this->app->url->url('admin/users/add-user'),
            'WAITING FOR ACTIVATION'    => $this->app->url->url('admin/users/waiting-activation-user'),
        ];

        $data['countWaitingActivationUser'] = $this->app->load->model($this->_model)->countWaitingActivationUser();

        return $this->app->adminLayout->render('admin/users/main-view' , $data);
    }

    /**
     * Get All Users
     *
     * @return view
     */
    public function all()
    {
        $userModel = $this->app->load->model($this->_model);
        $users = $userModel->getAllUsers();
        $data['users'] = $users;

        return $this->app->view->render('admin/users/all-users' , $data);
    }

    /**
     * Get All Admins
     *
     * @return view
     */
    public function getAdmins()
    {
        $userModel = $this->app->load->model($this->_model);
        $admins = $userModel->getAdmins();

        $data['admins'] = $admins;

        return $this->app->view->render('admin/users/admins', $data);
    }


    /**
     * Get Users Only
     *
     * @return view
     */
    public function getUsers()
    {
        $users = (array)$this->app->load->model($this->_model)->getUsers();

        return $this->app->view->render('admin/users/users' , compact('users'));
    }

    /**
     * Get Users Not Activation
     *
     * @return view
     */
    public function waitingActivation()
    {
        $users = $this->app->load->model($this->_model)->getInactiveUsers();

        return  $this->app->view->render('admin/users/inactive-users' , compact('users'));
    }

    /**
     * Activation User
     *
     * @param $id
     * @return json data
     */
    public function activeUser($id)
    {
        $status = false;

        if (!is_numeric($id)) {
            $status = false;
        }

        if ($this->app->load->model($this->_model)->activeUser($id)) {
            $status = true;
        }

        return $this->json($status);
    }

    /**
     * Load Add Section User
     *
     * @return mixed
     */
    public function add()
    {
        $data['usersGroups'] = $this->app->load->model($this->_usersGroupModel)->getGroups();
        $data['actionLink'] = $this->app->url->url('admin/users/add-user/submit');

        return $this->app->view->render('admin/users/add-user' , $data);
    }

    /**
     * Add A New User When Submit Button
     *
     * @return void
     */
    public function submit()
    {

        if (!$this->validData('register')) {

            $data['errors'] = implode('<br>' , $this->app->validate->getErrors());

        }else {

            $this->app->load->model($this->_model)->registerUser();

            $data['success'] = 'Successful registration';

            $data['redirect'] = $this->app->url->url('admin/users');

        }

        //return $this->app->view->render('admin/users/modal' , $data);
        return $this->json($data);
    }

    /**
     * Check In Registry Data user
     *
     * @param $type
     * @return bool
     */
    private function validData($type, $id = null)
    {
        if ($type == 'edit') {

            $this->app->validate->unique('email' , ['users', 'email', 'id', $id]);

            if (cleanInput($this->app->request->post('password'))) {
                $this->app->validate->password('password', 'invalid password format');
            }

            if (cleanInput($this->app->request->post('image'))) {
                $this->app->validate
                    ->requiredFile('image')
                    ->isImage('image' , 'your image is invalid');
            }

        }elseif ($type == 'register') {

            $this->app->validate
                ->unique('email', ['users', 'email'])
                ->required('password', 'Password is required')
                ->password('password', 'invalid password format')
                ->isImage('image' , 'your image is invalid');
        }

        $this->app->validate
            ->required('first_name', 'First Name is required')
            ->min('first_name', 4, 'First Name should be most 4 characters')
            ->max('first_name', 15, 'First Name should be lass Than 15 characters')
            ->string('first_name', 'First Name allowed only letters')
            ->required('last_name', 'Last Name is required')
            ->min('last_name', 4, 'Last Name should be most 4 characters')
            ->max('last_name', 15, 'Last Name should be lass than 15 characters')
            ->string('last_name', 'Last Name allowed only letters')
            ->required('email', 'Email is required')
            ->email('email', 'Email is not a valid email address')
            ->required('user_group')
            ->alphaNum('user_group')
            ->matches('password', 'confirm_password')
            ->required('gender')
            ->number('gender')
            ->required('status')
            ->number('status')
            ->required('birthday')
            ->date('birthday');

        return $this->app->validate->passes();
    }


    /**
     * Edit User
     *
     * @param id
     * @return void
     */
    public function edit($id)
    {
        if (!is_numeric($id)) {
            return false;
        }

        if (!$user = $this->app->load->model($this->_model)->getUser($id)) {
            return false;
        }

        $data['titleModal'] = sprintf('Edit %s' , $user['first_name'] .' '.$user['last_name']);
        $data['actionLink'] = sprintf($this->app->url->url('admin/users/edit/%d/submit'), $id);
        $data['user']   = $user;

        return $this->app->view->render('admin/users/edit-user' , $data);
    }

    /**
     * Submit Edit From
     *
     * @return mixed
     */
    public function editSubmit($id)
    {
        if (!$this->validData('edit', $id)) {

            $data['errors'] = implode('<br>', $this->validate->getErrors());

        }else {

            if ($this->app->load->model($this->_model)->editUser($id)) {

                $data['success'] = 'Successful Edition';

            }else {

                $data['errors'] = 'Something Error';

            }
        }

        return $this->json($data);
    }

    /**
     * Remove User
     *
     * @return void
     */
    public function remove($id)
    {
        $status = null;

        if (!is_numeric($id)) {
            $status = false;
        }

        if ($this->app->load->model($this->_model)->removeUser($id)) {

            $status = true;

        }else {

            $status = false;
        }

        return $this->json($status);
    }

}

