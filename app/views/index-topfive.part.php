<?php if ($lista != null) { ?>
    <p class="mb-0">¿Qué apasiona a nuestros usuarios?
    </p>
    <?php foreach ($lista as $videojuego) { ?>
        <?php //foreach (array(1, 2, 3, 4, 5) as $valor) { 
        ?>
        <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="0.1s">
            <div class="text-center p-4">
                <div class="d-inline-block rounded bg-light p-4 mb-4"><i class="fas fa-envelope fa-5x text-secondary"></i></div>
                <div class="feature-content">
                    <a href="single-game/<?= $videojuego->getNombre() ?>" class="h4"><?= $videojuego->getNombre() ?><i class="fa fa-long-arrow-alt-right"></i></a> <!--Enlace al detalle del juego y su titulo-->
                    <p class="mt-4 mb-0">Plataforma: <?= $videojuego->getPlataforma() ?></p> <!--Hacer más párrafos, que coja plataforma, genero, cantidad de comentarios y ¿puntuación global?-->
                    <p class="mt-4 mb-0">Cantidad de reviews: <?= $videojuego->getNumRevs() ?></p>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <p class="mb-0">Anímate y sé el primero en aportar tu videojuego favorito
    </p>
<?php } ?>
<!-- FALTA POR PROBAR CON BASE DE DATOS -> los videojuegos que tengan más comentarios y los presente en orden. -->