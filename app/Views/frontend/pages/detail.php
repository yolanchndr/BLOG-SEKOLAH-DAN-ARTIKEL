<?= $this->extend('frontend/layouts/main') ?>

<?= $this->section('content') ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                    <li class="breadcrumb-item active"><?= esc($page->title) ?></li>
                </ol>
            </nav>

            <h1 class="fw-bold mb-4 border-bottom pb-2"><?= esc($page->title) ?></h1>

            <?php if ($page->featured_image): ?>
                <img src="/<?= esc($page->featured_image) ?>" class="img-fluid rounded mb-4 w-100" style="max-height: 400px; object-fit: cover;" alt="<?= esc($page->title) ?>">
            <?php endif; ?>

            <div class="page-content lead-text">
                <?= $page->content ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>