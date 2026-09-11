<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<!-- Summernote CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-pen me-2"></i>Tambah Artikel Baru</h1>
    <a href="/admin/articles" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<!-- Form Konten Artikel -->
<form action="/admin/articles/store" method="post" enctype="multipart/form-data">
    <?= csrf_field() ?>

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="title" class="form-label font-weight-bold">Judul Artikel <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= old('title') ?>" placeholder="Masukkan judul artikel..." required>
                    </div>

                    <div class="mb-3">
                        <label for="excerpt" class="form-label">Ringkasan / Excerpt</label>
                        <textarea class="form-control" id="excerpt" name="excerpt" rows="3" placeholder="Ringkasan singkat berita..."><?= old('excerpt') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Isi Artikel <span class="text-danger">*</span></label>
                        <!-- Textarea yang diubah menjadi Summernote Editor -->
                        <textarea class="form-control" id="summernote" name="content" rows="12" required><?= old('content') ?></textarea>
                    </div>
                </div>
            </div>
            
            <!-- Panel SEO Metadata -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="fas fa-search me-2"></i>Pengaturan SEO Metadata</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="seo_title" class="form-label">SEO Title</label>
                        <input type="text" class="form-control" id="seo_title" name="seo_title" value="<?= old('seo_title') ?>" placeholder="Kosongkan jika disamakan judul artikel">
                    </div>

                    <div class="mb-3">
                        <label for="seo_description" class="form-label">SEO Description</label>
                        <textarea class="form-control" id="seo_description" name="seo_description" rows="2" placeholder="Deskripsi untuk mesin pencari Google..."><?= old('seo_description') ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel Kanan -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="fas fa-cog me-2"></i>Publikasi & Kategori</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category->id ?>" <?= old('category_id') == $category->id ? 'selected' : '' ?>>
                                    <?= esc($category->name) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status Penerbitan <span class="text-danger">*</span></label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="draft" <?= old('status') == 'draft' ? 'selected' : '' ?>>Draft</option>
                            <option value="published" <?= old('status') == 'published' ? 'selected' : '' ?>>Published</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="featured_image" class="form-label">Foto Sampul <span class="text-danger">*</span></label>
                        <input class="form-control" type="file" id="featured_image" name="featured_image" accept="image/*" required>
                    </div>

                    <hr>
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save me-1"></i> Simpan Artikel</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- jQuery & Summernote JS CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Tulis isi artikel lengkap di sini...',
            tabsize: 2,
            height: 350,
            toolbar: [
                ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
<?= $this->endSection() ?>