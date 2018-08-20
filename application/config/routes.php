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
$route['default_controller']        = 'landing';
$route['berita/(:any)']             = 'landing/news';
$route['pengaduan/(:any)']          = 'landing/report';
$route['survei/(:any)']             = 'landing/survey';
$route['404_override']              = 'landing/error404';
$route['translate_uri_dashes']      = FALSE;

$route['552470907:AAEJH-qfehSs5W43JF5QWpwIp0i1kl7gjps/info']             = 'telegram/info';
$route['552470907:AAEJH-qfehSs5W43JF5QWpwIp0i1kl7gjps/set']              = 'telegram/set';
$route['552470907:AAEJH-qfehSs5W43JF5QWpwIp0i1kl7gjps/unset']            = 'telegram/unset';
$route['552470907:AAEJH-qfehSs5W43JF5QWpwIp0i1kl7gjps']                  = 'telegram/webhook';

$route['masuk']                         = 'panel/masuk';
$route['panel']                         = 'panel/dashboard';
$route['panel/akun']                    = 'panel/akun';
$route['panel/akun/(:any)']             = 'panel/akun';
$route['panel/berita/buatbaru']         = 'panel/buat_berita';
$route['panel/berita']                  = 'panel/daftar_berita';
$route['panel/berita/ubah/(:any)']      = 'panel/ubah_berita';
$route['panel/berita/(:any)']           = 'panel/daftar_berita';
$route['panel/berita/(:any)/(:any)']    = 'panel/daftar_berita';
$route['panel/survei/buatbaru']         = 'panel/buat_survei';
$route['panel/survei/hasil/(:any)']     = 'panel/hasil_survei';
$route['panel/survei']                  = 'panel/daftar_survei';
$route['panel/survei/(:any)']           = 'panel/daftar_survei';
$route['panel/pengaduan/detail/(:any)'] = 'panel/detail_pengaduan';
$route['panel/pengaduan']               = 'panel/daftar_pengaduan';
$route['panel/pengaduan/(:any)']        = 'panel/daftar_pengaduan';
$route['panel/pengaduan/(:any)/(:any)'] = 'panel/daftar_pengaduan';
$route['panel/pola/kontrol/(:any)']     = 'panel/kontrol_pola';
$route['panel/pola/kontrol']            = 'panel/kontrol_pola';
$route['panel/pola/detail/(:any)']      = 'panel/detail_pola';
$route['panel/pola/(:any)']             = 'panel/daftar_pola';
$route['panel/pola']                    = 'panel/daftar_pola';
$route['panel/perintah']                = 'panel/perintah';
$route['panel/operasi/buatbaru']        = 'panel/buat_operasi';
$route['panel/operasi/ubah/(:any)']     = 'panel/ubah_operasi';
$route['panel/operasi']                 = 'panel/daftar_operasi';
$route['panel/operasi/(:any)']          = 'panel/daftar_operasi';

$route['captcha']           = 'request/captcha';
$route['auth/login']        = 'request/login';
$route['auth/logout']       = 'request/logout';
$route['req/acc/add']       = 'request/account_add';
$route['req/acc/update']    = 'request/account_update';
$route['req/acc']           = 'request/account_get_by_id';
$route['req/acc/delete']    = 'request/account_delete_by_id';
$route['req/news/add']      = 'request/news_add';
$route['req/news/delete']   = 'request/news_delete_by_id';
$route['req/news/update']   = 'request/news_update';
$route['req/survey/add']    = 'request/survey_add';
$route['req/survey/delete'] = 'request/survey_delete_by_id';
$route['req/report/refresh']    = 'request/report_refresh';
$route['req/discuss/start']     = 'request/start_discussion';
$route['req/discuss/stop']      = 'request/stop_discussion';
$route['req/response/add']      = 'request/add_response';
$route['req/report/changestat'] = 'request/change_report_status';
$route['req/path_control/clear']= 'request/clear_operation';

