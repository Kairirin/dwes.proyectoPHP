<div class="container-fluid py-5">
    <div class="container py-5 text-center">
        <div class="row justify-content-center" id="error">
            <div class="col-lg-6 wow fadeInUp container" data-wow-delay="0.3s">
                <i class="bi bi-exclamation-triangle display-1 text-secondary"></i>
                <h1><?= $httpHeaderMessage ?></h1>
                <p><?= $errorMessage ?></p>
                <a class="btn btn-primary rounded-pill py-3 px-5" href="/">Volver</a>
            </div>
        </div>
    </div>
</div>