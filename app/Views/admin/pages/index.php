<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-file-alt me-2"></i>Kelola Halaman Statis</h1>
    <a href="/admin/pages/create" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Tambah Halaman Baru
    </a>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show"><?= session()->getFlashdata('success') ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Judul Halaman</th>
                        <th>URL Slug</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Tanggal Dibuat</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($pages)) : foreach ($pages as $page) : ?>
                        <tr>
                            <td class="ps-4">
                                <strong><?= esc($page->title) ?></strong>
                            </td>
                            <td><code>/halaman/<?= esc($page->slug) ?></code></td>
                            <td><small><?= esc($page->author_name ?? 'Anonim') ?></small></td>
                            <td>
                                <span class="badge bg-<?= $page->status === 'published' ? 'success' : 'warning text-dark' ?>">
                                    <?= esc($page->status) ?>
                                </span>
                            </td>
                            <td><small><?= date('d M Y', strtotime($page->created_at)) ?></small></td>
                            <td class="text-end pe-4">
                                <a href="/admin/pages/edit/<?= $page->id ?>" class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-edit"></i> Edit</a>
                                <a href="/admin/pages/delete/<?= $page->id ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus halaman ini?');"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; else : ?>
                        <tr><td colspan="6" class="text-center text-muted py-4">Belum ada halaman statis yang dibuat.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>