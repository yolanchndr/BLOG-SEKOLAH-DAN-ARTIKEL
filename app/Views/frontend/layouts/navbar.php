<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">
            <?php if (!empty($site_profile->logo)): ?>
                <img src="/<?= esc($site_profile->logo) ?>" alt="Logo" height="30" class="d-inline-block align-text-top me-2">
            <?php else: ?>
                <i class="fas fa-graduation-cap me-2"></i>
            <?php endif; ?>
            <?= esc($site_profile->school_name ?? 'SMA Contoh Nusantara') ?>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="/">Beranda</a>
                </li>
                <?php if (!empty($nav_menus)): ?>
                    <?php foreach ($nav_menus as $menu): ?>
                        <?php if (!empty($menu->submenus)): ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown<?= $menu->id ?>" role="button" data-bs-toggle="dropdown">
                                    <?= esc($menu->name) ?>
                                </a>
                                <ul class="dropdown-menu">
                                    <?php foreach ($menu->submenus as $submenu): ?>
                                        <li>
                                            <a class="dropdown-item" href="<?= esc($submenu->url) ?>" target="<?= esc($submenu->target) ?>">
                                                <?= esc($submenu->name) ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link text-white" href="<?= esc($menu->url) ?>" target="<?= esc($menu->target) ?>">
                                    <?= esc($menu->name) ?>
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link text-white" href="/artikel">Berita</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="/profil">Profil</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="/kontak">Kontak</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>