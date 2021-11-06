<?php $this->template("layouts.app"); ?>
<?php $this->template("layouts.partials.header"); ?>

<section id="app-section" class="section-1">
    <nav class="navbar-bd">
        <?php $this->template("components.navbarPrincipal"); ?>
    </nav>
    <main class="main-bd">
        <?php $this->template("components.card"); ?>
    </main>
</section>

<script src="<?php $this->assets("src/js/app.js"); ?>"></script>
<?php $this->template("layouts.partials.endHTML"); ?>