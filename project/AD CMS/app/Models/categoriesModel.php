<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 9/9/2017
 * Time: 3:54 AM
 */

namespace app\Models;


use System\Model;

class categoriesModel extends Model
{
    /**
     * Table Name
     *
     * @var string
     */
    private $_table = 'categories';

    /**
     * Get Categories
     *
     * @return array
     */
    public function getCategories()
    {
        $data['categories'] = $this->db->select('*')->from($this->_table)->where('parent_id = ? OR parent_id IS NULL', 0)->fetchAll();
        $data['subcategories'] = $this->db->select('*')->from($this->_table)->where('parent_id != ?', 0)->fetchAll();

        return $data;
    }

    /**
     * Get All Categories
     *
     * @return array
     */
    public function getAllCategories()
    {
        return $this->getAll($this->_table);
    }

    /**
     * Get Parent Categories
     *
     * @return \stdClass
     */
    public function getParentCategories()
    {
        return $this->getCategories()['categories'];
    }

    /**
     * Get Subcategories
     *
     * @return array
     */
    public function getSubcategories()
    {
        return $this->getCategories()['subcategories'];
    }

    /**
     * Add New Category
     *
     * @return bool
     */
    public function addCategory()
    {
        $nameCategory = cleanInput($this->app->request->post('name'));

        $description = escape_tags_html($this->app->request->post('description'));

        $parentCategory = cleanInput($this->app->request->post('parentCategory'));

        $parentCategory = $parentCategory == 0 ? 'null' : $parentCategory;

        $status = cleanInput($this->app->request->post('status'));

        $this->app->db->data('parent_id', $parentCategory)
                      ->data('name', $nameCategory)
                      ->data('description', $description)
                      ->data('created', time())
                      ->data('status', $status)
                      ->insert($this->_table);

        return $this->app->db->count() ? true : false;
    }

    /**
     * Remove Category
     *
     * @param $id
     * @return bool
     */
    public function removeCategory($id)
    {

        if (!$this->exists($this->_table, $id)) {
            return false;
        }

        $parentID = $this->app->db->select('parent_id')->where('id = ?', $id)->fetch($this->_table)->parent_id;

        //if this category is parent
        if ($parentID == 0) {
            $this->app->db->where('parent_id = ?', $id)->delete($this->_table);
        }

        $this->app->db->where('id = ?', $id)->delete($this->_table);

        return $this->app->db->count() ? true : false;
    }

    /**
     * Get Category
     *
     * @param $id;
     * @return \stdClass
     */
    public function getCategory($id)
    {
        $category = $this->app->db->select('*')->from($this->_table)->where('id = ?', $id)->fetch();

        return $this->app->db->count() ? $category : false;
    }

    /**
     * Edit Category
     *
     * @param $id
     * @param $text
     * @return bool
     */
    public function editCategory($text, $id)
    {
        $categoryName = cleanInput($this->app->request->post('name'));
        $status = cleanInput($this->app->request->post('status'));
        $description = cleanInput($this->app->request->post('description'));

        //check if ID Exists
        if ($this->exists($this->_table, $id)) {

            //case in edit subcategories
            if ($text == 'subcategory') {

                //new choose parent category
                $newParentCategoryId = cleanInput($this->app->request->post('categories'));
                $oldParentCategoryId = $this->app->db->select('parent_id')->where('id = ?', $id)->fetch($this->_table)->parent_id;

                //check if new parent category is null
                $count = $this->app->db->select('COUNT(id) AS `count`')->where('id = ? AND parent_id IS NULL', $newParentCategoryId)->fetch($this->_table)->count;

                if ($count == 1) {
                    //edit new parent category [parent_id = 0]
                    $this->app->db->data('parent_id', 0)->where('id = ?', $newParentCategoryId)->update($this->_table);
                }

                //change parent_id for subcategory to id parent category
                $this->app->db->data('parent_id', $newParentCategoryId)->where('id = ?', $id)->update($this->_table);

                //get count subcategories from parent category
                $hasSubcategoriesInOldParentCategory = $this->app->db->select('COUNT(id) AS `count`')->where('parent_id = ?', $oldParentCategoryId)->fetch($this->_table)->count;

                if (!$hasSubcategoriesInOldParentCategory) {
                    //in not exists subcategories in old parent category
                    $this->app->db->data('parent_id', 'null')->where('id = ?', $oldParentCategoryId)->update($this->_table);
                }
            }

            //edit name, description and status category
            $this->app->db->table($this->_table)->data([
                'name'=> $categoryName,
                'description' => $description,
                'status' => $status
            ])->where('id = ?', $id)->update();

        }

    }

}