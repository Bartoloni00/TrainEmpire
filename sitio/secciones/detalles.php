<?php 
 $rutina = (new Rutinas)->porId($_GET['id']);
 $autenticacion = (new Autenticacion);
?>
    <div class="detalles_producto">
        <span><a href="index.php?s=productos">planificaciones</a> > <a href="index.php?s=productos&c=<?= $rutina->getCategoria();?>"><?= $rutina->getCategoria(); ?></a></span>
        <div>
        <img src="assets/productos/<?=$rutina->getImagen()?$rutina->getImagen():'defecto.jpg';?>" class="card-img-top" alt="planificacion de <?= $rutina->getTitulo(); ?>">
            <div>
                <h1><?= $rutina->getTitulo();?></h1>
                <span class="precio">$ <?= $rutina->getPrecio(); ?></span>
                <!-- <span class="entrenador">Entrenador: <?= $rutina->getusuarios_fk(); ?></span> -->
                <p><?= $rutina->getDescripcion(); ?></p>
                <?php if($autenticacion->estaAutenticado()):?>
                <form action="acciones/anadir-carrito.php" method="post">
                    <input type="hidden" name="id_producto" value="<?=  $rutina->getId() ;?>">
                    <button type="submit" class="btn-contacto">
                        Añadir al carrito
                    </button>
                </form>
                <?php else:?>
                <a href="index.php?s=login" class="btn-contacto">Añadir al carrito</a>
                <?php endif;?>
            </div>
        </div>
    </div>
