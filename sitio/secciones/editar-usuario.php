<?php
$usuario = (new Autenticacion)->getUsuario();
?>
<section class="mi-perfil d-flex flex-column align-items-center">
    <h1 class="text-center">Editar usuario</h1>
    <form action="acciones/editar-usuario.php" method="post" enctype="multipart/form-data" class="w-50">
        <div class="mb-3">
            <?php if ($usuario->getImagen() != null):?>
                <div class="mb-3 d-flex justify-content-center">
                    <img src="assets/entrenadores/<?=$usuario->getImagen();?>" alt="foto de perfil del usuario <?=$usuario->getUsername(); ?>" class="img-editar">
                </div>
            <?php endif;?>
            <label class="form-label" for="imagen">Foto de perfil:</label>
            <input type="file" id="imagen" name="imagen" class="form-control">
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Username: <span class="opcional">(opcional)</span></label>
            <input type="text" name="username" id="username" value="<?=$usuario->getUsername()??'';?>" class="form-control">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="text" name="email" id="email" value="<?=$usuario->getEmail()??'';?>" class="form-control">
        </div>
        <div class="mt-3 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Editar datos</button>
        </div>
    </form>
</section>
