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
            <p class="alerts alert-warn"><small><?= $this->getError("email"); ?></small></p>
        </div>
        <div class="group-input">
            <input type="password" name="password" placeholder="Password" autocomplete="off" value="<?= $this->old("password"); ?>">
            <p class="alerts alert-warn"><small><?= $this->getError("password"); ?></small></p>
        </div>
        <div class="group-input">
            <button class="btn btn-pr">Sign in</button>
        </div>
    </form>
</section>

<?php $this->template("layouts.partials.endHTML"); ?>