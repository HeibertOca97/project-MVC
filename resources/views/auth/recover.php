<?php $this->template("layouts.app"); ?>

<section class="container-1 box-section box-center">
    <form action="<?= $this->route("resetPassword/updateNewPassword"); ?>" method="post" class="fr-login">
        <h2 class="fr-title">Actualizacion de contraseña</h2>
        <div class="group-input">
            <?php if ($this->getStateAlert("warning")) { ?>
                <p class="alerts alert-warn"><small><?= $this->getMessageAlert("warning"); ?></small> </p>
            <?php } ?>
        </div>
        <input type="hidden" name="email" autocomplete="off" value="<?= $this->old("email", $email); ?>">
        <input type="hidden" name="token" autocomplete="off" value="<?= $this->old("email", $token); ?>">
        <div class="group-input">
            <input type="password" name="password" placeholder="Contrasena" autocomplete="off" value="<?= $this->old("password"); ?>">
        </div>
        <div class="group-input">
            <input type="password" name="confirm_password" placeholder="Confirmar contrasena" autocomplete="off" value="<?= $this->old("confirm_password"); ?>">
        </div>
        <div class="group-input">
            <button class="btn btn-pr">Actualizar</button>
        </div>
    </form>
</section>

<?php $this->template("layouts.partials.endHTML"); ?>