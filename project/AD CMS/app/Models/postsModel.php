<?php
/**
 * Created by PhpStorm.
 * User: AHMED
 * Date: 9/19/2017
 * Time: 3:41 AM
 */

namespace app\Models;


use System\Model;

class postsModel extends Model
{

    /**
     * Table Name
     *
     * @var string
     */
    private $_table = 'posts';

    /**
     * Login Model
     *
     * @var string
     */
    private $_loginModel = 'login';

    /**
     * Get All Posts
     *
     * @return \stdClass
     */
    public function getAllPosts()
    {
        return $this->app->db->select('posts.*, c.name AS categoryName, CONCAT(u.first_name," ",u.last_name) AS username')
                             ->from($this->_table)
                             ->join('INNER JOIN `categories` AS c ON posts.category_id = c.id')
                             ->join('INNER JOIN `users` AS u ON posts.user_id = u.id')
                             ->fetchAll();
    }


    /**
     * Add Post
     *
     * @return bool
     */
    public function addPost()
    {
        $title = escape_tags_html($this->app->request->post('title'));
        $category = cleanInput($this->app->request->post('category'));
        $status = cleanInput($this->app->request->post('status'));
        $post = $this->app->request->post('post');
        $tags = cleanInput($this->app->request->post('tags'));

        $image = $this->app->request->file('main_image');

        if ($image->uploaded()) {

            $path = uploadedImagesDir('posts/');

            $image->moveTo($path);

        }else {
            return false;
        }

        //import information user From Login Model
        $id = $this->app->load->model($this->_loginModel)->getInfoUser()->id;

        $relatePostsValue = $this->app->request->post('relatedPosts');

        $relatePosts = !empty($relatePostsValue) ? serialize($relatePostsValue) : '';

        $this->app->db->data([
            'category_id'   => $category,
            'user_id'       => $id,
            'title'         => $title,
            'details'       => $post,
            'image'         => linkUploads('images/posts/'.$image->nameImageAfterMovingIt()),
            'tags'          => $tags,
            'related_posts' => $relatePosts,
            'created'       => time(),
            'status'        => $status
        ])->insert($this->_table);

        return $this->app->db->count() ? true : false;
    }


    /**
     * Remove Post
     *
     * @param $id
     * @return bool
     */
    public function remove($id)
    {
        if (!$this->exists($this->_table, $id)) {

            return false;
        }

        $this->app->db->table($this->_table)->where('id = ?', $id)->delete();

        return $this->app->db->count() ? true : false;
    }

    /**
     * Get title and details Post
     *
     * @param $id
     * @return object
     */
    public function getPostForView($id)
    {
        if (!$this->exists($this->_table, $id)) {
            return false;
        }

        return $this->db->select('title, details')->from($this->_table)->where('id = ?', $id)->fetch();
    }


    /**
     * Get Post
     *
     * @param $id
     * @return object
     */
    public function getPost($id)
    {
        if (!$this->exists($this->_table, $id)) {
            return false;
        }

        return $this->get($this->_table, $id);
    }
}