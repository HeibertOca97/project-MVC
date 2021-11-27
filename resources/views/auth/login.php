<?php $this->template("layouts.app"); ?>
<?php $this->template("layouts.partials.header"); ?>

<section class="container-1 box-section box-center">
    <form action="<?php $this->route("login/signin") ?>" method="post" class="fr-login">
        <h2 class="fr-title">Inicio de sesion</h2>
        <?php if ($this->getStateAlert("warning")) { ?>
            <p class="alerts alert-warn"><small><?= $this->getMessageAlert("warning"); ?></small> </p>
        <?php } ?>
        <div class="group-input">
            <input type="email" name="email" placeholder="Email" autocomplete="off" value="<?= $this->old("email"); ?>">
            <?php if ($this->getStateError("email")) { ?>
                <p class="alerts alert-warn"><small><?= $this->getMessageError("email"); ?></small></p>
            <?php } ?>
        </div>
        <div class="group-input">
            <input type="password" name="password" placeholder="Password" autocomplete="off" value="<?= $this->old("password"); ?>">
            <?php if ($this->getStateError("password")) { ?>
                <p class="alerts alert-warn"><small><?= $this->getMessageError("password"); ?></small></p>
            <?php } ?>
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