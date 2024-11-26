<?php if ($reviews != null) { ?>
    <?php foreach ($reviews as $rev) { ?>
        <div class="testimonial-item" data-dot="<img class='img-fluid' src='<?= $rev->getUrlCaptura() ?>' alt=''>">
            <div class="testimonial-inner text-center p-5">
                <div class="d-flex align-items-center justify-content-center mb-4">
                    <div class="testimonial-inner-img border border-primary border-3 me-4" style="width: 100px; height: 100px; border-radius: 50%;">
                    <img src="<?= $reviewsRepository->getAutor($rev)->getUrlAvatar() ?>" class="img-fluid rounded-circle" alt="">
                    </div>
                    <div>
                        <h5 class="mb-2"><?= $rev->getTitulo() ?></h5>
                        <p class="mb-0"><?= $reviewsRepository->getAutor($rev)->getUsername() ?></p>
                    </div>
                </div>
                <div class="w-50 text-center aux">
                <p class="fs-7"><?= $rev->getComentario() ?></p>
                    <img src="<?= $rev->getUrlCaptura() ?>" alt="">
                </div>
                <!--                 
                    <div class="d-flex justify-content-center">
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                        <i class="fas fa-star text-primary"></i>
                    </div>
                </div> -->
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <p class="mb-0">Anímate y sé el primero en comentar</p>
<?php } ?>