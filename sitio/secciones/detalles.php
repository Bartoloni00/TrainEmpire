<?php 
 $rutina = (new Rutinas)->porId($_GET['id']);
?>
    <div class="detalles_producto">
        <span><a href="index.php?s=productos">planificaciones</a> > <a href="index.php?s=productos&c=<?= $rutina->getCategoria();?>"><?= $rutina->getCategoria(); ?></a></span>
        <div>
            <img src="assets/productos/<?= $rutina->getImagen();?>" alt="planificacion de <?= $rutina->getCategoria(); ?>">
            <div>
                <h1><?= $rutina->getTitulo();?></h1>
                <span class="precio">$ <?= $rutina->getPrecio(); ?></span>
                <span class="entrenador">Entrenador: <?= $rutina->getusuarios_fk(); ?></span>
                <p><?= $rutina->getDescripcion(); ?></p>
                <a href="index.php?s=contacto&id=<?= $rutina->getId();?>" class="btn-contacto">Contratar ahora</a>
            </div>
        </div>
    </div>
