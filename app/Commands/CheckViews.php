<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class CheckViews extends BaseCommand
{
    protected $group       = 'Development';
    protected $name        = 'check:views';
    protected $description = 'Mengecek ketersediaan seluruh file View Admin yang dipanggil oleh Controller.';

    public function run(array $params)
    {
        CLI::write("===================================================", 'yellow');
        CLI::write("         PENGECEKAN FILE VIEW ADMIN (CI4)          ", 'yellow');
        CLI::write("===================================================\n", 'yellow');

        // Daftar pemanggilan view yang digunakan dalam Controller Admin & Auth
        $viewsToCheck = [
            'Layouts Base' => [
                'admin/layouts/main',
                'admin/layouts/header',
                'admin/layouts/sidebar',
                'admin/layouts/footer',
            ],
            'Authentication' => [
                'auth/login',
            ],
            'Dashboard' => [
                'admin/dashboard/index',
            ],
            'Articles & Categories' => [
                'admin/articles/index',
                'admin/articles/create',
                'admin/categories/index',
            ],
            'Pages (Halaman Statis)' => [
                'admin/pages/index',
                'admin/pages/create',
                'admin/pages/edit',
            ],
            'Gallery & Albums' => [
                'admin/gallery/index',
                'admin/gallery/photos',
            ],
            'Documents' => [
                'admin/documents/index',
            ],
            'Banners & Menus' => [
                'admin/banners/index',
                'admin/menus/index',
            ],
            'Contact Messages' => [
                'admin/contact/index',
                'admin/contact/detail',
            ],
            'Users & Settings' => [
                'admin/users/index',
                'admin/settings/index',
                'admin/activity_logs/index',
            ],
            'Frontend Public' => [
                'frontend/layouts/main',
                'frontend/layouts/header',
                'frontend/layouts/navbar',
                'frontend/layouts/footer',
                'frontend/home/index',
                'frontend/articles/index',
                'frontend/articles/detail',
                'frontend/pages/detail',
                'frontend/gallery/index',
                'frontend/gallery/detail',
                'frontend/documents/index',
                'frontend/contact/index',
            ],
        ];

        $missingCount = 0;
        $foundCount   = 0;

        foreach ($viewsToCheck as $groupName => $files) {
            CLI::write(" [{$groupName}]", 'light_cyan');

            foreach ($files as $file) {
                $filePath = APPPATH . 'Views/' . $file . '.php';

                if (file_exists($filePath)) {
                    CLI::write("   [OK] " . $file . ".php", 'green');
                    $foundCount++;
                } else {
                    CLI::write("   [MISSING] " . $file . ".php", 'red');
                    $missingCount++;
                }
            }
            CLI::write('');
        }

        CLI::write("===================================================", 'yellow');
        CLI::write(" HASIL PENGECEKAN:", 'white');
        CLI::write("  - View Ditemukan : {$foundCount}", 'green');
        
        if ($missingCount > 0) {
            CLI::write("  - View Hilang    : {$missingCount} (Akan menyebabkan ViewException!)", 'red');
            CLI::write("\nSilakan buat file view yang berstatus [MISSING] di atas.", 'yellow');
        } else {
            CLI::write("  - View Hilang    : 0", 'green');
            CLI::write("\nSelamat! Seluruh file View telah lengkap dan bebas dari ViewException.", 'light_green');
        }
        CLI::write("===================================================\n", 'yellow');
    }
}