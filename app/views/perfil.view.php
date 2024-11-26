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
    <div class="container text-center py-5" style="max-width: 500px;">
        <div class="testimonial-inner-img border border-primary border-3 me-4" style="width: 100px; height: 100px; border-radius: 50%;">
            <img src="<?= $user->getUrlAvatar() ?>" class="img-fluid rounded-circle" alt="">
        </div>
        <h3 class="display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s"><?= $user->getUsername() ?></h1>
    </div>
</div>
<!-- Header End -->

<div class="container-fluid contact py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.1s">
                <h2 class="display-5 mb-2">Modificar perfil</h2>
                <form action="/perfil/<?= $user->getId() ?>/modif" method="post" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-lg-12 col-xl-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de usuario">
                                <label for="username">Username</label>
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                                <label for="password">Contraseña</label>
                            </div>
                        </div>
                        <div class="col-12 col-xl-6">
                            <label class="label-control">Avatar</label>
                            <input class="form-control-file" type="file" name="avatar">
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.3s">
                <h2 class="display-5 mb-2">Mis reseñas</h2>
                <?php if ($reviews != null) { ?>
                    <?php foreach ($reviews as $rev) { ?>
                        <div class="d-flex align-items-center mb-4">
                            <div class="bg-light d-flex align-items-center justify-content-center mb-3" style="width: 90px; height: 90px; border-radius: 50px;"><img src="<?= $rev->getUrlCaptura() ?>" alt="" class="h-50"></div>
                            <div class="ms-4">
                                <h4><?= $rev->getTitulo() ?></h4>
                                <a href="/videojuegos/<?= $reviewsRep->getVideojuego($rev)->getId() ?>"><?= $reviewsRep->getVideojuego($rev)->getNombre() ?></a>
                                <p class="mb-0"><?= $rev->getComentario() ?></p>
                                <i class="fas fa-pen"></i>
                                <a href="/comentario/<?=$rev->getId()?>/borrar"><i class="fas fa-trash-alt"></i></a>
                            </div>
                        </div>
                    <?php } ?>
                <?php } else { ?>
                    <p class="mb-0">Anímate y participa</p>
                <?php } ?>
            </div>
        </div>
    </div>
</div>