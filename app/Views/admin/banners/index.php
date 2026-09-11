<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-images me-2"></i>Kelola Banner / Hero Slider</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBannerModal">
        <i class="fas fa-plus me-1"></i> Tambah Banner Baru
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
                        <th class="ps-4">Gambar Slider</th>
                        <th>Judul & Subjudul</th>
                        <th>Tombol Aksi (CTA)</th>
                        <th>Jadwal Tayang</th>
                        <th>Urutan</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($banners)) : foreach ($banners as $banner) : ?>
                        <tr>
                            <td class="ps-4">
                                <img src="/<?= esc($banner->image) ?>" alt="Banner" class="img-thumbnail rounded" style="width: 120px; height: 60px; object-fit: cover;">
                            </td>
                            <td>
                                <strong><?= esc($banner->title ?? '-') ?></strong>
                                <small class="text-muted d-block"><?= esc($banner->subtitle ?? '-') ?></small>
                            </td>
                            <td>
                                <?php if ($banner->button_url) : ?>
                                    <a href="<?= esc($banner->button_url) ?>" target="_blank" class="btn btn-xs btn-outline-primary small">
                                        <i class="fas fa-link me-1"></i><?= esc($banner->button_text ?? 'Link') ?>
                                    </a>
                                <?php else : ?>
                                    <span class="text-muted small">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <small class="text-muted d-block">
                                    <i class="fas fa-calendar-alt me-1"></i>Mulai: <?= $banner->start_at ? date('d/m/Y H:i', strtotime($banner->start_at)) : 'Langsung' ?>
                                </small>
                                <small class="text-muted d-block">
                                    <i class="fas fa-calendar-check me-1"></i>Selesai: <?= $banner->end_at ? date('d/m/Y H:i', strtotime($banner->end_at)) : 'Tanpa Batas' ?>
                                </small>
                            </td>
                            <td><?= $banner->sort_order ?></td>
                            <td>
                                <span class="badge bg-<?= $banner->status === 'active' ? 'success' : 'secondary' ?>">
                                    <?= esc($banner->status) ?>
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <a href="/admin/banners/delete/<?= $banner->id ?>" 
                                   class="btn btn-sm btn-outline-danger" 
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus banner ini?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; else : ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Belum ada banner slider yang diunggah.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah Banner -->
<div class="modal fade" id="addBannerModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="/admin/banners/store" method="post" enctype="multipart/form-data" class="modal-content">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h5 class="modal-title">Tambah Banner / Slider Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Gambar Slider <span class="text-danger">*</span></label>
                    <input type="file" name="image" class="form-control" accept="image/*" required>
                    <small class="text-muted">Rekomendasi resolusi: 1920x600 px. Maksimal 3 MB.</small>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Judul Banner (Teks Utama)</label>
                        <input type="text" name="title" class="form-control" placeholder="Contoh: Penerimaan Peserta Didik Baru">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Subjudul (Teks Pendukung)</label>
                        <input type="text" name="subtitle" class="form-control" placeholder="Contoh: Tahun Ajaran 2026/2027">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Teks Tombol Aksi (CTA)</label>
                        <input type="text" name="button_text" class="form-control" placeholder="Contoh: Daftar Sekarang">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">URL Tujuan Tombol</label>
                        <input type="text" name="button_url" class="form-control" placeholder="Contoh: /halaman/ppdb atau https://...">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jadwal Mulai Tampil</label>
                        <input type="datetime-local" name="start_at" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jadwal Selesai Tampil</label>
                        <input type="datetime-local" name="end_at" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor Urutan Tampil</label>
                        <input type="number" name="sort_order" class="form-control" value="0">
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
                <button type="submit" class="btn btn-primary">Simpan Banner</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>