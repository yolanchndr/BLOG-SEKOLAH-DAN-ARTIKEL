<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-tags me-2"></i>Kelola Kategori Artikel</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        <i class="fas fa-plus me-1"></i> Tambah Kategori Baru
    </button>
</div>

<!-- Flash Message Notifikasi -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;" class="ps-4">No</th>
                        <th>Nama Kategori</th>
                        <th>Slug URL</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th style="width: 120px;" class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($categories)) : ?>
                        <?php $no = 1; foreach ($categories as $category) : ?>
                            <tr>
                                <td class="ps-4"><?= $no++ ?></td>
                                <td><strong><?= esc($category->name) ?></strong></td>
                                <td><code>/kategori/<?= esc($category->slug) ?></code></td>
                                <td><small class="text-muted"><?= esc($category->description ?? '-') ?></small></td>
                                <td>
                                    <span class="badge bg-<?= $category->status === 'active' ? 'success' : 'secondary' ?>">
                                        <?= esc($category->status) ?>
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="/admin/categories/delete/<?= $category->id ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');"
                                       title="Hapus Kategori">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Belum ada kategori yang dibuat.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/admin/categories/store" method="post" class="modal-content">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel">Tambah Kategori Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Contoh: Pengumuman" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi Singkat</label>
                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Penjelasan singkat kategori..."></textarea>
                </div>
                <div class="mb-3">
                    <label for="seo_title" class="form-label">SEO Title</label>
                    <input type="text" class="form-control" id="seo_title" name="seo_title" placeholder="Kosongkan jika disamakan nama kategori">
                </div>
                <div class="mb-3">
                    <label for="seo_description" class="form-label">SEO Description</label>
                    <textarea class="form-control" id="seo_description" name="seo_description" rows="2"></textarea>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select" id="status" name="status">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Kategori</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>