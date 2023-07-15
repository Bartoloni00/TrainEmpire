<?php
$usuario = (new Usuario)->porId($_GET['id']);
?>
<p class="msg-error"><strong>Estás por eliminar este usuario de manera definitiva.</strong> Para poder proceder, es necesario que confirmes la acción.</p>
<section class="mi-perfil">
    
    <h1>Confirmacion para eliminar usuario</h1>
    <div>
        <section>
            <h2>Datos del usuario a eliminar</h2>
            <div>
            <img src="../assets/entrenadores/<?=$usuario->getImagen()?$usuario->getImagen():'defecto.png';?>" class="card-img-top" alt="Foto de perfil del usuario <?= $usuario->getUsername()?$usuario->getUsername():$usuario->getEmail();?>">
            </div>
            <div class="datos">
                <span><b>Username</b>: <?= $usuario->getUsername()??'No posee nombre de usuario';?></span>
                <span><b>Email</b>: <?=$usuario->getEmail();?></span>
            </div>
            <form action="acciones/eliminar-usuario.php?id=<?= $usuario->getIdUsuario();?>" method="post" class="form-eliminar">
                <button type="submit" class="btn btn-danger ">Eliminar</button>
            </form>
        </section>
    </div>
</section>