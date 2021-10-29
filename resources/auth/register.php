<?php $this->template("layouts.app"); ?>
<?php $this->template("layouts.partials.header"); ?>

<section class="container-1 box-section box-center">
    <form action="<?php $this->route("register/signup") ?>" method="post" class="fr-login">
        <h2 class="fr-title">Inscribirse</h2>
        <?php if ($this->getStateAlert("success")) { ?>
            <p class="alerts alert-succ"><small><?= $this->getMessageAlert("success"); ?></small> </p>
        <?php } ?>
        <div class="group-input">
            <input type="text" name="username" placeholder="Username" autocomplete="off" value="<?= $this->old("username"); ?>">
            <p class="alerts alert-warn"><small><?= $this->getError("username"); ?></small></p>
        </div>
        <div class="group-input">
            <input type="email" name="email" placeholder="email" autocomplete="off" value="<?= $this->old("email"); ?>">
            <p class="alerts alert-warn"><small><?= $this->getError("email"); ?></small></p>
        </div>
        <div class="group-input">
            <input type="password" name="password" placeholder="Password" autocomplete="off" value="<?= $this->old("password"); ?>">
            <p class="alerts alert-warn"><small><?= $this->getError("password"); ?></small></p>
        </div>
        <div class="group-input">
            <button class="btn btn-pr">Sign up</button>
        </div>
    </form>
</section>

<?php $this->template("layouts.partials.endHTML"); ?>