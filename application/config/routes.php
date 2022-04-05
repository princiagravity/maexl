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
$route['default_controller']                = 'CustomerController';
$route['home']                              = 'CustomerController/home';
$route['login']                             = 'CustomerController/login_view';
$route['guest-login']                       = 'CustomerController/guest_login';
$route['productdetails/(:any)']             = 'CustomerController/single_product/$1';
$route['packagedetails/(:any)']             = 'CustomerController/single_package/$1';
$route['forget-password']                   = 'CustomerController/forget_password';
$route['forget-password-success']           = 'CustomerController/forget_password_success';
$route['change-password']                   = 'CustomerController/change_password_view';
$route['change-password-settings']          = 'CustomerController/change_password_settings';
$route['logout']                            = 'CustomerController/logout';
$route['cart']                              = 'CustomerController/cart';
$route['checkout']                          = 'CustomerController/checkout';
$route['orders']                            = 'CustomerController/orderslist';
$route['offers']                            = 'CustomerController/offerslist';
$route['order/(:any)']                      = 'CustomerController/order_details/$1';
$route['order-success/(:any)']              = 'CustomerController/order_success/$1';
$route['shop-grid']                         = 'CustomerController/shop_grid_view';
$route['settings']                          = 'CustomerController/settings_view';
$route['language']                          = 'CustomerController/language_view';
$route['privacy-policy']                    = 'CustomerController/privacy_policy_view';
$route['settings-change-password']          = 'CustomerController/forget_password_success';
$route['profile']                           = 'CustomerController/profile_view';
$route['404_override']                      = '';
$route['translate_uri_dashes']              = FALSE;

$route['agent']                              = 'AgentController/index';
$route['agent/add-customer']                 = 'AgentController/get_page/add-customer';
$route['agent/customers-list']               = 'AgentController/get_page/customers-list';
$route['agent/forget-password']              = 'AgentController/forget_password';
$route['agent/productdetails/(:any)']        = 'AgentController/single_product/$1';
$route['agent/orders']                       = 'AgentController/orderslist';
$route['agent/order/(:any)']                 = 'AgentController/order_details/$1';
$route['agent/customer-order/(:any)']        = 'AgentController/customer_orders/$1';
$route['agent/collection-report']            = 'AgentController/collection_report';
$route['agent/customer-profile/(:any)']      = 'AgentController/customer_profile/$1';
$route['agent/profile']                      = 'AgentController/profile_view';
$route['agent/forget-password-success']      = 'AgentController/forget_password_success';
$route['agent/change-password']              = 'AgentController/change_password_view';
$route['agent/home']                         = 'AgentController/home';
$route['agent/logout']                       = 'AgentController/logout';


$route['admin']                               = 'AdminController/index';
$route['admin/product-add']                   = 'AdminController/get_page/product-add';
$route['admin/product-update/(:any)']         = 'AdminController/get_page/product-add/$1';
$route['admin/product-category']              = 'AdminController/get_page/product-category';
$route['admin/update-category/(:any)']        = 'AdminController/get_page/product-category/$1';
$route['admin/add-area']                      = 'AdminController/get_page/area-add';
$route['admin/update-area/(:any)']            = 'AdminController/get_page/area-add/$1';
$route['admin/add-district']                  = 'AdminController/get_page/district-add';
$route['admin/update-district/(:any)']        = 'AdminController/get_page/district-add/$1';
$route['admin/add-slider']                    = 'AdminController/get_page/add-slider';
$route['admin/update-slider/(:any)']          = 'AdminController/get_page/add-slider/$1';
$route['admin/add-promocode']                 = 'AdminController/get_page/promocodes';
$route['admin/update-promocode/(:any)']       = 'AdminController/get_page/promocodes/$1';
$route['admin/add-offer']                     = 'AdminController/get_page/add-offers';
$route['admin/update-offer/(:any)']           = 'AdminController/get_page/add-offers/$1';
$route['admin/add-variants']                  = 'AdminController/get_page/add-variants';
$route['admin/update-variants/(:any)']        = 'AdminController/get_page/add-variants/$1';
$route['admin/add-package']                   = 'AdminController/get_page/package-add';
$route['admin/update-package/(:any)']         = 'AdminController/get_page/package-add/$1';
$route['admin/single-view/(:any)/(:any)']     = 'AdminController/single_view/$1/$2';
$route['admin/customer-registration']         = 'AdminController/get_page/add-customer';
$route['admin/customers-list']                = 'AdminController/get_page/customer-list';
$route['admin/customer-profile/(:any)']       = 'AdminController/get_page/customer-profile/$1';
$route['admin/update-customer/(:any)/(:any)'] = 'AdminController/get_page/add-customer/$2/$3';
$route['admin/agent-registration']            = 'AdminController/get_page/add-agent';
$route['admin/agents-list']                   = 'AdminController/get_page/agents-list';
$route['admin/add-stock/(:any)']              = 'AdminController/get_page/manage-stock/$1';
$route['admin/stock-list/(:any)']             = 'AdminController/get_page/stock-list/$1';
$route['admin/agent-profile/(:any)']          = 'AdminController/get_page/agent-profile/$1';
$route['admin/update-agent/(:any)/(:any)']    = 'AdminController/get_page/add-agent/$2/$3';
$route['admin/delete-user/(:any)']            = 'AdminController/delete_user/$1';
$route['admin/orders']                        = 'AdminController/get_page/orders';
$route['admin/single-order/(:any)']           = 'AdminController/get_page/single-order/$1';
$route['admin/add-holidays']                  = 'AdminController/get_page/add-holidays';
$route['admin/update-holidays/(:any)']        = 'AdminController/get_page/add-holidays/$1';
$route['admin/holiday-calendar']              = 'AdminController/get_page/holiday_calendar';
$route['admin/dashboard']                     = 'AdminController/dashboard';
$route['admin/customer/(:any)/(:any)']        = 'AdminController/customer_profile/$1/$2';
$route['admin/order-reports']                 = 'AdminController/get_page/order-reports';
$route['admin/agent-reports']                 = 'AdminController/get_page/agent-reports';
$route['admin/customer-reports']              = 'AdminController/get_page/customer-reports';
$route['admin/collection-reports']            = 'AdminController/get_page/collection-reports';






