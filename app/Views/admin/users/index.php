<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-users me-2"></i>Kelola Pengguna & Author</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
        <i class="fas fa-user-plus me-1"></i> Tambah Pengguna Baru
    </button>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show"><?= session()->getFlashdata('success') ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show"><?= session()->getFlashdata('error') ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Avatar</th>
                        <th>Nama & Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)) : foreach ($users as $user) : ?>
                        <tr>
                            <td class="ps-4">
                                <?php if ($user->avatar) : ?>
                                    <img src="/<?= esc($user->avatar) ?>" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                <?php else : ?>
                                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                        <i class="fas fa-user"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?= esc($user->name) ?></strong>
                                <small class="text-muted d-block">@<?= esc($user->username) ?></small>
                            </td>
                            <td><small><?= esc($user->email) ?></small></td>
                            <td><span class="badge bg-info text-dark"><?= esc($user->role_name ?? 'User') ?></span></td>
                            <td><small><?= esc($user->job_title ?? '-') ?></small></td>
                            <td>
                                <span class="badge bg-<?= $user->status === 'active' ? 'success' : 'danger' ?>">
                                    <?= esc($user->status) ?>
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <?php if ($user->id != session()->get('id')) : ?>
                                    <a href="/admin/users/delete/<?= $user->id ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus/nonaktifkan pengguna ini?');">
                                        <i class="fas fa-user-slash"></i>
                                    </a>
                                <?php else : ?>
                                    <span class="badge bg-light text-dark">Akun Anda</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; else : ?>
                        <tr><td colspan="7" class="text-center text-muted py-4">Belum ada data pengguna.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="/admin/users/store" method="post" enctype="multipart/form-data" class="modal-content">
            <?= csrf_field() ?>
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengguna / Author Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nama Lengkap *</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Username *</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Password *</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Role Akses *</label>
                        <select name="role_id" class="form-select" required>
                            <?php foreach ($roles as $role) : ?>
                                <option value="<?= $role->id ?>"><?= esc($role->name) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Jabatan (Job Title)</label>
                        <input type="text" name="job_title" class="form-control" placeholder="Contoh: Guru Bahasa / Penulis">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Bio Penulis</label>
                    <textarea name="bio" class="form-control" rows="2" placeholder="Deskripsi profil penulis..."></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Foto Avatar</label>
                    <input type="file" name="avatar" class="form-control" accept="image/*">
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Simpan Pengguna</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>