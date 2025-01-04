<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$translatable = [
    'search' => 'search/index',
    'search/(:any)/(:any)-(:num).html' => 'search/index/$2/$3/$1',
    'search/(:any)/(:any).html' => 'search/index/$2/0/$1',
    'search/(:any)-(:num).html' => 'search/index/$1/$2',
    'search/(:any).html' => 'search/index/$1',

    'page-(:num).html' => 'home/index//$1',

    '(:any)-(:num).html' => 'home/index/$1/$2',
    '(:any).html' => 'home/index/$1',

    'tag/(:any)-(:num).html' => 'ctag/index/$1/$2',
    'tag/(:any).html' => 'ctag/index/$1',

    'author/(:any)-(:num).html' => 'cauthor/index/$1/$2',
    'author/(:any).html' => 'cauthor/index/$1',

    'about/(:any)-(:num).html' => 'cauthor/about/$1/$2',
    'about/(:any).html' => 'cauthor/about/$1',

    'rss/(:any)-(:num).html' => 'cauthor/rss/$1/$2',
    'rss/(:any).html' => 'cauthor/rss/$1',

    'ckeditor/ckfinder/ckfinder.html?(:any)' => 'home/editor/$1'
];

foreach($translatable as $key => $item) {
    $route['ro/'.$key] = $item;
}

$route['ro'] = 'home/index';

$route = array_merge($route, $translatable);

/*
$route['search'] = 'search/index';
$route['search/(:any)/(:any)-(:num).html'] = 'search/index/$2/$3/$1';
$route['search/(:any)/(:any).html'] = 'search/index/$2/0/$1';
$route['search/(:any)-(:num).html'] = 'search/index/$1/$2';
$route['search/(:any).html'] = 'search/index/$1';

$route['page-(:num).html'] = 'home/index//$1';

$route['(:any)-(:num).html'] = 'home/index/$1/$2';
$route['(:any).html'] = 'home/index/$1';

$route['(:any)-(:num).html'] = 'home/index/$1/$2';
$route['(:any).html'] = 'home/index/$1';


$route['tag/(:any)-(:num).html'] = 'ctag/index/$1/$2';
$route['tag/(:any).html'] = 'ctag/index/$1';

$route['author/(:any)-(:num).html'] = 'cauthor/index/$1/$2';
$route['author/(:any).html'] = 'cauthor/index/$1';

$route['ckeditor/ckfinder/ckfinder.html?(:any)'] = 'home/editor/$1';
*/

