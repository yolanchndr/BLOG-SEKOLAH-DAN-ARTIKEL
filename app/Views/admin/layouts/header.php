<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FAVICON LOGO SEKOLAH UNTUK ADMIN -->
    <?php 
        // Mengambil profil sekolah dari database jika belum di-pass oleh controller
        $schoolModel = new \App\Models\SchoolProfileModel();
        $schoolProfile = $schoolModel->find(1);
    ?>
    <?php if (!empty($schoolProfile->logo)) : ?>
        <link rel="shortcut icon" href="/<?= esc($schoolProfile->logo) ?>" type="image/x-icon">
        <link rel="icon" href="/<?= esc($schoolProfile->logo) ?>" type="image/png">
    <?php endif; ?>
    <title><?= esc($title ?? 'Admin Panel') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

    <!-- Navbar Atas -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand" href="/admin/dashboard">Admin Sekolah</a>
            <div class="navbar-nav ms-auto">
                <span class="nav-item nav-link text-light">Halo, <?= esc(session()->get('name')) ?></span>
                <a class="nav-link text-danger" href="/auth/logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </nav>