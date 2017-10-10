<?php
//add routes


$app = \System\App::getInstance();   //get instance App Class

//check if url is started admin
if (strpos($app->request->url() , 'admin') === 0) {

    //share admin layout page
    $app->share('adminLayout' , function($app) {
        return $app->load->controller('admin/layout/layout');
    });


    $app->addCallable(function ($app) {
        $app->load->controller('admin/access')->index();
    });

}


//================================== admin routes ===========================\\
//-------------- login admin routes ------------\\
$app->route->add('admin/login' , 'admin/login');
$app->route->add('admin/login/submit' , 'admin/login@submit' , 'post');

//--------------- logout route ------------\\
$app->route->add('admin/logout' , 'admin/logout');

//-------------- dashboard route -----------\\
$app->route->add('admin/dashboard' , 'admin/dashboard');

//-------------- profile -------------\\
$app->route->add('admin/profile' , 'admin/profile');

//--------------- users --------------\\
$app->route->add('admin/users' , 'admin/users');
$app->route->add('admin/users/all' , 'admin/users@all', 'post');
$app->route->add('admin/users/all-users' , 'admin/users@allUsersTable', 'post');
$app->route->add('admin/users/admins' , 'admin/users@getAdmins', 'post');
$app->route->add('admin/users/users' , 'admin/users@getUsers', 'post');
$app->route->add('admin/users/add-user' , 'admin/users@add' , 'post');
$app->route->add('admin/users/add-user/submit' , 'admin/users@submit' , 'post');
$app->route->add('admin/users/waiting-activation-user' , 'admin/users@waitingActivation', 'post');
$app->route->add('admin/users/active/:id' , 'admin/users@activeUser' , 'post');
$app->route->add('admin/users/edit/:id' , 'admin/users@edit' , 'post');
$app->route->add('admin/users/edit/:id/submit' , 'admin/users@editSubmit' , 'post');
$app->route->add('admin/users/remove/:id' , 'admin/users@remove' , 'post');

//--------------- categories ---------------\\
$app->route->add('admin/categories' , 'admin/categories');
$app->route->add('admin/categories/index' , 'admin/categories@viewCategories', 'post');
$app->route->add('admin/categories/subcategories' , 'admin/categories@subcategories', 'post');
$app->route->add('admin/categories/add' , 'admin/categories@add', 'post');
$app->route->add('admin/categories/add/submit' , 'admin/categories@submit', 'post');
$app->route->add('admin/categories/remove/:id' , 'admin/categories@remove', 'post');
$app->route->add('admin/categories/edit/:text/:id' , 'admin/categories@edit', 'post');
$app->route->add('admin/categories/edit/:text/:id/submit' , 'admin/categories@editSubmit', 'post');

//--------------- posts ---------------------\\
$app->route->add('admin/posts' , 'admin/posts');
$app->route->add('admin/posts/all-posts' , 'admin/posts@posts', 'post');
$app->route->add('admin/posts/add' , 'admin/posts@add', 'post');
$app->route->add('admin/posts/add/submit' , 'admin/posts@addSubmit', 'post');
$app->route->add('admin/posts/remove/:id' , 'admin/posts@remove', 'post');
$app->route->add('admin/posts/view/:id' , 'admin/posts@viewPost', 'post');
$app->route->add('admin/posts/edit/:id' , 'admin/posts@edit', 'post');

//-------------- users group -----------------\\
$app->route->add('admin/users-groups' , 'admin/usersGroups@index');
$app->route->add('admin/users-groups/index' , 'admin/usersGroups@allGroups', 'post');

//-------------- ads -------------------------\\
$app->route->add('admin/ads' , 'admin/ads');
$app->route->add('admin/ads/index' , 'admin/ads@allAds', 'post');

//--------------- settings ------------------\\
$app->route->add('admin/settings' , 'admin/settings');


//==================================== #END# admin routes ======================\\


//=================================== Theme Routes =============================\\
$app->route->add('home' , 'home/home');
$app->route->add('about-us/:text' , 'home/about-us@about');
$app->route->add('login' , 'login/login@index');
$app->route->add('login/submit' , 'login/login@submit' , 'post');
$app->route->add('logout/:id' , 'login/login@logout' , 'post');


//=================================== NotFount Page =============================\\
$app->route->add('notfound' , 'errors/notFound');
$app->route->add('notfound/section' , 'errors/notFound@sectionView');
