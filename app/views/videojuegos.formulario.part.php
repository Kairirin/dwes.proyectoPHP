 <!-- Feature Start -->
 <div class="container-fluid feature overflow-hidden py-5">
     <div class="container py-5">
         <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 900px;">
             <h4 class="text-primary">Oops</h4>
             <h1 class="display-5 mb-4">Añadir nuevo juego a la web</h1>
         </div>

         <div class="justify-content-center text-center mb-5">
             <?php include __DIR__ . '/show-error.part.view.php'; ?>
             <form class="form-horizontal" action="/videojuegos/nuevo" method="post" enctype="multipart/form-data">
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
                                         <option value="<?= $plat->getId() ?>"
                                             <?= ($platSelec == $plat->getId()) ? 'selected' : '' ?>><?= $plat->getNombre() ?></option>
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