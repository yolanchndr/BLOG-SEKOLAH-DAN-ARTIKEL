<footer class="bg-dark text-white pt-5 pb-3 mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <h5><?= esc($site_profile->school_name ?? 'Sekolah Kami') ?></h5>
                <p class="text-secondary small">
                    <?= esc($site_profile->address ?? 'Alamat sekolah belum diatur.') ?>
                </p>
                <p class="text-secondary small mb-1"><i class="fas fa-phone me-2"></i><?= esc($site_profile->phone ?? '-') ?></p>
                <p class="text-secondary small"><i class="fas fa-envelope me-2"></i><?= esc($site_profile->email ?? '-') ?></p>
            </div>
            <div class="col-md-4 mb-4">
                <h5>Tautan Cepat</h5>
                <ul class="list-unstyled text-secondary small">
                    <li><a href="/artikel" class="text-secondary text-decoration-none">Berita & Pengumuman</a></li>
                    <li><a href="/dokumen" class="text-secondary text-decoration-none">Unduhan Dokumen</a></li>
                    <li><a href="/galeri" class="text-secondary text-decoration-none">Galeri Foto</a></li>
                    <li><a href="/kontak" class="text-secondary text-decoration-none">Hubungi Kami</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-4">
                <h5>Media Sosial</h5>
                <?php if (!empty($social_medias)): ?>
                    <?php foreach ($social_medias as $sosmed): ?>
                        <a href="<?= esc($sosmed->url) ?>" target="_blank" class="btn btn-outline-light btn-sm me-1 mb-1">
                            <i class="<?= esc($sosmed->icon ?? 'fas fa-link') ?> me-1"></i><?= esc($sosmed->name) ?>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <hr class="border-secondary">
        <div class="text-center text-secondary small">
            <?= esc($site_profile->footer_text ?? '© ' . date('Y') . ' Website Sekolah. All Rights Reserved.') ?>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>