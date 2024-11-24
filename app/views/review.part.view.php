<?php if ($reviews != null) { ?>
    <?php foreach ($reviews as $rev) { ?>
        <div class="d-flex align-items-center mb-4">
            <div class="bg-light d-flex align-items-center justify-content-center mb-3" style="width: 90px; height: 90px; border-radius: 50px;"><i class="fa fa-map-marker-alt fa-2x text-primary"></i></div>
            <div class="ms-4">
                <img src="<?= $rev->getUrlCaptura() ?>"
                    alt="<?= $reviewsRepository->getVideojuego($rev)->getNombre() ?>"
                    title="<?= $reviewsRepository->getVideojuego($rev)->getNombre() ?>"
                    height="200px">
            </div>
            <div class="ms-4">
                <h4><?= $rev->getTitulo() ?></h4>
                <p class="mb-0"><?= $rev->getComentario() ?></p>
                <p><small><?= $reviewsRepository->getAutor($rev)->getUsername() ?></small></p>
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <p class="mb-0">Anímate y sé el primero en comentar</p>
<?php } ?>