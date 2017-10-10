<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 9/18/2017
 * Time: 10:00 PM
 */

namespace app\Controllers\admin;

use System\Controller;
use System\View\view;


class postsController extends Controller
{

    /**
     * Model Class
     *
     * @var string
     */
    private $_model = 'posts';

    /**
     * Category Model
     *
     * @var string
     */
    private $_categoriesModel = 'categories';

    /**
     * Default Function
     *
     * @return main view
     */
    public function index()
    {
        $data['header'] = 'POSTS';
        $data['headerCard'] = 'Posts Tabs';
        $data['smallHeader'] = 'Add, Edit and Delete Posts';
        $data['navLinks'] = [
            'All Posts'     => $this->app->url->url('admin/posts/all-posts'),
            'Add Post'      => $this->app->url->url('admin/posts/add'),
        ];

        return $this->app->adminLayout->render('admin/posts/main-view', $data);
    }

    /**
     * View All Posts
     *
     * @return view
     */
    public function posts()
    {
        $posts = $this->app->load->model($this->_model)->getAllPosts();

        return $this->app->view->render('admin/posts/posts', compact('posts'));
    }

    /**
     * Add View
     *
     * @return view
     */
    public function add()
    {
        $data['action'] = $this->app->url->url('admin/posts/add/submit');
        $data['categories'] = $this->app->load->model($this->_categoriesModel)->getParentCategories();
        $data['subcategories'] = $this->app->load->model($this->_categoriesModel)->getSubcategories();
        $data['posts'] = $this->app->load->model($this->_model)->getAllPosts();

        return $this->app->view->render('admin/posts/add', $data);
    }


    /**
     * Add New Post
     *
     * @return json
     */
    public function addSubmit()
    {
        if (!$this->valid()) {

            $data['errors'] = implode('<br>', $this->app->validate->getErrors());

        }else {

            if ($this->app->load->model($this->_model)->addPost()) {

                $data['success'] = 'Done!';

            }else {

                $data['errors'] = 'something errors';

            }

        }

        return $this->json($data);
    }


    /**
     * Valid Data
     *
     * @param $action
     * @param $id
     * @return bool
     */
    public function valid($action = null, $id = null)
    {

        $this->app->validate->required('title', 'Please Insert Title Post')
            ->required('category')
            ->required('status')
            ->specialName('title', 'Title Name is Allowed string, digits, whitespace, [#,@,!,*,/,\,+,.,&,^,-,_,,]')
            ->int('category')
            ->isOneOrZero('status');

        if (is_null($action)) {
            //case is add post
            $this->app->validate->requiredFile('main_image', 'Main Image is Required')->isImage('main_image','Please Choose valid Image');

        }elseif ($action == 'edit') {
            //case is edit post

            if (!is_int($id)) {
                $this->app->valdiate->addError('id', 'Invalid ID');
                return false;
            }

            if ($this->app->request->file('mainImage')->uploaded()) {
                $this->app->validate->inImage('mainImage','Please Choose valid Image');
            }

        }else {
            return false;
        }

        return $this->app->validate->passes();
    }


    /**
     * Remove Post
     *
     * @param $id
     * @return json
     */
    public function remove($id)
    {
        $status = false;

        if (!is_numeric($id)) {

            return $this->json($status);

        }else {

            if (!$this->app->load->model($this->_model)->remove($id)) {

                $status = false;

            }else {

                $status = true;

            }

        }

        return $this->json($status);
    }


    /**
     * View Post
     *
     * @param $id
     * @return html
     */
    public function viewPost($id)
    {
        if (!is_numeric($id)) {
            return false;
        }

        $post = $this->load->model($this->_model)->getPostForView($id);

        return $this->app->view->render('admin/posts/viewPost', compact('post'));
    }


    /**
     * Edit Post
     *
     * @param $id
     * @return html
     */
    public function edit($id)
    {
        if (!is_numeric($id)){
            return false;
        }

        $data['post'] = $this->load->model($this->_model)->getPost($id);

        return $this->app->view->render('admin/posts/edit', $data);
    }

}