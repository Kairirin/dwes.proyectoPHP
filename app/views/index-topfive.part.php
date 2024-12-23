<?php if ($lista != null) { ?>
    <p class="mb-0">¿Qué apasiona a nuestros usuarios?
    </p>
    <?php foreach ($lista as $videojuego) { ?>
        <?php if ($videojuego->getNumRevs() != 0) { ?>
            <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
                <div class="text-center p-4">
                    <div class="d-inline-block rounded bg-light p-4 mb-4">
                        <img src="<?= $videojuego->getUrlPortada() ?>"
                            alt="<?= $videojuego->getNombre() ?>"
                            title="<?= $videojuego->getNombre() ?>"
                            height="200px">
                    </div>
                    <div class="feature-content">
                        <a href="single-game/<?= $videojuego->getNombre() ?>" class="h4"><?= $videojuego->getNombre() ?><i class="fa fa-long-arrow-alt-right"></i></a> <!--Enlace al detalle del juego y su titulo-->
                        <p class="mt-4 mb-0">Plataforma: <?= $juegosRepository->getPlataforma($videojuego)->getNombre() ?></p> <!--Hacer más párrafos, que coja plataforma, genero, cantidad de comentarios y ¿puntuación global?-->
                        <p class="mt-4 mb-0">Cantidad de reviews: <?= $videojuego->getNumRevs() ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
<?php } else { ?>
    <p class="mb-0">Anímate y sé el primero en aportar tu videojuego favorito
    </p>
<?php } ?>