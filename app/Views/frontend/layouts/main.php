<?= $this->include('frontend/layouts/header') ?>
<?= $this->include('frontend/layouts/navbar') ?>

<main>
    <?= $this->renderSection('content') ?>
</main>

<?= $this->include('frontend/layouts/footer') ?>