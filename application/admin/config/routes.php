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
$route['default_controller'] = 'news';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['news/(:any)'] = 'news/index/$1';
$route['news'] = 'news';
$route['news/add'] = 'news/add/$1';
$route['news/add/(:any)'] = 'news/add/$1';
$route['news/delete'] = 'news/delete';
$route['news/order'] = 'news/order';
$route['news/save_order'] = 'news/save_order';
$route['news/remove_home_page'] = 'news/remove_home_page';
$route['news/upload'] = 'news/upload';
$route['news/delete_image'] = 'news/delete_image';

$route['newscategories/(:any)'] = 'newscategories/index/$1';
$route['newscategories/add'] = 'newscategories/add/$1';
$route['newscategories/add/(:any)'] = 'newscategories/add/$1';
$route['newscategories/delete'] = 'newscategories/delete';
$route['newscategories/order'] = 'newscategories/order';
$route['newscategories/save_order'] = 'newscategories/save_order';

$route['users'] = 'users';
$route['users/(:any)'] = 'users/index/$1';
$route['users/logout'] = 'users/logout';
$route['users/login'] = 'users/login';
$route['users/add/(:any)'] = 'users/add/$1';
$route['users/add'] = 'users/add';
$route['users/delete'] = 'users/delete';
$route['users/upload'] = 'users/upload';
$route['users/delete_image'] = 'users/delete_image';

$route['regions/(:any)'] = 'regions/index/$1';
$route['regions/add'] = 'regions/add/$1';
$route['regions/add/(:any)'] = 'regions/add/$1';
$route['regions/delete'] = 'regions/delete';

$route['counties/(:any)'] = 'counties/index/$1';
$route['counties/add'] = 'counties/add/$1';
$route['counties/add/(:any)'] = 'counties/add/$1';
$route['counties/delete'] = 'counties/delete';
$route['counties/localitati'] = 'counties/localitati';
$route['counties/localitati/(:any)'] = 'counties/localitati/$1';

$route['countries/counties'] = 'countries/counties';

$route['localities/(:any)'] = 'localities/index/$1';
$route['localities/add'] = 'localities/add/$1';
$route['localities/add/(:any)'] = 'localities/add/$1';
$route['localities/delete'] = 'localities/delete';

$route['facilities/(:any)'] = 'facilities/index/$1';
$route['facilities/add'] = 'facilities/add/$1';
$route['facilities/add/(:any)'] = 'facilities/add/$1';
$route['facilities/delete'] = 'facilities/delete';
$route['facilities/index2/index/(:any)/(:any)'] = 'facilities/index?type=$1&pg=$2';

$route['events/(:any)'] = 'events/index/$1';
$route['events/add'] = 'events/add/$1';
$route['events/add/(:any)'] = 'events/add/$1';
$route['events/delete'] = 'events/delete';

$route['languages/(:any)'] = 'languages/index/$1';
$route['languages/add'] = 'languages/add/$1';
$route['languages/add/(:any)'] = 'languages/add/$1';
$route['languages/delete'] = 'languages/delete';

$route['newsletter'] = 'newsletter/index';
$route['newsletter/(:any)'] = 'newsletter/index/$1';
$route['newsletter/add'] = 'newsletter/add/$1';
$route['newsletter/add/(:any)'] = 'newsletter/add/$1';
$route['newsletter/delete'] = 'newsletter/delete';
$route['newsletter/export'] = 'newsletter/export';

$route['pages/(:any)'] = 'pages/index/$1';
$route['pages/add'] = 'pages/add/$1';
$route['pages/add/(:any)'] = 'pages/add/$1';
$route['pages/delete'] = 'pages/delete';

