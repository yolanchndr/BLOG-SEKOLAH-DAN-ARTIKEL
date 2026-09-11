<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Beranda</a></li>
            <li class="breadcrumb-item"><a href="/artikel" class="text-decoration-none">Berita</a></li>
            <li class="breadcrumb-item active text-truncate" style="max-width: 250px;"><?= esc($article->title) ?></li>
        </ol>
    </nav>

    <div class="row g-5">
        <!-- KONTEN UTAMA (Kiri) -->
        <div class="col-lg-8">
            <article>
                <!-- Badge Kategori -->
                <a href="/kategori/<?= esc($article->category_slug ?? 'umum') ?>" class="badge bg-primary text-decoration-none mb-3 px-3 py-2 rounded-pill">
                    <i class="fas fa-tag me-1"></i><?= esc($article->category_name ?? 'Umum') ?>
                </a>

                <!-- Judul Artikel -->
                <h1 class="article-header-title display-6 mb-4"><?= esc($article->title) ?></h1>

                <!-- Meta Penulis & Tanggal -->
                <div class="d-flex align-items-center justify-content-between pb-4 mb-4 border-bottom">
                    <div class="d-flex align-items-center">
                        <?php if (!empty($article->author_avatar)) : ?>
                            <img src="/<?= esc($article->author_avatar) ?>" class="author-avatar-img me-3" alt="Avatar">
                        <?php else : ?>
                            <div class="author-avatar-img me-3 bg-primary text-white d-flex align-items-center justify-content-center fw-bold">
                                <?= strtoupper(substr($article->author_name ?? 'A', 0, 1)) ?>
                            </div>
                        <?php endif; ?>
                        <div>
                            <h6 class="mb-0 fw-bold text-dark"><?= esc($article->author_name ?? 'Administrator') ?></h6>
                            <small class="text-muted"><?= esc($article->author_job ?? 'Penulis Sekolah') ?></small>
                        </div>
                    </div>
                    <div class="text-end text-muted small">
                        <div><i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($article->published_at ?? $article->created_at)) ?></div>
                        <div><i class="far fa-eye me-1"></i> <?= number_format($article->view_count) ?>x dibaca</div>
                    </div>
                </div>

                <!-- Gambar Utama (Featured Image) -->
                <?php if ($article->featured_image) : ?>
                    <div class="mb-4">
                        <img src="/<?= esc($article->featured_image) ?>" class="article-main-img shadow-sm" alt="<?= esc($article->title) ?>">
                    </div>
                <?php endif; ?>

                <!-- Tombol Bagikan Sosmed -->
                <?php 
                    $currentUrl = current_url();
                    $shareTitle = urlencode($article->title);
                ?>
                <div class="d-flex align-items-center gap-2 mb-4 p-3 bg-light rounded-4">
                    <span class="fw-bold small text-secondary me-2"><i class="fas fa-share-alt me-1"></i> Bagikan:</span>
                    <a href="https://api.whatsapp.com/send?text=<?= $shareTitle ?>%20<?= $currentUrl ?>" target="_blank" class="btn-share btn-share-wa" title="Bagikan ke WhatsApp">
                        <i class="fab fa-whatsapp"></i>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $currentUrl ?>" target="_blank" class="btn-share btn-share-fb" title="Bagikan ke Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text=<?= $shareTitle ?>&url=<?= $currentUrl ?>" target="_blank" class="btn-share btn-share-tw" title="Bagikan ke X / Twitter">
                        <i class="fab fa-x-twitter"></i>
                    </a>
                    <button type="button" class="btn-share btn-share-copy" onclick="navigator.clipboard.writeText('<?= $currentUrl ?>'); alert('Link berhasil disalin!');" title="Salin Link">
                        <i class="fas fa-link"></i>
                    </button>
                </div>

                <!-- Isi Konten Artikel -->
                <div class="article-rich-content mb-5">
                    <?= $article->content ?>
                </div>

                <!-- Lampiran File Berita (Jika Ada) -->
                <?php if (!empty($attachments)) : ?>
                    <div class="card border-0 bg-light rounded-4 p-4 mb-5">
                        <h6 class="fw-bold mb-3"><i class="fas fa-paperclip text-primary me-2"></i>Berkas & Lampiran Unduhan</h6>
                        <ul class="list-group list-group-flush rounded-3">
                            <?php foreach ($attachments as $file) : ?>
                                <li class="list-group-item bg-white d-flex justify-content-between align-items-center py-3">
                                    <div>
                                        <i class="far fa-file-alt text-primary me-2"></i>
                                        <span class="fw-semibold small"><?= esc($file->original_name) ?></span>
                                    </div>
                                    <a href="/artikel/attachment/download/<?= $file->id ?>" class="btn btn-sm btn-outline-primary rounded-pill">
                                        <i class="fas fa-download me-1"></i> Unduh
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Profil Penulis (Author Box) -->
                <div class="author-box d-flex align-items-center mb-5">
                    <?php if (!empty($article->author_avatar)) : ?>
                        <img src="/<?= esc($article->author_avatar) ?>" class="author-avatar-img me-3" style="width: 64px; height: 64px;" alt="Author">
                    <?php else : ?>
                        <div class="author-avatar-img me-3 bg-primary text-white d-flex align-items-center justify-content-center fw-bold fs-4" style="width: 64px; height: 64px;">
                            <?= strtoupper(substr($article->author_name ?? 'A', 0, 1)) ?>
                        </div>
                    <?php endif; ?>
                    <div>
                        <h6 class="fw-bold mb-1"><?= esc($article->author_name ?? 'Administrator') ?></h6>
                        <p class="text-muted small mb-0"><?= esc($article->author_bio ?? 'Penulis aktif kontributor berita dan kabar terbaru sekolah.') ?></p>
                    </div>
                </div>
            </article>

            <!-- Artikel Terkait -->
            <?php if (!empty($related_articles)) : ?>
                <div class="mt-5 pt-4 border-top">
                    <h5 class="fw-bold mb-4"><i class="fas fa-newspaper me-2 text-primary"></i>Berita Terkait</h5>
                    <div class="row g-4">
                        <?php foreach ($related_articles as $related) : ?>
                            <div class="col-md-4">
                                <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                                    <?php if ($related->featured_image) : ?>
                                        <img src="/<?= esc($related->featured_image) ?>" style="height: 140px; object-fit: cover;" alt="Cover">
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h6 class="card-title h6 fw-bold">
                                            <a href="/artikel/<?= esc($related->slug) ?>" class="text-decoration-none text-dark">
                                                <?= esc(character_limiter($related->title, 50)) ?>
                                            </a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- SIDEBAR (Kanan) -->
        <div class="col-lg-4">
            <div class="sticky-top" style="top: 90px;">
                
                <!-- Widget Artikel Populer -->
                <div class="sidebar-card">
                    <h5 class="fw-bold mb-4 pb-2 border-bottom"><i class="fas fa-fire text-danger me-2"></i>Artikel Populer</h5>
                    <?php if (!empty($popular_articles)) : ?>
                        <div class="d-flex flex-column gap-3">
                            <?php foreach ($popular_articles as $pop) : ?>
                                <div class="d-flex align-items-center">
                                    <?php if ($pop->featured_image) : ?>
                                        <img src="/<?= esc($pop->featured_image) ?>" class="popular-item-img me-3" alt="Thumb">
                                    <?php else : ?>
                                        <div class="popular-item-img me-3 bg-light d-flex align-items-center justify-content-center text-muted">
                                            <i class="fas fa-newspaper opacity-25"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div>
                                        <h6 class="mb-1 small fw-bold">
                                            <a href="/artikel/<?= esc($pop->slug) ?>" class="text-decoration-none text-dark hover-primary">
                                                <?= esc(character_limiter($pop->title, 55)) ?>
                                            </a>
                                        </h6>
                                        <div class="text-muted" style="font-size: 0.75rem;">
                                            <i class="far fa-eye me-1"></i> <?= number_format($pop->view_count) ?> views
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <p class="text-muted small mb-0">Belum ada data artikel populer.</p>
                    <?php endif; ?>
                </div>

                <!-- Widget Kategori -->
                <?php if (!empty($categories)) : ?>
                    <div class="sidebar-card">
                        <h5 class="fw-bold mb-3 pb-2 border-bottom"><i class="fas fa-folder me-2 text-primary"></i>Kategori Berita</h5>
                        <div class="d-flex flex-wrap gap-2">
                            <?php foreach ($categories as $cat) : ?>
                                <a href="/kategori/<?= esc($cat->slug) ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                    <?= esc($cat->name) ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>