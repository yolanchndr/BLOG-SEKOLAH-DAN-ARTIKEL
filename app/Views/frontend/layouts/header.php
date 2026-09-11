<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Website Resmi Sekolah') ?></title>
    <!-- FAVICON DINAMIS DARI LOGO SEKOLAH -->
    <?php if (!empty($site_profile->logo)) : ?>
        <link rel="shortcut icon" href="/<?= esc($site_profile->logo) ?>" type="image/x-icon">
        <link rel="icon" href="/<?= esc($site_profile->logo) ?>" type="image/png">
    <?php else : ?>
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <?php endif; ?>
    <meta name="description" content="<?= esc($site_profile->seo_desc_default ?? 'Selamat datang di Website Resmi Sekolah.') ?>">
    
    <!-- Bootstrap 5 CSS & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>