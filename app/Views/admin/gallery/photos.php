<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h2"><i class="fas fa-images me-2"></i><?= esc($album->name) ?></h1>
        <p class="text-muted small mb-0"><?= esc($album->description) ?></p>
    </div>
    <div>
        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#uploadPhotoModal">
            <i class="fas fa-upload me-1"></i> Unggah Foto Baru
        </button>
        <a href="/admin/gallery" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali ke Album
        </a>
    </div>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show"><?= session()->getFlashdata('success') ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="row">
    <?php if (!empty($photos)) : foreach ($photos as $photo) : ?>
        <div class="col-md-3 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                <img src="/<?= esc($photo->file_path . $photo->stored_name) ?>" class="card-img-top" style="height: 180px; object-fit: cover;" alt="Photo">
                <?php if ($photo->caption) : ?>
                    <div class="card-body p-2 text-center">
                        <small class="text-muted"><?= esc($photo->caption) ?></small>
                    </div>
                <?php endif; ?>
                <div class="card-footer bg-white border-0 text-center">
                    <a href="/admin/gallery/delete-photo/<?= $photo->id ?>" class="btn btn-sm btn-outline-danger w-100" onclick="return confirm('Hapus foto ini?');">
                        <i class="fas fa-trash me-1"></i> Hapus Foto
                    </a>
                </div>
            </div>
        </div>
    <?php endforeach; else : ?>
        <div class="col-12 text-center text-muted py-5">
            Album ini belum memiliki foto. Silakan unggah foto baru.
        </div>
    <?php endif; ?>
</div>

<!-- Modal Upload Foto -->
<div class="modal fade" id="uploadPhotoModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="/admin/gallery/upload-photo/<?= $album->id ?>" method="post" enctype="multipart/form-data" class="modal-content">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h5 class="modal-title">Unggah Foto ke Album</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Pilih File Foto *</label>
                    <input type="file" name="photo" class="form-control" accept="image/*" required>
                    <small class="text-muted">Format: JPG, PNG, WEBP. Maksimal 3 MB.</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan / Caption Foto</label>
                    <input type="text" name="caption" class="form-control" placeholder="Contoh: Dokumen kegiatan pembukaan">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Unggah Foto</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>