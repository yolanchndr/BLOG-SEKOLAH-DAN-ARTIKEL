<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-edit me-2"></i>Edit Halaman Statis</h1>
    <a href="/admin/pages" class="btn btn-outline-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
</div>

<form action="/admin/pages/update/<?= $page->id ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Halaman <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="<?= esc(old('title', $page->title)) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ringkasan Singkat (Excerpt)</label>
                        <textarea name="excerpt" class="form-control" rows="2"><?= esc(old('excerpt', $page->excerpt)) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Isi Konten Halaman <span class="text-danger">*</span></label>
                        <textarea name="content" class="form-control" rows="12" required><?= esc(old('content', $page->content)) ?></textarea>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light"><h6 class="mb-0 fw-bold">SEO Metadata</h6></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">SEO Title</label>
                        <input type="text" name="seo_title" class="form-control" value="<?= esc(old('seo_title', $page->seo_title)) ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SEO Description</label>
                        <textarea name="seo_description" class="form-control" rows="2"><?= esc(old('seo_description', $page->seo_description)) ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SEO Keywords</label>
                        <input type="text" name="seo_keywords" class="form-control" value="<?= esc(old('seo_keywords', $page->seo_keywords)) ?>">
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
                            <option value="draft" <?= old('status', $page->status) == 'draft' ? 'selected' : '' ?>>Draft</option>
                            <option value="published" <?= old('status', $page->status) == 'published' ? 'selected' : '' ?>>Published</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gambar Sampul</label>
                        <?php if ($page->featured_image) : ?>
                            <img src="/<?= esc($page->featured_image) ?>" class="img-thumbnail d-block mb-2" style="max-height: 120px;">
                        <?php endif; ?>
                        <input type="file" name="featured_image" class="form-control" accept="image/*">
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save me-1"></i> Perbarui Halaman</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?= $this->endSection() ?>