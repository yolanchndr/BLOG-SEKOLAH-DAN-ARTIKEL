<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Beranda</a></li>
            <li class="breadcrumb-item active">Kontak</li>
        </ol>
    </nav>

    <h2 class="fw-bold mb-4"><i class="fas fa-envelope me-2 text-primary"></i>Hubungi Kami</h2>

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

    <div class="row">
        <!-- Form Kirim Pesan -->
        <div class="col-lg-7 mb-4">
            <div class="card border-0 shadow-sm p-4">
                <h5 class="fw-bold mb-3">Kirim Pesan Pengunjung</h5>
                <form action="/kontak/kirim" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="<?= old('name') ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nomor WhatsApp / HP</label>
                            <input type="text" name="phone" class="form-control" value="<?= old('phone') ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subjek / Judul Pesan <span class="text-danger">*</span></label>
                        <input type="text" name="subject" class="form-control" value="<?= old('subject') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pesan Anda <span class="text-danger">*</span></label>
                        <textarea name="message" class="form-control" rows="5" required><?= old('message') ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane me-1"></i> Kirim Pesan</button>
                </form>
            </div>
        </div>

        <!-- Informasi Kontak Sekolah -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm p-4 mb-4">
                <h5 class="fw-bold mb-3">Informasi Sekolah</h5>
                <p class="mb-2"><i class="fas fa-school text-primary me-2"></i><strong><?= esc($site_profile->school_name ?? 'SMA Contoh Nusantara') ?></strong></p>
                <p class="mb-2"><i class="fas fa-map-marker-alt text-danger me-2"></i><?= esc($site_profile->address ?? '-') ?></p>
                <p class="mb-2"><i class="fas fa-phone text-success me-2"></i><?= esc($site_profile->phone ?? '-') ?></p>
                <p class="mb-2"><i class="fas fa-envelope text-warning me-2"></i><?= esc($site_profile->email ?? '-') ?></p>
                <p class="mb-0"><i class="fas fa-id-card text-info me-2"></i>NPSN: <?= esc($site_profile->npsn ?? '-') ?></p>
            </div>

            <!-- Google Maps Embed -->
            <?php if (!empty($site_profile->google_maps_url)) : ?>
                <div class="card border-0 shadow-sm p-2">
                    <iframe src="<?= esc($site_profile->google_maps_url) ?>" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>