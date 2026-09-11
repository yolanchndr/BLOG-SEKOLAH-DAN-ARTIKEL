<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
            <li class="breadcrumb-item active">Galeri Foto</li>
        </ol>
    </nav>

    <h2 class="fw-bold mb-4"><i class="fas fa-images me-2 text-primary"></i>Galeri Foto Sekolah</h2>

    <div class="row">
        <?php if (!empty($albums)) : foreach ($albums as $album) : ?>
            <div class="col-md-4 mb-4">
                <a href="/galeri/<?= esc($album->slug) ?>" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm hover-shadow">
                        <img src="/<?= esc($album->cover_image) ?>" class="card-img-top" style="height: 220px; object-fit: cover;" alt="Cover">
                        <div class="card-body">
                            <h5 class="card-title fw-bold text-dark mb-1"><?= esc($album->name) ?></h5>
                            <p class="card-text text-muted small"><?= esc($album->description) ?></p>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; else : ?>
            <div class="col-12 text-center text-muted py-5">Belum ada album galeri foto.</div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>