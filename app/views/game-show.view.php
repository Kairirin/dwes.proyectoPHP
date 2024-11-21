    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb mb-0">
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
            <h3 class="display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s"><?= $videojuego->getNombre() ?></h1>
                <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="/playstation">Playstation</a></li>
                    <li class="breadcrumb-item"><a href="/xbox">Xbox</a></li>
                    <li class="breadcrumb-item"><a href="/nintendo">Nintendo</a></li>
                    <li class="breadcrumb-item"><a href="/retro">Retro</a></li>
                </ol>
        </div>
    </div>
    <!-- Header End -->

    <div class="container-fluid price py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                    <h2 class="display-5 mb-2"><?= $videojuego->getNombre() ?></h2>
                    <p class="mb-4"><img src="<?= $videojuego->getUrlPortada() ?>" alt="<?= $videojuego->getNombre() ?>" title="<?= $videojuego->getNombre() ?>" width="50%">
                    <p class="mb-4">Reviews: <?= $videojuego->getNumRevs() ?></p>
                </div>
                <!--AQUÍ DENTRO TODAS LAS REVIEWS-->
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                    <div class="d-flex align-items-center mb-4">
                        <div class="bg-light d-flex align-items-center justify-content-center mb-3" style="width: 90px; height: 90px; border-radius: 50px;"><i class="fa fa-map-marker-alt fa-2x text-primary"></i></div>
                        <div class="ms-4">
                            <h4>Instituto</h4>
                            <p class="mb-0">IES San Vicente, San Vicente del Raspeig, Alicante</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="me-4">
                            <div class="bg-light d-flex align-items-center justify-content-center" style="width: 90px; height: 90px; border-radius: 50px;"><i class="fas fa-share fa-2x text-primary"></i></div>
                        </div>
                        <div class="d-flex">
                            <a class="btn btn-lg-square btn-primary rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-lg-square btn-primary rounded-circle mx-2" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-lg-square btn-primary rounded-circle mx-2" href=""><i class="fab fa-instagram"></i></a>
                            <a class="btn btn-lg-square btn-primary rounded-circle mx-2" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
            <h2 class="display-5 mb-2">Añade tu review</h2>
            <form class="form-horizontal" action="/comentario/nuevo" method="post" enctype="multipart/form-data">
                <div class="row g-3">
                    <div class="col-lg-12 col-xl-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="titulo" placeholder="Título">
                            <label for="titulo">Título</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Introduce comentario" id="comentario" style="height: 160px"></textarea>
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
    </div>