<?php $this->template("layouts.app"); ?>
<?php $this->template("layouts.partials.header"); ?>

<section class="container-1 box-section box-center">
    <form action="<?php $this->route("register/signup") ?>" method="post" class="fr-login">
        <h2 class="fr-title">Inscribirse</h2>
        <?php if ($this->getStateAlert("success")) { ?>
            <p class="alerts alert-succ"><small><?= $this->getMessageAlert("success"); ?></small> </p>
        <?php } else if ($this->getStateAlert("warning")) { ?>
            <p class="alerts alert-warn"><small><?= $this->getMessageAlert("warning"); ?></small> </p>
        <?php } ?>
        <div class="group-input">
            <input type="text" name="username" placeholder="Username" autocomplete="off" value="<?= $this->old("username"); ?>">
            <?php if ($this->getStateError("username")) { ?>
                <p class="alerts alert-warn"><small><?= $this->getMessageError("username"); ?></small></p>
            <?php } ?>
        </div>
        <div class="group-input">
            <input type="email" name="email" placeholder="email" autocomplete="off" value="<?= $this->old("email"); ?>">
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
            <input type="password" name="confirm_password" placeholder="Confirm password" autocomplete="off" value="<?= $this->old("confirm_password"); ?>">
            <?php if ($this->getStateError("confirm_password")) { ?>
                <p class="alerts alert-warn"><small><?= $this->getMessageError("confirm_password"); ?></small></p>
            <?php } ?>
        </div>
        <div class="group-input">
            <button class="btn btn-pr">Sign up</button>
        </div>
    </form>
</section>

<?php $this->template("layouts.partials.endHTML"); ?>