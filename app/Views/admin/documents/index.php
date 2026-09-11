<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-file-pdf me-2"></i>Kelola Dokumen Sekolah</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDocumentModal">
        <i class="fas fa-plus me-1"></i> Unggah Dokumen Baru
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
                        <th>Judul Dokumen</th>
                        <th>File Asli</th>
                        <th>Ekstensi / Ukuran</th>
                        <th>Diunduh</th>
                        <th>Pengunggah</th>
                        <th>Status</th>
                        <th style="width: 100px;" class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($documents)) : ?>
                        <?php $no = 1; foreach ($documents as $doc) : ?>
                            <tr>
                                <td class="ps-4"><?= $no++ ?></td>
                                <td>
                                    <strong><?= esc($doc->title) ?></strong>
                                    <br>
                                    <small class="text-muted"><?= esc($doc->description ?? '-') ?></small>
                                </td>
                                <td><small class="text-primary"><i class="fas fa-paperclip me-1"></i><?= esc($doc->original_name) ?></small></td>
                                <td>
                                    <span class="badge bg-light text-dark border me-1"><?= strtoupper(esc($doc->extension)) ?></span>
                                    <small class="text-muted"><?= round($doc->file_size / 1024, 2) ?> KB</small>
                                </td>
                                <td><small><i class="fas fa-download me-1"></i><?= $doc->download_count ?>x</small></td>
                                <td><small><?= esc($doc->uploader_name ?? 'Sistem') ?></small></td>
                                <td>
                                    <span class="badge bg-<?= $doc->status === 'active' ? 'success' : 'secondary' ?>">
                                        <?= esc($doc->status) ?>
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="/admin/documents/delete/<?= $doc->id ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini?');"
                                       title="Hapus Dokumen">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">
                                Belum ada dokumen publik yang diunggah.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Unggah Dokumen -->
<div class="modal fade" id="addDocumentModal" tabindex="-1" aria-labelledby="addDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="/admin/documents/store" method="post" enctype="multipart/form-data" class="modal-content">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h5 class="modal-title" id="addDocumentModalLabel">Unggah Dokumen Publik Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Judul Dokumen <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Contoh: Kalender Akademik 2026/2027" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Deskripsi Dokumen</label>
                    <textarea class="form-control" id="description" name="description" rows="2" placeholder="Penjelasan singkat isi dokumen..."></textarea>
                </div>
                <div class="mb-3">
                    <label for="file" class="form-label">Pilih File Dokumen <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" id="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.zip,.rar" required>
                    <small class="text-muted d-block mt-1">Format diizinkan: PDF, DOC, DOCX, XLS, XLSX, ZIP, RAR. Maksimal 10 MB.</small>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status Tampil</label>
                    <select class="form-select" id="status" name="status">
                        <option value="active">Active (Tampil di Pusat Unduhan)</option>
                        <option value="inactive">Inactive (Sembunyikan)</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Unggah Dokumen</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>