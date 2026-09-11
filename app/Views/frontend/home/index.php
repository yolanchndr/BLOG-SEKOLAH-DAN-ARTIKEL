<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container py-4">

    <!-- 1. HERO SLIDER CAROUSEL -->
    <?php if (!empty($banners)) : ?>
        <div id="heroCarousel" class="carousel slide hero-slider mb-5 shadow-sm" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php foreach ($banners as $index => $banner) : ?>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>"></button>
                <?php endforeach; ?>
            </div>

            <div class="carousel-inner" style="border-radius: 24px;">
                <?php foreach ($banners as $index => $banner) : ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <img src="/<?= esc($banner->image) ?>" class="d-block w-100" alt="Banner Slide">
                        <div class="hero-overlay text-white">
                            <div class="col-lg-8">
                                <?php if ($banner->title) : ?>
                                    <h2 class="fw-bold display-6 mb-2"><?= esc($banner->title) ?></h2>
                                <?php endif; ?>
                                <?php if ($banner->subtitle) : ?>
                                    <p class="lead opacity-90 mb-3" style="font-size: 1.1rem;"><?= esc($banner->subtitle) ?></p>
                                <?php endif; ?>
                                <?php if ($banner->button_url) : ?>
                                    <a href="<?= esc($banner->button_url) ?>" class="btn btn-primary rounded-pill px-4 py-2 font-weight-bold">
                                        <?= esc($banner->button_text ?: 'Selengkapnya') ?> <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
    <?php endif; ?>

    <!-- 2. QUICK FEATURE BOXES -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <a href="/halaman/profil" class="text-decoration-none">
                <div class="feature-box d-flex align-items-center">
                    <div class="feature-icon bg-primary-subtle text-primary me-3">
                        <i class="fas fa-school"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-0">Profil Sekolah</h6>
                        <small class="text-muted">Sejarah & Visi Misi</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="/artikel" class="text-decoration-none">
                <div class="feature-box d-flex align-items-center">
                    <div class="feature-icon bg-success-subtle text-success me-3">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-0">Pengumuman</h6>
                        <small class="text-muted">Info Kegiatan Resmi</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="/galeri" class="text-decoration-none">
                <div class="feature-box d-flex align-items-center">
                    <div class="feature-icon bg-warning-subtle text-warning me-3">
                        <i class="fas fa-images"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-0">Galeri Foto</h6>
                        <small class="text-muted">Dokumentasi Acara</small>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="/dokumen" class="text-decoration-none">
                <div class="feature-box d-flex align-items-center">
                    <div class="feature-icon bg-danger-subtle text-danger me-3">
                        <i class="fas fa-file-pdf"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-0">Pusat Dokumen</h6>
                        <small class="text-muted">Unduh File & Form</small>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- 3. GRID CARD BERITA TERBARU -->
    <div class="d-flex justify-content-between align-items-end mb-4">
        <div>
            <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-1 rounded-pill mb-2">KABAR TERKINI</span>
            <h3 class="fw-bold text-dark mb-0">Berita & Pengumuman Terbaru</h3>
        </div>
        <a href="/artikel" class="btn btn-outline-primary rounded-pill btn-sm px-3">Lihat Semua Berita <i class="fas fa-chevron-right ms-1"></i></a>
    </div>

    <div class="row g-4 mb-5">
        <?php if (!empty($latest_articles)) : ?>
            <?php foreach ($latest_articles as $article) : ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card modern-card h-100">
                        <div class="img-container">
                            <a href="/kategori/<?= esc($article->category_slug ?? 'umum') ?>" class="badge-overlay text-decoration-none">
                                <?= esc($article->category_name ?? 'Umum') ?>
                            </a>
                            <a href="/artikel/<?= esc($article->slug) ?>">
                                <?php if ($article->featured_image) : ?>
                                    <img src="/<?= esc($article->featured_image) ?>" alt="<?= esc($article->title) ?>">
                                <?php else : ?>
                                    <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center text-muted">
                                        <i class="fas fa-newspaper fa-3x opacity-25"></i>
                                    </div>
                                <?php endif; ?>
                            </a>
                        </div>
                        
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title h6 mb-3">
                                <a href="/artikel/<?= esc($article->slug) ?>" class="text-decoration-none text-dark">
                                    <?= esc($article->title) ?>
                                </a>
                            </h5>

                            <p class="card-text text-secondary small mb-auto">
                                <?= esc(character_limiter(strip_tags($article->excerpt ?? $article->content), 95)) ?>
                            </p>

                            <div class="author-meta d-flex justify-content-between align-items-center">
                                <span><i class="far fa-user me-1 text-primary"></i> <?= esc($article->author_name ?? 'Admin') ?></span>
                                <span><i class="far fa-calendar-alt me-1 text-primary"></i> <?= date('d M Y', strtotime($article->published_at ?? $article->created_at)) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col-12">
                <div class="text-center py-5 modern-card">
                    <i class="fas fa-newspaper fa-3x mb-3 text-muted"></i>
                    <h5 class="fw-bold text-dark">Belum Ada Berita</h5>
                    <p class="text-muted small">Artikel berita akan tampil di sini setelah diterbitkan.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>

</div>
<?= $this->endSection() ?>