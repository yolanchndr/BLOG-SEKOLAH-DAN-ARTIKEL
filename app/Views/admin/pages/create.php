<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-plus-circle me-2"></i>Tambah Halaman Baru</h1>
    <a href="/admin/pages" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>

<?php if (session()->getFlashdata('errors')) : ?>
    <div class="alert alert-danger alert-dismissible fade show">
        <ul class="mb-0">
            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<form action="/admin/pages/store" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Halaman <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="<?= old('title') ?>" placeholder="Contoh: Sejarah Sekolah" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ringkasan Singkat (Excerpt)</label>
                        <textarea name="excerpt" class="form-control" rows="2"><?= old('excerpt') ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Isi Konten Halaman <span class="text-danger">*</span></label>
                        <textarea name="content" class="form-control" rows="12" required><?= old('content') ?></textarea>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light"><h6 class="mb-0 fw-bold">SEO Metadata</h6></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">SEO Title</label>
                        <input type="text" name="seo_title" class="form-control" value="<?= old('seo_title') ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SEO Description</label>
                        <textarea name="seo_description" class="form-control" rows="2"><?= old('seo_description') ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SEO Keywords</label>
                        <input type="text" name="seo_keywords" class="form-control" value="<?= old('seo_keywords') ?>" placeholder="profil, sejarah, visi misi">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light"><h6 class="mb-0 fw-bold">Atribut Penerbitan</h6></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="draft" <?= old('status') == 'draft' ? 'selected' : '' ?>>Draft</option>
                            <option value="published" <?= old('status') == 'published' ? 'selected' : '' ?>>Published</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Sampul (Gambar Banner)</label>
                        <input type="file" name="featured_image" class="form-control" accept="image/*">
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save me-1"></i> Simpan Halaman</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?= $this->endSection() ?>