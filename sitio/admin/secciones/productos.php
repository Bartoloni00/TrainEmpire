<?php

//require_once __DIR__.'/../../bootstrap/autoload.php';
$rutinas = (new Rutinas)->todo();
if ($autenticacion->getUsuario()->getRolFk() != 1) {
    $filtrado = (new Filtro)->filtradoPorEntrenador($rutinas,$autenticacion->getUsuario()->getIdUsuario());
    $rutinas = $filtrado;
}
?>
<section>
    <h1>Administrador de Rutinas</h1>
    <div>
        <a href="index.php?s=anadir-planificaciones" class="btn btn-primary m-auto">Crear rutina</a>
    </div>

    <table class="table">
    <thead class="thead-dark">
        <tr>
            <?php if($autenticacion->getUsuario()->getRolFk() === 1):?>
                <th class="esconder-movile">Creador</th>
            <?php endif;?>
            <th>Título</th>
            <th class="esconder-tablet">Síntesis</th>
            <th class="esconder-tablet">Imagen</th>
            <th class="esconder-movile">Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($rutinas as $rutina):?>
        <tr>
            <?php if($autenticacion->getUsuario()->getRolFk() === 1):?>
                <td class="esconder-movile"><?=$rutina->getusuarios_fk();?></td>
            <?php endif;?>
            <td><?=$rutina->getTitulo();?></td>
            <td class="esconder-tablet"><?=$rutina->getSintesis();?></td>
            <td class="esconder-tablet">
                <img src="../assets/productos/<?=$rutina->getImagen()?$rutina->getImagen():'defecto.jpg';?>" 
                     alt="Rutina de <?= $rutina->getCategoria()?> realizada por <?= $rutina->getusuarios_fk()?>" 
                     class="img-admin">
            </td>
            <td class="esconder-movile">$ <?=$rutina->getPrecio();?></td>
            <td>
                <a href="index.php?s=editar-planificaciones&id=<?= $rutina->getId();?>" class="btn btn-warning">Editar</a>
                <a href="index.php?s=eliminar-planificaciones&id=<?= $rutina->getId();?>" class="btn btn-danger">Eliminar</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
</section>