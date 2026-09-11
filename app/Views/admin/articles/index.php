<?= $this->extend('admin/layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><i class="fas fa-newspaper me-2"></i>Kelola Artikel</h1>
    <a href="/admin/articles/create" class="btn btn-primary">
        <i class="fas fa-plus me-1"></i> Tambah Artikel Baru
    </a>
</div>

<!-- Flash Message Notifikasi -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th style="width: 80px;">Sampul</th>
                        <th>Judul Artikel</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Dilihat</th>
                        <th>Tanggal</th>
                        <th style="width: 120px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($articles)) : ?>
                        <?php $no = 1; foreach ($articles as $article) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td>
                                    <?php if ($article->featured_image) : ?>
                                        <img src="/<?= esc($article->featured_image) ?>" alt="Cover" class="img-thumbnail" style="width: 60px; height: 45px; object-fit: cover;">
                                    <?php else : ?>
                                        <span class="badge bg-secondary">No Image</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong><?= esc($article->title) ?></strong>
                                    <br>
                                    <small class="text-muted">/<?= esc($article->slug) ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        <?= esc($article->category_name ?? 'Tanpa Kategori') ?>
                                    </span>
                                </td>
                                <td><small><?= esc($article->author_name ?? 'Anonim') ?></small></td>
                                <td>
                                    <?php if ($article->status === 'published') : ?>
                                        <span class="badge bg-success">Published</span>
                                    <?php else : ?>
                                        <span class="badge bg-warning text-dark">Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td><small><i class="fas fa-eye me-1"></i><?= $article->view_count ?></small></td>
                                <td><small><?= date('d M Y', strtotime($article->created_at)) ?></small></td>
                                <td class="text-center">
                                    <a href="/admin/articles/delete/<?= $article->id ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');"
                                       title="Hapus Artikel">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">
                                Belum ada artikel yang dibuat. Silakan tambah artikel baru.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>