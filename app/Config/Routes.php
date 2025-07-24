<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'LoginFilter']);
$routes->get('/tbl_pk', 'Home::tbl_pk');
$routes->get('/tbl_lvl', 'Home::tbl_lvl');

// CMS
$routes->get('/cms', 'CMS::admin');
$routes->get('/cms/users', 'CMS::users');


// autotentikasi
$routes->get('/login', 'Otentikasi::index');
$routes->post('process', 'Otentikasi::process');
$routes->get('logout', 'Otentikasi::logout');

// Admin TU
$routes->get('/tu', 'TataUsaha::index', ['filter' => 'LoginFilter']);
$routes->get('/cTim', 'TataUsaha::create_tim', ['filter' => 'LoginFilter']);
$routes->get('/tTim', 'TataUsaha::tableTim');
$routes->post('/save_tim', 'TataUsaha::save');
$routes->post('/uTim', 'TataUsaha::upTim');
$routes->post('/subTim', 'TataUsaha::subTim');
$routes->get('/disTim', 'TataUsaha::displayTim');
$routes->post('/disTim', 'TataUsaha::delTim');
$routes->get('/tAnggota', 'TataUsaha::tambahAnggota');
$routes->post('/delAnggota', 'TataUsaha::delAnggota');
$routes->get('/tabAnggota', 'TataUsaha::tabAnggota');
$routes->post('/saveAngg', 'TataUsaha::save_anggota');

// Penilaian Mandiri
$routes->get('/soal_pengungkit', 'PenilaianMandiri::soal_pengungkit', ['filter' => 'LoginFilter']);
$routes->get('/soal_hasil', 'PenilaianMandiri::soal_hasil', ['filter' => 'LoginFilter']);
$routes->post('/soal/save', 'PenilaianMandiri::save');
$routes->post('/soal/savePK', 'PenilaianMandiri::savePK', ['filter' => 'LoginFilter']);
$routes->post('/soal/savelvl', 'PenilaianMandiri::savelvl', ['filter' => 'LoginFilter']);
$routes->get('/pm', 'PenilaianMandiri::index', ['filter' => 'LoginFilter']);
$routes->get('/prfl_satker', 'PenilaianMandiri::prfl_satker', ['filter' => 'LoginFilter']);
$routes->get('/dash_pm', 'PenilaianMandiri::dash', ['filter' => 'LoginFilter']);
$routes->post('/save_prfl_satker', 'PenilaianMandiri::save_prfl_satker');
$routes->post('/save_sk', 'PenilaianMandiri::save_sk');
$routes->post('/edit_sk', 'PenilaianMandiri::edit_sk');
$routes->get('/tombol', 'PenilaianMandiri::updateTombol');
$routes->get('/progress1', 'PenilaianMandiri::progress_1');
$routes->get('/progress2', 'PenilaianMandiri::progress_2');
$routes->post('/submit_pm', 'PenilaianMandiri::submit_pm');
$routes->post('/spm_pim', 'PenilaianMandiri::submit_pim');
$routes->post('/reverse_pm', 'PenilaianMandiri::reverse_pm');

// Auditor
$routes->get('/prfl', 'Auditor::index');
$routes->get('/riwayat', 'Auditor::riwayat');
$routes->get('/dash_pk', 'Auditor::dash');
