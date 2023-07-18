<?php
$usuario = (new Autenticacion)->getUsuario();
$rutinas = (new Rutinas)->todo();
if ($autenticacion->getUsuario()->getRolFk() != 1) {
    $filtrado = (new Filtro)->filtradoPorEntrenador($rutinas,$autenticacion->getUsuario()->getIdUsuario());
    $rutinas = $filtrado;
}
?>
<section class="mi-perfil">
    <h1>Mi perfil</h1>
    <div>
        <section>
            <h2>Mis datos</h2>
            <div>
            <img src="assets/entrenadores/<?=$usuario->getImagen()?$usuario->getImagen():'defecto.png';?>" class="card-img-top" alt="Foto de perfil del usuario <?= $usuario->getUsername()?$usuario->getUsername():$usuario->getEmail();?>">
            </div>
            <div class="datos">
                <h3><b><?= $usuario->getUsername()??'No tienes nombre de usuario';?></b></h3>
                <span><?=$usuario->getEmail();?></span>
            </div>
            <a href="index.php?s=editar-usuario" class="btn-contacto">Editar datos</a>
        </section>
        <section>
            <h2>Mis productos</h2>
        <ul>
            <?php foreach ($rutinas as $rutina):?>
                <li>
                    <?= $rutina->getTitulo();?>
                    <a href="index.php?s=detalles&id=<?= $rutina->getId();?>" class="btn-contacto">ver mas</a>
                </li>
            <?php endforeach;?>
        </ul>
        </section>
    </div>
</section>