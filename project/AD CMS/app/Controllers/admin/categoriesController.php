<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 8/3/2017
 * Time: 4:40 AM
 */

namespace app\Controllers\admin;


use System\Controller;
use System\View\view;

class categoriesController extends Controller
{

    /**
     * Main Model Class
     *
     * @var string
     */
    private $_model = 'categories';

    /**
     * Index
     *
     * @return mixed
     */
    public function index()
    {

        $data['header'] = 'Categories';
        $data['headerCard'] = 'Manage Your Categories';
        $data['smallHeader'] = 'Add, Edit and Delete Category';
        $data['navLinks'] = [
            'CATEGORIES'    => $this->app->url->url('admin/categories/index'),
            'SUB CATEGORIES'    => $this->app->url->url('admin/categories/subcategories'),
            'ADD NEW CATEGORY'    => $this->app->url->url('admin/categories/add'),
        ];

        return $this->app->adminLayout->render('admin/categories/main-view' , $data);
    }


    /**
     * Categories View
     *
     * @return view
     */
    public function viewCategories()
    {
        $data = $this->app->load->model($this->_model)->getCategories();

        return $this->app->view->render('admin/categories/categories', $data);
    }

    /**
     * Subcategories View
     *
     * @return view
     */
    public function subcategories()
    {
        $data = $this->app->load->model($this->_model)->getCategories();

        return $this->app->view->render('admin/categories/subcategories', $data);
    }

    /**
     * Add View
     *
     * @return view
     */
    public function add()
    {
        $data['categories'] = $this->app->load->model($this->_model)->getParentCategories();
        $data['action'] = $this->app->url->url('admin/categories/add/submit');

        return $this->app->view->render('admin/categories/add', $data);
    }


    /**
     * Add New Category
     *
     * @return json
     */
    public function submit()
    {
        $json = [];

        if (!$this->valid()) {
            $json['errors'] = implode('<br>', $this->app->validate->getErrors());
        }else {

            if ($this->app->load->model($this->_model)->addCategory()) {

                $json['success'] = 'Success Add Category';

            }else {

                $json['errors'] = 'something errors';

            }
        }

        return $this->json($json);
    }


    /**
     * Validate Data
     *
     * @param $edit
     * @return bool
     */
    private function valid($edit = null)
    {

        if (is_null($edit)) {
            //case add new category
            $this->app->validate->required('parentCategory', 'Please Choose Parent Category')
                                ->int('parentCategory');


        }elseif ($edit == 'subcategory') {
            //case edit subcategory
            $this->app->validate->int('categories');

        }

        $this->app->validate->required('name' , 'Category Name Is Required')
                            ->specialName('name' , 'invalid Category Name')
                            ->required('status')
                            ->isOneOrZero('status'); //is 1 or 0

        return $this->app->validate->passes();
    }


    /**
     * Remove Category
     *
     * @param $id
     * @return mixed
     */
    public function remove($id)
    {
        if (!is_numeric($id)) return false;

        if (!$this->app->load->model($this->_model)->removeCategory($id)) {
            return $this->json(false);
        }

        return $this->json(true);
    }

    /**
     * Edit View [modal]
     *
     * @param $id;
     * @param $text
     * @return view
     */
    public function edit($text, $id)
    {
        if (!is_numeric($id)) return false;

        if (! $category = $this->app->load->model($this->_model)->getCategory($id)) {
            return false;
        }

        $data['category'] = (array)$category;
        $data['titleModal'] = sprintf('Edit %s Category', ucwords($category->name));

        if (strtolower($text) == 'category') {
            //here edit parent category

            $data['titleCategories'] = "Subcategories";

            //get all subcategories
            $data['editCategory'] = true;

            $data['actionLink'] = $this->app->url->url(sprintf('admin/categories/edit/category/%d/submit', $category->id));

        }elseif (strtolower($text == 'subcategory')) {
            //here for edit subcategories

            $data['titleCategories'] = "Parent Categories";

            $data['categories'] = $this->app->load->model($this->_model)->getParentCategories();

            $data['actionLink'] = $this->app->url->url(sprintf('admin/categories/edit/subcategory/%d/submit', $category->id));

        }else {
            //return not found page
            $this->app->url->redirect('notfound');

        }

        return $this->app->view->render('admin/categories/edit', $data);
    }

    /**
     * Save Edit Data
     *
     * @param $id;
     * @param $text;
     * @return mixed
     */
    public function editSubmit($text ,$id)
    {
        if (!is_numeric($id)) {
            $json['errors'] = 'invalid edit category';
        }

        $text = strtolower($text);

        if (!$this->valid($text)) {

            $json['errors'] = implode('<br>', $this->app->validate->getErrors());

        }else {

            $this->app->load->model($this->_model)->editCategory($text, $id);

            $json['success'] = 'Done!';

        }

        return $this->json($json);
    }
}
