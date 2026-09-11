<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==========================================
// 1. PUBLIC FRONTEND ROUTES
// ==========================================

// Homepage
$routes->get('/', 'HomeController::index');

// Berita / Artikel Publik
$routes->get('artikel', 'ArticlePublicController::index');
$routes->get('artikel/(:segment)', 'ArticlePublicController::detail/$1');
$routes->get('artikel/attachment/download/(:num)', 'ArticlePublicController::downloadAttachment/$1');
$routes->get('artikel', 'ArticlePublicController::index');
$routes->get('artikel/(:segment)', 'ArticlePublicController::detail/$1');
$routes->get('artikel/attachment/download/(:num)', 'ArticlePublicController::downloadAttachment/$1');
$routes->get('kategori/(:segment)', 'ArticlePublicController::category/$1');

// Halaman Statis Publik (Sejarah, Visi-Misi, Profil)
$routes->get('halaman/(:segment)', 'PagePublicController::detail/$1');
$routes->get('profil', 'PagePublicController::detail/profil');

// Galeri Foto Publik
$routes->get('galeri', 'GalleryPublicController::index');
$routes->get('galeri/(:segment)', 'GalleryPublicController::detail/$1');

// Pusat Unduhan Dokumen Publik
$routes->get('dokumen', 'DocumentPublicController::index');
$routes->get('dokumen/download/(:segment)', 'DocumentPublicController::download/$1');

// Form Kontak / Pesan Publik
$routes->get('kontak', 'ContactPublicController::index');
$routes->post('kontak/kirim', 'ContactPublicController::send');

// ==========================================
// 2. AUTHENTICATION ROUTES
// ==========================================
$routes->get('auth/login', 'AuthController::login');
$routes->post('auth/attempt', 'AuthController::attemptLogin');
$routes->get('auth/logout', 'AuthController::logout');

// ==========================================
// 3. ADMIN PANEL ROUTES (PROTECTED BY AUTH)
// ==========================================
$routes->group('admin', ['filter' => 'auth'], function ($routes) {

    // ------------------------------------------
    // A. BISA DIAKSES OLEH SEMUA ROLE (ADMIN & AUTHOR)
    // ------------------------------------------
    
    // Dashboard
    $routes->get('dashboard', 'Admin\DashboardController::index');

    // Pengelolaan Artikel (Author hanya bisa mengelola artikel miliknya sendiri)
    $routes->get('articles', 'Admin\ArticleController::index');
    $routes->get('articles/create', 'Admin\ArticleController::create');
    $routes->post('articles/store', 'Admin\ArticleController::store');
    $routes->get('articles/delete/(:num)', 'Admin\ArticleController::delete/$1');

    // ------------------------------------------
    // B. KHUSUS SUPER ADMIN / ADMIN UTAMA (role:1)
    // ------------------------------------------
    $routes->group('', ['filter' => 'role:1'], function ($routes) {

        // Pengelolaan Kategori Artikel
        $routes->get('categories', 'Admin\CategoryController::index');
        $routes->post('categories/store', 'Admin\CategoryController::store');
        $routes->get('categories/delete/(:num)', 'Admin\CategoryController::delete/$1');

        // Pengelolaan Halaman Statis
        $routes->get('pages', 'Admin\PageController::index');
        $routes->get('pages/create', 'Admin\PageController::create');
        $routes->post('pages/store', 'Admin\PageController::store');
        $routes->get('pages/edit/(:num)', 'Admin\PageController::edit/$1');
        $routes->post('pages/update/(:num)', 'Admin\PageController::update/$1');
        $routes->get('pages/delete/(:num)', 'Admin\PageController::delete/$1');

        // Pengelolaan Galeri & Album Foto
        $routes->get('gallery', 'Admin\GalleryController::index');
        $routes->post('gallery/store-album', 'Admin\GalleryController::storeAlbum');
        $routes->get('gallery/photos/(:num)', 'Admin\GalleryController::photos/$1');
        $routes->post('gallery/upload-photo/(:num)', 'Admin\GalleryController::uploadPhoto/$1');
        $routes->get('gallery/delete-photo/(:num)', 'Admin\GalleryController::deletePhoto/$1');

        // Pengelolaan Dokumen Publik
        $routes->get('documents', 'Admin\DocumentController::index');
        $routes->post('documents/store', 'Admin\DocumentController::store');
        $routes->get('documents/delete/(:num)', 'Admin\DocumentController::delete/$1');

        // Kotak Masuk Pesan Kontak
        $routes->get('contact-messages', 'Admin\ContactMessageController::index');
        $routes->get('contact-messages/detail/(:num)', 'Admin\ContactMessageController::detail/$1');
        $routes->get('contact-messages/delete/(:num)', 'Admin\ContactMessageController::delete/$1');

        // Pengaturan Website & Profil Sekolah
        $routes->get('settings', 'Admin\SettingController::index');
        $routes->post('settings/update-profile', 'Admin\SettingController::updateProfile');
        $routes->post('settings/store-sosmed', 'Admin\SettingController::storeSosmed');
        $routes->get('settings/delete-sosmed/(:num)', 'Admin\SettingController::deleteSosmed/$1');

        // Pengelolaan Menu Navigasi Bertingkat
        $routes->get('menus', 'Admin\MenuController::index');
        $routes->post('menus/store', 'Admin\MenuController::store');
        $routes->get('menus/delete/(:num)', 'Admin\MenuController::delete/$1');

        // Pengelolaan Hero Banner / Slider
        $routes->get('banners', 'Admin\BannerController::index');
        $routes->post('banners/store', 'Admin\BannerController::store');
        $routes->get('banners/delete/(:num)', 'Admin\BannerController::delete/$1');

        // Pengelolaan Pengguna & Author
        $routes->get('users', 'Admin\UserController::index');
        $routes->post('users/store', 'Admin\UserController::store');
        $routes->get('users/delete/(:num)', 'Admin\UserController::delete/$1');

        // Catatan Aktivitas Sistem (Activity Logs / Audit Trail)
        $routes->get('activity-logs', 'Admin\ActivityLogController::index');
    });
});