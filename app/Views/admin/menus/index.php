<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-sitemap me-2"></i>Kelola Menu Navigasi</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMenuModal">
        <i class="fas fa-plus me-1"></i> Tambah Menu Baru
    </button>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Nama Menu</th>
                        <th>URL / Link Target</th>
                        <th>Target Window</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($parent_menus)) : ?>
                        <?php foreach ($parent_menus as $menu) : ?>
                            <!-- Parent Menu Row -->
                            <tr class="table-active fw-bold">
                                <td class="ps-4">
                                    <i class="<?= esc($menu->icon ?? 'fas fa-link') ?> me-2 text-primary"></i>
                                    <?= esc($menu->name) ?>
                                </td>
                                <td><code><?= esc($menu->url) ?></code></td>
                                <td><span class="badge bg-secondary"><?= esc($menu->target) ?></span></td>
                                <td><?= $menu->sort_order ?></td>
                                <td>
                                    <span class="badge bg-<?= $menu->status === 'active' ? 'success' : 'danger' ?>">
                                        <?= esc($menu->status) ?>
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="/admin/menus/delete/<?= $menu->id ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Menghapus menu parent ini akan menghapus seluruh submenunya. Lanjutkan?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>

                            <!-- Submenu Rows -->
                            <?php if (!empty($menu->submenus)) : ?>
                                <?php foreach ($menu->submenus as $sub) : ?>
                                    <tr>
                                        <td class="ps-5">
                                            <i class="fas fa-level-up-alt fa-rotate-90 me-2 text-muted"></i>
                                            <i class="<?= esc($sub->icon ?? 'fas fa-angle-right') ?> me-1 text-secondary"></i>
                                            <?= esc($sub->name) ?>
                                        </td>
                                        <td><code><?= esc($sub->url) ?></code></td>
                                        <td><span class="badge bg-light text-dark"><?= esc($sub->target) ?></span></td>
                                        <td><?= $sub->sort_order ?></td>
                                        <td>
                                            <span class="badge bg-<?= $sub->status === 'active' ? 'success' : 'danger' ?>">
                                                <?= esc($sub->status) ?>
                                            </span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <a href="/admin/menus/delete/<?= $sub->id ?>" 
                                               class="btn btn-sm btn-outline-danger" 
                                               onclick="return confirm('Hapus submenu ini?');">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                Belum ada menu navigasi yang dibuat.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Menu -->
<div class="modal fade" id="addMenuModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="/admin/menus/store" method="post" class="modal-content">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h5 class="modal-title">Tambah Menu Navigasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Parent Menu</label>
                    <select name="parent_id" class="form-select">
                        <option value="">-- Tidak Ada (Jadikan Menu Utama) --</option>
                        <?php foreach ($all_parents as $parent) : ?>
                            <option value="<?= $parent->id ?>"><?= esc($parent->name) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <small class="text-muted">Pilih parent jika ingin menjadikan menu ini sebagai Submenu.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama Menu <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" placeholder="Contoh: Profil Sekolah" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">URL / Link Tujuan <span class="text-danger">*</span></label>
                    <input type="text" name="url" class="form-control" placeholder="Contoh: /halaman/profil atau https://..." required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Target Window</label>
                        <select name="target" class="form-select">
                            <option value="_self">Halaman Sama (_self)</option>
                            <option value="_blank">Tab Baru (_blank)</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor Urutan</label>
                        <input type="number" name="sort_order" class="form-control" value="0">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Icon (FontAwesome Class)</label>
                        <input type="text" name="icon" class="form-control" placeholder="fas fa-home">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan Menu</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>