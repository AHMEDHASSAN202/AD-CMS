<?php

define('DEFAULT_IMAGE_MALE', 'public/uploads/images/users/defaultMale.png');
define('DEFAULT_IMAGE_FEMALE', 'public/uploads/images/users/defaultFemale.png');


/**
 * Show data
 *
 * @param $var
 */
if (! function_exists('pre')) {

    function pre($var) {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}

/**
 * Show data and exist
 *
 * @param $var
 */
if (! function_exists('pred')) {

    function pred($var) {
        pre($var);
        exit();
    }
}

/**
 * Escape Html tags
 *
 * @param $value
 */
if (! function_exists('escape_tags_html')) {

    function escape_tags_html($value) {
        return htmlspecialchars($value , ENT_QUOTES , 'UTF-8');
    }
}

/**
 * Strip All Tags [html - xml - php]
 *
 * @return clean value
 */
if (! function_exists('stripTags')) {

    function stripTags($value) {
        $value = trim($value);
        return strip_tags($value);
    }
}


/**
 * Clean Input
 *
 * @return valid value
 */
if (! function_exists('cleanInput')) {

    function cleanInput($value) {
        return strip_tags(escape_tags_html($value));
    }
}

/**
 * Generate Full Path For The Given Path In Public directory
 *
 * @param $path
 */
if (! function_exists('assets')) {

    function assets($path) {
        $app = \System\App::getInstance();
        return $app->url->url('public/' . $path);
    }
}

/**
 * Generate Url
 *
 * @param $url
 */
if (! function_exists('url')) {

    function url($url) {
        $app = \System\App::getInstance();
        return $app->url->url($url);
    }
}

/**
 * Generate Difference Code
 *
 * @return $code
 */
if (! function_exists('generateCode')) {

    function generateCode()
    {
        return sha1(time() . mt_rand());
    }
}


/**
 * Generate Unique ID
 *
 * @return $code
 */
if (! function_exists('uniqueCode')) {

    function uniqueCode()
    {
        return md5(uniqid() . time() . mt_rand(0000000000 , 9999999999));
    }

}


/**
 * Default Path Image User
 *
 * @return $fullPath
 */
if (! function_exists('defaultUserImage')) {

    function defaultUserImage($gender = 'male') {
        if ($gender == 'male') {
            return DEFAULT_IMAGE_MALE;
        }elseif ($gender == 'female') {
            return DEFAULT_IMAGE_FEMALE;
        }else {
            return 'not found image';
        }
    }
}


/**
 * Remove File
 *
 * @return void
 */
if (! function_exists('removeFile')) {
    function removeFile($file) {
        if (file_exists(trim($file))) {
            unlink($file);
        }
    }
}

/**
 * Uploaded Images Directory
 *
 * @param $path
 */
if (! function_exists('uploadedImagesDir')) {
    function uploadedImagesDir($path)
    {
        $app = System\App::getInstance();

        return $app->file->toPublic('uploads/images/'.$path);
    }
}

/**
 * Upload Path [use this path store in database]
 *
 * @param $path
 */
if (! function_exists('linkUploads')) {
    function linkUploads($path)
    {
        return str_replace('\\', '/', 'public/uploads/'.$path);
    }
}