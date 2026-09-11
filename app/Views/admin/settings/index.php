<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-cogs me-2"></i>Pengaturan Website & Sekolah</h1>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show"><?= session()->getFlashdata('success') ?><button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
<?php endif; ?>

<div class="row">
    <!-- Form Profil Sekolah -->
    <div class="col-lg-8">
        <form action="/admin/settings/update-profile" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light"><h6 class="mb-0 fw-bold">Identitas Sekolah</h6></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label class="form-label">Nama Sekolah *</label>
                            <input type="text" name="school_name" class="form-control" value="<?= esc($site_profile->school_name ?? '') ?>" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Singkatan</label>
                            <input type="text" name="school_short_name" class="form-control" value="<?= esc($site_profile->school_short_name ?? '') ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">NPSN</label>
                            <input type="text" name="npsn" class="form-control" value="<?= esc($site_profile->npsn ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenjang (SMA/SMP/SD)</label>
                            <input type="text" name="level" class="form-control" value="<?= esc($site_profile->level ?? '') ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="address" class="form-control" rows="2"><?= esc($site_profile->address ?? '') ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="text" name="phone" class="form-control" value="<?= esc($site_profile->phone ?? '') ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email Resmi</label>
                            <input type="email" name="email" class="form-control" value="<?= esc($site_profile->email ?? '') ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Google Maps Embed URL (Iframe src)</label>
                        <input type="text" name="google_maps_url" class="form-control" value="<?= esc($site_profile->google_maps_url ?? '') ?>">
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light"><h6 class="mb-0 fw-bold">Kepala Sekolah</h6></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kepala Sekolah</label>
                        <input type="text" name="principal_name" class="form-control" value="<?= esc($site_profile->principal_name ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Sambutan Kepala Sekolah</label>
                        <textarea name="principal_message" class="form-control" rows="4"><?= esc($site_profile->principal_message ?? '') ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto Kepala Sekolah</label>
                        <input type="file" name="principal_photo" class="form-control" accept="image/*">
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light"><h6 class="mb-0 fw-bold">Tampilan & SEO</h6></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Logo Sekolah</label>
                        <input type="file" name="logo" class="form-control" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teks Footer Copyright</label>
                        <input type="text" name="footer_text" class="form-control" value="<?= esc($site_profile->footer_text ?? '') ?>">
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Pengaturan</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Tabel Media Sosial -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Media Sosial</h6>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addSosmedModal"><i class="fas fa-plus"></i></button>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <?php if (!empty($social_medias)) : foreach ($social_medias as $sm) : ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <i class="<?= esc($sm->icon) ?> me-2"></i>
                                <strong><?= esc($sm->name) ?></strong>
                            </div>
                            <a href="/admin/settings/delete-sosmed/<?= $sm->id ?>" class="text-danger" onclick="return confirm('Hapus sosmed ini?')"><i class="fas fa-trash"></i></a>
                        </li>
                    <?php endforeach; else : ?>
                        <li class="list-group-item text-center text-muted">Belum ada sosmed.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Sosmed -->
<div class="modal fade" id="addSosmedModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="/admin/settings/store-sosmed" method="post" class="modal-content">
            <?= csrf_field() ?>
            <div class="modal-header"><h5 class="modal-title">Tambah Media Sosial</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="mb-3"><label class="form-label">Nama (contoh: Instagram Resmi)</label><input type="text" name="name" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Platform (instagram, youtube, facebook)</label><input type="text" name="platform" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">URL Profil</label><input type="url" name="url" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Icon Class (contoh: fab fa-instagram)</label><input type="text" name="icon" class="form-control" value="fab fa-instagram"></div>
            </div>
            <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>