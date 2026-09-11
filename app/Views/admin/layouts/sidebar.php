<?php
// Helper sederhana untuk menentukan class 'active' berdasarkan URI Path saat ini
$uri = service('uri');
$currentSegment = $uri->getSegment(2); // Ambil segment kedua setelah 'admin' (misal: 'articles', 'pages')
?>

<nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse border-end min-vh-100 p-3">
    <!-- MENU UTAMA (Bisa diakses Admin & Author) -->
    <div class="mb-3 ps-2 text-uppercase text-muted fw-bold small">Main Menu</div>
    <ul class="nav flex-column mb-3">
        <li class="nav-item mb-1">
            <a href="/admin/dashboard" class="nav-link rounded <?= ($currentSegment === 'dashboard' || $currentSegment === '') ? 'active bg-primary text-white' : 'text-dark' ?>">
                <i class="fas fa-tachometer-alt me-2 <?= ($currentSegment === 'dashboard' || $currentSegment === '') ? 'text-white' : 'text-primary' ?>"></i> Dashboard
            </a>
        </li>
        <li class="nav-item mb-1">
            <a href="/admin/articles" class="nav-link rounded <?= ($currentSegment === 'articles') ? 'active bg-primary text-white' : 'text-dark' ?>">
                <i class="fas fa-newspaper me-2 <?= ($currentSegment === 'articles') ? 'text-white' : 'text-success' ?>"></i> Artikel
            </a>
        </li>
    </ul>

    <!-- MENU KHUSUS SUPER ADMIN / ADMIN UTAMA (role_id == 1) -->
    <?php if (session()->get('role_id') == 1) : ?>
        <div class="mb-2 ps-2 text-uppercase text-muted fw-bold small">Konten & Media</div>
        <ul class="nav flex-column mb-3">
            <li class="nav-item mb-1">
                <a href="/admin/categories" class="nav-link rounded <?= ($currentSegment === 'categories') ? 'active bg-primary text-white' : 'text-dark' ?>">
                    <i class="fas fa-tags me-2 <?= ($currentSegment === 'categories') ? 'text-white' : 'text-info' ?>"></i> Kategori
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="/admin/pages" class="nav-link rounded <?= ($currentSegment === 'pages') ? 'active bg-primary text-white' : 'text-dark' ?>">
                    <i class="fas fa-file-alt me-2 <?= ($currentSegment === 'pages') ? 'text-white' : 'text-secondary' ?>"></i> Halaman Statis
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="/admin/gallery" class="nav-link rounded <?= ($currentSegment === 'gallery') ? 'active bg-primary text-white' : 'text-dark' ?>">
                    <i class="fas fa-images me-2 <?= ($currentSegment === 'gallery') ? 'text-white' : 'text-warning' ?>"></i> Galeri Foto
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="/admin/documents" class="nav-link rounded <?= ($currentSegment === 'documents') ? 'active bg-primary text-white' : 'text-dark' ?>">
                    <i class="fas fa-file-pdf me-2 <?= ($currentSegment === 'documents') ? 'text-white' : 'text-danger' ?>"></i> Dokumen
                </a>
            </li>
        </ul>

        <div class="mb-2 ps-2 text-uppercase text-muted fw-bold small">Tampilan & Interaksi</div>
        <ul class="nav flex-column mb-3">
            <li class="nav-item mb-1">
                <a href="/admin/banners" class="nav-link rounded <?= ($currentSegment === 'banners') ? 'active bg-primary text-white' : 'text-dark' ?>">
                    <i class="fas fa-sliders-h me-2 <?= ($currentSegment === 'banners') ? 'text-white' : 'text-primary' ?>"></i> Hero Banner
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="/admin/menus" class="nav-link rounded <?= ($currentSegment === 'menus') ? 'active bg-primary text-white' : 'text-dark' ?>">
                    <i class="fas fa-sitemap me-2 <?= ($currentSegment === 'menus') ? 'text-white' : 'text-dark' ?>"></i> Menu Navigasi
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="/admin/contact-messages" class="nav-link rounded <?= ($currentSegment === 'contact-messages') ? 'active bg-primary text-white' : 'text-dark' ?>">
                    <i class="fas fa-envelope me-2 <?= ($currentSegment === 'contact-messages') ? 'text-white' : 'text-success' ?>"></i> Pesan Masuk
                </a>
            </li>
        </ul>

        <div class="mb-2 ps-2 text-uppercase text-muted fw-bold small">Sistem</div>
        <ul class="nav flex-column">
            <li class="nav-item mb-1">
                <a href="/admin/users" class="nav-link rounded <?= ($currentSegment === 'users') ? 'active bg-primary text-white' : 'text-dark' ?>">
                    <i class="fas fa-users me-2 <?= ($currentSegment === 'users') ? 'text-white' : 'text-info' ?>"></i> Pengguna & Author
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="/admin/settings" class="nav-link rounded <?= ($currentSegment === 'settings') ? 'active bg-primary text-white' : 'text-dark' ?>">
                    <i class="fas fa-cogs me-2 <?= ($currentSegment === 'settings') ? 'text-white' : 'text-secondary' ?>"></i> Pengaturan Website
                </a>
            </li>
            <li class="nav-item mb-1">
                <a href="/admin/activity-logs" class="nav-link rounded <?= ($currentSegment === 'activity-logs') ? 'active bg-primary text-white' : 'text-dark' ?>">
                    <i class="fas fa-history me-2 <?= ($currentSegment === 'activity-logs') ? 'text-white' : 'text-danger' ?>"></i> Activity Log
                </a>
            </li>
        </ul>
    <?php endif; ?>
</nav>