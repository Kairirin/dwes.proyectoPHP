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
        <h3 class="display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Registro</h1>
    </div>
</div>

<div id="login">
    <div class="container text-center">
        <div class="col-xs-12 col-sm-8 col-sm-push-2">
            <hr>
            <?php include __DIR__ . '/show-error.part.view.php' ?>
            <form clas="form-horizontal" action="/check-registro" method="post">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Username</label>
                        <input class="form-control" type="text" name="username" value="<?= $username ?? '' ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <label class="label-control">Contraseña</label>
                        <input class="form-control" name="password" type="password">
                        <label class="label-control">Repite contraseña</label>
                        <input class="form-control" name="re-password" type="password">
                    </div>
                </div>
                <!-- CAPTCHA -->
                <label class="label-control">Introduce el captcha <br> <img style="border: 1px solid #D3D0D0 " src="/app/utils/captcha.php" id='captcha'></label>
                <input class="form-control" type="text" name="captcha">
                <button class="pull-right btn btn-lg sr-button">ENVIAR</button>
            </form>
        </div>
    </div>
</div>