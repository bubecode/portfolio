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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'welcome'; // Welcome redirects to admin/auth/login
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Admin Routes (Standard MVC, so mostly handled by default routing, but we can be explicit)
$route['admin'] = 'admin/dashboard';
$route['admin/login'] = 'admin/auth/login';

// Public API Routes
$route['api/profile'] = 'api/profile/index';
$route['api/about'] = 'api/about/index';
$route['api/skills'] = 'api/skills/index';
$route['api/projects'] = 'api/projects/index';
$route['api/experience'] = 'api/experience/index';
$route['api/education'] = 'api/education/index';
$route['api/awards'] = 'api/awards/index';
$route['api/services'] = 'api/services/index';
$route['api/meta'] = 'api/meta/index';
$route['api/v1/contact']['post'] = 'api/contact';
$route['api/v1/content'] = 'api/content/index';
