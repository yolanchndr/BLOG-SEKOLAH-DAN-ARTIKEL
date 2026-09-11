<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-images me-2"></i>Kelola Galeri Foto</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAlbumModal">
        <i class="fas fa-plus me-1"></i> Buat Album Baru
    </button>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show"><?= session()->getFlashdata('success') ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="row">
    <?php if (!empty($albums)) : foreach ($albums as $album) : ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <img src="/<?= esc($album->cover_image) ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="Cover">
                <div class="card-body">
                    <h5 class="card-title fw-bold"><?= esc($album->name) ?></h5>
                    <p class="card-text text-muted small"><?= esc($album->description) ?></p>
                </div>
                <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                    <a href="/admin/gallery/photos/<?= $album->id ?>" class="btn btn-sm btn-outline-primary"><i class="fas fa-folder-open me-1"></i> Kelola Foto</a>
                    <span class="badge bg-<?= $album->status === 'active' ? 'success' : 'secondary' ?>"><?= esc($album->status) ?></span>
                </div>
            </div>
        </div>
    <?php endforeach; else : ?>
        <div class="col-12 text-center text-muted py-5">Belum ada album galeri.</div>
    <?php endif; ?>
</div>

<!-- Modal Tambah Album -->
<div class="modal fade" id="addAlbumModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="/admin/gallery/store-album" method="post" enctype="multipart/form-data" class="modal-content">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h5 class="modal-title">Tambah Album Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Album *</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="2"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Foto Sampul Album *</label>
                    <input type="file" name="cover_image" class="form-control" accept="image/*" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan Album</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>