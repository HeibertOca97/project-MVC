<?php $this->template("layouts.app"); ?>
<?php $this->template("layouts.partials.header"); ?>

<section class="container-1 box-section box-center">
    <form action="<?php $this->route("completeData/updateInfo") ?>" method="post" class="fr-login">
        <h2 class="fr-title">Complete su informacion</h2>
        <?php if ($this->getStateAlert("warning")) { ?>
            <p class="alerts alert-warn"><small><?= $this->getMessageAlert("warning"); ?></small> </p>
        <?php } ?>
        <div class="group-input">
            <input type="text" name="username" placeholder="Username" autocomplete="off" value="<?= $this->old("username"); ?>">
            <?php if ($this->getStateError("username")) { ?>
                <p class="alerts alert-warn"><small><?= $this->getMessageError("username"); ?></small></p>
            <?php } ?>
        </div>
        <div class="group-input">
            <button class="btn btn-pr">Guardar informacion</button>
        </div>
    </form>
</section>

<?php $this->template("layouts.partials.endHTML"); ?>