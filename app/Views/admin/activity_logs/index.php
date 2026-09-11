<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-history me-2"></i>Catatan Aktivitas Sistem</h1>
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

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;" class="ps-4">No</th>
                        <th>Waktu</th>
                        <th>Pengguna</th>
                        <th>Aksi</th>
                        <th>Modul</th>
                        <th>Deskripsi</th>
                        <th class="pe-4">IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($logs)) : ?>
                        <?php $no = 1; foreach ($logs as $log) : ?>
                            <tr>
                                <td class="ps-4"><?= $no++ ?></td>
                                <td><small class="text-muted"><i class="fas fa-clock me-1"></i><?= date('d/m/Y H:i:s', strtotime($log->created_at)) ?></small></td>
                                <td>
                                    <strong><?= esc($log->user_name ?? 'Sistem / Guest') ?></strong>
                                    <?php if (!empty($log->username)) : ?>
                                        <small class="text-muted d-block">@<?= esc($log->username) ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                        $badgeColor = 'secondary';
                                        if ($log->action === 'create') $badgeColor = 'success';
                                        elseif ($log->action === 'update') $badgeColor = 'warning text-dark';
                                        elseif ($log->action === 'delete') $badgeColor = 'danger';
                                        elseif ($log->action === 'login') $badgeColor = 'info text-dark';
                                    ?>
                                    <span class="badge bg-<?= $badgeColor ?>"><?= strtoupper(esc($log->action)) ?></span>
                                </td>
                                <td><span class="badge bg-light text-dark border"><?= esc($log->module) ?></span></td>
                                <td><small><?= esc($log->description) ?></small></td>
                                <td class="pe-4"><code><?= esc($log->ip_address ?? '-') ?></code></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">
                                Belum ada riwayat aktivitas yang tercatat.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if (isset($pager)) : ?>
        <div class="card-footer bg-white border-0 pt-3">
            <?= $pager->links() ?>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>