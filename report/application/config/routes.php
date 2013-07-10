<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
| There is one reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
*/

$route['default_controller'] = "admin";


/* End of file routes.php */
/* Location: ./application/config/routes.php */

$route['clients/add'] = "clients/add";
$route['clients/details/(:num)'] = "clients/details/$1";
$route['clients/edit/(:num)'] = "clients/edit/$1";
$route['clients/delete/(:num)'] = "clients/delete/$1";
$route['clients/get_location/(:num)'] = "clients/get_location/$1";
$route['clients/export'] = "clients/export";
$route['clients/export/(:any)'] = "clients/export";
$route['clients/(:any)'] = "clients/index";

$route['schedule/add'] = "schedule/add";
$route['schedule/edit/(:num)'] = "schedule/edit/$1";
$route['schedule/delete/(:num)'] = "schedule/delete/$1";
$route['schedule/isok/(:num)'] = "schedule/isok/$1";
$route['schedule/export'] = "schedule/export";
$route['schedule/export/(:any)'] = "schedule/export";
$route['schedule/checkedin'] = "schedule/checkedin";
$route['schedule/checkedin/(:any)'] = "schedule/checkedin";
$route['schedule/checkedplot'] = "schedule/checkedplot";
$route['schedule/checkedplot/(:any)'] = "schedule/checkedplot";

$route['comp/checkedplot'] = "comp/checkedplot";
$route['comp/checkedplot/(:any)'] = "comp/checkedplot";
$route['comp/complist'] = "comp/complist";
$route['comp/complist/(:any)'] = "comp/complist";

$route['opor/newO'] = "opor/newO";
$route['opor/newO/(:any)'] = "opor/newO";

$route['schedule/(:any)'] = "schedule/index";