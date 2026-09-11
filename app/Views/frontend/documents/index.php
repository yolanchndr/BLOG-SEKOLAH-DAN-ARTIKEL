<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
            <li class="breadcrumb-item active">Dokumen Sekolah</li>
        </ol>
    </nav>

    <h2 class="fw-bold mb-4"><i class="fas fa-file-download me-2 text-primary"></i>Pusat Unduhan Dokumen</h2>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Judul Dokumen</th>
                            <th>Deskripsi</th>
                            <th>Ukuran File</th>
                            <th>Diunduh</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($documents)) : foreach ($documents as $doc) : ?>
                            <tr>
                                <td class="ps-4">
                                    <strong class="d-block"><?= esc($doc->title) ?></strong>
                                    <small class="text-uppercase text-muted"><i class="fas fa-file me-1"></i><?= esc($doc->extension) ?></small>
                                </td>
                                <td><small class="text-muted"><?= esc($doc->description ?? '-') ?></small></td>
                                <td><small><?= round($doc->file_size / 1024, 2) ?> KB</small></td>
                                <td><small><?= $doc->download_count ?> kali</small></td>
                                <td class="text-end pe-4">
                                    <a href="/dokumen/download/<?= esc($doc->slug) ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-download me-1"></i> Unduh
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; else : ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada dokumen yang tersedia untuk diunduh.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>