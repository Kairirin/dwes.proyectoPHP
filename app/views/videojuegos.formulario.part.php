 <!-- Feature Start -->
 <div class="container-fluid feature overflow-hidden py-5">
     <div class="container py-5">
         <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
             <h4 class="text-primary">Oops</h4>
             <h1 class="display-5 mb-4">¿Se nos ha olvidado algún juego importante para ti?</h1>
             <p class="mb-0">Rellena el formulario y añade tus videojuegos favoritos
             </p>
         </div>

         <div class="justify-content-center text-center mb-5">
             <!-- Sección que muestra la confirmación del formulario o bien sus errores -->
             <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') : ?>
                 <div class="alert alert-<?= empty($errores) ? 'info' : 'danger'; ?> alert-dismissible" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">x</span>
                     </button>
                     <?php if (empty($errores)) : ?>
                         <p><?= $mensaje ?></p>
                     <?php else : ?>
                         <ul>
                             <?php foreach ($errores as $error) : ?>
                                 <li><?= $error ?></li>
                             <?php endforeach; ?>
                         </ul>
                     <?php endif; ?>
                 </div>
             <?php endif; ?>
             <!-- Formulario que permite subir una imagen con su descripción -->
             <!-- Hay que indicar OBLIGATORIAMENTE enctype="multipart/form-data" para enviar ficheros al servidor -->
             <form clas="form-horizontal" action="<?= $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                 <div class="form-group">
                     <div class="col-xs-12">
                         <label class="label-control">Imagen</label>
                         <input class="form-control-file" type="file" name="imagen">
                     </div>
                 </div>
                 <div class="form-group">
                     <div class="col-xs-12">
                         <label class="label-control">Título</label>
                         <input type="text" class="form-control" id="titulo" name="titulo" value="<?= $titulo ?> ">
                         <div class="form-group">
                             <label class="label-control">Plataforma</label>
                             <div class="col-xs-12">
                                 <select class="form-control" name="plataforma">
                                     <?php foreach ($plataformas as $plat) : ?>
                                         <option value="<?= $plat->getCod() ?>"><?= $plat->getNombre() ?></option>
                                     <?php endforeach; ?>
                                 </select>
                             </div>
                         </div>
                         <button class="pull-right btn btn-lg sr-button">ENVIAR</button>
                     </div>
                 </div>
             </form>
         </div>
     </div>
 </div>
 <!-- Feature End -->