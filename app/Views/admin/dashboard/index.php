<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard Overview</h1>
</div>

<div class="row text-white">
    <div class="col-md-3 mb-3">
        <div class="card bg-primary p-3 shadow-sm">
            <h5>Total Artikel</h5>
            <h3><?= $total_articles ?></h3>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-success p-3 shadow-sm">
            <h5>Pesan Masuk</h5>
            <h3><?= $total_messages ?></h3>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-warning p-3 shadow-sm">
            <h5>Total Pengguna</h5>
            <h3><?= $total_users ?></h3>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-info p-3 shadow-sm">
            <h5>Dokumen Publik</h5>
            <h3><?= $total_documents ?></h3>
        </div>
    </div>
</div>
<?= $this->endSection() ?>