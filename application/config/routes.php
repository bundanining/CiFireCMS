<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']   = 'Home';
$route['404_override']         = 'Error_404';
$route['translate_uri_dashes'] = TRUE;

// ADMIN.
$route[FADMIN] = FADMIN.'/login';
$route[FADMIN.'/logout'] = FADMIN.'/login/logout';
$route[FADMIN.'/forgot'] = FADMIN.'/login/forgot';
// $route[FADMIN.'/profile'] = FADMIN.'/user/profile';

// MEMBER.
$route['l-member'] = 'l-member/login';
$route['l-member/logout'] = 'l-member/login/logout';
$route['l-member/forgot'] = 'l-member/login/forgot';
$route['l-member/register'] = 'l-member/login/register';
$route['l-member/activation'] = 'l-member/login/activation';
$route['l-member/change-password'] = 'l-member/account/password';
$route['l-member/delete-account'] = 'l-member/account/delete';

// WEB.
$route['index/([0-9-]+)'] = 'index/index/$1';
$route['home'] = 'home/index';
$route['home/([0-9]+)'] = 'home/index/$1';
$route['pages/([a-z0-9-]+)'] = 'pages/index/$1';
$route['about-us'] = 'pages/index/about-us';
$route['contact'] = 'contact/index';
$route['category/([a-z0-9-]+)'] = 'category/index/$1';
$route['category/([a-z0-9-]+)/([0-9]+)'] = 'category/index/$1/$2';
$route['tag/([a-z0-9-]+)'] = 'tag/index/$1';
$route['tag/([a-z0-9-]+)/([0-9]+)'] = 'tag/index/$1/$2';
$route['search/([^/]*)'] = 'search/index/$1';
$route['search/([^/]*)/([0-9]+)'] = 'search/index/$1/$2';
$route['gallery'] = 'gallery/index';
$route['gallery/([a-z0-9-]+)'] = 'gallery/album/$1';

// dinamic routes.
foreach(glob(APPPATH."/config/routes/*.php") as $routes_file)
{
	require_once $routes_file;
}
