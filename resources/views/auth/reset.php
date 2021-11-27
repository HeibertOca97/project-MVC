<?php $this->template("layouts.app"); ?>
<?php $this->template("layouts.partials.header"); ?>

<section class="container-1 box-section box-center">
    <form action="<?= $this->route("resetPassword/checkedResetPassword"); ?>" method="post" class="fr-login">
        <h2 class="fr-title">Restablezca su contraseña</h2>
        <div class="group-input">
            <?php if ($this->getStateAlert("success")) { ?>
                <p class="alerts alert-succ"><small><?= $this->getMessageAlert("success"); ?></small> </p>
            <?php } ?>
            <?php if ($this->getStateAlert("warning")) { ?>
                <p class="alerts alert-warn"><small><?= $this->getMessageAlert("warning"); ?></small> </p>
            <?php } ?>
        </div>
        <div class="group-input">
            <small>Ingrese su dirección de correo electrónico que utilizó para registrarse. Le enviaremos un correo electrónico con su nombre de usuario y un enlace para restablecer su contraseña.</small>
        </div>
        <div class="group-input">
            <input type="email" name="email" placeholder="Direccion de correo electronico" autocomplete="off" value="<?= $this->old("email"); ?>">
            <?php if ($this->getStateError("email")) { ?>
                <p class="alerts alert-warn"><small><?= $this->getMessageError("email"); ?></small></p>
            <?php } ?>
        </div>
        <div class="group-input">
            <button class="btn btn-pr">Enviar mi enlace de recuperacion</button>
        </div>
        <div class="group-input">
            <small><a href="<?= $this->route('login'); ?>" class="links link-item">Volver al inicio de sesion</a></small>
        </div>
    </form>
</section>

<?php $this->template("layouts.partials.endHTML"); ?>