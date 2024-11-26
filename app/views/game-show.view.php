<div class="container-fluid testimonial py-5">
    <div class="container py-5">
<!-- show-game" style="background-image: url(<?= $videojuego->getUrlPortada() ?>);" -->
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
            <h4 class="text-primary">Reviews: <?= $videojuego->getNumRevs() ?></h4>
            <h1 class="display-5 mb-4"><?= $videojuego->getNombre() ?></h1>
        </div>
        <div class="testimonial-carousel owl-carousel wow zoomInDown" data-wow-delay="0.2s">
            <?php require_once __DIR__ . '/review.part.view.php' ?>
        </div>
    </div>
</div>
<div class="col-lg-6 wow fadeInLeft newReview" data-wow-delay="0.1s">
    <?php include __DIR__ . '/show-error.part.view.php'; ?>
    <h2 class="display-5 mb-2">Añade tu review</h2>
    <form class="form-horizontal" action="/videojuegos/<?= $videojuego->getId() ?>/nuevo" method="post" enctype="multipart/form-data">
        <div class="row g-3">
            <div class="col-lg-12 col-xl-6">
                <div class="form-floating">
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título">
                    <label for="titulo">Título</label>
                </div>
            </div>
            <div class="col-12">
                <div class="form-floating">
                    <textarea class="form-control" name="comentario" placeholder="Introduce comentario" id="comentario" style="height: 160px"></textarea>
                    <label for="comentario">Comentario</label>
                </div>
            </div>
            <div class="form-floating">
                <div class="col-xs-12">
                    <label class="label-control">Imagen</label>
                    <input class="form-control-file" type="file" name="imagen">
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary w-100 py-3">Enviar</button>
            </div>
        </div>
    </form>
</div>