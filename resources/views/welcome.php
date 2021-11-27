<?php $this->template("layouts.app"); ?>

<section class="welcome">
    <h1><?php print $title; ?></h1>
    <p>Directory <strong>resources/welcome</strong> </p>
    <nav class="box-link">
        <a href="<?php $this->route("login") ?>" class="link-item link-cl1">Sign in</a> <strong>/</strong>
        <a href="<?php $this->route("register") ?>" class="link-item link-cl1">Sign up</a>
    </nav>
</section>

<?php $this->template("layouts.partials.endHTML"); ?>
