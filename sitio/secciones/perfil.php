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
                <span><b>Username</b>: <?= $usuario->getUsername()??'No tienes nombre de usuario';?></span>
                <span><b>Email</b>: <?=$usuario->getEmail();?></span>
            </div>
            <a href="" class="btn btn-danger">Editar datos</a>
        </section>
        <section>
            <h2>Mis productos</h2>
        <ul>
            <?php foreach ($rutinas as $rutina):?>
                <li>
                    <?= $rutina->getTitulo();?>
                    <a href="index.php?s=detalles&id=<?= $rutina->getId();?>" class="btn btn-danger">ver mas</a>
                </li>
            <?php endforeach;?>
        </ul>
        </section>
    </div>
</section>