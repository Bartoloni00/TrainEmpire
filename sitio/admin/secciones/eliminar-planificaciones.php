<?php
//require_once __DIR__.'/../../bootstrap/autoload.php';
$rutina = (new Rutinas)->porId($_GET['id']);
?>
<div class="container">
    <h1>Confirmación de Eliminar</h1>

    <p class="msg-error">Estás por eliminar esta rutina de manera definitiva. Para poder proceder, es necesario que confirmes la acción.</p>

    <article class="detalles_producto">
        <div>
            <img src="../assets/productos/<?= $rutina->getImagen();?>" alt="planificacion de <?= $rutina->getCategoria(); ?>">
            <div>
                <h2><?= $rutina->getTitulo();?></h2>
                <span class="precio">$ <?= $rutina->getPrecio(); ?></span>
                <span class="entrenador">Entrenador: <?= $rutina->getusuarios_fk(); ?></span>
                <p><?= $rutina->getDescripcion(); ?></p>
            </div>
        </div>
    </article>
    <!-- Si tenemos un form por POST, podemos pasarle algún dato que necesitemos en la URL por el
                 query string. -->
    <form action="acciones/eliminar-planificacion.php?id=<?= $rutina->getId();?>" method="post" class="form-eliminar">
        <button type="submit" class="btn btn-danger ">Eliminar</button>
    </form>
</div>
