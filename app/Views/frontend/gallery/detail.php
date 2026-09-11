<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
            <li class="breadcrumb-item"><a href="/galeri">Galeri Foto</a></li>
            <li class="breadcrumb-item active"><?= esc($album->name) ?></li>
        </ol>
    </nav>

    <div class="mb-4">
        <h2 class="fw-bold mb-1"><i class="fas fa-images me-2 text-primary"></i><?= esc($album->name) ?></h2>
        <p class="text-muted"><?= esc($album->description ?? 'Dokumentasi foto kegiatan sekolah.') ?></p>
    </div>

    <div class="row">
        <?php if (!empty($photos)) : ?>
            <?php foreach ($photos as $photo) : ?>
                <div class="col-md-3 col-sm-6 mb-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <a href="/<?= esc($photo->file_path . $photo->stored_name) ?>" target="_blank">
                            <img src="/<?= esc($photo->file_path . $photo->stored_name) ?>" class="card-img-top rounded-top" style="height: 200px; object-fit: cover;" alt="Foto Galeri">
                        </a>
                        <?php if ($photo->caption) : ?>
                            <div class="card-body p-2 text-center bg-light">
                                <small class="text-muted d-block"><?= esc($photo->caption) ?></small>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col-12 text-center text-muted py-5">
                Belum ada foto di dalam album ini.
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>