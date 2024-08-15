<?php $this->template("layouts.app"); ?>
<?php $this->template("layouts.partials.header"); ?>

<section class="container-1 box-section box-center">
    <form action="<?= $this->route("register/signup") ?>" method="post" class="fr-login">
        <h2 class="fr-title">Inscribirse</h2>
        <?php if ($this->checkMessageFlash("warning")): ?>
            <?= $this->getMessageFlash("warning") ?>
        <?php elseif($this->checkMessageFlash("success")): ?>
            <?= $this->getMessageFlash("success") ?>
        <?php endif; ?>
    
        <div class="group-input">
            <input type="email" name="email" placeholder="email" autocomplete="off" value="<?= $this->old("email"); ?>">
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
            <input type="password" name="confirm_password" placeholder="Confirm password" autocomplete="off" value="<?= $this->old("confirm_password"); ?>">
            <?php if($this->checkStateError("confirm_password")): ?>
            <?= $this->getErrorMessage("confirm_password") ?>
            <?php endif; ?>
        </div>
        <div class="group-input">
            <button class="btn btn-pr">Sign up</button>
        </div>
    </form>
</section>

<?php $this->template("layouts.partials.endHTML"); ?>
