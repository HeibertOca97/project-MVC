<section class="container-1">
    <div class="card-1 mxt-1">
        <div class="card-hd1 card-bg-p">
            <h2>Welcome, <?= $this->AuthUser()->username; ?></h2>
        </div>
        <div class="card-bd1">
            <p><strong>email: </strong> <?= $this->AuthUser()->email; ?></p>
            <p><strong>token: </strong> <?= $this->AuthUser()->token_user; ?></p>
            <p><strong>created_at: </strong> <?= $this->AuthUser()->created_at; ?></p>
            <p><strong>updated_at: </strong> <?= $this->AuthUser()->updated_at; ?></p>
        </div>
    </div>
</section>
