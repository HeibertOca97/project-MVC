<?php $this->template("layouts.partials.header"); ?>

<h1><?php print $title; ?></h1>
<!-- <p><?php print $username; ?></p>
<p><?php print $dataModel['username']; ?></p>
<p><?php var_dump($persons); ?></p> -->
<p><?php print $this->assets("resources/src/css/app.css"); ?></p>


<?php $this->template("layouts.partials.footer"); ?>