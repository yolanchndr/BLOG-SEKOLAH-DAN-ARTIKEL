<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <!-- Breadcrumb Modern -->
    <div class="mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb modern-breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-muted"><i class="fas fa-home me-1"></i>Beranda</a></li>
                <?php if (isset($active_category)) : ?>
                    <li class="breadcrumb-item"><a href="/artikel" class="text-decoration-none text-muted">Berita</a></li>
                    <li class="breadcrumb-item active text-primary fw-semibold" aria-current="page"><?= esc($active_category->name) ?></li>
                <?php else : ?>
                    <li class="breadcrumb-item active text-primary fw-semibold" aria-current="page">Berita & Pengumuman</li>
                <?php endif; ?>
            </ol>
        </nav>
    </div>

    <!-- Hero Header -->
    <div class="row align-items-center mb-5">
        <div class="col-lg-7">
            <span class="badge bg-primary-subtle text-primary fw-bold px-3 py-2 rounded-pill mb-2">PORTAL INFORMASI</span>
            <h1 class="display-6 fw-bold text-dark mb-2">
                <?= isset($active_category) ? 'Kategori: ' . esc($active_category->name) : 'Kabar & Pengumuman Sekolah' ?>
            </h1>
            <p class="text-secondary lead mb-0" style="font-size: 1.05rem;">
                Dapatkan kabar berita terbaru, pengumuman penting, dan catatan prestasi dari civitas akademika kami.
            </p>
        </div>
    </div>

    <!-- Filter Pills Kategori -->
    <?php if (!empty($categories)) : ?>
        <div class="mb-5 d-flex flex-wrap gap-2">
            <a href="/artikel" class="category-pill <?= !isset($active_category) ? 'active' : 'inactive' ?>">
                Semua Artikel
            </a>
            <?php foreach ($categories as $cat) : ?>
                <a href="/kategori/<?= esc($cat->slug) ?>" 
                   class="category-pill <?= (isset($active_category) && $active_category->id == $cat->id) ? 'active' : 'inactive' ?>">
                    <?= esc($cat->name) ?>
                </a>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Grid Artikel -->
    <div class="row g-4">
        <?php if (!empty($articles)) : ?>
            <?php foreach ($articles as $article) : ?>
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
                                <?= esc(character_limiter(strip_tags($article->excerpt ?? $article->content), 100)) ?>
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
                    <i class="fas fa-folder-open fa-3x mb-3 text-muted"></i>
                    <h5 class="fw-bold text-dark">Belum ada berita diterbitkan</h5>
                    <p class="text-muted small">Belum ada kabar atau pengumuman pada kategori ini saat ini.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination Modern -->
    <?php if (isset($pager)) : ?>
        <div class="d-flex justify-content-center mt-5">
            <?= $pager->links() ?>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>