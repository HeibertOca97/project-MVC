<header class="header">
    <nav class="navbar-1 container-1">
        <picture class="box-logo">
            <a href="<?= $this->AuthCheck() ? $this->route("dashboard") : $this->route("");  ?>"><?= $this->config("app.name"); ?></a>
        </picture>
        <div class="box-link">
            <?php if ($this->AuthCheck()) { ?>
                <a href="<?= $this->route("login/logout")  ?>" class="link-item link-cl1">Log out</a>
            <?php } else { ?>
                <a href="<?= $this->route("login")  ?>" class="link-item <?= $this->requestRoute('login') ? 'link-active' : 'link-cl1'; ?>">Sign in</a>
                <a href="<?= $this->route("register")  ?>" class="link-item <?= $this->requestRoute('register') ? 'link-active' : 'link-cl1'; ?>">Sign up</a>
            <?php } ?>
        </div>
    </nav>
</header>