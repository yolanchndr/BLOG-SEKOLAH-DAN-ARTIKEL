<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-envelope me-2"></i>Pesan Masuk</h1>
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
                        <th class="ps-3">Pengirim</th>
                        <th>Subjek</th>
                        <th>Status</th>
                        <th>Tanggal Kirim</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($messages)) : foreach ($messages as $msg) : ?>
                        <tr class="<?= $msg->status === 'unread' ? 'fw-bold table-light' : '' ?>">
                            <td class="ps-3">
                                <?= esc($msg->name) ?>
                                <small class="text-muted d-block"><?= esc($msg->email) ?></small>
                            </td>
                            <td><?= esc($msg->subject) ?></td>
                            <td>
                                <span class="badge bg-<?= $msg->status === 'unread' ? 'danger' : 'secondary' ?>">
                                    <?= esc($msg->status) ?>
                                </span>
                            </td>
                            <td><small><?= date('d M Y H:i', strtotime($msg->created_at)) ?></small></td>
                            <td class="text-center">
                                <a href="/admin/contact-messages/detail/<?= $msg->id ?>" class="btn btn-sm btn-outline-primary me-1"><i class="fas fa-eye"></i> Baca</a>
                                <a href="/admin/contact-messages/delete/<?= $msg->id ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus pesan ini?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; else : ?>
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada pesan masuk.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>