<?= $this->include('admin/layouts/header') ?>

<div class="container-fluid">
    <div class="row">
        <!-- Panggil Sidebar -->
        <?= $this->include('admin/layouts/sidebar') ?>

        <!-- Konten Utama Dinamis -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            <?= $this->renderSection('content') ?>
        </main>
    </div>
</div>

<?= $this->include('admin/layouts/footer') ?>