<?php $this->template("layouts.app"); ?>
<?php $this->template("layouts.partials.header"); ?>

<section class="container-1 box-section box-center">
    <form action="<?= $this->route("login/signin") ?>" method="post" class="fr-login">
        <h2 class="fr-title">Inicio de sesion</h2>
        <?php if ($this->checkMessageFlash("warning")): ?>
            <?= $this->getMessageFlash("warning") ?>
        <?php endif; ?>
        <div class="group-input">
            <input type="email" name="email" placeholder="Email" autocomplete="off" value="<?= $this->old("email"); ?>">
            <?php if($this->checkStateError("email")): ?>
            <?= $this->getErrorMessage("email") ?>
            <?php endif; ?>
        </div>
        <div class="group-input">
            <input type="password" name="password" placeholder="Password" autocomplete="off" value="<?= $this->old("password"); ?>">
            <?php if($this->checkStateError("password")): ?>
            <?= $this->getErrorMessage("password") ?>
            <?php endif; ?>
        </div>
        <div class="group-input">
            <small><a href="<?= $this->route('resetPassword'); ?>" class="links link-item">Has olvidado tu contraseña?</a></small>
        </div>
        <div class="group-input">
            <button class="btn btn-pr">Sign in</button>
        </div>
    </form>
</section>

<?php $this->template("layouts.partials.endHTML"); ?>
