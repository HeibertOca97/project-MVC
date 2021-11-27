<header class="header">
    <nav class="navbar-1 container-1">
        <picture class="box-logo">
            <a href="<?= $this->AuthCheck() ? $this->route("dashboard") : $this->route("");  ?>"><?= $this->config("app.name"); ?></a>
        </picture>
        <div class="box-link">
            <?php if ($this->AuthCheck()) { ?>
                <div class="box-tools">
                    <button id="btn-navbar" class="link-item link-cl1" title="Menu" data-state="false"><i class="fas fa-bars"></i></button>
                </div>
                <div class="box-tools">
                    <button id="btn-mas" class="link-item link-cl1" title="Mas" data-state="false">
                        <i class="fas fa-sort-down"></i>
                    </button>
                    <div class="link-item-opt">
                        <div class="item-opt1">
                            <picture><img src="https://www.pngall.com/wp-content/uploads/5/User-Profile-PNG-High-Quality-Image.png" alt="Logo"></picture>
                            <p>
                                <strong><?= $this->AuthUser()->username ?></strong>
                                <span>Perfil</span>
                            </p>
                        </div>
                        <a href="<?= $this->route("gestion/profile")  ?>" class="item-opt3">Ver perfil</a>
                        <a href="<?= $this->route("login/logout")  ?>" class="item-opt2 link-cl2"><i class="fas fa-door-open"></i><span>Log out</span></a>
                    </div>
                </div>
            <?php } else { ?>
                <a href="<?= $this->route("login")  ?>" class="link-item <?= $this->requestRoute('login') ? 'link-active' : 'link-cl1'; ?>">Sign in</a>
                <a href="<?= $this->route("register")  ?>" class="link-item <?= $this->requestRoute('register') ? 'link-active' : 'link-cl1'; ?>">Sign up</a>
            <?php } ?>
        </div>
    </nav>
</header>