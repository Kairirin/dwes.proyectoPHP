<!DOCTYPE html>
<html lang="en">

<?php require_once __DIR__ . '/inicio.part.php'; ?>

<body>

    <?php require_once __DIR__ . '/navegacion.part.php'; ?>

    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <ul class="breadcrumb-animation">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <div class="container text-center py-5" style="max-width: 900px;">
            <h3 class="display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Videojuegos</h1>
                <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <!--APLICAR FILTROS-->
                    <li class="breadcrumb-item"><a href="#">Playstation</a></li>
                    <li class="breadcrumb-item"><a href="#">Xbox</a></li>
                    <li class="breadcrumb-item"><a href="#">Nintendo</a></li>
                    <li class="breadcrumb-item"><a href="#">Retro</a></li>
                </ol>
        </div>
    </div>
    <!-- Header End -->


    <!-- Pricing Start -->
    <div class="container-fluid price py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
                <h4 class="text-primary">¿Lo buscas todo? Aquí lo tienes</h4>
                <h1 class="display-5 mb-4">Explora sin límites</h1>
            </div>
            <div class="row g-5 justify-content-center">

                <?php foreach ($videojuegos as $juego) : ?>
                    <div class=" col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="tarjeta price-item bg-light rounded text-center">
                            <div class="text-center text-dark border-bottom d-flex flex-column justify-content-center p-4" style="width: 100%; height: 100px;">
                                <p class="fs-2 fw-bold text-uppercase mb-0"><?= $juego->getNombre() ?></p>
                            </div>
                            <img src="<?= $juego->getUrlPortada() ?>"
                                alt="<?= $juego->getNombre() ?>"
                                title="<?= $juego->getNombre() ?>">
                            <!-- <div class="tarjeta d-flex justify-content-center">
                            </div> -->
                            <div class="text-start p-5">
                                <p><i class="fas fa-check text-success me-1"></i> Plataforma: <?= $juego->getPlataforma() ?></p>
                                <p><i class="fas fa-check text-success me-1"></i> Reviews: <?= $juego->getNumRevs() ?></p>
                                <button class="btn btn-light rounded-pill py-2 px-5" type="button">Ver reviews</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- Pricing End -->

    <?php require_once __DIR__ . '/videojuegos.formulario.part.php'; ?>

    <?php require_once __DIR__ . '/fin.part.php'; ?>
</body>
</html>