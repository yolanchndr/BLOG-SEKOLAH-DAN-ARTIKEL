<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-envelope-open me-2"></i>Detail Pesan Masuk</h1>
    <a href="/admin/contact-messages" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Kembali ke Pesan Masuk
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold"><?= esc($message->subject) ?></h6>
                <small class="text-muted"><i class="fas fa-clock me-1"></i><?= date('d M Y H:i', strtotime($message->created_at)) ?></small>
            </div>
            <div class="card-body">
                <div class="mb-4 pb-3 border-bottom">
                    <p class="mb-1"><strong>Pengirim:</strong> <?= esc($message->name) ?></p>
                    <p class="mb-1"><strong>Email:</strong> <a href="mailto:<?= esc($message->email) ?>"><?= esc($message->email) ?></a></p>
                    <p class="mb-0"><strong>No. Telepon / WA:</strong> <?= esc($message->phone ?? '-') ?></p>
                </div>
                <div class="message-body">
                    <h6 class="fw-bold text-muted mb-2">Isi Pesan:</h6>
                    <p class="text-dark style-message"><?= nl2br(esc($message->message)) ?></p>
                </div>
            </div>
            <div class="card-footer bg-white text-end">
                <a href="mailto:<?= esc($message->email) ?>?subject=Re: <?= urlencode($message->subject) ?>" class="btn btn-primary">
                    <i class="fas fa-reply me-1"></i> Balas via Email
                </a>
                <a href="/admin/contact-messages/delete/<?= $message->id ?>" class="btn btn-outline-danger" onclick="return confirm('Hapus pesan ini?');">
                    <i class="fas fa-trash me-1"></i> Hapus Pesan
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>