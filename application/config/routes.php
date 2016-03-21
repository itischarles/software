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
|	https://codeigniter.com/user_guide/general/routing.html
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

$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
//$route['register'] = 'auth/register';



//USERS
$route['user/new'] = 'users/addNewUser';

$route['user/my-account'] = 'users/editUser/';
$route['user/(:any)'] = 'users/viewUser/$1';
//$route['user/(:any)'] = 'users/editUser/$1'; //temprary use this
$route['user/(:any)/edit'] = 'users/editUser/$1';
$route['user/(:any)/del'] = 'users/deleteUser/$1';


//settings
$route['system-setting'] = 'System_settings/listSettings';


//wrappers and accounts

$route['wrappers/list-wrappers'] = 'Wrapper/listWrappers';
$route['wrappers/wrapper/new'] = 'Wrapper/newWrapper';
$route['wrapper/(:any)/edit'] = 'Wrapper/editWrapper/$1';
$route['wrapper/(:any)'] = 'Wrapper/viewWrapper/$1';

//rules
$route['wrapper/(:any)/list-rules'] = 'Wrapper/WrapperRules_list/$1';
$route['wrapper/(:any)/products'] = 'Wrapper/product_new/$1';
//$route['wrapper/(:any)/new-rules'] = 'Wrapper/WrapperRules_addNew/$1';

//product
$route['wrapper/(:any)/product/new'] = 'Products/addProduct/$1';
$route['wrapper/(:any)/product/(:any)'] = 'Products/viewProduct/$1/$2';
$route['wrapper/(:any)/product/(:any)/edit'] = 'Products/editProduct/$1/$2';

//product option

$route['add-product-option/wrapper/(:any)/product/(:any)'] = 'Products/addProductOptions/$1/$2';
$route['edit-product-option/wrapper/(:any)/product/(:any)/option/(:num)'] = 'Products/updateProductOptions/$1/$2/$3';




// financial-adviser
$route['financial-adviser/advisers'] = 'Financial_adviser/searchFinancialAdvisers';
$route['financial-adviser/adviser/new'] = 'Financial_adviser/addFinancialAdviser';
$route['financial-adviser/adviser/(:any)'] = 'Financial_adviser/viewFinancialAdviser/$1';
$route['financial-adviser/adviser/(:any)/edit'] = 'Financial_adviser/editFinancialAdviser/$1';

// ajax load adviser by where
$route['advisers/xhttplist'] = 'Financial_adviser/xhttpListAdvisers';





$route['financial-adviser/companies'] = 'Financial_adviser/searchFinancialAdvisersCompany';
$route['financial-adviser/company/new'] = 'Financial_adviser/addFinancialAdviserCompany';
$route['financial-adviser/company/(:any)'] = 'Financial_adviser/viewFinancialAdviserCompany/$1';
$route['financial-adviser/company/(:any)/edit'] = 'Financial_adviser/editFinancialAdviserCompany/$1';

$route['financial-adviser/networks'] = 'Financial_adviser/searchFinancialAdvisersCompanyNetwrok';
$route['financial-adviser/network/new'] = 'Financial_adviser/addFinancialAdviserCompanyNetwrok';
$route['financial-adviser/network/(:any)'] = 'Financial_adviser/viewFinancialAdviserCompanyNetwrok/$1';
$route['financial-adviser/network/(:any)/edit'] = 'Financial_adviser/editFinancialAdviserCompanyNetwrok/$1';


//WORKFLOW AND CLIENTS OPERTION
$route['clients'] = 'Clients/index';
$route['client/new'] = 'Clients/newClient';
$route['client/(:any)/edit']= 'Clients/editClient/$1';
$route['client/(:any)'] = 'Clients/viewClient/$1';
//$route['client/(:any)/applicant-details'] = 'Clients/clientDetails/$1';


//Apply for an account
//
$route['client/(:any)/account/(:any)/new-application'] = 'Application/newApplication/$1/$2';
//$route['client/(:any)/'] = 'Clients/clientDetails/$1';


$route['default_controller'] = 'dashboard';
$route['404_override'] = 'Error_custom';
$route['translate_uri_dashes'] = FALSE;
